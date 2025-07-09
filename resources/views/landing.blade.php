@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Landing Page Styles -->
<link href="{{ asset('css/landing.css') }}" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="landing-hero">
    <img src="{{ asset('assets/image/logo.png') }}" alt="Logo BPMP NTB">
    <h1>Selamat Datang di Aplikasi Buku Tamu Digital</h1>
    <p>Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat</p>
    <a href="{{ route('buku-tamus.create') }}" class="btn btn-primary btn-isi">📋 Isi Buku Tamu</a>
</div>

{{-- SLIDER --}}
<div id="slider" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('assets/image/bpmp_1.jpg') }}" class="d-block w-100" alt="Slide 1">
    </div>
    {{-- Tambahkan gambar slide lain jika perlu --}}
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

{{-- FOOTER --}}
<footer class="mt-5">
  <div class="container">
    <div class="row text-white">
      <div class="col-md-4 mb-4">
        <h5>Balai Penjaminan Mutu Pendidikan<br>Provinsi Nusa Tenggara Barat (BPMP NTB)</h5>
        <p>Jl. Panji Tilarnegara, No. 08 Mataram – NTB</p>
        <div class="social-icons mt-3">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <h5>Hubungi Kami</h5>
        <ul class="list-unstyled">
          <li><i class="bi bi-telephone"></i> 628113906669</li>
          <li><i class="bi bi-envelope"></i> ntblpmp@gmail.com</li>
          <li><i class="bi bi-geo-alt"></i> Jl. Panji Tilarnegara, No. 08 Mataram – NTB</li>
        </ul>
        <h6 class="mt-3">Jam Layanan</h6>
        <p>Senin – Jumat: 08.00 – 16.00 WIB</p>
      </div>
    </div>

    <hr class="text-white mt-4">
    <div class="text-center text-white small">
      © {{ date('Y') }} Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat (BPMP NTB). All rights reserved.
    </div>
  </div>
</footer>
@endsection
