<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private $user;
    private $products;
    private $wallet;

    public function __construct(User $user, Product $products, Wallet $wallet)
    {
        $this->user = $user;
        $this->products = $products;
        $this->wallet = $wallet;
    }

    public function index()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $products = $this->getProducts();

        return view('index')
            ->with('user', $user)
            ->with('products', $products);
    }

    public function profile()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('profile.index')
            ->with('user', $user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('profile.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:50|unique:users,name,' . Auth::user()->id,
            'email'   => 'required|email|unique:users,email,' . Auth::user()->id,
            'profpic' => 'mimes:jpeg,jpg,gif,png'
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->profpic) {
            $user->profpic = 'data:profpic/' . $request->profpic->extension() . ';base64,' . base64_encode(file_get_contents($request->profpic));
        }

        $user->save();

        return redirect()->route('profile');
    }

    public function getProducts()
    {
        $all_products = $this->products->latest()->get();

        $showable_product = [];

        foreach ($all_products as $product) {
            if ($product->approval == 1 || $product->approval == 2) {
                $showable_product[] = $product;
            }
        }

        return $showable_product;
    }

    public function addBalance(Request $request)
    {
        $request->validate([
            'balance' => 'required|integer|min:1'
        ]);

        //define the user
        $user = Auth::user();

        //check if user has wallet data in the table
        if ($user->wallet) {
            $user->wallet->balance = $user->wallet->balance + $request->balance;

            $user->wallet->save();
        } else {
            $this->wallet->user_id = Auth::user()->id;
            $this->wallet->balance = $request->balance;

            $this->wallet->save();
        }

        return redirect()->back();
    }
}
