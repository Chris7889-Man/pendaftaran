@extends('admin.layouts.app')

@section('dataPeserta')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables Data Peserta</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a href="#">official
            DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>No Hp</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Konsentrasi</th>
                            <th>Hobi</th>
                            <th>Alasan Masuk</th>
                            <th>Status Peserta</th>
                            <th>Status Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPeserta as $peserta)
                            <tr>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->nim }}</td>
                                <td>{{ $peserta->angkatan }}</td>
                                <td>{{ $peserta->jurusan }}</td>
                                <td>{{ $peserta->no_hp }}</td>
                                <td>{{ $peserta->jenis_kelamin }}</td>
                                <td>{{ $peserta->alamat }}</td>
                                <td>{{ $peserta->tempat_lahir }}, {{ $peserta->tanggal_lahir }}</td>
                                <td>{{ $peserta->konsentrasi }}</td>
                                <td>{{ $peserta->hobi }}</td>
                                <td>{{ $peserta->alasan_masuk }}</td>
                                <td>{{ $peserta->status_peserta }}</td>
                                <td>{{ $peserta->status_pembayaran }}</td>
                                <td>Rp. {{ number_format($peserta->total_pembayaran, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex justify-content-between gap-4">
                                        <!-- Tombol Print -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modalPrintPeserta{{ $peserta->id }}">
                                            <i class="fas fa-print"></i>
                                        </button>

                                        <!-- Tombol Edit -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditPeserta{{ $peserta->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#modalHapusPeserta{{ $peserta->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit Peserta -->
                            <div class="modal fade" id="modalEditPeserta{{ $peserta->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editPesertaLabel{{ $peserta->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.data-peserta.update', $peserta->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Peserta</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama"
                                                                value="{{ $peserta->nama }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ $peserta->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Angkatan</label>
                                                            <input type="text" class="form-control" name="angkatan"
                                                                maxlength="4" min="2022" max="{{ now()->year }}"
                                                                inputmode="numeric" value="{{ $peserta->angkatan }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No Hp</label>
                                                            <input type="tel" class="form-control" name="no_hp" inputmode="tel"
                                                                value="{{ $peserta->no_hp }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <input type="date" class="form-control" name="tanggal_lahir"
                                                                value="{{ $peserta->tanggal_lahir }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Hobi</label>
                                                            <input type="text" class="form-control" name="hobi"
                                                                value="{{ $peserta->hobi }}">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nim</label>
                                                            <input type="text" class="form-control" name="nim" maxlength="6"
                                                                value="{{ $peserta->nim }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jurusan</label>
                                                            <select name="jurusan" id="jurusan" class="form-control">
                                                                <option value="TEKNIK INFORMATIKA" {{ $peserta->jurusan == 'TEKNIK INFORMATIKA' ? 'selected' : '' }}>TEKNIK INFORMATIKA
                                                                </option>
                                                                <option value="SISTEM INFORMASI" {{ $peserta->jurusan == 'SISTEM INFORMASI' ? 'selected' : '' }}>SISTEM INFORMASI</option>
                                                                <option value="MANAJEMEN INFORMATIKA" {{ $peserta->jurusan == 'MANAJEMEN INFORMATIKA' ? 'selected' : '' }}>MANAJEMEN INFORMATIKA</option>
                                                                <option value="REKAYASAN PERANGKAT LUNAK" {{ $peserta->jurusan == 'REKAYASAN PERANGKAT LUNAK' ? 'selected' : '' }}>REKAYASAN PERANGKAT LUNAK</option>
                                                                <option value="BISNIS DIGITAL" {{ $peserta->jurusan == 'BISNIS DIGITAL' ? 'selected' : '' }}>BISNIS DIGITAL</option>
                                                                <option value="KEWIRAUSAHAAN" {{ $peserta->jurusan == 'KEWIRAUSAHAAN' ? 'selected' : '' }}>
                                                                    KEWIRAUSAHAAN</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jenis Kelamin</label><br>
                                                            <div class="d-flex justify-content-between mb-4">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jenis_kelamin" id="laki{{ $peserta->id }}"
                                                                        value="Laki-laki" {{ $peserta->jenis_kelamin == 'Laki-laki' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="laki{{ $peserta->id }}">Laki-laki</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jenis_kelamin" id="perempuan{{ $peserta->id }}"
                                                                        value="Perempuan" {{ $peserta->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="perempuan{{ $peserta->id }}">Perempuan</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tempat Lahir</label>
                                                            <input type="text" class="form-control" name="tempat_lahir"
                                                                value="{{ $peserta->tempat_lahir }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Konsentrasi</label>
                                                            <input type="text" class="form-control" name="konsentrasi"
                                                                value="{{ $peserta->konsentrasi }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Status Pembayaran</label>
                                                            <select name="status_pembayaran" id="status_pembayaran"
                                                                class="form-control">
                                                                <option value="Belum Lunas" {{ $peserta->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas
                                                                </option>
                                                                <option value="Lunas" {{ $peserta->status_pembayaran == 'Lunas' ? 'selected' : '' }}>Lunas</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="form-group">
                                                            <label>Total Pembayaran</label>
                                                            <input type="number" class="form-control" name="total_pembayaran"
                                                                 value="{{ $peserta->total_pembayaran }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <textarea name="alamat" id="alamat" class="form-control" cols="10"
                                                                rows="5">{{ $peserta->alamat }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alasan Masuk</label>
                                                            <textarea name="alasan_masuk" id="alasan_masuk" class="form-control"
                                                                cols="10" rows="5">{{ $peserta->alasan_masuk }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Hapus Peserta -->
                            <div class="modal fade" id="modalHapusPeserta{{ $peserta->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="hapusPesertaLabel{{ $peserta->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.data-peserta.destroy', $peserta->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Yakin ingin menghapus peserta <strong>{{ $peserta->nama }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                           <!-- Modal Print Peserta -->
                            <div class="modal fade" id="modalPrintPeserta{{ $peserta->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Print</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>
                                                Yakin ingin mencetak 
                                                <strong>{{ $peserta->nama }}</strong>?
                                            </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button onclick="printPeserta({{ $peserta->id }})"
                                                    class="btn btn-danger">
                                                Cetak
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   <script>
function printPeserta(id) {
    let url = "{{ route('admin.data-peserta.print', ':id') }}";
    url = url.replace(':id', id);

    window.open(url, '_blank');

    $('.modal').modal('hide');
}
</script>
@endsection