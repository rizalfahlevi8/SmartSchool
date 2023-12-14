@extends('components.main')


@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('barang_main') }}">Daftar Barang</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
</ol>
<h6 class="font-weight-bolder mb-0">Edit Data Daftar Barang</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Edit Data Daftar Barang</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <form method="POST" action="{{ route('update-barang', $barang->id) }}" class="row g-3 py-1 px-4" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="oldImage" value="{{$barang->image}}">
                    <div class="col-md-6">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control rounded-3" required value="{{ $barang->nama_barang }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tahun Pengadaan</label>
                        <div class="input-group">
                            <input type="date" name="tahun_pengadaan" class="form-control rounded-3" required value="{{ $barang->tahun_pengadaan }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Gambar</label>
                        <br>
                        <img src="{{ asset('storage/image/' . $barang->image) }}" height="150px" width="200px">
                        <br>
                        <label for="image" class="form-label">Pilih Gambar Baru</label>
                        <img class="img-preview img-fluid">
                        <input type="file" name="image" id="image" class="form-control rounded-3" accept="image/*" onchange="previewImage()" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis</label>
                        <select name="jenis" class="form-select rounded-3" required>
                            <option value="" selected>-- Pilih Jenis --</option>
                            @foreach ($jenis_barang as $item)
                            <option value="{{ $item }}" {{ $barang->jenis === $item ? 'selected' : '' }}>
                                {{ ucfirst($item) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Seluruh Barang</label>
                        <input type="number" name="jumlah_seluruh_barang" class="form-control rounded-3" required value="{{ $barang->jumlah_seluruh_barang }}">
                    </div>
                    {{-- Tambahkan field lain sesuai kebutuhan --}}
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary ml-5 text-sm rounded-3">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>
                        <a href="{{ route('barang_main') }}" type="button" class="btn btn-danger text-sm rounded-3">
                            <i class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function validateForm() {
        var fileInput = document.getElementById('image');
        var filePath = fileInput.value;

        // Memeriksa apakah input file tidak kosong
        if (filePath === '') {
            alert('Mohon pilih gambar sebelum melanjutkan.');
            return false;
        }

        // Memeriksa tipe file (hanya gambar yang diizinkan)
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('Tipe file tidak valid. Hanya file gambar dengan ekstensi .jpg, .jpeg, .png, atau .gif diperbolehkan.');
            fileInput.value = ''; // Mengosongkan input file jika tidak valid
            return false;
        }

        // File dan tipe valid, lanjutkan dengan operasi lain yang diperlukan
        previewImage();
        return true;
    }
</script>
@endsection