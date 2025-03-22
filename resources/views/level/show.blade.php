@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Level</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">ID</dt>
            <dd class="col-sm-8">{{ $level->level_id }}</dd>

            <dt class="col-sm-4">Kode Level</dt>
            <dd class="col-sm-8">{{ $level->level_kode }}</dd>

            <dt class="col-sm-4">Nama Level</dt>
            <dd class="col-sm-8">{{ $level->level_nama }}</dd>
        </dl>
        <a href="{{ route('level.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
