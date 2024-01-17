<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(12);
        return view('pages.blog', [
            'articles' => $articles
        ]);
    }

    public function show(string $slug)
    {
        $article = Article::whereSlug($slug)->firstOrFail();
        return view('pages.blog-detail', [
            'article' => $article
        ]);
    }
}
