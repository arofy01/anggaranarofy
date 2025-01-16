@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center mb-4">
                <div class="clock-container p-3 rounded shadow-sm">
                    <div id="clock" class="display-4 text-primary"></div>
                    <div id="date" class="text-muted"></div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="marquee-container p-2 bg-primary text-white rounded">
                    <marquee behavior="scroll" direction="left" scrollamount="5">
                        Selamat datang di Sistem Informasi Anggaran BAPPEDA - Mari bersama-sama mengelola anggaran dengan efektif dan transparan 📊
                    </marquee>
                </div>
            </div>
            <div class="col-md-12">
                <h1 class="mb-4">Selamat Datang di Dashboard</h1>
                <p>Ini adalah halaman dashboard Anda.</p>
            </div>
        </div>
    </div>

    <style>
        .clock-container {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .marquee-container {
            overflow: hidden;
        }
        #clock {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
        }
        #date {
            font-size: 1.2rem;
        }
    </style>

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
@endsection
