@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Rekapan Tamu</h3>

    <form method="GET" action="{{ route('rekapan.index') }}" class="mb-4 row g-3">
        <div class="col-md-3">
            <label>Jenis Data</label>
            <select name="tipe_data" class="form-select">
                <option value="buku" {{ $tipe == 'buku' ? 'selected' : '' }}>Buku Tamu</option>
                <option value="biodata" {{ $tipe == 'biodata' ? 'selected' : '' }}>Biodata Tamu</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>Tanggal Awal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ $tanggalAwal }}">
        </div>
        <div class="col-md-3">
            <label>Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button class="btn btn-primary">Tampilkan</button>
        </div>
    </form>

    @if(count($data))
        <form method="POST" action="{{ route('rekapan.export') }}" class="mb-3 row g-2">
            @csrf
            <input type="hidden" name="tipe_data" value="{{ $tipe }}">
            <input type="hidden" name="tanggal_awal" value="{{ $tanggalAwal }}">
            <input type="hidden" name="tanggal_akhir" value="{{ $tanggalAkhir }}">
            <div class="col-md-4">
                <input type="text" name="filename" class="form-control" placeholder="Nama file (opsional)">
            </div>
            <div class="col-md-3">
                <button class="btn btn-success">Ekspor ke Excel</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        @if ($tipe === 'biodata')
                            <th>No</th><th>Nama</th><th>Instansi</th><th>Keperluan</th><th>No HP</th><th>Tanggal</th><th>Permasalahan</th><th>Tanggapan</th><th>Status</th>
                        @else
                            <th>No</th><th>Nama</th><th>Instansi</th><th>Keperluan</th><th>No HP</th><th>Tanggal</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            @if ($tipe === 'biodata')
                                <td>{{ optional($item->bukuTamu)->nama }}</td>
                                <td>{{ optional($item->bukuTamu)->instansi }}</td>
                                <td>{{ optional($item->bukuTamu)->keperluan }}</td>
                                <td>{{ optional($item->bukuTamu)->no_hp }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->permasalahan }}</td>
                                <td>{{ $item->tanggapan }}</td>
                                <td>{{ $item->status }}</td>
                            @else
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->instansi }}</td>
                                <td>{{ $item->keperluan }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Tidak ada data yang ditampilkan.</p>
    @endif
</div>
@endsection
