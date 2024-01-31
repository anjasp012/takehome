<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('roles', '!=', 'ADMIN')->count();
        $revenue = Transaction::sum('total_price');
        $transaction = Transaction::count();
        return view('pages.admin.dashboard', [
            'users' => $users,
            'revenue' => $revenue,
            'transaction' => $transaction,
        ]);
    }

    public function changePassword()
    {
        return view('pages.admin.password');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        auth()->user()->update(
            [
                'password' => Hash::make($request->password),
            ]
        );
        return redirect(route('admin-dashboard'));
    }
}
