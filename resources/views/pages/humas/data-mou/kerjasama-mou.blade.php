@extends('components.main')
@section('title-content')
    Kerja Sama MoU
@endsection
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page" ><a class="opacity-5 text-dark" href="/mou">Data Kerja Sama</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Kerja Sama</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tambah Mitra Kerja Sama</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
              <main class="form-Kerjasama">
                <form action="/add-mou" method="post" enctype="multipart/form-data" class="row g-3 py-1 px-4">
                  @csrf
                    <div class="col-md-6">
                        <label class="form-label" for="nama">Nama Mitra</label>
                        <div class="input-group">
                            <input
                            type="text" name="nama_mitra" class="form-control rounded-3"
                            id="nama_mitra" required
                                value="{{ old('nama_mitra') }}" {{ $errors->has('nama_mitra') ? 'autofocus="true"' : '' }}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">PT Mitra</label>
                        <div class="input-group">
                            <input
                            type="text" name="pt_mitra" class="form-control rounded-3"
                            id="pt_mitra" required
                                value="{{ old('pt_mitra') }}" {{ $errors->has('pt_mitra') ? 'autofocus="true"' : '' }}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">Asal Mitra atau Instansi</label>
                        <div class="input-group">
                            <input
                            type="text" name="asal_mitra" class="form-control rounded-3"
                            id="asal_mitra" required
                                value="{{ old('asal_mitra') }}" {{ $errors->has('asal_mitra') ? 'autofocus="true"' : '' }}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">Tujuan Mitra</label>
                        <div class="input-group">
                            <input
                            type="text" name="tujuan_mitra" class="form-control rounded-3"
                            id="tujuan_mitra" required
                                value="{{ old('tujuan_mitra') }}" {{ $errors->has('tujuan_mitra') ? 'autofocus="true"' : '' }}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Deskripsi Singkat Mitra</label>
                        <div class="form-floating mb-3" >
                            <textarea class="form-control" name="deskripsi_singkat_mitra" placeholder="Leave a comment here" id="floatingTextarea" style="height: 120px"
                            id="deskripsi_singkat_mitra" required
                                value="{{ old('deskripsi_singkat_mitra') }}" {{ $errors->has('deskripsi_singkat_mitra') ? 'autofocus="true"' : '' }}></textarea>
                            <label for="floatingTextarea" style="color:darkgrey" > Jelaskan deskripsi singkat terkait kerja sama</label>
                        </div>
                    </div>

                    {{-- <div class="col-md-6">

                        <div class="row">
                            <label for="formFile" class="form-label">File</label>
                            <label class="form-label"> Keterangan : Silahkan upload file dalam bentuk doc, docx atau pdf </label>
                        </div>
                            <input class="form-control rounded-3 text-sm" name="file_mitra" type="file"
                            id="file-input"
                            required value="{{ old('file_mitra') }}" {{ $errors->has('file_mitra') ? 'autofocus="true"' : '' }}>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="row">
                            <label for="formFile" class="form-label">File</label>
                            <label class="form-label"> Keterangan : Silahkan upload file dalam bentuk doc, docx, atau pdf </label>
                        </div>
                        <input class="form-control rounded-3 text-sm" name="file_mitra" type="file"
                            id="file-input" accept=".doc, .docx, .pdf"
                            required value="{{ old('file_mitra') }}" {{ $errors->has('file_mitra') ? 'autofocus="true"' : '' }}>
                        <span id="file-error" class="text-danger"></span>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai Kerjasama</label>
                        <div class="input-group">
                            <input type="date" name="tgl_mulai_kerjasama" class="form-control rounded-3"
                            id='tgl_mulai_kerjasama'
                                required value="{{ old('tgl_mulai_kerjasama') }}"
                                {{ $errors->has('tgl_mulai_kerjasama') ? 'autofocus="true"' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="tanggal_berakhir">Tanggal Berakhir Kerjasama</label>
                        <div class="input-group">
                            <input type="date" name="tgl_berakhir_kerjasama" class="form-control rounded-3"
                            id='tgl_berakhir_kerjasama'
                                required value="{{ old('tgl_berakhir_kerjasama') }}"
                                {{ $errors->has('tgl_berakhir_kerjasama') ? 'autofocus="true"' : '' }}>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end" style="gap: 10px">
                        <a href="/mou" type="button" class="btn btn-danger text-sm rounded-3"
                            style="margin-bottom: 0;">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                            class="btn btn-primary text-sm rounded-3 mr-2" style="margin-bottom: 0;">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body py-1 px-4 pb-2">

                </div>
        </div>
    </div>
</div>

<script>
    // Dapatkan elemen input tanggal
    var tglMulaiInput = document.getElementById('tgl_mulai_kerjasama');
    var tglBerakhirInput = document.getElementById('tgl_berakhir_kerjasama');

    // Tambahkan event listener untuk memeriksa tanggal
    tglMulaiInput.addEventListener('change', function () {
        validateDates();
    });

    tglBerakhirInput.addEventListener('change', function () {
        validateDates();
    });

    function validateDates() {
        // Dapatkan tanggal yang dipilih
        var tglMulai = new Date(tglMulaiInput.value);
        var tglBerakhir = new Date(tglBerakhirInput.value);

        // Periksa apakah Tanggal Mulai setelah atau sama dengan Tanggal Berakhir
        if (tglMulai >= tglBerakhir) {
            alert('Tanggal Mulai Kerjasama harus setelah Tanggal Berakhir Kerjasama.');
            // Anda juga dapat mereset input tanggal atau menampilkan pesan kesalahan ke pengguna.

            // reset tanggal
            tglBerakhirInput.value='';
        }
    }
</script>

<script>
    document.getElementById('file-input').addEventListener('change', function() {
        var allowedExtensions = ['.doc', '.docx', '.pdf'];
        var input = this;
        var file = input.files[0];
        var fileName = file.name;

        var isValid = allowedExtensions.some(function(ext) {
            return fileName.endsWith(ext);
        });

        var errorSpan = document.getElementById('file-error');
        if (!isValid) {
            errorSpan.textContent = 'File harus dalam format doc, docx, atau pdf.';
            input.value = '';  // Clear the input field
        } else {
            errorSpan.textContent = '';  // Clear any previous error message
        }
    });
</script>
@endsection
