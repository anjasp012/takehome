<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('galleries')->paginate(32);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function details($slug)
    {
        $categories = Category::all();
        $categoryId = Category::whereSlug($slug)->firstOrFail();
        $products = Product::with('galleries')->where('category_id', $categoryId->id)->paginate(32);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
