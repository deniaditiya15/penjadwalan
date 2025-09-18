<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cetak Jadwal</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 0; padding: 0; }
        .header { text-align: center; margin-bottom: 10px; }
        h1, h2, h3, p { margin: 0; }
        h1 { font-size: 16px; }
        h2 { font-size: 14px; }
        h3 { font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        .footer { margin-top: 20px; text-align: right; font-size: 11px; }
        hr { border: 1px solid #000; margin-top: 5px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="header">
        <h1>SMPN 1 BELITANG III</h1>
        <h2>Jl. Raya Nusa Bakti, Belitang III, OKU Timur</h2>
        <p>Email: smpn1belitang3@example.com | Telp: (0713) 123456</p>
        <hr>
    </div>

    <!-- Judul -->
    <h2 style="text-align: center; margin-bottom: 10px;">Data Jadwal Pelajaran</h2>

    <!-- Tabel Jadwal -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mapel</th>
                <th>Guru</th>
                <th>Hari</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $i => $j)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $j->kelas->kelas }}</td>
                <td>{{ $j->mapel->nama_mapel }}</td>
                <td>{{ $j->guru->nama }}</td>
                <td>{{ $j->hari }}</td>
                <td>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>
