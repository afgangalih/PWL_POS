@extends('layouts.template')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Barang</h1>
            </div>
        </div>
    </div>
</section>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Barang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="barang_kode" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="barang_nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control">
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->kategori_id }}">{{ $kat->kategori_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
