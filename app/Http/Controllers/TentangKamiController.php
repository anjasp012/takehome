<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tentangkami = About::first();
        return view('pages.tentangkami', compact('tentangkami'));
    }
}
