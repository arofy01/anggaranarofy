<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Pengeluaran</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengeluaran</th>
                <th>Admin</th>
                <th>Jumlah</th>
                <th>Anggaran</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengeluarans as $pengeluaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengeluaran->nama_pengeluaran }}</td>
                    <td>{{ $pengeluaran->admin->nama ?? 'Tidak Diketahui' }}</td>
                    <td>Rp {{ number_format($pengeluaran->jumlah, 2, ',', '.') }}</td>
                    <td>{{ $pengeluaran->anggaran->nama_anggaran ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $pengeluaran->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
