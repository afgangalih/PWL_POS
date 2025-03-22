@extends('layouts.template')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Barang</h3>
        <div class="card-tools">
            <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th width="200">ID Barang</th>
                <td>{{ $barang->barang_id }}</td>
            </tr>
            <tr>
                <th>Kode Barang</th>
                <td>{{ $barang->barang_kode }}</td>
            </tr>
            <tr>
                <th>Nama Barang</th>
                <td>{{ $barang->barang_nama }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $barang->kategori_nama }}</td>
            </tr>
            <tr>
                <th>Harga Beli</th>
                <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Harga Jual</th>
                <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $barang->stok ?? 0 }}</td>
            </tr>
            <tr>
                <th>Ditambahkan pada</th>
                <td>{{ $barang->created_at ?? '-' }}</td>
            </tr>
            <tr>
                <th>Terakhir diperbarui</th>
                <td>{{ $barang->updated_at ?? '-' }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection