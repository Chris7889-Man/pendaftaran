<?php

namespace App\Http\Controllers;

use App\Models\DataPeserta;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function print($id)
    {
        $peserta = DataPeserta::findOrFail($id);

        // ✅ Update status jadi sudah registrasi
        if ($peserta->status_peserta != 'sudah registrasi') {
            $peserta->status_peserta = 'sudah registrasi';
            $peserta->save();
        }

        // Generate PDF
        $pdf = Pdf::loadView('admin.printpeserta', compact('peserta'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('kartu_registrasi_' . $peserta->nama . '.pdf');
    }
}
