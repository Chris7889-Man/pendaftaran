<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Data Peserta</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
        }

        /* HEADER */
        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            color: #4e73df;
        }

        .header p {
            margin: 2px;
            font-size: 11px;
        }

        /* CARD STYLE */
        .card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #4e73df;
            color: white;
            padding: 6px;
            text-align: center;
            font-size: 10px;
        }

        td {
            padding: 5px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        /* TEXT */
        .text-center {
            text-align: center;
        }

        .small {
            font-size: 9px;
        }

        /* BADGE STYLE */
        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 9px;
            color: #fff;
        }

        .badge-success {
            background-color: #1cc88a;
        }

        .badge-danger {
            background-color: #e74a3b;
        }

        .badge-warning {
            background-color: #f6c23e;
        }

        /* FOOTER */
        .footer {
            margin-top: 10px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h2>DATA PESERTA</h2>
        <p>Data Registrasi Peserta</p>
        <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
    </div>

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Angkatan</th>
                    <th>Jurusan</th>
                    <th>HP</th>
                    <th>JK</th>
                    <th>Alamat</th>
                    <th>TTL</th>
                    <th>Konsentrasi</th>
                    <th>Hobi</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($peserta as $index => $p)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->nim }}</td>
                        <td class="small">{{ $p->email }}</td>
                        <td class="text-center">{{ $p->angkatan }}</td>
                        <td>{{ $p->jurusan }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td class="text-center">{{ $p->jenis_kelamin }}</td>
                        <td class="small">{{ $p->alamat }}</td>
                        <td class="small">
                            {{ $p->tempat_lahir }}<br>
                            {{ date('d-m-Y', strtotime($p->tanggal_lahir)) }}
                        </td>
                        <td>{{ $p->konsentrasi }}</td>
                        <td>{{ $p->hobi }}</td>
                        <td class="small">{{ $p->alasan_masuk }}</td>

                        <!-- STATUS PESERTA -->
                        <td class="text-center">
                            @if($p->status_peserta == 'sudah registrasi')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Belum</span>
                            @endif
                        </td>

                        <!-- STATUS PEMBAYARAN -->
                        <td class="text-center">
                            @if($p->status_pembayaran == 'lunas')
                                <span class="badge badge-success">Lunas</span>
                            @else
                                <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>

                        <td class="text-center">
                            Rp {{ number_format($p->total_pembayaran, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak oleh sistem • {{ date('d-m-Y H:i') }}
    </div>

</body>

</html>