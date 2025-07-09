<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center w-100 mb-4">
            <img src="{{ asset('assets/image/logo_kemdikbud.png') }}" alt="Kemendikbud" class="img-fluid sidebar-logo">
        </div>

        <a href="{{ route('dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>
        <a href="{{ route('buku-tamus.index') }}" class="{{ request()->is('buku-tamus*') ? 'active' : '' }}">
            📒 Data Tamu
        </a>
        <a href="{{ route('biodata-tamus.index') }}" class="{{ request()->is('biodata-tamus*') ? 'active' : '' }}">
            🧾 Biodata Tamu
        </a>
        <a href="{{ route('rekapan.index') }}" class="{{ request()->is('rekapan*') ? 'active' : '' }}">
            📁 Rekapan
        </a>

        <div class="mt-auto w-100">
            <hr class="text-white">
            <a href="{{ route('logout') }}" class="text-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                🚪 Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        {{-- Tombol toggle sidebar --}}
        <button class="toggle-sidebar-btn" id="toggleSidebar">☰</button>

        @yield('content')
    </div>

    {{-- Script toggle --}}
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            toggleBtn.textContent = sidebar.classList.contains('collapsed') ? '☰' : '☰';
        });
    </script>

</body>
</html>
