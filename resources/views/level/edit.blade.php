@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Level</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('level.update', $level->level_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" name="level_kode" class="form-control @error('level_kode') is-invalid @enderror" value="{{ old('level_kode', $level->level_kode) }}" required>
                @error('level_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Level</label>
                <input type="text" name="level_nama" class="form-control @error('level_nama') is-invalid @enderror" value="{{ old('level_nama', $level->level_nama) }}" required>
                @error('level_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('level.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
