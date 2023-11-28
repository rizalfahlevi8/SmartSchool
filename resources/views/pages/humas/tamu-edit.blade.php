@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/humas/data-tamu">Tamu</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Tamu</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit Data Tamu</h6>
                    </div>
                </div>
                @php
                    $opsi_tujuan_array = explode(',', $tamu->Opsi_Tujuan);
                    while (count($opsi_tujuan_array) < 4) {
                        $opsi_tujuan_array[] = '';
                    }
                    $form_input = [
                        'id' => $tamu->id,
                        'nama' => $tamu->nama,
                        'alamat' => $tamu->alamat,
                        'Opsi_Tujuan' => $tamu->Opsi_Tujuan,
                        'Keterangan' => $tamu->Keterangan,
                       
                    ];
                    foreach ($form_input as $key => $input_value) {
                        if (old($key) && old($key) != '') {
                            $form_input[$key] = old($key);
                        }
                    }
                @endphp
                <div class="card-body px-0 pb-2">
                    <form action="/tamu-edit/{{ $tamu->id }}" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <label for="nip" class="form-label">id</label>
                            <div class="input-group">
                                <input id="id" type="text" onkeypress="return hanyaAngka(event)" id="id"
                                    class="form-control rounded-3" pattern="[0-9]{16}" maxlength="16" required
                                    required value="{{ $tamu->id }}" {{ $errors->has('id') ? 'autofocus="true"' : '' }}
                                    readonly disabled>
                            </div>
                            @if ($errors->has('id'))
                                <span class="text-danger">{{ $errors->first('id') }}</span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <div class="input-group">
                                <input type="text" name="namaTamu" class="form-control" id="nama" value="{{ $tamu->nama }}" required
                                    {{ $errors->has('nama') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="asal">Asal</label>
                            <div class="input-group">
                                <input type="text" name="alamatTamu" class="form-control rounded-3" id="alamat" required
                                    value="{{ $form_input['alamat'] }}"
                                    {{ $errors->has('alamat') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="tujuan">Tujuan</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="Opsi" id="Opsi_Tujuan">
                                        <option selected> Pilih Tujuan </option>
                                        @foreach ($userRoles as $r)
                                            <option value="{{ $r->role }}">{{ $r->role }}</option>  
                                        @endforeach
                                        {{-- @foreach ($tujuans as $tujuan)

                                            <option value="{{ $tujuan }}"
                                                @if ($form_input['Opsi_Tujuan'] == $tujuan) {{ 'selected' }} @endif>
                                                {{ ucfirst($tujuan) }}
                                            </option>
                                        @endforeach --}}

                                            {{-- <option value="kepala sekolah" {{ $tamu->Opsi_Tujuan == 'kepala sekolah' ? 'Selected' : '' }}>Kepala Sekolah
                                            </option>
                                            <option value="wakil kepala sekolah" {{ $tamu->Opsi_Tujuan == 'wakil kepala sekolah' ? 'Selected' : '' }}>Wakil Kepala Sekolah
                                            </option>
                                            <option value="guru" {{ $tamu->Opsi_Tujuan == 'guru' ? 'Selected' : '' }}>Guru
                                            </option>
                                            <option value="siswa" {{ $tamu->Opsi_Tujuan == 'siswa' ? 'Selected' : '' }}>Siswa
                                            </option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <div class="input-group">
                                <input type="text" name="keteranganTamu" class="form-control rounded-3" id="Keterangan"
                                    required value="{{ $form_input['Keterangan'] }}"
                                    {{ $errors->has('Keterangan') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                            <a href="/data-tamu" type="button" class="btn btn-danger text-sm rounded-3"
                                style="margin-bottom: 0;">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                href="/data-tamu" class="btn btn-primary text-sm rounded-3 mr-2" style="margin-bottom: 0;">
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
    </script>
@endsection
{{-- footer --}}