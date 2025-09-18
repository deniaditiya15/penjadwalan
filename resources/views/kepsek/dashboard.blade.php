@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h2 class="mb-4 fw-bold text-secondary">Dashboard Kepala Sekolah</h2>

    <!-- Ringkasan Data -->
    <div class="row mb-4">
        <!-- Guru -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="background:#f8faff;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="bi bi-person-badge-fill fs-2 text-primary"></i>
                    </div>
                    <h6 class="text-muted">Jumlah Guru</h6>
                    <h3 class="fw-bold text-dark">{{ $jumlahGuru }}</h3>
                </div>
            </div>
        </div>
        <!-- Kelas -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="background:#f8faff;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="bi bi-building fs-2 text-success"></i>
                    </div>
                    <h6 class="text-muted">Jumlah Kelas</h6>
                    <h3 class="fw-bold text-dark">{{ $jumlahKelas }}</h3>
                </div>
            </div>
        </div>
        <!-- Mapel -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="background:#f8faff;">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="bi bi-journal-bookmark-fill fs-2 text-danger"></i>
                    </div>
                    <h6 class="text-muted">Jumlah Mapel</h6>
                    <h3 class="fw-bold text-dark">{{ $jumlahMapel }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Lingkaran + Tanggal -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <strong class="fw-semibold">Ringkasan Data Sekolah</strong>
            <span class="text-muted small">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
        </div>
        <div class="card-body d-flex justify-content-center align-items-center" style="height: 320px;">
            <canvas id="dashboardChart" style="max-width: 280px; max-height: 280px;"></canvas>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('dashboardChart').getContext('2d');

const dashboardChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($chartLabels) !!},
        datasets: [{
            data: {!! json_encode($chartData) !!},
            backgroundColor: ['#445ebf','#4caf50','#f44336','#ff9800','#9c27b0','#00bcd4'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    font: { size: 13 },
                    color: '#333'
                }
            }
        }
    }
});
</script>
@endsection
