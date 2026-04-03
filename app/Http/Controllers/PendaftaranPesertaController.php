<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataPeserta;
use Carbon\Carbon;

class PendaftaranPesertaController extends Controller
{
    // ─────────────────────────────────────────────────────────────
    //  KONFIGURASI PERIODE PENDAFTARAN
    //  Cukup ubah nilai di sini untuk menyesuaikan jadwal.
    // ─────────────────────────────────────────────────────────────
    public const REG_OPEN_YEAR   = 2026;
    public const REG_OPEN_MONTH  = 4;
    public const REG_OPEN_DAY    = 2;

    public const REG_CLOSE_YEAR  = 2026;
    public const REG_CLOSE_MONTH = 4;
    public const REG_CLOSE_DAY   = 20;

    // ─────────────────────────────────────────────────────────────
    //  DAFTAR PROGRAM STUDI YANG VALID
    // ─────────────────────────────────────────────────────────────
    public const PROGRAM_STUDI = [
        'TEKNIK INFORMATIKA',
        'SISTEM INFORMASI',
        'REKAYASA PERANGKAT LUNAK',
        'BISNIS DIGITAL',
        'KEWIRAUSAHAAN',
        'MANAJEMEN INFORMATIKA',
    ];

    // ─────────────────────────────────────────────────────────────
    //  DAFTAR KONSENTRASI YANG VALID
    //  Sesuaikan dengan konsentrasi yang tersedia di kampus Anda.
    // ─────────────────────────────────────────────────────────────
    public const KONSENTRASI = [
        'Pemrograman Web',
        'Pemrograman Mobile',
        'Desain Grafis',
        'Videografi',
    ];

    // ─────────────────────────────────────────────────────────────
    //  STATUS DEFAULT — diisi otomatis, tidak dari input user
    // ─────────────────────────────────────────────────────────────
    private const DEFAULT_STATUS_PESERTA    = 'Belum Registrasi';
    private const DEFAULT_STATUS_PEMBAYARAN = 'Belum Lunas';

    // ─────────────────────────────────────────────────────────────
    //  Internal helpers
    // ─────────────────────────────────────────────────────────────
    private function openDate(): Carbon
    {
        return Carbon::create(self::REG_OPEN_YEAR, self::REG_OPEN_MONTH, self::REG_OPEN_DAY, 0, 0, 0);
    }

    private function closeDate(): Carbon
    {
        return Carbon::create(self::REG_CLOSE_YEAR, self::REG_CLOSE_MONTH, self::REG_CLOSE_DAY, 23, 59, 59);
    }

    // ─────────────────────────────────────────────────────────────
    //  SHOW — halaman formulir
    // ─────────────────────────────────────────────────────────────
    public function show()
    {
        $now       = Carbon::now();
        $openDate  = $this->openDate();
        $closeDate = $this->closeDate();

        $is_open   = $now->between($openDate, $closeDate);
        $is_before = $now->lt($openDate);

        $countdown_target = null;
        $countdown_label  = '';

        if ($is_open) {
            $countdown_target = $closeDate->toIso8601String();
            $countdown_label  = 'Sisa waktu pendaftaran';
        } elseif ($is_before) {
            $countdown_target = $openDate->toIso8601String();
            $countdown_label  = 'Pendaftaran dibuka dalam';
        }

        $success = session('success', false);
        $peserta = session('peserta_pendaftaran');

        return view('formpendaftaran', compact(
            'is_open',
            'is_before',
            'countdown_target',
            'countdown_label',
            'success',
            'peserta'
        ));
    }

    // ─────────────────────────────────────────────────────────────
    //  STORE — proses simpan data pendaftaran
    // ─────────────────────────────────────────────────────────────
    public function store(Request $request)
    {
        $now       = Carbon::now();
        $openDate  = $this->openDate();
        $closeDate = $this->closeDate();

        // Validasi periode pendaftaran
        if (!$now->between($openDate, $closeDate)) {
            return back()
                ->withErrors([
                    'nim' => sprintf(
                        'Pendaftaran hanya dibuka %s – %s.',
                        $openDate->translatedFormat('j F Y'),
                        $closeDate->translatedFormat('j F Y')
                    ),
                ])
                ->withInput();
        }

        // Rules validasi
        $rules = [
            'nama'          => ['required', 'string', 'max:255'],
            'nim'           => ['required', 'digits:6', 'unique:data_peserta,nim'],
            'email'         => ['required', 'email', 'max:255', 'unique:data_peserta,email'],
            'angkatan'      => ['required', 'integer', 'between:2000,' . now()->year],
            'jurusan'       => ['required', 'in:' . implode(',', self::PROGRAM_STUDI)],
            'no_hp'         => ['required', 'string', 'regex:/^(\+62|62|0)[0-9]{9,12}$/'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat'        => ['required', 'string', 'max:500'],
            'tempat_lahir'  => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'konsentrasi'   => ['required', 'in:' . implode(',', self::KONSENTRASI)],
            'hobi'          => ['required', 'string', 'max:255'],
            'alasan_masuk'  => ['required', 'string', 'max:1000'],
        ];

        // Pesan error custom
        $messages = [
            'nama.required'          => 'Nama lengkap wajib diisi.',
            'nama.max'               => 'Nama tidak boleh lebih dari 255 karakter.',
            'nim.required'           => 'NIM wajib diisi.',
            'nim.digits'             => 'NIM harus terdiri dari 6 digit angka.',
            'nim.unique'             => 'NIM :input sudah terdaftar. Satu NIM hanya boleh mendaftar sekali.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email :input sudah terdaftar.',
            'angkatan.required'      => 'Angkatan wajib diisi.',
            'angkatan.digits'        => 'Angkatan harus berupa 4 digit tahun. Contoh: 2023.',
            'angkatan.min'           => 'Angkatan tidak valid.',
            'angkatan.max'           => 'Angkatan tidak boleh melebihi tahun ini.',
            'jurusan.required'       => 'Program studi wajib dipilih.',
            'jurusan.in'             => 'Program studi yang dipilih tidak valid.',
            'no_hp.required'         => 'Nomor HP wajib diisi.',
            'no_hp.regex'            => 'Format nomor HP tidak valid. Gunakan format 08xxxxxxxxx atau +62xxxxxxxxxx.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'alamat.required'        => 'Alamat lengkap wajib diisi.',
            'alamat.max'             => 'Alamat tidak boleh lebih dari 500 karakter.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max'       => 'Tempat lahir tidak boleh lebih dari 100 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before'   => 'Tanggal lahir tidak valid.',
            'konsentrasi.required'   => 'Konsentrasi wajib dipilih.',
            'konsentrasi.in'         => 'Konsentrasi yang dipilih tidak valid.',
            'hobi.required'          => 'Hobi wajib diisi.',
            'alasan_masuk.required'  => 'Alasan masuk wajib diisi.',
            'alasan_masuk.max'       => 'Alasan masuk tidak boleh lebih dari 1000 karakter.',
        ];

        $validated = $request->validate($rules, $messages);

        // Normalisasi nomor HP → selalu diawali 62 (tanpa +)
        $validated['no_hp'] = preg_replace('/^\+?62|^0/', '62', $validated['no_hp']);

        // Isi otomatis — tidak boleh diubah oleh user
        $validated['status_peserta']    = self::DEFAULT_STATUS_PESERTA;
        $validated['status_pembayaran'] = self::DEFAULT_STATUS_PEMBAYARAN;
        $validated['total_pembayaran'] = 0.00;


        try {
            $peserta = DataPeserta::create($validated);

            session([
                'success'             => true,
                'peserta_pendaftaran' => $peserta->toArray(),
            ]);

            return redirect()->route('form-pendaftaran')->with('success', true);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()
                ->withErrors(['nim' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'])
                ->withInput();
        }
    }
}
