@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Biodata Tamu</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('biodata-tamus.create') }}" class="btn btn-primary mb-3">
        Tambah Biodata Tamu
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>No HP</th>
                <th>Tanggal</th>
                <th>Permasalahan</th>
                <th>Tanggapan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bukuTamus as $index => $tamu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tamu->nama }}</td>
                    <td>{{ $tamu->instansi }}</td>
                    <td>{{ $tamu->keperluan }}</td>
                    <td>{{ $tamu->no_hp }}</td>
                    <td>{{ $tamu->tanggal->format('Y-m-d') }}</td>
                    <td>{{ $tamu->biodata->permasalahan ?? '-' }}</td>
                    <td>{{ $tamu->biodata->tanggapan ?? '-' }}</td>
                    <td>{{ $tamu->biodata->status ?? '-' }}</td>
                    <td>
                        @if ($tamu->biodata)
                            <a href="{{ route('biodata-tamus.edit', $tamu->biodata->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('biodata-tamus.destroy', $tamu->biodata->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @else
                            <a href="{{ route('biodata-tamus.create', ['buku_tamu_id' => $tamu->id]) }}" class="btn btn-sm btn-success">Isi Biodata</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data tamu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
