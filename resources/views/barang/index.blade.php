@extends('layouts.template')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
              
            </div>
            <div class="col-sm-6">
              
            </div>
        </div>
    </div>
</section>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Data Barang</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary" href="{{ route('barang.create') }}">
                <i class="fa fa-plus"></i> Tambah Barang
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('js')
<script>
$(document).ready(function() {
    $('#table_barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('barang.list') }}",
            type: "GET"
        },
        columns: [
            { data: "barang_id", className: "text-center" },
            { data: "barang_kode", className: "text-center" },
            { data: "barang_nama" },
            { data: "kategori_nama" },
            { data: "harga_beli", className: "text-right" },
            { data: "harga_jual", className: "text-right" },
            { data: "aksi", className: "text-center", orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
