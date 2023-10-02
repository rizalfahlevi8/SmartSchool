@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-guru">Guru</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Guru</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit Data Guru</h6>
                    </div>
                </div>
                @php
                    $alamat_array = explode(',', $guru->alamat);
                    while (count($alamat_array) < 5) {
                        $alamat_array[] = '';
                    }
                    $form_input = [
                        'nip' => $guru->nip,
                        'nama' => $guru->nama,
                        'no_telp' => $guru->no_telp,
                        'agama' => $guru->agama,
                        'tempat_lahir' => $guru->tempat_lahir,
                        'tanggal_lahir' => $guru->tanggal_lahir,
                        'alamat.provinsi' => $alamat_array[0],
                        'alamat.kabupaten' => $alamat_array[1],
                        'alamat.kecamatan' => $alamat_array[2],
                        'alamat.desa' => $alamat_array[3],
                        'alamat.lanjutan' => $alamat_array[4],
                        'jenis_kelamin' => $guru->jenis_kelamin,
                        'status' => $guru->status,
                        'foto' => $guru->foto,
                        'signature' => $guru->signature,
                    ];
                    foreach ($form_input as $key => $input_value) {
                        if (old($key) && old($key) != '') {
                            $form_input[$key] = old($key);
                        }
                    }
                @endphp
                <div class="card-body px-0 pb-2">
                    <form action="/administrasi/guru-update/{{ $guru->id }}" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <div class="input-group">
                                <input id="nip" type="text" onkeypress="return hanyaAngka(event)" name="nip"
                                    class="form-control rounded-3" pattern="[0-9]{16}" maxlength="16" required
                                    value="{{ $form_input['nip'] }}" {{ $errors->has('nip') ? 'autofocus="true"' : '' }}
                                    readonly disabled>
                            </div>
                            @if ($errors->has('nip'))
                                <span class="text-danger">{{ $errors->first('nip') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" name="nama" class="form-control rounded-3" id="nama" required
                                    value="{{ $form_input['nama'] }}"
                                    {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="no_telp">No Telepon</label>
                            <div class="input-group">
                                <input id="no_telp" type="text" maxlength="13" onkeypress="return hanyaAngka(event)"
                                    name="no_telp" class="form-control rounded-3" id="no_telp" required
                                    value="{{ $form_input['no_telp'] }}"
                                    {{ $errors->has('no_telp') ? 'autofocus="true"' : '' }} readonly disabled>
                            </div>
                            @if ($errors->has('no_telp'))
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="agama">Agama</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="agama" id="agama" disabled readonly>
                                        <option selected>-- Pilih Agama --</option>
                                        @foreach ($agamas as $agama)
                                            <option value="{{ $agama }}"
                                                @if ($form_input['agama'] == $agama) {{ 'selected' }} @endif>
                                                {{ ucfirst($agama) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="tempat_lahir">Tempat Lahir</label>
                            <div class="input-group">
                                <input type="text" name="tempat_lahir" class="form-control rounded-3" id="tempat_lahir"
                                    required disabled value="{{ $form_input['tempat_lahir'] }}"
                                    {{ $errors->has('tempat_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_lahir" class="form-control rounded-3" id="tanggal_lahir"
                                    required disabled value="{{ $form_input['tanggal_lahir'] }}"
                                    {{ $errors->has('tanggal_lahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6" style="display: flex; flex-wrap: wrap; gap: 10px">
                            @foreach (['provinsi', 'kabupaten', 'kecamatan', 'desa'] as $alamat_detail)
                                <div class="" style="flex-grow: 1; min-width: 218px;">
                                    <label for="alamat-{{ $alamat_detail }}"
                                        class="form-label">{{ ucfirst($alamat_detail) }}</label>
                                    <div class="input-group">
                                        <input name="alamat[{{ $alamat_detail }}]" class="form-control rounded-3"
                                            id="alamat-{{ $alamat_detail }}" type="text"
                                            value="{{ $form_input['alamat.' . $alamat_detail] }}" required>
                                    </div>
                                </div>
                            @endforeach
                            <div class="" style="flex-grow: 1; min-width: 218px;">
                                <label for="alamat-lanjutan" class="form-label">Informasi Tambahan</label>
                                <div class="input-group">
                                    <textarea name="alamat[lanjutan]" class="form-control rounded-3" id="alamat-lanjutan" type="text"
                                        placeholder="Dusun, Jalan, Rt/Rw..." style="resize: none">{{ $form_input['alamat.lanjutan'] }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <br>
                            @foreach (['laki-laki', 'perempuan'] as $gender)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="{{ $gender }}" value="{{ $gender }}" required
                                        @if ($form_input['jenis_kelamin'] == $gender) {{ 'checked' }} @endif disabled>
                                    <label class="form-check-label" for="{{ $gender }}">
                                        {{ ucfirst($gender) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status Guru</label>
                            <br>
                            @foreach ($status_gurus as $status_guru)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        id="{{ $status_guru }}" value="{{ $status_guru }}" required
                                        @if ($form_input['status'] == $status_guru) {{ 'checked' }} @endif>
                                    <label class="form-check-label" for="{{ $status_guru }}">
                                        {{ ucfirst($status_guru) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Foto</label>
                            <br>
                            <img src=" {{ asset('storage/guru/img/' . $form_input['foto']) }}" id="file-preview-poster"
                                alt="..." class="img-thumbnail mt-2" width="50%">
                            {{-- <p style="font-size: 13px">Ukuran direkomendasikan 1920x1080 pixel</p> --}}
                        </div>

                        <div class="col-md-6">
                            <label for="signature-pad" class="form-label">Signature</label>
                            <div id="signature-pad" class="signature-pad" style="height: 65%">
                                <img src=" {{ asset('storage/guru/signatures/' . $form_input['signature']) }}"
                                    id="file-preview-poster" alt="..." class="img-thumbnail mt-2" width="100%">
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                            <a href="/administrasi/guru" type="button" class="btn btn-danger text-sm rounded-3"
                                style="margin-bottom: 0;">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                class="btn btn-primary text-sm rounded-3 mr-2" style="margin-bottom: 0;">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

        function showPreviewSignature(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("signature-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
{{-- footer --}}
