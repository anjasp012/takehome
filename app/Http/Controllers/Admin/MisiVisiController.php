<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MisiVisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class MisiVisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = MisiVisi::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('visimisi.create') .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("visimisi.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('description', function ($item) {
                    return $item->description;
                })
                ->rawColumns(['action', 'description'])
                ->make();
        }

        return view('pages.admin.misivisi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $misivisi = MisiVisi::first();
        return view('pages.admin.misivisi.create_update', compact('misivisi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => ['required']
        ]);
        $misivisi = MisiVisi::first();
        MisiVisi::updateOrCreate(['id' => @$misivisi->id], $request->all());
        return redirect(route('visimisi.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(MisiVisi $misiVisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MisiVisi $MisiVisi)
    {
        $misivisi = MisiVisi::first();
        return view('pages.admin.misivisi.create_update', compact('misivisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MisiVisi $misiVisi)
    {
        $request->validate([
            'description' => ['required']
        ]);
        $misivisi = MisiVisi::first();
        MisiVisi::updateOrCreate(['id' => $misivisi->id], $request->all());
        return redirect(route('visimisi.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($misiVisi)
    {
        $misiVisi = MisiVisi::first();
        $misiVisi->delete();
        return back();
    }
}
