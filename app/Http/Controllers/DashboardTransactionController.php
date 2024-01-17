<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])->latest()->whereHas('product', function ($product) {
            $product->where('user_id', Auth::user()->id);
        });
        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])->latest()->whereHas('transaction', function ($transaction) {
            $transaction->where('user_id', Auth::user()->id);
        });
        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions->get(),
            'buyTransactions' => $buyTransactions->get(),
        ]);
    }

    public function details($id)
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);
        return view('pages.dashboard-transactions-details', [
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $transaction = TransactionDetail::findOrFail($id);
        $data = $request->all();
        $transaction->update($data);
        return redirect()->route('dashboard-transaction-details', $id);
    }
}
