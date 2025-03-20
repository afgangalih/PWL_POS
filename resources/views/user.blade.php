<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="{{ route('user.create') }}">Tambah User</a> <!-- Sesuaikan dengan rute baru -->
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>Level ID</td>
            <td>Level Kode</td>
            <td>Level Nama</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
            <td>{{ $d->level->level_kode ?? 'N/A' }}</td>
            <td>{{ $d->level->level_nama ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('user.edit', $d->user_id) }}">Ubah</a> <!-- Sesuaikan dengan rute baru -->
                <form action="{{ route('user.destroy', $d->user_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
