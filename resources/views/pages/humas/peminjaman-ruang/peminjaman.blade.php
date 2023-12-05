@extends('components.main')
@section('title-content')
    Data Peminjaman Ruang
@endsection
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
                        <button type="button"data-bs-toggle="modal" data-bs-target="#insert-modal"
                            class="btn btn-primary font-weight-bold btn--edit text-xs " data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Detail">
                            <i class="material-icons opacity-10">add</i>Tambah
                        </button>
                        <a href="data-peminjaman-history" type="submit" id="btntambah"
                            class="btn btn-danger font-weight-bold text-xs">
                            Riwayat
                        </a>
                        <!-- Button trigger modal -->

                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Ruang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Peminjam
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal peminjaman
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal Pengembalian
                                    </th>
                                    <th
                                        class="
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
    <button type="button" data-bs-toggle="modal" data-bs-target="#update-modal"
        id-peminjaman="{{ $p->id }}" id-ruang="{{ $p->ruang_id }}"
        nama-peminjam="{{ $p->nama_peminjam }}" tgl-peminjaman="{{ $p->tanggal_peminjaman }}"
        tgl-pengembalian="{{ $p->tanggal_pengembalian }}" class="btn btn-warning font-weight-bold btn--edit text-sm rounded-circle"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
        onclick="showUpdateModalDialog(this)">
        <i class="fa fa-edit"></i>
    </button>
</td>

<td class="text-center">
    <button type="button" data-bs-toggle="modal" data-bs-target="#detail-modal"
        class="btn btn-info font-weight-bold btn--edit text-sm rounded-circle"
        style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Detail" id-peminjaman="{{ $p->id }}" nama_peminjam="{{ $p->nama_peminjam }}"
        ruang="{{ $p->ruang_id }}"
        onclick="showModalDialog(this)">
        <i class="fa fa-eye"></i>
    </button>
</td>

<td class="text-center">
    <a href="/peminjaman-hapus/{{ $p->id }}"
        onclick="return confirm('Anda yakin akan menghapus data ini?')"
        class="btn btn-danger font-weight-bold text-sm rounded-circle"
        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
        <i class="fa fa-trash"></i>
    </a>
</td>

</tr>

<div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">Detail Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">
                                <span class="float-start fw-bold">Nama Peminjam</span>
                                <div class="float-end">:</div>
                            </div>
                            <div class="col-md-7" >{{ $p->nama_peminjam }}</div>
                        </div>
                    </li>
                    <!-- Tambahkan elemen list-group-item lain sesuai kebutuhan -->
                </ul>
            </div>
        </div>
    </div>
</div>



                        
                        
                        <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Peminjaman
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/peminjaman-update" class="row g-3 py-1 px-4" method="post"
                                            enctype="multipart/form-data">
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
                                                    <input type="text" name="nama_peminjam" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('nama_peminjam') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tanggal peminjaman</label>
                                                <div class="input-group">
                                                    <input type="date" name="tgl_peminjaman" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('tgl_peminjaman') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tanggal pengembalian</label>
                                                <div class="input-group">
                                                    <input type="date" name="tgl_pengembalian" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('tgl_pengembalian') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger ml-5 text-sm rounded-3"
                                                    style="float:right; ">
                                                    <i class="fa fa-save"></i>
                                                    Simpan
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- modal insert --}}
                        <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Ruang
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/peminjaman-tambah" class="row g-3 py-1 px-4" method="POST"
                                            enctype="multipart/form-data">
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
                                                    <input type="text" name="nama_peminjam"
                                                        class="form-control rounded-3" id="inputEmail4" required
                                                        value="{{ old('nama_peminjam') }}"
                                                        {{ $errors->has('nama_peminjam') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Peminjaman</label>
                                                <div class="input-group">
                                                    <input type="date" name="tgl_peminjaman" class="form-control rounded-3"
                                                        id="inputEmail4" required value="{{ old('tgl_peminjaman') }}"
                                                        {{ $errors->has('tgl_peminjaman') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Pengembalian</label>
                                                <div class="input-group">
                                                    <input type="date" name="tgl_pengembalian" class="form-control rounded-3"
                                                        id="inputEmail4" required value="{{ old('tgl_pengembalian') }}"
                                                        {{ $errors->has('tgl_pengembalian') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary ml-5 text-sm rounded-3"
                                                    style="float:right; ">
                                                    <i class="fa fa-save"></i>
                                                    Simpan
                                                </button>
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Batal</button>
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
    </div>
    <script>
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
        var idPeminjaman = button.getAttribute("id-peminjaman");
        var namaPeminjam = button.getAttribute("nama-peminjam");
        var tglPeminjaman = button.getAttribute("tgl-peminjaman");
        var tglPengembalian = button.getAttribute("tgl-pengembalian");
        
        // Mengambil elemen input dengan id yang sesuai
        var inputIdPeminjam = document.querySelector('input[name="id_peminjaman"]');
        var inputNamaPeminjam = document.querySelector('input[name="nama_peminjam"]');
        var inputTglPeminjaman = document.querySelector('input[name="tgl_peminjaman"]');
        var inputTglPengembalian = document.querySelector('input[name="tgl_pengembalian"]');
        
        // Mengisi nilai input dengan nilai yang diperoleh dari tombol
        inputIdPeminjam.value = idPeminjaman;
        inputNamaPeminjam.value = namaPeminjam;
        inputTglPeminjaman.value = tglPeminjaman;
        inputTglPengembalian.value = tglPengembalian;
        }
    </script>
@endsection

