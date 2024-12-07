<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi Anggaran</title>
    <!-- Link ke Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles') <!-- Tempat untuk menambahkan CSS tambahan jika diperlukan -->
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Aplikasi Anggaran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anggaran.index') }}">Anggaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pengeluaran.index') }}">Pengeluaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('report.index') }}">Laporan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container my-4">
        @yield('content') <!-- Isi konten dinamis di sini -->
    </div>

    {{-- <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3"> --}}
    
    </footer>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') <!-- Tempat untuk menambahkan JS tambahan jika diperlukan -->
</body>
</html>
