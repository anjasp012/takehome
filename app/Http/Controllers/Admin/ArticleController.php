<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Article::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('news.edit', $item->id) .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("news.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->thumbnail ? '<img src="' . asset($item->getPhoto()) . '" style="max-width: 240px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }

        return view('pages.admin.article.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->title);
        $data['thumbnail'] = $request->file('thumbnail')->store('assets/article', 'public');
        Article::create($data);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Article::findOrFail($id);
        return view('pages.admin.article.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $id)
    {
        $item = Article::findOrFail($id);
        $data = $request->all();

        $data['thumbnail'] = $request->has('thumbnail') ? $request->file('thumbnail')->store('assets/article', 'public') : $item->thumbnail;

        $item->update($data);

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Article::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
