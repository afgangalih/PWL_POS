<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang</h1>

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <label>Kode Barang:</label>
        <input type="text" name="barang_kode" required><br>

        <label>Nama Barang:</label>
        <input type="text" name="barang_nama" required><br>

        <label>Harga Beli:</label>
        <input type="number" name="harga_beli" required><br>

        <label>Harga Jual:</label>
        <input type="number" name="harga_jual" required><br>

        <label>Kategori:</label>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
                <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
            @endforeach
        </select><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('barang.index') }}"><button>Kembali</button></a>
</body>
</html>
