<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $product;
    private $user;
    private $transaction;
    private $wallet;
    private $library;

    public function __construct(Transaction $transaction, Product $product, User $user, Wallet $wallet, Library $library)
    {
        $this->transaction = $transaction;
        $this->product = $product;
        $this->user = $user;
        $this->wallet = $wallet;
        $this->library = $library;
    }

    public function cartIndex()
    {
        $all_transactions = $this->transaction->all();
        $cart_total_price = 0;

        foreach ($all_transactions as $transaction) {
            if ($transaction->pay_status == 1) {

                $cart_total_price = $cart_total_price + $transaction->total_price;
            }
            $total_price = $cart_total_price;
        }

        return view('cart')
            ->with('all_transactions', $all_transactions)
            ->with('total_price', $total_price);
    }

    public function buyProduct(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|max:1'
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);
        $product = $this->product->findOrFail($id);

        $total_price = $product->price * $request->amount;

        $this->transaction->amount = $request->amount;
        $this->transaction->total_price = $total_price;
        $this->transaction->product_id  = $product->id;
        $this->transaction->buyer_id    = $user->id;
        $this->transaction->pay_status  = Transaction::PAY_STATUS_PENDING;

        $this->transaction->save();

        return redirect()->route('cart.index');
    }

    public function makePayment()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        $buyer_balance = $user->wallet->balance; //buyer current balance

        //find the seller data
        $transactions = $this->transaction->where('buyer_id', Auth::user()->id)->where('pay_status' , 1)->get();

        //
        foreach ($transactions as $transaction) {
            $product = $this->product->findOrFail($transaction->product_id);
            $seller = $this->user->findOrFail($product->seller_id);

            if ($seller->wallet) {
                $seller->wallet->balance = $seller->wallet->balance + $transaction->total_price;

                $seller->wallet->save();
            } else {
                $this->wallet->user_id = $seller->id;
                $this->wallet->balance = $transaction->total_price;

                $this->wallet->save();
            }

            //Deduct user Balance
            $buyer_balance = $buyer_balance - $transaction->total_price;

            $transaction->pay_status = Transaction::PAY_STATUS_DONE;
            $transaction->save();
        }

        $user->wallet->balance = $buyer_balance;
        $user->wallet->save();

        return redirect()->route('index');
        //identify the seller thru the transaction table
        //$seller = $this->transaction->product->where('seller_id', $seller->id);
    }

    public function library()
    {
        $transactions = $this->transaction
                    ->where('buyer_id',Auth::user()->id)
                    ->where('pay_status', 2)
                    ->get()
                    ->groupBy('product_id');
                    //Group all transaction by product_id

        return view('library')
                ->with('transactions',$transactions);
    }
}
