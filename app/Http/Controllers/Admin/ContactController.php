<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Contact::query();
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-bs-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a href="' . route('contact.create') .  '" class="dropdown-item">Sunting</a>
                                    <form action="' . route("contact.destroy", $item->id) .  '" method="POST">
                                        ' . method_field('DELETE') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contact = Contact::first();
        return view('pages.admin.contact.create_update', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $contact = Contact::first();
        Contact::updateOrCreate(['id' => @$contact->id], $request->all());
        return redirect(route('contact.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $contact = Contact::first();
        return view('pages.admin.contact.create_update', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $contact = Contact::first();
        Contact::updateOrCreate(['id' => $contact->id], $request->all());
        return redirect(route('contact.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back();
    }
}
