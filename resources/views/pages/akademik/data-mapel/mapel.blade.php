@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-mapel">Mapel</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Mata Pelajaran</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Mata Pelajaran</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <button type="button" id="btntambah" class="btn btn-primary font-weight-bold text-xs"
                            data-bs-toggle="modal" data-bs-target="#insert-modal">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
                        </button>
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
                                        Mapel</th>

                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($mapels->count() > 0)
                                    @foreach ($mapels as $mapel)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">
                                                {{ $mapel->nama_mapel }}
                                            </td>

                                            <td class="text-center">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#update-modal"
                                                    class="btn
                                        btn-warning font-weight-bold btn--edit text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                                    onclick="showUpdateModal(this)" id-mapel="{{ $mapel->id }}"
                                                    nama-mapel="{{ $mapel->nama_mapel }}">
                                                    <i class="fa fa-edit"></i>

                                                </button>

                                                <a href="/akademik/mapel-hapus/{{ $mapel->id }}"
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
                                        <td colspan="3" class="text-center">Data Pelajaran Kosong!!!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="Update Pelajaran" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="Update Pelajaran">Edit Mata
                        Pelajaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="" class="row g-3 px-3" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="nama-mapel" class="col-form-label">Nama
                                    Mapel</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_mapel" class="form-control text-sm" value="" required
                                    id="nama-mapel">
                            </div>

                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/akademik/mapel-tambah" class="row g-3 px-3" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        {{-- <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Kode Mapel&nbsp</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="kodemapel" class="form-control" required disabled>
                            </div>

                        </div> --}}
                        <br>
                        <div class="row g-2 align-items-center px-3">
                            <div class="col-auto">
                                <label for="nama_mapel" class="col-form-label">Nama Mapel</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="nama_mapel" name="nama_mapel" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function showUpdateModal(element) {
            const updateModalDialog = document.querySelector('#update-modal form');
            const nama_mapel = updateModalDialog.querySelector('#nama-mapel');

            updateModalDialog.setAttribute('action', '/akademik/mapel-update/' + element.getAttribute('id-mapel'))
            nama_mapel.value = element.getAttribute('nama-mapel');
        }
    </script>
@endsection
{{-- footer --}}
