@extends('components.main')
@section('title-content')
Data Peminjaman Barang
@endsection
@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-peminjaman">Peminjaman Barang</a>
    </li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
</ol>
<h6 class="font-weight-bolder mb-0">Riwayat Peminjaman</h6>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Riwayat Peminjaman Barang</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    <a href="data-peminjaman-barang" type="submit" id="btntambah" class="btn btn-primary font-weight-bold text-xs">
                        Kembali
                    </a>
                    <!-- Button trigger modal -->

                    <table id="example" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    No
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Barang
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Jumlah
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Nama Peminjam
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Tanggal peminjaman
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Tanggal Pengembalian
                                </th>
                                @if (auth()->user()->hasRole('admin'))
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Status Pengembalian
                                </th>
                                <th class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    Aksi
                                </th>
                                @endif
                            </tr>
                        </thead>
                        @if ($peminjaman_barang->count())
                        <tbody>
                            @foreach ($peminjaman_barang as $p)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ $p->barang->nama_barang }}
                                </td>
                                <td class="text-center">
                                    {{ $p->jumlah }}
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
                                @if (auth()->user()->hasRole('admin'))
                                <td class="text-center">
                                    <span class="badge {{ $p->status ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ $p->status ? 'Dikembalikan' :  'Belum Dikembalikan' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if (!$p->status)
                                    <a id="confirmButton{{ $p->id }}" href="data-peminjaman-barang-confirm/{{ $p->id }}" class=" btn btn-success font-weight-bold text-sm rounded-circle" title="konfirmasi" onclick="return confirm('Apakah Ruangan sudah dikembalikan?')">
                                        <i class="fa fa-calendar-check"></i>
                                    </a>
                                    @endif
                                    <a href="/data-peminjaman-barang-hapus/{{ $p->id }}" onclick="return confirm('Anda yakin akan menghapus data ini?')" class=" btn btn-danger font-weight-bold text-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </a> 
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">No found.</td>
                            </tr>
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- footer --}}