@extends('layouts.app')

@section('title', 'Buku Tamu')

@section('content')
<div class="row">
    <!-- Form Buku Tamu -->
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4>PENGUNJUNG</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('buku-tamus.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Pengunjung</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instansi</label>
                        <input type="text" name="instansi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>


                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Statistik Pengunjung -->
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5>STATISTIK PENGUNJUNG</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Hari Ini</span> <strong>{{ $statistik['hari_ini'] }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Kemarin</span> <strong>{{ $statistik['kemarin'] }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Bulan Ini</span> <strong>{{ $statistik['bulan_ini'] }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Keseluruhan</span> <strong>{{ $statistik['total'] }}</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
