@extends('components.main')
@section('title-content')
    Data Jadwal
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-jadwalmengajar">Jadwal Guru</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Jadwal Guru</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Jadwal Mengajar Guru</h6>
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
                                        NIP</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Guru</th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $u)
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
                                            {{-- <a href="data-jadwalmengajar-atur/{{ $u->id }}"
                                                class="btn
                                                btn-success font-weight-bold btn--edit text-sm rounded">
                                                <i class="fa fa-edit"></i> Atur Jadwal
                                            </a> --}}
                                            <a href="data-jadwalmengajar-cek/{{ $u->id }}"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded">
                                                <i class="fa fa-edit"></i> Cek Jadwal
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
    </div>
@endsection
{{-- footer --}}
