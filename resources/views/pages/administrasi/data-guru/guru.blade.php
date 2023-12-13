@extends('components.main')
@section('title-content')
    Data Guru
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-guru">Guru</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Guru</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Guru</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <a href="/administrasi/guru-tambah" type="submit" id="btntambah"
                            class="btn btn-primary font-weight-bold text-xs">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
                        </a>
                        <a href="/userguru/export" type="submit" id="btntambah"
                            class="btn btn-success font-weight-bold text-xs">
                            Export Data Guru
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
                                        NIP
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Lengkap
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-5">
                                        No Telepon
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gurus as $guru)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $guru->nip }}
                                        </td>
                                        <td class="text-center">
                                            {{ $guru->nama }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $guru->no_telp }}
                                        </td>
                                        <td class="text-center" style="display: flex; gap: 10px; justify-content: center">
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#detail-modal"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded-circle"
                                                style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Detail" id-guru="{{ $guru->id }}" nip="{{ $guru->nip }}"
                                                nama-guru="{{ $guru->nama }}" jenis-kelamin="{{ $guru->jenis_kelamin }}"
                                                tempat-tanggal-lahir="{{ $guru->tempat_lahir }}, {{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d/m/Y') }}"
                                                no-telp="{{ $guru->no_telp }}"agama="{{ $guru->agama }}"
                                                alamat="{{ $guru->alamat }}" status-guru="{{ $guru->status }}"
                                                guru-signature="{{ asset('storage/guru/signatures/' . $guru->signature) }}"
                                                foto="{{ asset('storage/guru/img/' . $guru->foto) }}"
                                                onclick="showModalDialog(this)">
                                                <i class="fa fa-eye"></i>

                                            </button>
                                            <a href="/administrasi/guru-update/{{ $guru->id }}"
                                                class=" btn btn-warning font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" style="margin: 5px 0;"
                                                title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/administrasi/guru-hapus/{{ $guru->id }}"
                                                onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                                class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" style="margin: 5px 0;"
                                                title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Detail guru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="foto" id="foto">
                                    <img src="" alt="" width="100%" height="auto">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NIP</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" id="nip">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="nama">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Jenis
                                                    Kelamin</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="jenis_kelamin">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tempat,
                                                    tanggal
                                                    lahir</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                                id="tempat_tanggal_lahir">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">No Telepon
                                                </span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="no_telp">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Status
                                                </span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="status">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Agama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="agama">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Alamat</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="alamat">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tanda tangan</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" id="signature">
                                                <img src="" style="width: 100%">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        function showModalDialog(element) {
            const updateModalDialog = document.getElementById('detail-modal');
            const nama = updateModalDialog.querySelector('#nama');
            const ttl = updateModalDialog.querySelector('#tempat_tanggal_lahir');
            const jenisKelamin = updateModalDialog.querySelector('#jenis_kelamin');
            const alamat = updateModalDialog.querySelector('#alamat');
            const agama = updateModalDialog.querySelector('#agama');
            const no_telp = updateModalDialog.querySelector('#no_telp');
            const nip = updateModalDialog.querySelector('#nip');
            const signature = updateModalDialog.querySelector('#signature img');
            const foto = updateModalDialog.querySelector('#foto img');
            const status = updateModalDialog.querySelector('#status');

            nama.innerText = element.getAttribute('nama-guru');
            ttl.innerText = element.getAttribute('tempat-tanggal-lahir');
            no_telp.innerText = element.getAttribute('no-telp');
            agama.innerText = element.getAttribute('agama');
            foto.src = element.getAttribute('foto');
            signature.src = element.getAttribute('guru-signature');
            nip.innerText = element.getAttribute('nip');
            status.innerText = element.getAttribute('status-guru');
            alamat.innerText = element.getAttribute('alamat');
            jenisKelamin.innerText = element.getAttribute('jenis-kelamin');
        }
    </script>
@endsection
{{-- footer --}}
