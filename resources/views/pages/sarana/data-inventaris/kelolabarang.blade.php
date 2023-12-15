@extends('components.main')

@section('title-content')
Inventaris
@endsection

@section('breadcrumbs')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/sarana/inventaris">Inventaris</a></li>
    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inventaris Barang</li>
</ol>
<h6 class="font-weight-bolder mb-0">Persediaan Barang</h6>
<h6 class="font-weight-bolder mb-0">Ruang : {{$ruangs->nama_ruang}}</h6>
@endsection

@section('content')
<style>
    .select2-selection__rendered {
        display: none !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-0 pb-2">
                <div class="table-responsive pb-2 px-3">
                    <div class="row">
                        <div class="col-12">
                            @if (auth()->user()->hasRole('admin'))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahBarangModal" class="btn btn-primary font-weight-bold btn--edit text-xs " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail">
                                <i class="material-icons opacity-10">add</i>Tambah Barang
                            </button>
                            @endif
                        </div>
                    </div>
                    <!-- Tabel untuk menampilkan inventaris -->
                    <table id="example" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">No</th>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Nama Barang</th>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Tahun Pengadaan</th>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Jenis</th>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Gambar</th>
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Jumlah Barang</th>
                                @if (auth()->user()->hasRole('admin'))
                                <th class="text-center text-uppercase text-secondary font-weight-bold">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $i)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $i->barang->nama_barang ?? '-' }}</td>
                                <td class="text-center">{{ $i->tahun_pengadaan ?? '-' }}</td>
                                <td class="text-center">{{ $i->jenis ?? '-' }}</td>
                                <td><img src="{{ asset('storage/image/' . $i->barang->image) }}" height="100px" width="120px"></td>
                                <td class="text-center">{{ $i->jumlah_barang ?? '-' }}</td>
                                @if (auth()->user()->hasRole('admin'))
                                <td class="text-center">
                                    <a href="{{ route('delete-inventaris', ['id' => $i->id]) }}" onclick="return confirm('Anda yakin akan menghapus data ini?')" class="btn btn-danger font-weight-bold text-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                @endif
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
                <form id="formBarang" action="{{ route('store-inventaris', $ruangs->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_barang_cari" class="form-label">Cari Nama Barang:</label>
                        <input type="text" class="form-control" id="nama_barang_cari" name="nama_barang_cari">
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang_cari" class="form-label">Pilih Barang:</label>
                        <select id="nama_barang_dropdown" class="form-select mt-2"></select>
                    </div>
                    <!-- Input untuk Jumlah Barang -->
                    <div class="mb-3">
                        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Tambahkan Barang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nama_barang_cari').keyup(function() {
            var query = $(this).val();

            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("search-barang") }}',
                    method: 'GET',
                    data: {
                        searchTerm: query
                    },
                    success: function(response) {
                        var dropdown = $('#nama_barang_dropdown');
                        dropdown.empty();

                        if (response.length > 0) {
                            response.forEach(function(barang) {
                                dropdown.append($('<option></option>').attr('value', barang.nama_barang).text(barang.nama_barang));
                            });
                        } else {
                            dropdown.append($('<option></option>').text('No matches found'));
                        }
                    }
                });
            }
        });

        $('#nama_barang_dropdown').change(function() {
            var selectedBarang = $(this).val();

            $.ajax({
                url: '{{ route("get-barang-detail-by-name") }}',
                method: 'GET',
                data: {
                    selectedBarang: selectedBarang
                },
                success: function(response) {
                    $('#barang_id').val(response.barang_id);
                    $('#nama_barang').val(response.nama_barang);
                    $('#tahun_pengadaan').val(response.tahun_pengadaan);
                    $('#jenis').val(response.jenis);
                },
                error: function() {
                    console.error('Gagal mendapatkan detail barang.');
                }
            });
        });
    });
</script>
@endsection