@extends('components.main')

@section('title-content')
    Inventaris
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/persediaan">Inventaris</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kelola Barang</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Persediaan barang</h6>
    <h6 class="font-weight-bolder mb-0">Ruang : {{$ruangs->nama_ruang}}</h6>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="row">
                        

                            <div class="col-12">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarangModal">
                                    Tambah Barang
                                </button>
                            </div>
                        </div>
                        <!-- Tabel untuk menampilkan inventaris -->
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Tahun Pengadaan</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jenis</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jumlah Barang</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jumlah Barang Baik</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Jumlah Barang Rusak</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventaris as $i)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $i->barang->nama_barang ?? '-' }}</td>
                                    <td class="text-center">{{ $i->tahun_pengadaan ?? '-' }}</td>
                                    <td class="text-center">{{ $i->jenis ?? '-' }}</td>
                                    <td class="text-center">{{ $i->jumlah_barang ?? '-' }}</td>
                                    <td class="text-center">{{ $i->jumlah_baik ?? '-' }}</td>
                                    <td class="text-center">{{ $i->jumlah_rusak ?? '-' }}</td>
                                    <td class="text-center">
                                    <a href="{{ route('delete-inventaris', ['id' => $i->id]) }}"
                                        onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                        class="btn btn-danger font-weight-bold text-sm rounded-circle"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding a new record -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form to add a new record -->
                    <form action="{{ route('store-inventaris', $ruangs->id) }}" method="POST">
                        @csrf
                        <!-- ID Barang -->
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">ID Barang</label>
                            <input type="text" class="form-control" id="barang_id" name="barang_id" required>
                        </div>
                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                        </div>
                        <!-- Tahun Pengadaan -->
                        <div class="mb-3">
                            <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                            <input type="date" class="form-control" id="tahun_pengadaan" name="tahun_pengadaan">
                        </div>
                        <!-- Jenis -->
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" required>
                        </div>
                        <!-- Jumlah Barang -->
                        <div class="mb-3">
                            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                        </div>
                        <!-- Jumlah Barang Baik -->
                        <div class="mb-3">
                            <label for="jumlah_baik" class="form-label">Jumlah Barang Baik</label>
                            <input type="number" class="form-control" id="jumlah_baik" name="jumlah_baik" required>
                        </div>
                        <!-- Jumlah Barang Rusak -->
                        <div class="mb-3">
                            <label for="jumlah_rusak" class="form-label">Jumlah Barang Rusak</label>
                            <input type="number" class="form-control" id="jumlah_rusak" name="jumlah_rusak" required>
                        </div>
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Tambahkan Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
