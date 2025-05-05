@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Selamat Datang, {{ $user->nama }}</h3>
    </div>
    <div class="card-body">
        <p>Level: {{ $user->level->level_nama }}</p>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
</div>
@endsection
