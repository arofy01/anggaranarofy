<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENGELUARAN ANGGARAN</h2>
        @if(!empty($start_date) && !empty($end_date))
            <p>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</p>
        @endif
        <p>Tanggal Cetak: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 10%">Tahun</th>
                <th style="width: 25%">Nama Pengeluaran</th>
                <th style="width: 30%">Keterangan</th>
                <th style="width: 15%">Nominal</th>
                <th style="width: 15%">Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($reports as $index => $report)
                @php $total += $report->nominal; @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->tahun }}</td>
                    <td>{{ $report->nama_pengeluaran }}</td>
                    <td>{{ $report->keterangan ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($report->nominal, 0, ',', '.') }}</td>
                    <td>{{ $report->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="text-right">Total</td>
                <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>* Dokumen ini digenerate secara otomatis oleh sistem</p>
    </div>
</body>
</html>
