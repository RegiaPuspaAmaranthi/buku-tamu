@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Tamu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('buku-tamus.update', $bukuTamu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $bukuTamu->nama) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="instansi" class="form-label">Instansi</label>
            <input type="text" name="instansi" value="{{ old('instansi', $bukuTamu->instansi) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <textarea name="keperluan" class="form-control" required>{{ old('keperluan', $bukuTamu->keperluan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Telepon</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $bukuTamu->no_hp) }}">
        </div>


        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $bukuTamu->tanggal) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('buku-tamus.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
