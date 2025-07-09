@extends('layouts.app')

@section('title', 'Buku Tamu')

@section('content')
<div class="container py-4" style="background-color: #F1F7F9;">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="row g-4 align-items-stretch">

                <!-- FORM PENGUNJUNG -->
                <div class="col-md-8">
                    <div class="card shadow border-0" style="border-radius: 1rem;">
                        <div class="card-body px-4 py-4">

                            <div class="mb-4">
                                <h5 class="fw-bold" style="color: #064089; border-left: 5px solid #0A61C9; padding-left: 10px;">
                                    FORM BUKU TAMU
                                </h5>
                            </div>

                            <form action="{{ route('buku-tamus.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control shadow-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama Pengunjung</label>
                                    <input type="text" name="nama" class="form-control shadow-sm" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Instansi / Alamat</label>
                                    <input type="text" name="instansi" class="form-control shadow-sm">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" name="no_hp" class="form-control shadow-sm" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Keperluan</label>
                                    <input type="text" name="keperluan" class="form-control shadow-sm" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #0A61C9;">
                                        💾 Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- STATISTIK PENGUNJUNG -->
                <div class="col-md-4">
                    <div class="card shadow border-0 h-50" style="border-radius: 1rem;">
                        <div class="card-body px-4 py-4">

                            <div class="mb-4">
                                <h5 class="fw-bold" style="color: #064089; border-left: 5px solid #0A61C9; padding-left: 10px;">
                                    JUMLAH TAMU
                                </h5>
                            </div>

                            <ul class="list-group list-group-flush fs-6">
                                <li class="list-group-item d-flex justify-content-between bg-transparent border-bottom">
                                    <span>Hari Ini:</span> <strong>{{ $statistik['hari_ini'] }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-transparent border-bottom">
                                    <span>Kemarin:</span> <strong>{{ $statistik['kemarin'] }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-transparent border-bottom">
                                    <span>Bulan Ini:</span> <strong>{{ $statistik['bulan_ini'] }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-transparent">
                                    <span>Keseluruhan:</span> <strong>{{ $statistik['total'] }}</strong>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <!-- END STATISTIK -->

            </div>
        </div>
    </div>
</div>
@endsection
