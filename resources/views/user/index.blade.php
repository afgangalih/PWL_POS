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

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url(('user/create_ajax')) }}')" class="btn btn-sm-btn-success mt-1">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-4">
                <label for="level_id">Filter:</label>
                <select class="form-control" id="level_id" name="level_id">
                    <option value="">- Semua -</option>
                    @foreach($level as $item)
                        <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Level Pengguna</small>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-
backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = ''){
$('#myModal').load(url,function(){
$('#myModal').modal('show');
});
}
$(document).ready(function() {
    var dataUser = $('#table_user').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url": "{{ route('user.list') }}",
            "dataType": "json",
            "type": "POST",
            "headers": {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            "data": function(d) {
                d.level_id = $('#level_id').val();
            }
        },
        columns: [
            { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
            { data: "username", orderable: true, searchable: true },
            { data: "nama", orderable: true, searchable: true },
            { data: "level.level_nama", orderable: false, searchable: false },
            { data: "aksi", className: "text-center", orderable: false, searchable: false }
        ]
    });



    $('#level_id').on('change', function() {
        dataUser.ajax.reload();
    });
});
</script>
@endpush
