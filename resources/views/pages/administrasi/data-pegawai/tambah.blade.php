@extends('components.main')
@section('title-content')
    Data Pegawai
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
    </script>
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-pegawai">Pegawai</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Pegawai</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tambah Data Pegawai</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="data-pegawai-insert" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">NIP</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan NIP</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" name="nip"
                                    class="form-control rounded-3" required value="{{ old('nip') }}"
                                    {{ $errors->has('nip') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nip'))
                                <span class="text-danger">{{ $errors->first('nip') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nama lengkap</label>
                                <input type="text" name="nama" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ old('nama') }}"
                                    {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Jenis Kelamin</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-laki"
                                    value="Laki-laki" {{ old('jeniskelamin') == 'Laki-laki' ? 'checked=' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan"
                                    value="Perempuan" {{ old('jeniskelamin') == 'Perempuan' ? 'checked=' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <div class="input-group">
                                <select class="form-select rounded-3 form-control-lg text-sm"
                                    aria-label="Default select example" name="jabatan">
                                    <option selected>-- Pilih Jabatan --</option>
                                    <option value="Kepala Sekolah"
                                        @if (old('jabatan') == 'Kepala Sekolah') {{ 'selected' }} @endif>Kepala Sekolah</option>
                                    <option value="waka" @if (old('jabatan') == 'waka') {{ 'selected' }} @endif>
                                        Wakil Kepala Sekolah</option>
                                    <option value="Tata Usaha" @if (old('jabatan') == 'Tata Usaha') {{ 'selected' }} @endif>
                                        Tata Usaha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tempat Lahir</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan tempat lahir</label>
                                <input type="text" name="tempatlahir" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ old('tempatlahir') }}"
                                    {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="date" name="tgllahir" class="form-control rounded-3" id="inputEmail4"
                                    required value="{{ old('tgllahir') }}"
                                    {{ $errors->has('tgllahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">No Telepon</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan no telepon</label>
                                <input type="text" maxlength="13" onkeypress="return hanyaAngka(event)" name="notelp"
                                    class="form-control rounded-3" id="inputEmail4" required value="{{ old('notelp') }}"
                                    {{ $errors->has('notelp') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('notelp'))
                                <span class="text-danger">{{ $errors->first('notelp') }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Agama</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan agama</label>
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="agama">
                                        <option selected>-- Pilih Agama --</option>
                                        <option value="Islam"
                                            @if (old('agama') == 'Islam') {{ 'selected' }} @endif>Islam</option>
                                        <option value="Kristen Protestan"
                                            @if (old('agama') == 'Kristen Protestan') {{ 'selected' }} @endif>Kristen Protestan
                                        </option>
                                        <option value="Kristen Katolik"
                                            @if (old('agama') == 'Kristen Katolik') {{ 'selected' }} @endif>Kristen Katolik
                                        </option>
                                        <option value="Hindu"
                                            @if (old('agama') == 'Hindu') {{ 'selected' }} @endif>Hindu</option>
                                        <option value="Buddha"
                                            @if (old('agama') == 'Buddha') {{ 'selected' }} @endif>Buddha</option>
                                        <option value="Konghucu"
                                            @if (old('agama') == 'Konghucu') {{ 'selected' }} @endif>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Alamat</label>
                            <div class="input-group">
                                <textarea name="alamat" class="form-control rounded-3" style="height: 100px" required>{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control rounded-3 text-sm" name="foto" type="file"
                                id="file-input-poster" accept="image/*" onchange="showPreviewposter(event);"
                                value="{{ old('foto') }}" {{ $errors->has('foto') ? 'autofocus="true"' : '' }}>
                            <img src=" {{ asset('assets') }}/img/thumbnail.png" id="file-preview-poster" alt="..."
                                class="img-thumbnail mt-2" width="50%">
                            {{-- <p style="font-size: 13px">Ukuran direkomendasikan 1920x1080 pixel</p> --}}
                        </div>
                        <div class="col text-right">
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="data-pegawai" type="button" class="btn btn-danger text-sm rounded-3"
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
