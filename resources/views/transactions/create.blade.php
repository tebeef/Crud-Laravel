@extends('layouts.app')

@section('title', 'Tambah Transaksi')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Tambah Transaksi Baru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" required>
                </div>
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Satuan</label>
                    <input type="number" class="form-control" id="harga" name="harga" min="0" step="100" required>
                </div>
                <div class="mb-3">
                    <label for="kuantitas" class="form-label">Kuantitas</label>
                    <input type="number" class="form-control" id="kuantitas" name="kuantitas" min="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection