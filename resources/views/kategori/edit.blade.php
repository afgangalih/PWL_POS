@extends('layouts.template')

@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori_kode">Kode Kategori</label>
                <input type="text" name="kategori_kode" class="form-control" value="{{ old('kategori_kode', $kategori->kategori_kode) }}" required>
            </div>
            <div class="form-group">
                <label for="kategori_nama">Nama Kategori</label>
                <input type="text" name="kategori_nama" class="form-control" value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
