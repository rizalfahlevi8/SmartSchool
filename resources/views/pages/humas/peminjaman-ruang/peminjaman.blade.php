@extends('components.main')
@section('title-content')
Data Peminjaman Ruang
@endsection
@if (auth()->user()->hasRole('admin', 'wakasek'))
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-peminjaman">Peminjaman</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
</ol>
<h6 class="font-weight-bolder mb-0">Peminjaman Ruang</h6>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        @if ($hariini->count())
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-success shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Sedang Dipinjam</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    <table id="daftarhariini" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Ruang</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama Peminjam</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tanggal peminjaman</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tanggal Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hariini as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $p->ruang->nama_ruang }}</td>
                                <td class="text-center">{{ $p->nama_peminjam }}</td>
                                <td class="text-center">{{ $p->tanggal_peminjaman }}</td>
                                <td class="text-center">{{ $p->tanggal_pengembalian }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <p class="text-center">Tidak ada data untuk hari ini.</p>
        @endif
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Peminjaman Ruang</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    @if (auth()->user()->hasRole('admin'))
                    <button type="button" data-bs-toggle="modal" data-bs-target="#insert-modal" class="btn btn-primary font-weight-bold btn--edit text-xs " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                        <i class="material-icons opacity-10">add</i>Tambah
                    </button>
                    @endif
                    <a href="data-peminjaman-history" type="submit" id="btntambah" class="btn btn-danger font-weight-bold text-xs">
                        Riwayat
                    </a>
                    <!-- Button trigger modal -->

                    <table id="example" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Ruang
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Nama Peminjam
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Tanggal peminjaman
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Tanggal Pengembalian
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Status Pengajuan
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Surat Peminjaman
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        @if ($peminjaman->count())
                        <tbody>
                            @foreach ($peminjaman as $p)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ $p->ruang->nama_ruang }}
                                </td>
                                <td class="text-center">
                                    {{ $p->nama_peminjam }}
                                </td>
                                <td class="text-center">
                                    {{ $p->tanggal_peminjaman }}
                                </td>
                                <td class="text-center">
                                    {{ $p->tanggal_pengembalian }}
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ is_null($p->status_pengajuan) ? 'text-bg-warning' : ($p->status_pengajuan ? 'text-bg-success' : 'text-bg-danger') }}">
                                        {{ is_null($p->status_pengajuan) ? 'Menunggu' : ($p->status_pengajuan ? 'Disetujui' : 'Ditolak') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a  class=" btn btn-primary font-weight-bold text-sm" href="{{ asset('storage/surat/' . str_replace(' ', '%20', $p->surat)) }}" target="_blank">
                                        Lihat file
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                
                                @if (auth()->user()->hasRole('admin'))
                                <td class="text-center" style="display: flex; gap: 10px; justify-content: center">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#update-modal" id-peminjaman="{{ $p->id }}" id-ruang="{{ $p->ruang_id }}" nama-peminjam="{{ $p->nama_peminjam }}" tgl-peminjaman="{{ $p->tanggal_peminjaman }}" tgl-pengembalian="{{ $p->tanggal_pengembalian }}" class="btn btn-warning font-weight-bold btn--edit text-sm rounded-circle" style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" onclick="showUpdateModalDialog(this)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="/peminjaman-hapus/{{ $p->id }}" onclick="return confirm('Anda yakin akan menghapus data ini?')" class=" btn btn-danger font-weight-bold text-sm rounded-circle" style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                @elseif (auth()->user()->hasRole('wakasek'))
                                <td class="text-center" style="display: flex; gap: 10px; justify-content: center">
                                    @if (!$p->status_pengajuan)
                                    <a href="peminjaman-approve/{{ $p->id }}" class=" btn btn-success font-weight-bold text-sm" title="konfirmasi" onclick="return confirm('Apakah anda yakin menyetujui pengajuan ini?')">
                                        Setuju
                                    </a>
                                    <a href="peminjaman-decline/{{ $p->id }}" class=" btn btn-danger font-weight-bold text-sm" title="konfirmasi" onclick="return confirm('Apakah anda yakin menolak pengajuan ini?')">
                                        Tolak
                                    </a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">No found.</td>
                            </tr>
                        </tbody>
                        @endif
                    </table>

                    <!--Update modal-->
                    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Peminjaman
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/peminjaman-update" class="row g-3 py-1 px-4" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="text" name="id_peminjaman" value="" hidden>
                                        <div class="col-md-6">
                                            <label class="form-label">Ruang</label>
                                            <div class="input-group">
                                                <label class="form-label">Pilih Ruang</label>
                                                <div class="input-group">
                                                    <select class="form-select rounded-3 form-control-lg text-sm" aria-label="Default select example" name="ruang" id="r">
                                                        <option value="">-- Pilih Ruang --</option>
                                                        @foreach ($ruang as $r)
                                                        <option value="{{ $r->id }}">
                                                            {{ $r->nama_ruang }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama peminjam</label>
                                            <div class="input-group">
                                                <input type="text" name="nama_peminjam" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('nama_peminjam') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal peminjaman</label>
                                            <div class="input-group">
                                                <input type="date" name="tgl_peminjaman" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('tgl_peminjaman') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal pengembalian</label>
                                            <div class="input-group">
                                                <input type="date" name="tgl_pengembalian" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('tgl_pengembalian') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Surat Peminjaman</label>
                                            <div for="surat" class="input-group">
                                                <input class="form-control" type="file" id="surat" name="surat" required value="" {{ $errors->has('surat') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger ml-5 text-sm rounded-3" style="float:right; ">
                                                <i class="fa fa-save"></i>
                                                Simpan
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- modal insert --}}
                    <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Ruang
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/peminjaman-tambah" class="row g-3 py-1 px-4" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        @csrf
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Ruang</label>
                                            <div class="input-group">
                                                <label class="form-label">Pilih Ruang</label>
                                                <div class="input-group">
                                                    <select class="form-select rounded-3 form-control-lg text-sm" aria-label="Default select example" name="ruang" id="ruang" required>
                                                        <option value="">-- Pilih Ruang --</option>
                                                        @foreach ($ruang as $r)
                                                        <option value="{{ $r->id }}" {{ old('ruang') == $r->id ? 'selected' : '' }}>
                                                            {{ $r->nama_ruang }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Peminjam</label>
                                            <div class="input-group">
                                                <input type="text" name="nama_peminjam" class="form-control rounded-3" id="inputEmail4" required value="{{ old('nama_peminjam') }}" {{ $errors->has('nama_peminjam') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Peminjaman</label>
                                            <div class="input-group">
                                                <input type="date" name="tgl_peminjaman" class="form-control rounded-3" id="inputEmail4" required value="{{ old('tgl_peminjaman') }}" {{ $errors->has('tgl_peminjaman') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Pengembalian</label>
                                            <div class="input-group">
                                                <input type="date" name="tgl_pengembalian" class="form-control rounded-3" id="inputEmail4" required value="{{ old('tgl_pengembalian') }}" {{ $errors->has('tgl_pengembalian') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <input type="file" class="form-control" id="suratpinjam"
                                                        name="surat" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" required
                                                        onchange="validateForm()">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                                <i class="fa fa-save"></i>
                                                Simpan
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Aksi Detail surat waka-->
                    @if (auth()->user()->hasRole('wakasek'))
                    <div class="modal fade" id="detail-Surat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Pengajuan Peminjaman
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class="float-start fw-bold">Nama</span>
                                                            <div class="float-end">:</div>
                                                        </div>
                                                        <div class="col-md-7" style="text-transform: capitalize" id="nama_peminjam">

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class="float-start fw-bold">Tanggal Peminjaman</span>
                                                            <div class="float-end">:</div>
                                                        </div>
                                                        <div class="col-md-7" style="text-transform: capitalize" id="tanggal_peminjaman">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class="float-start fw-bold">Tanggal Pengembalian</span>
                                                            <div class="float-end">:</div>
                                                        </div>
                                                        <div class="col-md-7" style="text-transform: capitalize" id="tanggal_pengembalian">

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <span class="float-start fw-bold">Surat Pengajuan
                                                            </span>
                                                            <div class="float-end">:</div>
                                                        </div>
                                                        <div class="col-md-7" style="text-transform: capitalize" id="surat">
                                                            <a href="{{ asset('storage/public/surat/' . str_replace(' ', '%20', $p->surat)) }}" target="_blank">
                                                                Lihat file
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tolak</button>
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Setuju</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
</div>
</div>
<script>
    function showModalDialog(element) {
        const updateModalDialog = document.getElementById('detail-Surat');
        const nama = updateModalDialog.querySelector('#nama_peminjam');
        const tglPeminjaman = updateModalDialog.querySelector('#tanggal_peminjaman');
        const tglPengembalian = updateModalDialog.querySelector('#tanggal_pengembalian');

        nama.innerText = element.getAttribute('nama-peminjam');
        tglPeminjaman.innerText = element.getAttribute('tgl-peminjaman');
        tglPengembalian.innerText = element.getAttribute('tgl-pengembalian');

    }


    function showUpdateModalDialog(button) {
        // Mendapatkan nilai id-ruang dari button yang diklik
        var idRuang = button.getAttribute("id-ruang");

        // Mengambil elemen select dengan id "r"
        var selectRuang = document.getElementById("r");

        // Loop melalui semua opsi dalam elemen select
        for (var i = 0; i < selectRuang.options.length; i++) {
            var option = selectRuang.options[i];

            // Membandingkan nilai opsi dengan id-ruang yang diperoleh
            if (option.value == idRuang) {
                // Mengatur opsi yang sesuai sebagai yang terpilih
                option.selected = true;
            }
        }

        // Mendapatkan nilai atribut dari tombol yang diklik
        var detailModal = button
        var idPeminjaman = button.getAttribute("id-peminjaman");
        var namaPeminjam = button.getAttribute("nama-peminjam");
        var tglPeminjaman = button.getAttribute("tgl-peminjaman");
        var tglPengembalian = button.getAttribute("tgl-pengembalian");
        var surat = button.getAttribute("surat");


        // Mengambil elemen input dengan id yang sesuai
        var inputIdPeminjam = document.querySelector('input[name="id_peminjaman"]');
        var inputNamaPeminjam = document.querySelector('input[name="nama_peminjam"]');
        var inputTglPeminjaman = document.querySelector('input[name="tgl_peminjaman"]');
        var inputTglPengembalian = document.querySelector('input[name="tgl_pengembalian"]');
        var inputSurat = document.querySelector('input[name="surat"]');

        // Mengisi nilai input dengan nilai yang diperoleh dari tombol
        inputIdPeminjam.value = idPeminjaman;
        inputNamaPeminjam.value = namaPeminjam;
        inputTglPeminjaman.value = tglPeminjaman;
        inputTglPengembalian.value = tglPengembalian;
        inputSurat.value = surat;
    }

    function validateForm() {
    // Mendapatkan elemen input file
    var fileInput = document.getElementById('suratpinjam');

                // Memeriksa apakah ada file yang dipilih
                if (fileInput.files.length === 0) {
                    alert('Pilih file untuk diunggah.');
                    return false;
                }

    // Mendapatkan file yang dipilih
    var file = fileInput.files[0];
    
    // Memeriksa tipe file (hanya gambar atau dokumen yang diizinkan)
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf|\.doc|\.docx)$/i;

    if (!allowedExtensions.exec(file.name)) {
        alert('Tipe file tidak valid. Hanya file gambar dengan ekstensi .jpg, .jpeg, .png, atau dokumen dengan ekstensi .pdf, .doc, atau .docx diperbolehkan.');
        fileInput.value = ''; // Mengosongkan input file jika tidak valid
        return false;
    }

    return true;
}
</script>
@endif
@endsection
{{-- footer --}}