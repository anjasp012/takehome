<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = User::find(auth()->user()->id);
        $categories = Category::all();
        return view('pages.dashboard-settings', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function storeupdate(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update($request->all());
        return back();
    }

    public function account()
    {
        $user = User::find(auth()->user()->id);
        return view('pages.dashboard-account', [
            'user' => $user
        ]);
    }

    public function accountupdate(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->update($request->all());
        return redirect()->back();
    }
}
