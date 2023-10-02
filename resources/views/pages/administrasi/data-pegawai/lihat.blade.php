@extends('components.main')
@section('title-content')
    Data Pegawai
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pegawai</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Lihat Data </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Pegawai</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">

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
                                        NIP</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Lengkap</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Jabatan</th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No Telepon</th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->NIP }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $u->jabatan }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $u->notelp }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal"
                                                data-bs-target="#detail-modal{{ $u->id }}"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                                <i class="fa fa-eye"></i> Detail

                                            </button>

                                        </td>
                                    </tr>
                                    {{-- modal detail --}}
                                    <div class="modal fade" id="detail-modal{{ $u->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail Pegawai
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="foto">
                                                                <img src="{{ $u->foto ? asset('assets/img/pegawai/' . $u->foto) : asset('assets/img/thumbnail.png') }} "
                                                                    alt="" width="100%" height="auto">
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
                                                                        <div class="col-md-7">
                                                                            {{ $u->NIP }}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <span class="float-start fw-bold">Nama</span>
                                                                            <div class="float-end">:</div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            {{ $u->nama }}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <span class="float-start fw-bold">Jabatan</span>
                                                                            <div class="float-end">:</div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            {{ $u->jabatan }}
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
                                                                        <div class="col-md-7">
                                                                            {{ $u->jk }}
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
                                                                        <div class="col-md-7">
                                                                            {{ $u->tempatlahir }},

                                                                            {{ \Carbon\Carbon::parse($u->tgllahir)->format('d/m/Y') }}
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
                                                                        <div class="col-md-7">
                                                                            {{ $u->notelp }}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <span class="float-start fw-bold">Agama</span>
                                                                            <div class="float-end">:</div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            {{ $u->agama }}
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <span class="float-start fw-bold">Alamat</span>
                                                                            <div class="float-end">:</div>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            {{ $u->alamat }}
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
