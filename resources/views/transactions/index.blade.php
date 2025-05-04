@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Transaksi Kasir</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->nama_pelanggan }}</td>
                        <td>{{ $transaction->nama_barang }}</td>
                        <td>Rp {{ number_format($transaction->harga, 0, ',', '.') }}</td>
                        <td>{{ $transaction->kuantitas }}</td>
                        <td>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-active">
                    <th colspan="5">Total Keseluruhan</th>
                    <th colspan="2">Rp {{ number_format($totalHargaAll, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection