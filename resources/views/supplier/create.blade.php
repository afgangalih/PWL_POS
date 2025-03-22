@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Supplier</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="supplier_kode">Kode Supplier</label>
                <input type="text" name="supplier_kode" class="form-control" required maxlength="10">
            </div>
            <div class="form-group">
                <label for="supplier_name">Nama Supplier</label>
                <input type="text" name="supplier_name" class="form-control" required maxlength="100">
            </div>
            <div class="form-group">
                <label for="supplier_alamat">Alamat</label>
                <textarea name="supplier_alamat" class="form-control" maxlength="255"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
