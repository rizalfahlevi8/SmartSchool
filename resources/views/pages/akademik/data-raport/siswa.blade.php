@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-raport-admin">Raport</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">data siswa</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="/data-raport-admin" type="button" id="btntambah"
                class="btn btn-secondary rounded-pill font-weight-bold text-xs text-white">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">

                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        NISN</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Siswa</th>

                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $siswa->nisn }}
                                        </td>
                                        <td class="text-center">
                                            {{ $siswa->nama }}
                                        </td>
                                        <td class="text-center">
                                            <a href="/akademik/raport/uts/{{ $siswa->id }}"
                                                class="btn btn-primary btn-sm" style="margin-bottom: 0">uts</a>
                                            <a href="/akademik/raport/uas/{{ $siswa->id }}"
                                                class="btn btn-primary btn-sm" style="margin-bottom: 0">uas</a>
                                        </td>
                                    </tr>
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
