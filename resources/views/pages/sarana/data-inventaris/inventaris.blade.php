@extends('components.main')

@section('title-content')
    Inventaris
@endsection

@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inventaris</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Inventaris</h6>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Inventaris</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="d-flex justify-content-between mb-4">
                    </div>

                    <table class="table align-items-center mb-0">
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
                                        <a href="{{ route('atur-barang', $ruang->id) }}" class="btn btn-primary">Atur Barang</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
