@extends('components.main')

@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">daftarbarang</li>
</ol>
<h6 class="font-weight-bolder mb-0">Daftar Barang</h6>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Daftar Barang</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    @if (auth()->user()->hasRole('admin'))
                    <a href="/sarana/barang-tambah" type="submit" id="btntambah" class="btn btn-primary font-weight-bold text-xs">
                        <i class="material-icons opacity-10">add</i>
                        Tambah
                    </a>
                    @endif
                    <table id="example" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Nama Barang</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Tahun Pengadaan</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Jenis</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Gambar</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Jumlah </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($daftarBarang as $barang)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $barang->nama_barang }}</td>
                                <td class="text-center">{{ $barang->tahun_pengadaan }}</td>
                                <td class="text-center">{{ $barang->jenis }}</td>
                                <td><img src="{{ asset('storage/image/' . $barang->image) }}" height="100px" width="120px"></td>
                                <td class="text-center">{{ $barang->jumlah_seluruh_barang }}</td>
                                <td class="text-center">
                                    <a href="{{ route('update-barang', $barang->id) }}"  class="btn
                                            btn-warning font-weight-bold btn--edit text-sm rounded-circle">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('hapus-barang', $barang->id) }}" onclick="return confirm('Anda yakin akan menghapus data ini?')"  class="btn
                                            btn-danger font-weight-bold btn--edit text-sm rounded-circle">
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
</div>
@endsection