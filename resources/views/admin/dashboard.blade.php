@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Data Tamu</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukuTamus as $tamu)
            <tr>
                <td>{{ $tamu->nama }}</td>
                <td>{{ $tamu->instansi }}</td>
                <td>{{ $tamu->keperluan }}</td>
                <td>{{ $tamu->tanggal }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                    <form action="#" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
