<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;

class DataPesertaController extends Controller
{
    //
    public function index()
    {
        $dataPeserta = DataPeserta::all();
        return view('admin.datapeserta', compact('dataPeserta'));
    }

    public function destroy($id)
    {
        $peserta = DataPeserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('admin.data-peserta')->with('success', 'Peserta berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $peserta = DataPeserta::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:data_peserta,nim,' . $id,
            'email' => 'required|string|email|max:255|unique:data_peserta,email,' . $id,
            'angkatan' => 'required|integer',
            'jurusan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'konsentrasi' => 'required|string|max:255',
            'hobi' => 'nullable|string|max:255',
            'alasan_masuk' => 'nullable|string',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
            'total_pembayaran' => 'required|numeric|min:0',
        ]);

        $peserta->update($validated);
        return redirect()->route('admin.data-peserta')->with('success', 'Peserta berhasil diperbarui.');
    }
}
