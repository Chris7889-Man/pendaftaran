<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta — DITRA XXIV</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo_dimensi.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/form/style.css') }}">

</head>

<body>
    <!-- ── SITE HEADER ── -->
    <header class="site-header">
        <div class="sh-left">
            <span class="sh-text">DITRA XXIV</span>
            <div class="sh-divider"></div>
            <span class="sh-text">Dimensi Training 24</span>
        </div>
        <span class="sh-badge">Pendaftaran Resmi</span>
        <div class="sh-right">
            <div class="sh-divider"></div>
            <span class="sh-text">{{ now()->year }}</span>
        </div>
    </header>

    <div class="page">

        <!-- ── HERO ── -->
        <div class="hero">
            <div class="medallion">
                <div class="medallion-ring"></div>
                <div class="medallion-inner">
                    <img src="{{ asset('assets/form/logoditra.png') }}" style="margin-left: -10px;" alt="DITRA XXIV">
                </div>
            </div>
            <p class="event-label">Dimensi Training XXIV &nbsp;·&nbsp; Pendaftaran Peserta Baru</p>
            <div class="ornament">
                <div class="orn-dot"></div>
                <div class="orn-line"></div>
                <div class="orn-diamond"></div>
                <div class="orn-line r"></div>
                <div class="orn-dot"></div>
            </div>
            <h1 class="hero-title">Formulir<br><em>Pendaftaran</em></h1>
            <p class="hero-sub">Lengkapi data diri Anda dengan seksama untuk menyelesaikan proses pendaftaran secara resmi.</p>
        </div>

        <!-- ── DATE BANNER ── -->
        <div class="date-banner">
            <div class="date-col">
                <span class="date-col-label">Dibuka</span>
                <span class="date-col-day">{{ \App\Http\Controllers\PendaftaranPesertaController::REG_OPEN_DAY }}</span>
                <span class="date-col-month">{{ \Carbon\Carbon::create(null, \App\Http\Controllers\PendaftaranPesertaController::REG_OPEN_MONTH)->translatedFormat('F') }}</span>
                <span class="date-col-year">{{ \App\Http\Controllers\PendaftaranPesertaController::REG_OPEN_YEAR }}</span>
            </div>
            <div class="date-middle">
                <div class="status-pill {{ $is_open ? 'open' : ($is_before ? 'before' : 'closed') }}">
                    <span class="dot"></span>
                    @if ($is_open)       Sedang Dibuka
                    @elseif ($is_before) Belum Dibuka
                    @else                Telah Ditutup
                    @endif
                </div>
            </div>
            <div class="date-col">
                <span class="date-col-label">Ditutup</span>
                <span class="date-col-day">{{ \App\Http\Controllers\PendaftaranPesertaController::REG_CLOSE_DAY }}</span>
                <span class="date-col-month">{{ \Carbon\Carbon::create(null, \App\Http\Controllers\PendaftaranPesertaController::REG_CLOSE_MONTH)->translatedFormat('F') }}</span>
                <span class="date-col-year">{{ \App\Http\Controllers\PendaftaranPesertaController::REG_CLOSE_YEAR }}</span>
            </div>
        </div>

        <!-- ── COUNTDOWN ── -->
        @if ($countdown_target)
        <div class="countdown-wrap">
            <div class="cd-label">{{ $countdown_label }}</div>
            <div class="cd-boxes">
                <div class="cd-box"><span class="cd-num" id="cd-d">--</span><span class="cd-unit">Hari</span></div>
                <span class="cd-sep">:</span>
                <div class="cd-box"><span class="cd-num" id="cd-h">--</span><span class="cd-unit">Jam</span></div>
                <span class="cd-sep">:</span>
                <div class="cd-box"><span class="cd-num" id="cd-m">--</span><span class="cd-unit">Menit</span></div>
                <span class="cd-sep">:</span>
                <div class="cd-box"><span class="cd-num" id="cd-s">--</span><span class="cd-unit">Detik</span></div>
            </div>
        </div>
        @endif

        <!-- ── CARD ── -->
        <div class="card">
            <div class="card-crown">
                <div class="crown-inner">
                    <div class="crown-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.8)"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                            <line x1="9" y1="12" x2="15" y2="12"/>
                            <line x1="9" y1="16" x2="13" y2="16"/>
                        </svg>
                    </div>
                    <div>
                        <div class="crown-text-h">Formulir Pendaftaran</div>
                        <div class="crown-text-s">Isi seluruh kolom dengan data yang valid dan benar</div>
                    </div>
                    <div class="crown-required-note">Wajib <em>*</em></div>
                </div>
            </div>

            @if ($is_open)
            <form method="POST" id="formPendaftaran" action="{{ route('form-pendaftaran.store') }}" novalidate>
                @csrf
                <div class="form-body">

                    {{-- ══════════════════════════════════
                         SEKSI 1 — Identitas Mahasiswa
                    ══════════════════════════════════ --}}
                    <div class="section-head">
                        <div class="section-head-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                            Identitas Mahasiswa
                        </div>
                        <div class="section-head-line"></div>
                    </div>

                    <div class="fg">

                        {{-- NAMA --}}
                        <div class="field {{ $errors->has('nama') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                Nama Lengkap <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" name="nama" placeholder="Nama sesuai KTP" value="{{ old('nama') }}">
                            </div>
                            @error('nama')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- NIM --}}
                        <div class="field {{ $errors->has('nim') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                NIM <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                                </span>
                                <input type="text" name="nim" placeholder="Cth: 123456"
                                       maxlength="6" value="{{ old('nim') }}" autocomplete="off" inputmode="numeric">
                            </div>
                            @error('nim')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="field {{ $errors->has('email') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                Email <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <input type="email" name="email" placeholder="nama@email.com"
                                       value="{{ old('email') }}" inputmode="email">
                            </div>
                            @error('email')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- ANGKATAN --}}
                        <div class="field {{ $errors->has('angkatan') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                Angkatan <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </span>
                                <input type="text" name="angkatan" placeholder="Cth: 2023"
                                       maxlength="4" value="{{ old('angkatan') }}" inputmode="numeric">
                            </div>
                            @error('angkatan')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- JURUSAN --}}
                        <div class="field {{ $errors->has('jurusan') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                Program Studi <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                                <select name="jurusan" style="padding-left:2.6rem">
                                    <option value="" disabled {{ old('jurusan') ? '' : 'selected' }}>-- Pilih program studi --</option>
                                    @foreach (\App\Http\Controllers\PendaftaranPesertaController::PROGRAM_STUDI as $prodi)
                                        <option value="{{ $prodi }}" {{ old('jurusan') === $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jurusan')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- KONSENTRASI --}}
                        <div class="field {{ $errors->has('konsentrasi') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                                Konsentrasi <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </span>
                                <select name="konsentrasi" style="padding-left:2.6rem">
                                    <option value="" disabled {{ old('konsentrasi') ? '' : 'selected' }}>-- Pilih konsentrasi --</option>
                                    @foreach (\App\Http\Controllers\PendaftaranPesertaController::KONSENTRASI as $k)
                                        <option value="{{ $k }}" {{ old('konsentrasi') === $k ? 'selected' : '' }}>{{ $k }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('konsentrasi')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- NO HP --}}
                        <div class="field fg-full {{ $errors->has('no_hp') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                No. HP / WhatsApp <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3.09 5.18 2 2 0 0 1 5.07 3h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L9.09 10.9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                </span>
                                <input type="tel" name="no_hp" placeholder="08xxxxxxxxxx"
                                       value="{{ old('no_hp') }}" inputmode="tel">
                            </div>
                            @error('no_hp')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- JENIS KELAMIN --}}
                        <div class="field fg-full {{ $errors->has('jk') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2"/></svg>
                                Jenis Kelamin <span class="req">*</span>
                            </label>
                            <div class="gender-row">
                                <label class="gl" style="flex:1">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') === 'Laki-laki' ? 'checked' : '' }}>
                                    <span class="gl-dot"></span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="7" r="4"/><path d="M10 11c-5 0-8 2.5-8 5v1h16v-1c0-2.5-3-5-8-5z"/><line x1="17" y1="1" x2="17" y2="7"/><line x1="14" y1="4" x2="20" y2="4"/></svg>
                                    Laki-laki
                                </label>
                                <label class="gl" style="flex:1">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'checked' : '' }}>
                                    <span class="gl-dot"></span>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M8 12c-4 0-6 2-6 4v1h16v-1c0-2-2-4-6-4z"/><line x1="12" y1="14" x2="12" y2="19"/><line x1="9" y1="17" x2="15" y2="17"/></svg>
                                    Perempuan
                                </label>
                            </div>
                            @error('jenis_kelamin')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                    </div>{{-- .fg --}}

                    {{-- ══════════════════════════════════
                         SEKSI 2 — Data Pribadi
                    ══════════════════════════════════ --}}
                    <div class="section-head">
                        <div class="section-head-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Data Pribadi
                        </div>
                        <div class="section-head-line"></div>
                    </div>

                    <div class="fg">

                        {{-- TEMPAT LAHIR --}}
                        <div class="field {{ $errors->has('tempat_lahir') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                Tempat Lahir <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                </span>
                                <input type="text" name="tempat_lahir" placeholder="Cth: Makassar"
                                       value="{{ old('tempat_lahir') }}">
                            </div>
                            @error('tempat_lahir')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="field {{ $errors->has('tanggal_lahir') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                Tanggal Lahir <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                </span>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                            @error('tanggal_lahir')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- HOBI --}}
                        <div class="field fg-full {{ $errors->has('hobi') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                Hobi <span class="req">*</span>
                            </label>
                            <div class="input-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                </span>
                                <input type="text" name="hobi" placeholder="Cth: Membaca, Coding, Desain, Main game"
                                       value="{{ old('hobi') }}">
                            </div>
                            @error('hobi')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="field fg-full {{ $errors->has('alamat') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                Alamat Lengkap <span class="req">*</span>
                            </label>
                            <div class="input-shell ta-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                                </span>
                                <textarea name="alamat" rows="3"
                                    placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota/Kab.">{{ old('alamat') }}</textarea>
                            </div>
                            @error('alamat')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                        {{-- ALASAN MASUK --}}
                        <div class="field fg-full {{ $errors->has('alasan_masuk') ? 'has-err' : '' }}">
                            <label class="field-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                Alasan Masuk <span class="req">*</span>
                            </label>
                            <div class="input-shell ta-shell">
                                <span class="inp-ico">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                </span>
                                <textarea name="alasan_masuk" rows="4"
                                    placeholder="Tuliskan alasan Anda mendaftar di UKM kami">{{ old('alasan_masuk') }}</textarea>
                            </div>
                            @error('alasan_masuk')<span class="err-msg">{{ $message }}</span>@enderror
                        </div>

                    </div>{{-- .fg --}}

                </div>{{-- .form-body --}}

                <div class="form-foot">
                    <div class="foot-divider"></div>
                    <button type="submit" id="btnSubmit" class="btn-submit">
                        <span>Kirim Pendaftaran</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                    <p class="foot-note">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Data Anda dienkripsi dan terlindungi sesuai kebijakan privasi kami
                    </p>
                </div>
            </form>
            @else
            <div style="padding:2rem;text-align:center;">
                <p style="font-size:1rem;opacity:.7;">
                    @if ($is_before)
                        Pendaftaran belum dibuka. Silakan kembali pada tanggal yang telah ditentukan.
                    @else
                        Masa pendaftaran telah berakhir. Terima kasih atas antusiasme Anda.
                    @endif
                </p>
            </div>
            @endif

        </div>{{-- .card --}}

        <!-- ── COUNTDOWN SCRIPT ── -->
        @if ($countdown_target)
        <script>
            (function () {
                const target = new Date("{{ $countdown_target }}");
                function tick() {
                    const diff = Math.max(0, Math.floor((target - new Date()) / 1000));
                    const pad  = n => String(n).padStart(2, '0');
                    document.getElementById('cd-d').textContent = pad(Math.floor(diff / 86400));
                    document.getElementById('cd-h').textContent = pad(Math.floor((diff % 86400) / 3600));
                    document.getElementById('cd-m').textContent = pad(Math.floor((diff % 3600) / 60));
                    document.getElementById('cd-s').textContent = pad(diff % 60);
                    if (diff > 0) setTimeout(tick, 1000);
                }
                tick();
            })();
        </script>
        @endif

        <!-- ── PAGE FOOTER ── -->
        <div id="ed" class="page-foot">
            <div class="pf-orn">
                <div class="pf-line"></div>
                <div class="pf-diamond"></div>
                <div class="pf-line"></div>
            </div>
            <p class="pf-text">
                &nbsp;·&nbsp; © DITRA XXIV&nbsp;·&nbsp;<a class="aku" href="{{ url('/') }}" >Dimensi </a> Training 24&nbsp;·&nbsp; Semua Hak Dilindungi
            </p>
        </div>

    </div>{{-- .page --}}

    <script>
    const form = document.getElementById('formPendaftaran');

if (form) {
    form.addEventListener('submit', function(e) {

        const btn = document.getElementById('btnSubmit');

        if (btn.disabled) {
            e.preventDefault();
            return;
        }

        btn.disabled = true;

        btn.innerHTML = `
            <span style="display:flex;align-items:center;gap:8px;">
                <svg width="20" height="20" viewBox="0 0 50 50">
                    <circle cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="4"
                        stroke-linecap="round" stroke-dasharray="90,150">
                        <animateTransform
                            attributeName="transform"
                            type="rotate"
                            from="0 25 25"
                            to="360 25 25"
                            dur="1s"
                            repeatCount="indefinite"/>
                    </circle>
                </svg>
                Mengirim...
            </span>
        `;
    });
}
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Pendaftaran Berhasil!',
                text: 'Silakan bergabung ke grup WhatsApp untuk informasi selanjutnya.',
                icon: 'success',
                confirmButtonText: 'Gabung Grup'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("https://chat.whatsapp.com/JDJTs338udE1k5NzGkUBG8", "_blank");
                }
            });
        }
    });
</script>
@endif


</body>
</html>
