<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HeaderCategory;
use App\Models\SubCategory;
use App\Models\SubHeaderCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function headerCategories()
    {
        return HeaderCategory::all();
    }

    public function subHeaderCategories(string $header_category_id)
    {
        return SubHeaderCategory::where('header_category_id', $header_category_id)->get();
    }

    public function categories(string $sub_header_category_id)
    {
        return Category::where('sub_header_category_id', $sub_header_category_id)->get();
    }
}
