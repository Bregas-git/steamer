<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);

        return view('sellers.products')
            ->with('products', $products);
    }

    public function show($id)
    {
        $product = $this->product->findOrfail($id);

        return view('sellers.product-view')
            ->with('product', $product);
    }

    public function reject($id)
    {
        $product = $this->product->findOrfail($id);

        $product->approval = Product::PRODUCT_APPROVAL_REJECTED;
        $product->save();

        return redirect()->route('seller.index.product');
    }

    public function approve($id)
    {
        $product = $this->product->findOrfail($id);

        $product->approval = Product::PRODUCT_APPROVAL_ACCEPTED;
        $product->save();

        return redirect()->route('seller.index.product');
    }
}
