@extends('admin.app')

@section('title-content')
    Inventaris
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/inventaris">Inventaris</a></li>
    </ol>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
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
                        <a href="{{ route('daftar-barang.index') }}" class="btn btn-primary">Daftar Barang</a>
                        <a href="{{ route('ruang.index') }}" class="btn btn-primary">Ruang</a>
                    </div>

                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Ruangan</th>
                                <th class="text-center">Nama Ruangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRuangan as $ruangan)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $ruangan->id }}</td>
                                    <td class="text-center">{{ $ruangan->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('atur-barang', $ruangan->id) }}" class="btn btn-primary">Atur Barang</a>
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
