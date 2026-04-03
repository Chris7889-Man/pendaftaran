<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kartu Registrasi Peserta</title>

    <style>
        body {
            font-family: "Times New Roman", serif;
        }

        .card {
            width: 100%;
            border: 2px solid black;
            padding: 15px;
        }

        .header {
            text-align: right;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
        }

        /* ✅ LOGO DIPERBAIKI */
        .logo {
            width: 250px;
            margin-top: -15px;
            margin-left: -35px;
        }

        /* ✅ TEXT DIPERBESAR */
        .data td {
            padding: 6px 0;
            font-size: 16px;
        }

        .label {
            width: 160px;
        }

        .colon {
            width: 10px;
        }

        /* biar value lebih jelas */
        .data td:last-child {
            font-weight: bold;
        }

        .ttd {
            width: 180px;
            height: 120px;
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
        }

        .footer-line {
            border-top: 2px dashed black;
            margin: 20px 0;
        }
    </style>
</head>

<body>

    <!-- ================== BAGIAN ATAS ================== -->
    <div class="card">

        <!-- HEADER -->
        <div class="header">
            DIMENSI TRAINING XXIV
        </div>

        <!-- CONTENT -->
        <table>
            <tr>
                <!-- LOGO -->
                <td style="width: 35%; text-align: center; vertical-align: top;">
                    <img src="{{ public_path('assets/form/logoditra.png') }}" class="logo">
                </td>

                <!-- DATA -->
                <td style="width: 65%;">
                    <table class="data">
                        <tr>
                            <td class="label"><b>Nama</b></td>
                            <td class="colon">:</td>
                            <td>{{ $peserta->nama }}</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Stambuk</b></td>
                            <td>:</td>
                            <td>{{ $peserta->nim }}</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Jurusan</b></td>
                            <td>:</td>
                            <td>{{ $peserta->jurusan }}</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Tanggal lahir</b></td>
                            <td>:</td>
                            <td>{{ $peserta->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Nomor Hp</b></td>
                            <td>:</td>
                            <td>{{ $peserta->no_hp }}</td>
                        </tr>
                        <tr>
                            <td class="label"><b>Alamat</b></td>
                            <td>:</td>
                            <td>{{ $peserta->alamat }}</td>
                        </tr>
                    </table>

                    <!-- TTD PESERTA -->
                    <table style="width:100%; margin-top:25px;">
                        <tr>
                            <td></td>
                            <td style="width:200px;">
                                <div class="ttd">
                                    Tanda Tangan<br>Peserta
                                </div>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <!-- TANGGAL CETAK -->
        <div style="text-align:right; margin-top:10px; font-size:12px;">
            Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>

    </div>

    <!-- GARIS PUTUS -->
    <div class="footer-line"></div>

    <!-- ================== BAGIAN BAWAH ================== -->
    <div class="card">

        <!-- INFO PANITIA -->
        <div style="text-align:right; font-size:14px;">
            Panitia Pelaksana DITRA XXIV <br>
            Dipanegara Management Study – Dimensi <br>
            Periode 2025 - 2026
        </div>

        <!-- DATA ULANG -->
        <table class="data" style="margin-top:15px;">
            <tr>
                <td class="label"><b>Nama</b></td>
                <td>:</td>
                <td>{{ $peserta->nama }}</td>
            </tr>
            <tr>
                <td class="label"><b>Stambuk</b></td>
                <td>:</td>
                <td>{{ $peserta->nim }}</td>
            </tr>
            <tr>
                <td class="label"><b>Jurusan</b></td>
                <td>:</td>
                <td>{{ $peserta->jurusan }}</td>
            </tr>
            <tr>
                <td class="label"><b>Tanggal lahir</b></td>
                <td>:</td>
                <td>{{ $peserta->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td class="label"><b>Nomor Hp</b></td>
                <td>:</td>
                <td>{{ $peserta->no_hp }}</td>
            </tr>
            <tr>
                <td class="label"><b>Alamat</b></td>
                <td>:</td>
                <td>{{ $peserta->alamat }}</td>
            </tr>
        </table>

        <!-- TTD PANITIA -->
        <table style="width:100%; margin-top:25px;">
            <tr>
                <td></td>
                <td style="width:200px;">
                    <div class="ttd">
                        Tanda Tangan<br>Panitia
                    </div>
                </td>
            </tr>
        </table>

        <!-- TANGGAL CETAK -->
        <div style="text-align:right; margin-top:10px; font-size:12px;">
            Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>

    </div>

</body>

</html>