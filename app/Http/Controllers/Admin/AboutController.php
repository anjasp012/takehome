<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = About::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('about.create') .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("about.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('page_body', function ($item) {
                    return $item->page_body;
                })
                ->rawColumns(['action', 'page_body'])
                ->make();
        }

        return view('pages.admin.about.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $about = About::first();
        return view('pages.admin.about.create_update', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        // dd($about);
        $data = $request->all();
        $data['slug'] = Str::slug($request->page_title);
        $data['created_by'] = auth()->user()->id;
        $data['picture'] =  $request->file('picture')->store('assets/about', 'public');
        $about = About::first();
        About::updateOrCreate(['id' => @$about->id], $data);
        return redirect(route('about.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $about = About::first();
        return view('pages.admin.about.create_update', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();
        return back();
    }
}
