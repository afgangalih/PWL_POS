@extends('layouts.template')

@section('content')
<div class="card card-outline card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Supplier</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('supplier.update', $supplier->supplier_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supplier_kode">Kode Supplier</label>
                <input type="text" name="supplier_kode" class="form-control" value="{{ $supplier->supplier_kode }}" required maxlength="10">
            </div>
            <div class="form-group">
                <label for="supplier_name">Nama Supplier</label>
                <input type="text" name="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}" required maxlength="100">
            </div>
            <div class="form-group">
                <label for="supplier_alamat">Alamat</label>
                <textarea name="supplier_alamat" class="form-control" maxlength="255">{{ $supplier->supplier_alamat }}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
