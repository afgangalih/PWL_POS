<div class="modal-header">
    <h5 class="modal-title">Detail Supplier</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $supplier->supplier_id }}</td>
        </tr>
        <tr>
            <th>Kode</th>
            <td>{{ $supplier->supplier_kode }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $supplier->supplier_nama }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $supplier->supplier_alamat }}</td>
        </tr>
        <tr>
            <th>Dibuat</th>
            <td>{{ $supplier->created_at ?? '-' }}</td>
        </tr>
        <tr>
            <th>Diperbarui</th>
            <td>{{ $supplier->updated_at ?? '-' }}</td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
</div>
