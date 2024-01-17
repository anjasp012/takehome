<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonyRequest;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\Facades\DataTables;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Testimony::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('testimony.edit', $item->id) .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("testimony.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->photo ? '<img src="' . asset($item->getPhoto()) . '" style="max-width: 120px;" />' : '';
                })
                ->editColumn('description', function ($item) {
                    return new HtmlString($item->description);
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }

        return view('pages.admin.testimony.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.testimony.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonyRequest $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/testimony', 'public');
        Testimony::create($data);

        return redirect()->route('testimony.index');
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
        $item = Testimony::findOrFail($id);
        return view('pages.admin.testimony.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonyRequest $request, string $id)
    {
        $item = Testimony::findOrFail($id);
        $data = $request->all();

        $data['photo'] = $request->file('photo') ? $request->file('photo')->store('assets/testimony', 'public') : $item->photo;

        $item->update($data);

        return redirect()->route('testimony.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Testimony::findOrFail($id);
        $item->delete();

        return redirect()->back();
    }
}
