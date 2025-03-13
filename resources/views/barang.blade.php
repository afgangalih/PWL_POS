<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
</head>
<body>
    <h1>Daftar Barang</h1>

    <a href="{{ route('barang.create') }}"><button>Tambah Barang</button></a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Kategori</th>
        </tr>
        @foreach($barang as $b)
        <tr>
            <td>{{ $b->barang_kode }}</td>
            <td>{{ $b->barang_nama }}</td>
            <td>{{ $b->harga_beli }}</td>
            <td>{{ $b->harga_jual }}</td>
            <td>{{ $b->kategori->kategori_nama ?? 'Tanpa Kategori' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
