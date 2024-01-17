<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\HeaderCategoryRequest;
use App\Models\HeaderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

use function Clue\StreamFilter\fun;

class HeaderCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = HeaderCategory::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('header-category.edit', $item->id) .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("header-category.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . asset($item->getPhoto()) . '" style="max-width: 48px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }

        return view('pages.admin.header-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.header-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeaderCategoryRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');
        HeaderCategory::create($data);

        return redirect()->route('header-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = HeaderCategory::findOrFail($id);
        return view('pages.admin.header-category.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeaderCategoryRequest $request, string $id)
    {
        $item = HeaderCategory::findOrFail($id);
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo') ? $request->file('photo')->store('assets/category', 'public') : $item->photo;

        $item->update($data);

        return redirect()->route('header-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = HeaderCategory::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
