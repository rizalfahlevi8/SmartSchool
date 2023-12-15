@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-siswa">Siswa</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
@endsection
@section('script')
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        function showPreviewposter(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-preview-poster");
                preview.src = src;
                preview.style.display = "block";
            }
        }

        // Menampilkan atau menyembunyikan inputan "Asal Sekolah" berdasarkan status
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const asalSekolah = document.getElementById('asal_sekolah');
            const tglMasuk = document.getElementById('tgl_masuk');

            if (statusSelect.value === 'pindahan') {
                asalSekolah.style.display = 'block';
            }
            statusSelect.addEventListener('change', function() {
                if (statusSelect.value === 'pindahan') {
                    asalSekolah.style.display = 'block';
                } else {
                    asalSekolah.style.display = 'none';
                }
            });
        });
    </script>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tambah Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="/administrasi/siswa-tambah" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf


                        {{-- <div class="col-md-6">
                            <label for="no_pendaftaran" class="form-label">Nomer Pendaftaran</label>

                        <div class="col-md-6">
                            <label for="no-pendaftar" class="form-label">Nomer Pendaftaran</label>

                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="no_pendaftar"
                                    class="form-control rounded-3" id="no-pendaftar" required
                                    value="{{ old('no_pendaftar') }}"
                                    {{ $errors->has('no_pendaftar') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('no_pendaftar'))
                                <span class="text-danger">{{ $errors->first('no_pendaftar') }}</span>
                            @endif

                        <div class="col-md-6">
                            <label for="no-pendaftar" class="form-label">Nomer Pendaftaran</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="no_pendaftar"
                                    class="form-control rounded-3" id="no-pendaftar" required
                                    value="{{ old('no_pendaftar') }}"
                                    {{ $errors->has('no_pendaftar') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('no_pendaftar'))
                                <span class="text-danger">{{ $errors->first('no_pendaftar') }}</span>
                            @endif
                        </div>

                        </div>

                        <div class="col-md-6">
                            <label for="nis" class="form-label">NIS</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nis"
                                    class="form-control rounded-3" id="nis" required value="{{ old('nis') }}"
                                    {{ $errors->has('nis') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nis'))
                                <span class="text-danger">{{ $errors->first('nis') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="nisn" class="form-label">NISN</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nisn"
                                    class="form-control rounded-3" required value="{{ old('nisn') }}" id="nisn"
                                    {{ $errors->has('nisn') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nisn'))
                                <span class="text-danger">{{ $errors->first('nisn') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <div class="input-group">
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nik"
                                    class="form-control rounded-3" id="nik" required value="{{ old('nik') }}"
                                    {{ $errors->has('nik') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nik'))
                                <span class="text-danger">{{ $errors->first('nik') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control rounded-3" id="nama" required
                                    value="{{ old('nama') }}" {{ $errors->has('nama') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="tempat-lahir">Tempat Lahir</label>
                            <div class="input-group">
                                <input type="text" name="tempat_lahir" class="form-control rounded-3" id="tempat-lahir"
                                    required value="{{ old('tempat_lahir') }}"
                                    {{ $errors->has('tempat_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="tanggal-lahir">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_lahir" class="form-control rounded-3" id="tanggal-lahir"
                                    required value="{{ old('tanggal_lahir') }}"
                                    {{ $errors->has('tanggal_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                            <br>
                            @foreach (['laki-laki', 'perempuan'] as $gender)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="{{ $gender }}" value="{{ $gender }}"
                                        @if (old('jenis_kelamin') == $gender) checked @endif id="jenis-kelamin">
                                    <label class="form-check-label" for="{{ $gender }}">
                                        {{ ucfirst($gender) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="agama">Agama</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="agama" required id="agama">
                                        <option selected>-- Pilih Agama --</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama }}"
                                                @if (old('agama') == $agama) selected @endif>
                                                {{ ucfirst($agama) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="nama-ayah">Nama Ayah</label>
                            <div class="input-group">
                                <input type="text" name="nama_ayah" class="form-control rounded-3" id="nama-ayah"
                                    required value="{{ old('nama_ayah') }}"
                                    {{ $errors->has('nama_ayah') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="nama-ibu">Nama Ibu</label>
                            <div class="input-group">
                                <input type="text" name="nama_ibu" class="form-control rounded-3" id="nama-ibu"
                                    required value="{{ old('nama_ibu') }}"
                                    {{ $errors->has('nama_ibu') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="nama-wali">Nama Wali</label>
                            <div class="input-group">
                                <input type="text" name="nama_wali" class="form-control rounded-3" id="nama-wali"


                                    value="{{ old('nama_wali') }}"

                                    required value="{{ old('nama_wali') }}"

                                    {{ $errors->has('nama_wali') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="kelas">Kelas</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="kelas" id="kelas" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($list_kelas as $kelas)
                                            <option value="{{ $kelas->id }}"
                                                {{ old('kelas') == $kelas->id ? 'selected' : '' }}>
                                                {{ $kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="no-telp">No Telepon</label>
                            <div class="input-group">
                                <input type="text" maxlength="13" onkeypress="return hanyaAngka(event)"
                                    name="no_telp" class="form-control rounded-3" id="no-telp" required
                                    value="{{ old('no_telp') }}" {{ $errors->has('no_telp') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('no_telp'))
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="status" id="status" required>
                                        <option selected>-- Pilih Status --</option>
                                        <option value="bukan pindahan" @if (old('status') == 'bukan pindahan' || request('status') == 'bukan pindahan' || (isset($_GET['status']) && $_GET['status'] == 'bukan pindahan')) selected @endif>Baru
                                        </option>
                                        <option value="pindahan" @if (old('status') == 'pindahan' || request('status') == 'dipindah' || (isset($_GET['status']) && $_GET['status'] == 'pindahan')) selected @endif>Pindahan
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="asal_sekolah" style="display: none;">
                            <label class="form-label" for="asal-sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control rounded-3 form-control-lg text-sm"
                                name="asal_sekolah" value="{{ old('asal_sekolah') }}" id="asal-sekolah">
                        </div>
                        <div class="col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <div class="input-group">
                                <textarea name="alamat" class="form-control rounded-3" style="height: 100px" required id="alamat">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="file-input-poster" class="form-label">Foto</label>
                            <input class="form-control rounded-3 text-sm" name="foto" type="file"

                                id="file-input-poster" accept="image/*" onchange="showPreviewposter(event);"

                                id="file-input-poster" accept="image/*" required onchange="showPreviewposter(event);"

                                value="{{ old('foto') }}" {{ $errors->has('foto') ? 'autofocus' : '' }}>
                            <img src="{{ asset('assets' . '/img/thumbnail.png') }}" id="file-preview-poster"
                                alt="..." class="img-thumbnail mt-2" width="50%">
                            {{-- <p style="font-size: 13px">Ukuran direkomendasikan 1920x1080 pixel</p> --}}
                        </div>
                        <div class="col text-right">
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                <i class="fa fa-right"></i>
                                Simpan
                            </button>
                            <a href="siswa" type="button" class="btn btn-danger text-sm rounded-3"
                                style="float: right;margin-right:10px"><i class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
