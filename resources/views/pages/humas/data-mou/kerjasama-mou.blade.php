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
                            {{-- id="nama" required
                                value="{{ old('nama') }}" {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }} --}}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">PT Mitra</label>
                        <div class="input-group">
                            <input 
                            type="text" name="pt_mitra" class="form-control rounded-3" 
                            {{-- id="nama" required
                                value="{{ old('nama') }}" {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }} --}}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">Asal Mitra atau Instansi</label>
                        <div class="input-group">
                            <input 
                            type="text" name="asal_mitra" class="form-control rounded-3" 
                            {{-- id="nama" required
                                value="{{ old('nama') }}" {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }} --}}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="nama">Tujuan Mitra</label>
                        <div class="input-group">
                            <input 
                            type="text" name="tujuan_mitra" class="form-control rounded-3" 
                            {{-- id="nama" required
                                value="{{ old('nama') }}" {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }} --}}
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Deskripsi Singkat Mitra</label>
                        <div class="form-floating mb-3" > 
                            <textarea class="form-control" name="deskripsi_singkat_mitra" placeholder="Leave a comment here" id="floatingTextarea" style="height: 120px"  ></textarea>
                            <label for="floatingTextarea" style="color:darkgrey" > Jelaskan deskripsi singkat terkait kerja sama</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">File</label>
                        <input class="form-control rounded-3 text-sm" name="file_mitra" type="file"
                            id="file-input" 
                            value="{{ old('file') }}" {{ $errors->has('file') ? 'autofocus="true"' : '' }}>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai Kerjasama</label>
                        <div class="input-group">
                            <input type="date" name="tgl_mulai_kerjasama" class="form-control rounded-3" 
                                required value="{{ old('tanggal_lahir') }}"
                                {{ $errors->has('tanggal_lahir') ? 'autofocus="true"' : '' }}>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="tanggal_berakhir">Tanggal Berakhir Kerjasama</label>
                        <div class="input-group">
                            <input type="date" name="tgl_berakhir_kerjasama" class="form-control rounded-3"
                                required value="{{ old('tanggal_lahir') }}"
                                {{ $errors->has('tanggal_lahir') ? 'autofocus="true"' : '' }}>
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
{{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script> --}}
<script>
    // var wrapper = document.getElementById("signature-pad");
    // var clearButton = wrapper.querySelector("[data-action=clear]");
    // var changeColorButton = wrapper.querySelector("[data-action=change-color]");
    // var savePNGButton = wrapper.querySelector("[data-action=save-png]");
    // var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
    // var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
    // var canvas = wrapper.querySelector("canvas");
    // var signaturePad = new SignaturePad(canvas, {
    //     backgroundColor: 'rgb(255, 255, 255)'
    // });
    // document.querySelector("[data-action=clear]").addEventListener("click", function() {
    //     signaturePad.clear();
    // });

    // function getSignatureImage() {
    //     if (!signaturePad.isEmpty()) {
    //         return signaturePad.toDataURL();
    //     } else {
    //         return null;
    //     }
    // }

    // document.querySelector("form").addEventListener("submit", function() {

    //     var signatureDataUrl = getSignatureImage();


    //     document.querySelector("#signature-input").value = signatureDataUrl;
    // });

    // function resizeCanvas() {

    //     var ratio = Math.max(window.devicePixelRatio || 1, 1);

    //     canvas.width = canvas.offsetWidth * ratio;
    //     canvas.height = canvas.offsetHeight * ratio;
    //     canvas.getContext("2d").scale(ratio, ratio);
    //     signaturePad.clear();
    // }

    // window.onresize = resizeCanvas;
    // resizeCanvas();

    ///

    // function download(dataURL, filename) {
    //     var blob = dataURLToBlob(dataURL);
    //     var url = window.URL.createObjectURL(blob);
    //     var a = document.createElement("a");
    //     a.style = "display: none";
    //     a.href = url;
    //     a.download = filename;
    //     document.body.appendChild(a);
    //     a.click();
    //     window.URL.revokeObjectURL(url);
    // }

    // function dataURLToBlob(dataURL) {
    //     var parts = dataURL.split(';base64,');
    //     var contentType = parts[0].split(":")[1];
    //     var raw = window.atob(parts[1]);
    //     var rawLength = raw.length;
    //     var uInt8Array = new Uint8Array(rawLength);
    //     for (var i = 0; i < rawLength; ++i) {
    //         uInt8Array[i] = raw.charCodeAt(i);
    //     }
    //     return new Blob([uInt8Array], {
    //         type: contentType
    //     });
    // }
    // clearButton.addEventListener("click", function(event) {
    //     signaturePad.clear();
    // });
    // changeColorButton.addEventListener("click", function(event) {
    //     var r = Math.round(Math.random() * 255);
    //     var g = Math.round(Math.random() * 255);
    //     var b = Math.round(Math.random() * 255);
    //     var color = "rgb(" + r + "," + g + "," + b + ")";
    //     signaturePad.penColor = color;
    // });
    // savePNGButton.addEventListener("click", function(event) {
    //     if (signaturePad.isEmpty()) {
    //         alert("Please provide a signature first.");
    //     } else {
    //         var dataURL = signaturePad.toDataURL();
    //         download(dataURL, "signature.png");
    //     }
    // });

    ///

    // function hanyaAngka(evt) {
    //     var charCode = (evt.which) ? evt.which : event.keyCode
    //     if (charCode > 31 && (charCode < 48 || charCode > 57))

    //         return false;
    //     return true;
    // }

    // function showPreviewposter(event) {
    //     if (event.target.files.length > 0) {
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById("file-preview-poster");
    //         preview.src = src;
    //         preview.style.display = "block";
    //     }
    // }

    // function showPreviewSignature(event) {
    //     if (event.target.files.length > 0) {
    //         var src = URL.createObjectURL(event.target.files[0]);
    //         var preview = document.getElementById("signature-preview");
    //         preview.src = src;
    //         preview.style.display = "block";
    //     }
    // }
</script>

@endsection