<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Aplikasi Anggaran</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --navbar-height: 56px;
        }

        body {
            min-height: 100vh;
            padding-top: var(--navbar-height);
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            height: var(--navbar-height);
            background: linear-gradient(to right, #1a237e, #0d47a1);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            padding-top: 0;
            padding-bottom: 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #fff !important;
            background-color: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            color: #fff !important;
            background-color: rgba(255,255,255,0.15);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            border-radius: 10px;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 0.5rem;
        }

        /* Clock Styles */
        .clock-container {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        #clock {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1a237e;
            font-family: 'Arial', sans-serif;
            margin: 0;
            line-height: 1;
        }

        #date {
            font-size: 1.1rem;
            color: #666;
            margin-top: 5px;
        }

        /* Marquee Styles */
        .marquee-container {
            background: linear-gradient(to right, #1a237e, #0d47a1);
            color: white;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .marquee-text {
            display: block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(to bottom, #1a237e, #0d47a1);
                padding: 1rem;
                border-radius: 10px;
                margin-top: 0.5rem;
            }

            .nav-link {
                padding: 0.75rem 1rem !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-chart-line me-2"></i>
                BAPPEDA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('anggaran*') ? 'active' : '' }}" href="{{ route('anggaran.index') }}">
                            <i class="fas fa-money-bill-wave me-1"></i> Anggaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}" href="{{ route('pengeluaran.index') }}">
                            <i class="fas fa-receipt me-1"></i> Pengeluaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('report*') ? 'active' : '' }}" href="{{ route('report.index') }}">
                            <i class="fas fa-file-alt me-1"></i> Laporan
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                    <i class="fas fa-user"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <!-- Clock and Marquee -->
        <div class="container">
            <div class="clock-container">
                <div id="clock"></div>
                <div id="date"></div>
            </div>
            <div class="marquee-container">
                <div class="marquee-text">
                    🏢 Selamat datang di Sistem Informasi Anggaran BAPPEDA - Mari bersama-sama mengelola anggaran dengan efektif dan transparan 📊 - Komitmen Kami: Transparansi, Akuntabilitas, dan Efisiensi dalam Pengelolaan Anggaran 💡
                </div>
            </div>
        </div>

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function updateClock() {
            const now = new Date();
            const clock = document.getElementById('clock');
            const dateDisplay = document.getElementById('date');
            
            // Format time
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clock.textContent = `${hours}:${minutes}:${seconds}`;
            
            // Format date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateDisplay.textContent = now.toLocaleDateString('id-ID', options);
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call
    </script>
    @stack('scripts')

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    </script>
    @endif
</body>
</html>