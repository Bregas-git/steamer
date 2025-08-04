<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    private $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }


    public function index()
    {
        $all_categories = $this->categories->latest()->paginate(8);
        $max_count = $all_categories->count();

        return view('admin.categories.index')
                ->with('all_categories', $all_categories)
                ->with('max_count', $max_count);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'min:3|unique:categories,name'
        ]);

        $this->categories->name = ucfirst($request->name);
        $this->categories->save();

        return redirect()->back();
    }

    public function edit(Request $request, $id)
    {
        $category = $this->categories->findOrFail($id);

        $request->validate([
            'name' => 'min:3|unique:categories,name,'. $category->id
        ]);

        $category->name = $request->name;

        $category->save();

        return redirect()->back();
    }
}
