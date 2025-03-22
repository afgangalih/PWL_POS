@extends('layouts.template')

@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Detail Kategori</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Kode Kategori</th>
                <td>{{ $kategori->kategori_kode }}</td>
            </tr>
            <tr>
                <th>Nama Kategori</th>
                <td>{{ $kategori->kategori_nama }}</td>
            </tr>
            <tr>
                <th>Dibuat Pada</th>
                <td>{{ $kategori->created_at }}</td>
            </tr>
            <tr>
                <th>Terakhir Diperbarui</th>
                <td>{{ $kategori->updated_at }}</td>
            </tr>
        </table>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
