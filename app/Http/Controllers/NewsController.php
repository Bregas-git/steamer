<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    private $news;
    private $user;
    private $product;

    public function __construct(News $news, User $user, Product $product)
    {
        $this->news    = $news;
        $this->user    = $user;
        $this->product = $product;
    }

    public function index()
    {
        $seller_news = $this->news->where('seller_id', Auth::user()->id)->get();

        return view('sellers.news.index')
            ->with('seller_news', $seller_news);
    }

    public function create()
    {
        $seller_products = $this->product->where('seller_id', Auth::user()->id)->get();

        return view('sellers.news.create')
            ->with('seller_products', $seller_products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'headline' => 'required|min:10',
            'content'  => 'required',
            'image'    => 'mimes:jpeg,jpg,gif,png'
        ]);

        $this->news->seller_id = Auth::user()->id;
        $this->news->headline = $request->headline;
        $this->news->product_id = $request->product_id;
        $this->news->content = $request->content;
        if ($request->hasFile('image')) {
            $this->news->image = 'data:news-img/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }
        $this->news->save();

        return redirect()->route('seller.news.index');
    }

    public function view($id)
    {
        $news = $this->news->findOrFail($id);

        return view('sellers.news.view')
            ->with('news', $news);
    }

    public function edit($id)
    {
        $news = $this->news->findOrFail($id);
        $seller_products = $this->product->where('seller_id', Auth::user()->id)->get();

        return view('sellers.news.edit')
            ->with('news', $news)
            ->with('seller_products', $seller_products);
    }
}
