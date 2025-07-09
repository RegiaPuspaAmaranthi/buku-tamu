@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-dark">Dashboard Admin</h2>

    <!-- Statistik Biodata -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow text-white border-0" style="background-color: #064089;">
                <div class="card-body">
                    <h6>Total Biodata</h6>
                    <h3>{{ $totalBiodata ?? '-' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-white border-0" style="background-color: #0A61C9;">
                <div class="card-body">
                    <h6>Belum Selesai</h6>
                    <h3>{{ $belumSelesai ?? '-' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow text-white border-0" style="background-color: #749DC8;">
                <div class="card-body">
                    <h6>Proses</h6>
                    <h3>{{ $proses ?? '-' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0" style="background-color: #F1F7F9; color: #07326A;">
                <div class="card-body">
                    <h6>Selesai</h6>
                    <h3>{{ $selesai ?? '-' }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Jumlah Tamu -->
    <div class="card shadow border-0">
        <div class="card-header bg-white fw-bold text-dark">
            Grafik Jumlah Tamu per Bulan
        </div>
        <div class="card-body">
            <canvas id="grafikTamu" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('grafikTamu').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($bulan ?? []),
            datasets: [{
                label: 'Jumlah Tamu',
                data: @json($jumlahTamu ?? []),
                backgroundColor: '#0A61C9'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endsection
