@extends('layouts.admin')

@section('title', 'Biodata Tamu')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-dark">🧾 Daftar Biodata Tamu</h2>

    {{-- Form Pencarian dan Filter --}}
    <form method="GET" action="{{ route('biodata-tamus.index') }}" class="row g-2 mb-4 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Pencarian</label>
            <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Nama, Instansi, Keperluan">
        </div>
        <div class="col-md-3">
            <label class="form-label">Filter Status</label>
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="Belum Selesai" {{ request('status') == 'Belum Selesai' ? 'selected' : '' }}>Belum Selesai</option>
                <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">🔍 Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('biodata-tamus.index') }}" class="btn btn-secondary w-100">♻️ Reset</a>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Instansi/Alamat</th>
                            <th>Keperluan</th>
                            <th>Nomor HP</th>
                            <th>Permasalahan</th>
                            <th>Tanggapan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($biodataTamus as $index => $data)
                        <tr>
                            <td>{{ $biodataTamus->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td class="text-start">{{ $data->nama }}</td>
                            <td class="text-start">{{ $data->instansi }}</td>
                            <td class="text-start">{{ $data->keperluan }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td class="text-start">{{ $data->permasalahan ?? '-' }}</td>
                            <td class="text-start">{{ $data->tanggapan ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $data->status == 'Selesai' ? 'success' : ($data->status == 'Proses' ? 'warning' : ($data->status == 'Belum Selesai' ? 'danger' : 'secondary')) }}">
                                    {{ $data->status ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @if ($data->biodata_id)
                                    <a href="{{ route('biodata-tamus.edit', $data->biodata_id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                    <form action="{{ route('biodata-tamus.destroy', $data->biodata_id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                @else
                                    <a href="{{ route('biodata-tamus.create', ['buku_tamu_id' => $data->id]) }}" class="btn btn-sm btn-success">Isi Biodata</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">Tidak ada data ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="card-footer bg-white py-3">
        <div class="d-flex justify-content-center">
            {{ $biodataTamus->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
