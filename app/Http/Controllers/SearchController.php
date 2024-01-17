<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request->query);
        $categories = Category::where('name', 'like', "%" . $request->cari . "%")->get();
        $products = Product::with('galleries')->where('name', 'like', "%$request->cari%")
            ->paginate(32);
        return view('pages.pencarian', [
            'categories' => $categories,
            'products' => $products,
            'cari' => $request->cari
        ]);
    }
}
