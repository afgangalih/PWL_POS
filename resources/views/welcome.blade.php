@extends('layouts.template')

@section('content')
<div class="row">
    <!-- Welcome Box -->
    <div class="col-md-12">
        <div class="card bg-gradient-primary text-white shadow">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-4x mr-3"></i>
                    <div>
                        <h2>Selamat Datang, {{ $user->nama }}!</h2>
                        <p class="mb-1">Anda login sebagai <strong>{{ $user->level->level_nama }}</strong></p>
                        <p class="mb-0">Gunakan menu di samping untuk mengakses fitur sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Boxes -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pengguna</span>
                <span class="info-box-number">125</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-tags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kategori</span>
                <span class="info-box-number">15</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Barang</span>
                <span class="info-box-number">210</span>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<!-- Chart.js -->
<script>
    const ctxBarang = document.getElementById('barangChart').getContext('2d');
    const barangChart = new Chart(ctxBarang, {
        type: 'bar',
        data: {
            labels: ['Barang', 'Kategori', 'Supplier'],
            datasets: [{
                label: 'Data',
                data: [210, 15, 25],
                backgroundColor: ['#17a2b8', '#6f42c1', '#fd7e14'],
            }]
        },
        options: {
            onClick: function(evt, elements) {
                if (elements.length > 0) {
                    const label = this.data.labels[elements[0].index];
                    const routes = {
                        'Barang': '/barang',
                        'Kategori': '/kategori',
                        'Supplier': '/supplier'
                    };
                    const url = routes[label];
                    if (url) {
                        window.location.href = url;
                    }
                }
            }
        }
    });
</script>

@endsection
