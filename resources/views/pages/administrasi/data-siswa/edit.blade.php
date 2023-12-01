@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-siswa">Siswa</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
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

            // Fungsi untuk mengatur tampilan asalSekolah saat halaman dimuat
            function setAsalSekolahVisibility() {
                if (statusSelect.value === 'pindahan') {
                    asalSekolah.style.display = 'block';
                } else {
                    asalSekolah.style.display = 'none';
                }
            }

            // Panggil fungsi saat halaman dimuat
            setAsalSekolahVisibility();

            // Tambahkan event listener untuk mendeteksi perubahan status
            statusSelect.addEventListener('change', function() {
                setAsalSekolahVisibility();
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
                        <h6 class="text-white text-capitalize ps-3">Edit Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="/administrasi/siswa-update/{{ $siswa->id }}" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">NIS</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan NIS</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nis"
                                    class="form-control rounded-3" required value="{{ $siswa->nis }}"
                                    {{ $errors->has('nis') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nis'))
                                <span class="text-danger">{{ $errors->first('nis') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">NISN</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan NISN</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nisn"
                                    class="form-control rounded-3" required value="{{ $siswa->nisn }}"
                                    {{ $errors->has('nisn') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nisn'))
                                <span class="text-danger">{{ $errors->first('nisn') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">NIK</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan NIK</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nik"
                                    class="form-control rounded-3" required value="{{ $siswa->nik }}"
                                    {{ $errors->has('nik') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nik'))
                                <span class="text-danger">{{ $errors->first('nik') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nama lengkap</label>
                                <input type="text" name="nama" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->nama }}"
                                    {{ $errors->has('nama') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tempat Lahir</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan tempat lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->tempat_lahir }}"
                                    {{ $errors->has('tempat_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_lahir" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->tanggal_lahir }}"
                                    {{ $errors->has('tanggal_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Jenis Kelamin</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="Laki-laki"
                                    value="laki-laki" {{ $siswa->jenis_kelamin == 'laki-laki' ? 'checked' : '' }}>

                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="Laki-laki"
                                    value="perempuan" {{ $siswa->jenis_kelamin == 'perempuan' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan agama</label>
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="agama">
                                        <option selected disabled>-- Pilih Agama --</option>
                                        @foreach (['islam', 'kristen', 'hindu', 'buddha', 'konghucu'] as $agama)
                                            <option value="{{ $agama }}"
                                                {{ $siswa->agama == $agama ? 'selected' : '' }}>{{ ucfirst($agama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Ayah</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->nama_ayah }}"
                                    {{ $errors->has('nama_ayah') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Ibu</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->nama_ibu }}"
                                    {{ $errors->has('nama_ibu') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Masukkan Wali</label>
                            <div class="input-group">
                                <input type="text" name="nama_wali" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ $siswa->nama_wali }}"
                                    {{ $errors->has('nama_wali') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kelas</label>
                            <div class="input-group">
                                <label class="form-label">Pilih Kelas</label>
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="kelas" id="kelas">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas_list as $kelas)
                                            <option value="{{ $kelas->id }}"
                                                {{ $siswa->id_kelas == $kelas->id ? 'selected' : '' }}>
                                                {{ $kelas->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No Telepon</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan no telepon</label>
                                <input type="text" maxlength="13" onkeypress="return hanyaAngka(event)"
                                    name="no_telp" class="form-control rounded-3" id="inputEmail4" required
                                    value="{{ $siswa->no_telp }}"
                                    {{ $errors->has('no_telp') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('no_telp'))
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan Status</label>
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="status" id="status">
                                        <option value="" selected>-- Pilih Status --</option>
                                        @foreach ($status_siswa as $status)
                                            <option value="{{ $status }}"
                                                {{ $siswa->status == $status ? 'Selected' : '' }}>{{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="asal_sekolah"
                            style="{{ $siswa->status == 'pindahan' ? 'display: block;' : 'display: none;' }}">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" class="form-control rounded-3 form-control-lg text-sm"
                                name="asal_sekolah" value="{{ $siswa->sekolah }}">
                        </div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control rounded-3 text-sm" name="foto" type="file"
                                id="file-input-poster" accept="image/*" onchange="showPreviewposter(event);"
                                value="{{ $siswa->foto }}" {{ $errors->has('foto') ? 'autofocus="true"' : '' }}>
                            <img src=" {{ asset('storage/murid/img/' . $siswa->foto) }}" id="file-preview-poster"
                                alt="..." class="img-thumbnail mt-2" width="50%">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Alamat</label>
                            <div class="input-group">
                                <textarea name="alamat" class="form-control rounded-3" style="height: 100px" required>{{ $siswa->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="text-right card-footer">
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="/administrasi/siswa" type="button" class="btn btn-danger text-sm rounded-3"
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
