<head>
    <!-- Select2 -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
      <!-- Or for RTL support -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
</head> 
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
                    // $opsi_tujuan_array = explode(',', $tamu->Opsi_Tujuan);
                    // while (count($opsi_tujuan_array) < 4) {
                    //     $opsi_tujuan_array[] = '';
                    // }
                    $form_input = [
                        'id' => $tamu->id,
                        'nama' => $tamu->nama,
                        'alamat' => $tamu->alamat,
                        'Opsi_Tujuan' => $tamu->Opsi_Tujuan,
                        'Keterangan' => $tamu->Keterangan,
                        'Opsi_lanjutan' => $tamu->Opsi_lanjutan,
                       
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
                            <label class="form-label" for="asal">Pilih Tujuan</label>
                            <select onchange="handleTujuan(this)" id="opsi_tujuan" name="Opsi" class="form-select" aria-label="Default select example">
                                <option value="" disabled selected></option>
                                @foreach ($userRoles as $r)
                                    @php
                                        $formattedRole = ucwords($r->role);
                                    @endphp
                                    <option value="{{ $r->role }}" {{ $r->role == $form_input['Opsi_Tujuan'] ? 'selected' : '' }}>
                                        {{ $formattedRole }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="asal">Pilih nama yang ingin dituju</label>
                            <select id="opsi_lanjutan" name="Opsi_Lanjutan" class="form-select col-md-3" aria-label="Default select example">
                                <option value="" {{ $form_input['Opsi_lanjutan'] == '' ? 'selected' : '' }}></option>
                                <!-- Tambahan opsi yang dihasilkan dari data sebelumnya -->
                            </select>
                        </div>
                        
                        {{-- <div class="col-md-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <div class="input-group">
                                <input type="text" name="keteranganTamu" class="form-control rounded-3" id="Keterangan"
                                    required value="{{ $form_input['Keterangan'] }}"
                                    {{ $errors->has('Keterangan') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div> --}}

                        <div class="mb-3" style="padding-left: 20px; padding-right: 20px;">
                            <label for="exampleFormControlTextarea1" class="form-label fs-6">Keterangan</label>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="keteranganTamu" id="floatingTextarea" style="height: 100px" required{{ $errors->has('Keterangan') ? ' autofocus="true"' : '' }}>{{ $form_input['Keterangan'] }}</textarea>
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
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    const opsi_lanjutan_dropdown = $('#opsi_lanjutan');
    const opsi_tujuan_dropdown = $('#opsi_tujuan');

    opsi_tujuan_dropdown.select2({
        theme: 'bootstrap-5',
        width: opsi_tujuan_dropdown.data('width') ? opsi_tujuan_dropdown.data('width') : opsi_tujuan_dropdown.hasClass('w-100') ? '100%' : 'style',
        placeholder: opsi_tujuan_dropdown.data('placeholder'),
    });

    opsi_lanjutan_dropdown.select2({
        theme: 'bootstrap-5',
        width: opsi_lanjutan_dropdown.data('width') ? opsi_lanjutan_dropdown.data('width') : opsi_lanjutan_dropdown.hasClass('w-100') ? '100%' : 'style',
        placeholder: opsi_lanjutan_dropdown.data('placeholder'),
    });

    const handleTujuan = async (role) => {
        try {
            const res = await fetch(`/get-username-by-role/${role}`);
            const result = await res.json();
            console.log(result);

            let options = result.map(user => `<option value="${user.username}">${user.nama}</option>`);

            opsi_lanjutan_dropdown.empty().append(options);
        } catch (error) {
            console.error('Error fetching or processing data:', error);
        }
    };

    // Synchronize initial values
    const selectedRole = opsi_tujuan_dropdown.val();
        if (selectedRole) {
            handleTujuan(selectedRole);
        }

        opsi_tujuan_dropdown.on('change', function() {
            const selectedRole = $(this).val();
            handleTujuan(selectedRole);
        });

        opsi_lanjutan_dropdown.on('select2:opening', function(e) {
            const selectedRole = opsi_tujuan_dropdown.val();
            if (!selectedRole) {
                e.preventDefault();
                alert('Pilih terlebih dahulu tujuan untuk memfilter nama yang ingin di tuju');
            }
        });
    });
      </script>
@endsection
{{-- footer --}}