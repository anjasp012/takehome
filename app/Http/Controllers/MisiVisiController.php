<?php

namespace App\Http\Controllers;

use App\Models\MisiVisi;
use Illuminate\Http\Request;

class MisiVisiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $misivisi = MisiVisi::first();
        return view('pages.visimisi', compact('misivisi'));
    }
}
