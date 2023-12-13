@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-siswa">Ruang</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Ruang</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Ruang</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                         @if (auth()->user()->hasRole('admin'))
                        <button type="button"data-bs-toggle="modal" data-bs-target="#insert-modal"
                            class="btn btn-primary font-weight-bold btn--edit text-xs " data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Detail">
                            <i class="material-icons opacity-10">add</i>Tambah
                        </button>
                        @endif
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Ruang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Luas
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Lokasi
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($ruangs->count() > 0)
                                    @foreach ($ruangs as $ruang)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">
                                                {{ $ruang->nama_ruang }}
                                            </td>
                                            <td class="text-center">
                                                {{ $ruang->luas }}
                                            </td>
                                            <td class="text-center">
                                                {{ $ruang->lokasi }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button"data-bs-toggle="modal" data-bs-target="#update-modal"
                                                    id-ruang="{{ $ruang->id }}" nama-ruang="{{ $ruang->nama_ruang }}"
                                                    luas-ruang="{{ $ruang->luas }}" lokasi-ruang="{{ $ruang->lokasi }}"
                                                    class="btn
                                            btn-warning font-weight-bold btn--edit text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                                    onclick="showUpdateModalDialog(this)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a href="{{ route('hapus-ruang', ['ruang' => $ruang->id]) }}"
                                                    onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                                    class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-white" id="exampleModalLabel">Edit Ruang
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('update-ruang') }}" class="row g-3 py-1 px-4" method="post"
                                            enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <input type="text" name="id_ruang" value="" hidden>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama ruang</label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_ruang" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('nama_ruang') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Luas</label>
                                                <div class="input-group">
                                                    <input type="text" name="luas" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('luas') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Lokasi</label>
                                                <div class="input-group">
                                                    <input type="text" name="lokasi" class="form-control rounded-3"
                                                        id="inputEmail4" required value=""
                                                        {{ $errors->has('luas') ? 'autofocus="true"' : '' }}>
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
                                        <form action="{{ route('tambah-ruang') }}" class="row g-3 py-1 px-4"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Ruang</label>
                                                <div class="input-group">
                                                    <input type="text" name="nama_ruang"
                                                        class="form-control rounded-3" id="inputEmail4" required
                                                        value="{{ old('nama_ruang') }}"
                                                        {{ $errors->has('nama_ruang') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Luas</label>
                                                <div class="input-group">
                                                    <input type="text" name="luas" class="form-control rounded-3"
                                                        id="inputEmail4" required value="{{ old('luas') }}"
                                                        {{ $errors->has('luas') ? 'autofocus="true"' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lokasi</label>
                                                <div class="input-group">
                                                    <input type="text" name="lokasi" class="form-control rounded-3"
                                                        id="inputEmail4" required value="{{ old('lokasi') }}"
                                                        {{ $errors->has('lokasi') ? 'autofocus="true"' : '' }}>
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
        function showUpdateModalDialog(element) {
            const updateModalDialog = document.getElementById('update-modal');
            const inputRuang_id = updateModalDialog.querySelector('input[name="id_ruang"]');
            const inputNamaRuang = updateModalDialog.querySelector('input[name="nama_ruang"]');
            const inputLuas = updateModalDialog.querySelector('input[name="luas"]');
            const inputLokasi = updateModalDialog.querySelector('input[name="lokasi"]');

            inputRuang_id.value = element.getAttribute('id-ruang');
            inputNamaRuang.value = element.getAttribute('nama-ruang');
            inputLuas.value = element.getAttribute('luas-ruang');
            inputLokasi.value = element.getAttribute('lokasi-ruang');
        }
    </script>
@endsection
{{-- footer --}}
