<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $totalHargaAll = $transactions->sum('total_harga');
        return view('transactions.index', compact('transactions', 'totalHargaAll'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
        ]);

        $total_harga = $request->harga * $request->kuantitas;

        Transaction::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'kuantitas' => $request->kuantitas,
            'total_harga' => $total_harga,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required|numeric|min:0',
            'kuantitas' => 'required|integer|min:1',
        ]);

        $total_harga = $request->harga * $request->kuantitas;

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'kuantitas' => $request->kuantitas,
            'total_harga' => $total_harga,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}