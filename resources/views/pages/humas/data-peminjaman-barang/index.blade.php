@extends('components.main')
@section('title-content')
Data Peminjaman barang
@endsection
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-peminjaman">Peminjaman barang</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
</ol>
<h6 class="font-weight-bolder mb-0">Peminjaman barang</h6>
@endsection
@section('content')
{{-- @dd($peminjaman) --}}

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
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jumlah</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama Peminjam</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tanggal peminjaman</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tanggal Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($hariini) --}}
                            @foreach ($hariini as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $p->barang->nama_barang}}</td>
                                <td class="text-center">{{ $p->jumlah }}</td>
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
                    <h6 class="text-white text-capitalize ps-3">Peminjaman Barang</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    @if (auth()->user()->hasRole('admin'))
                    <button type="button" data-bs-toggle="modal" data-bs-target="#insert-modal" class="btn btn-primary font-weight-bold btn--edit text-xs " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                        <i class="material-icons opacity-10">add</i>Tambah
                    </button>
                    @endif
                    <a href="/data-peminjaman-barang-history" type="submit" id="btntambah" class="btn btn-danger font-weight-bold text-xs">
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
                                    Barang
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Jumlah
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
                        <tbody id="table-peminjaman">
                            {{-- @dd($peminjaman) --}}
                            @foreach ($peminjaman as $p => $value)
                            <tr data-id="{{ $value->id }}">
                                <input type="hidden" name="id">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td data-id-barang="{{ $value->barang_id }}" class="text-center">
                                    {{ isset($value->barang) ? $value->barang->nama_barang : 'Barang tidak tersedia' }}
                                </td>
                                </td>
                                <td class="text-center">
                                    {{ $value->jumlah }}
                                </td>
                                <td class="text-center">
                                    {{ $value->nama_peminjam }}
                                </td>
                                <td class="text-center">
                                    {{ $value->tanggal_peminjaman }}
                                </td>
                                <td class="text-center">
                                    {{ $value->tanggal_pengembalian }}
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ is_null($value->status_pengajuan) ? 'text-bg-warning' : ($value->status_pengajuan ? 'text-bg-success' : 'text-bg-danger') }}">
                                        {{ is_null($value->status_pengajuan) ? 'Menunggu' : ($value->status_pengajuan ? 'Disetujui' : 'Ditolak') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a class=" btn btn-primary font-weight-bold text-sm" href="{{ asset('storage/surat/' . str_replace(' ', '%20', $value->surat)) }}" target="_blank">
                                        Lihat file
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                @if (auth()->user()->hasRole('admin'))
                                <td class="text-center" style="display: flex; gap: 10px; justify-content: center">
                                    <button class="btn btn-warning font-weight-bold btn--edit text-sm rounded-circle" style="margin: 5px 0;" type="button" data-bs-toggle="modal" data-bs-target="#update-modal" id-peminjaman="{{ $value->id }}" id-barang="{{ $value->barang_id }}" jumlah="{{ $value->jumlah }}" nama-peminjam="{{ $value->nama_peminjam }}" tgl-peminjaman="{{ $value->tanggal_peminjaman }}" tgl-pengembalian="{{ $value->tanggal_pengembalian }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" onclick="showUpdateModalDialog(this)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form class="d-inline" action="{{ route('peminjamanBarang.destroy', $value->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Anda yakin akan menghapus data ini?')" class=" btn btn-danger font-weight-bold text-sm rounded-circle" style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    {{-- <a href="{{ route('peminjamanBarang.destroy', $p->id) }}"
                                    onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                    class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                    </a> --}}
                                </td>
                                @elseif (auth()->user()->hasRole('wakasek'))
                                <td class="text-center" style="display: flex; gap: 10px; justify-content: center">
                                    @if (!$value->status_pengajuan)
                                    <a href="data-peminjaman-barang-approve/{{ $value->id }}" class=" btn btn-success font-weight-bold text-sm" title="konfirmasi" onclick="return confirm('Apakah anda yakin menyetujui pengajuan ini?')">
                                        Setuju
                                    </a>
                                    <a href="data-peminjaman-barang-decline/{{ $value->id }}" class=" btn btn-danger font-weight-bold text-sm" title="konfirmasi" onclick="return confirm('Apakah anda yakin menolak pengajuan ini?')">
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
                    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Peminjaman
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="modal-edit-form" action="{{ route('peminjamanBarang.update') }}" class="row g-3 py-1 px-4" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="id" value="" hidden>
                                        <div class="col-md-6">
                                            <label class="form-label">Barang</label>
                                            <div class="input-group">
                                                <label class="form-label">Pilih Barang</label>
                                                <div class="input-group">
                                                    <select class="form-select rounded-3 form-control-lg text-sm" aria-label="Default select example" name="barang" id="r">
                                                        <option value="">-- Pilih Barang --</option>
                                                        @foreach ($barang as $r)
                                                        <option value="{{ $r->id }}">
                                                            {{ $r->nama_barang }}
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
                                        <div class="col-md-6">
                                            <label class="form-label">Jumlah</label>
                                            <div class="input-group">
                                                <input type="text" name="jumlah" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('jumlah') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal peminjaman</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal_peminjaman" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('tanggal_peminjaman') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal pengembalian</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal_pengembalian" class="form-control rounded-3" id="inputEmail4" required value="" {{ $errors->has('tanggal_pengembalian') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Surat Peminjaman</label>
                                            <div for="surat" class="input-group">
                                                <input class="form-control rounded-3" type="file" id="inputEmail4" name="surat" required value="" {{ $errors->has('surat') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
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

                    {{-- modal insert --}}
                    <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white" id="exampleModalLabel"> Tambah Barang
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('peminjamanBarang.store') }}" class="row g-3 py-1 px-4" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        @csrf
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Barang</label>
                                            <div class="input-group">
                                                <label class="form-label">Pilih Barang</label>
                                                <div class="input-group">
                                                    <select name="barang_id" class="form-select rounded-3 form-control-lg text-sm" aria-label="Default select example" name="barang" id="barang" required>
                                                        <option value="">-- Pilih Barang --</option>
                                                        @foreach ($barang as $r)
                                                        <option value="{{ $r->id }}" {{ old('Barang') == $r->id ? 'selected' : '' }}>
                                                            {{ $r->nama_barang }}
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
                                                <input type="date" name="tanggal_peminjaman" class="form-control rounded-3" required value="{{ old('tanggal_peminjaman') }}" {{ $errors->has('tanggal_peminjaman') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Pengembalian</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal_pengembalian" class="form-control rounded-3" required value="{{ old('tanggal_pengembalian') }}" {{ $errors->has('tanggal_pengembalian') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah</label>
                                            <div class="input-group">
                                                <input type="number" name="jumlah" class="form-control rounded-3" id="inputEmail4" required value="{{ old('jumlah') }}" {{ $errors->has('jumlah') ? 'autofocus="true"' : '' }}>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="surat" class="form-label">Surat Pengajuan</label>
                                            <input class="form-control" type="file" id="surat" name="surat" accept=".jpg, .jpeg, .png, .pdf, .doc, .docx" required>
                                        </div>
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
                </div>
            </div>
        </div>
    </div>
    <script>
        function showModalDialog(element) {
            const updateModalDialog = document.getElementById('detail-modal');
            const nama = updateModalDialog.querySelector('#nama_peminjam');
            const namaBarang = updateModalDialog.querySelector('#barang');
            const jumlahBarang = updateModalDialog.querySelector('#jumlah');
            const tglPeminjaman = updateModalDialog.querySelector('#tanggal_peminjaman');
            const tglPengembalian = updateModalDialog.querySelector('#tanggal_pengembalian');
            const suratPeminjaman = updateModalDialog.querySelector('#surat');


            nama.innerText = element.getAttribute('nama-peminjam');
            namaBarang.innerText = element.getAttribute('nama-barang')
            jumlahBarang.innerText = element.getAttribute('jumlah');
            tglPeminjaman.innerText = element.getAttribute('tgl-peminjaman');
            tglPengembalian.innerText = element.getAttribute('tgl-pengembalian');
            suratPeminjaman.innerText = element.getAttribute('surat');
        }

        function showUpdateModalDialog(button) {
            // Mendapatkan nilai id-ruang dari button yang diklik
            var idBarang = button.getAttribute("id-barang");
            const tr = button.parentNode.parentNode;
            const form_modal = document.getElementById('modal-edit-form');


            let namaBarang = tr.children[2].getAttribute("data-id-barang");
            let jumlahBarng = tr.children[3].innerHTML;
            let namaPeminjam = tr.children[4].innerHTML;
            let tanggalPeminjam = tr.children[5].innerHTML;
            let tanggalPengembalian = tr.children[6].innerHTML;
            let suratPeminjaman = tr.children[7].innerHTML;

            const inputNamaBarang = form_modal.querySelector('select[name="barang"]');
            const inputNamaPeminjan = form_modal.querySelector('input[name="nama_peminjam"]');
            const inputJumlahBarang = form_modal.querySelector('input[name="jumlah"]');
            const inputTanggalPeminjaman = form_modal.querySelector('input[name="tanggal_peminjaman"]');
            const inputTanggalPengembalian = form_modal.querySelector('input[name="tanggal_pengembalian"]');
            const inputSuratPeminjaman = form_modal.querySelector('input[name="surat"]');

            inputNamaBarang.value = namaBarang;
            inputJumlahBarang.value = jumlahBarng;
            inputNamaPeminjan.value = namaPeminjam;
            inputTanggalPeminjaman.value = tanggalPeminjam;
            inputTanggalPengembalian.value = tanggalPengembalian;
            inputSuratPeminjaman.value = suratPeminjaman;

            console.log(inputNamaPeminjam);

        }

        function validateForm() {
            // Mendapatkan elemen input file
            var fileInput = document.getElementById('surat');

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
    @endsection
    {{-- footer --}}