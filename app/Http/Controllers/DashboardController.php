<?php

namespace App\Http\Controllers;

use App\Models\DataPeserta;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPeserta = DataPeserta::count();
        $laki = DataPeserta::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = DataPeserta::where('jenis_kelamin', 'Perempuan')->count();

        $kuota = 100; // ubah sesuai kebutuhan
        $sisaKuota = $kuota - $totalPeserta;

        // ✅ jumlah peserta per jurusan
        $jurusan = DataPeserta::select('jurusan', DB::raw('count(*) as total'))
            ->groupBy('jurusan')
            ->pluck('total', 'jurusan');

        $laki = DataPeserta::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = DataPeserta::where('jenis_kelamin', 'Perempuan')->count();

        return view('admin.dashboard', compact(
            'totalPeserta',
            'laki',
            'perempuan',
            'sisaKuota',
            'kuota',
            'jurusan',
            'laki',
            'perempuan'
        ));
    }

    public function downloadSemua()
    {
        $peserta = DataPeserta::orderBy('nama')->get();

        $pdf = Pdf::loadView('admin.downloadpeserta', compact('peserta'))
            ->setPaper('A4', 'landscape'); // penting!

        return $pdf->download('data_peserta.pdf');
    }
}
