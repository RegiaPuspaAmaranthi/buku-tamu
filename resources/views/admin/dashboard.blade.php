@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Tamu</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>No HP</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukuTamus as $index => $tamu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tamu->nama }}</td>
                    <td>{{ $tamu->instansi }}</td>
                    <td>{{ $tamu->keperluan }}</td>
                    <td>{{ $tamu->no_hp }}</td>
                    <td>{{ $tamu->tanggal->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('buku-tamus.edit', $tamu->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('buku-tamus.destroy', $tamu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
