<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PopupRequest;
use App\Models\Popup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Popup::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('popup.edit', $item->id) .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("popup.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photo', function ($item) {
                    return $item->picture ? '<img src="' . asset($item->getPhoto()) . '" style="max-width: 240px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }

        return view('pages.admin.popup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.popup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PopupRequest $request)
    {
        $data = $request->all();
        $data['picture'] = $request->file('picture')->store('assets/popup', 'public');

        Popup::create($data);

        return redirect()->route('popup.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Popup $popup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Popup $popup)
    {
        return view('pages.admin.popup.edit', ['item' => $popup]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Popup $popup)
    {
        $data = $request->all();

        $data['picture'] = $request->has('picture') ? $request->file('picture')->store('assets/promo', 'public') : $popup->picture;

        $popup->update($data);

        return redirect()->route('popup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Popup $popup)
    {
        $popup->delete();
        return back();
    }
}
