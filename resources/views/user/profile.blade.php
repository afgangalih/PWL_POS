@extends('layouts.template')

@section('content')
<div class="container-fluid">
 

    <div class="card shadow p-4">
        <div class="row">
            <!-- Kolom Foto Profil -->
            <div class="col-md-4 border-right text-center d-flex flex-column align-items-center">
                <img src="{{ $user->profil_picture ? asset('storage/'.$user->profil_picture) : asset('img/default-profile.png') }}"
                     alt="Foto Profil"
                     class="rounded-circle mb-3 shadow"
                     style="width: 180px; height: 180px; object-fit: cover;">

                <span class="badge badge-success mb-3">Akun Aktif</span>

                <form action="{{ url('/user/update_picture') }}" method="POST" enctype="multipart/form-data" class="w-100 px-4">
                    @csrf
                    <div class="form-group text-left">
                        <label for="profil_picture"><strong>Ganti Foto</strong></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profil_picture" name="profil_picture" accept="image/*">
                            <label class="custom-file-label" for="profil_picture">Pilih file</label>
                        </div>
                        @error('profil_picture')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-2">Upload</button>
                </form>

                <div class="mt-4 px-4 text-left">
                    <h6><strong>Tentang Pengguna</strong></h6>
                    <p class="text-muted small">
                        Selamat datang, {{ $user->nama }}. Kamu saat ini login sebagai <strong>{{ $user->level->level_nama ?? '-' }}</strong>. Pastikan data kamu selalu diperbarui.
                    </p>
                </div>
            </div>

            <!-- Kolom Data User -->
            <div class="col-md-8 pl-md-5">
                <h4 class="mb-4">Informasi Akun</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-user mr-2 text-primary"></i>
                        <strong>Username:</strong> {{ $user->username }}
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-id-card mr-2 text-primary"></i>
                        <strong>Nama:</strong> {{ $user->nama }}
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-user-shield mr-2 text-primary"></i>
                        <strong>Level:</strong> {{ $user->level->level_nama ?? '-' }}
                    </li>
                </ul>

                <div class="mt-4">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#profil_picture').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);

            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('img.rounded-circle').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush
