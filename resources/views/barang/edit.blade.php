@extends('layouts.template')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Barang</h1>
            </div>
        </div>
    </div>
</section>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Edit Barang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->barang_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" name="barang_kode" class="form-control" value="{{ $barang->barang_kode }}" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="barang_nama" class="form-control" value="{{ $barang->barang_nama }}" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control">
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->kategori_id }}" {{ $kat->kategori_id == $barang->kategori_id ? 'selected' : '' }}>
                            {{ $kat->kategori_nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}" required>
            </div>
            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

@endsection
