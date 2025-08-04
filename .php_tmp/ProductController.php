<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $product;
    private $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index()
    {
        $products = $this->product->latest()->paginate(5);

        return view('sellers.products')
            ->with('products', $products);
    }

    public function create()
    {
        $categories = $this->category->all();

        return view('sellers.products-create')
            ->with('categories', $categories);
    }

    public function save(Request $request)
    {
        $request->validate([
            'cover_art'  => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'category'   => 'required|array|min:1',
            'title'      => 'required|max:50|unique:products,title',
            'price'      => 'required|integer',
            'description' => 'required|max:1000'
        ]);

        $this->product->seller_id = Auth::user()->id;
        $this->product->cover_art = 'data:cover/' . $request->cover_art->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_art));
        $this->product->title = $request->title;
        $this->product->price = $request->price;
        $this->product->description = $request->description;
        $this->product->approval = Product::PRODUCT_APPROVAL_WAIT;

        $this->product->save();

        foreach ($request->category as $category_id) {
            $category_product[] = ['category_id' => $category_id];
        }

        $this->product->categoryProduct()->createMany($category_product);

        return redirect()->route('seller.index.product');
    }

    public function show($id)
    {
        $product = $this->product->findOrfail($id);

        return view('sellers.product-view')
            ->with('product', $product);
    }

    public function edit($id)
    {
        $product = $this->product->findOrfail($id);
        $categories = $this->category->all();

        $selected_categories = [];

        foreach ($product->CategoryProduct as $category_product) {
            $selected_categories[] = $category_product->category_id;
        }

        return view('sellers.product-edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $product = $this->product->findOrFail($id);

        $request->validate([
            'cover_art'  => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'category'   => 'required|array|min:1',
            'title'      => 'required|max:50|unique:products,title',
            'price'      => 'required|integer',
            'description' => 'required|max:1000'
        ]);

        if($request->cover_art){
            $product->cover_art = 'data:cover/' . $request->cover_art->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_art));
        }

        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->save();

        $product->categoryProduct()->delete();

        foreach ($request->category as $category_id){
            $category_product[] = ['category_id' => $category_id];

        }

        $product->categoryProduct()->createMany($category_product);

        return redirect()->route('seller.show.product', $id);
    }
}
