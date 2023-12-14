@extends('components.main')
@section('title-content')
    Data Tamu
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item text-sm"><a aria-current="page" >Tamu</a></li>
        {{-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li> --}}
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Tamu</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Daftar Tamu</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <a href="/tamu" type="submit" id="btntambah"
                            class="btn btn-primary font-weight-bold text-xs">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
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
                                        Nama
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Asal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tujuan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Yang Di Tuju
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Keterangan
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th

                                        Aksi
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tamus as $t)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $t->nama }}
                                        </td>
                                        <td class="text-center">
                                            {{ $t->alamat }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $t->Opsi_Tujuan }}
                                        </td>
                                        <td class="text-center">
                                            {{ $t->nama_tujuan }}
                                        </td>
                                        <td class="text-center">
                                            {{ $t->Keterangan }}
                                        </td>
                                        <td class="text-center">
                                            @if ($t->status === 'menunggu')
                                                Menunggu
                                            @elseif ($t->status === 'pesan_telah_diterima')
                                                Pesan Di Terima
                                            @elseif ($t->status === 'pesan_telah_selesai')
                                                Pesan Selesai
                                            @else
                                                {{ $t->status }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#detail-modal"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded-circle"
                                                style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Detail"  id="{{ $t->id }}"nama="{{ $t->nama }}" 
                                                alamat="{{ $t->alamat }}" Opsi_Tujuan="{{ $t->Opsi_Tujuan }}" Opsi_lanjutan="{{ $t->nama_tujuan }}" Keterangan="{{ $t->Keterangan }}"
                                                onclick="showModalDialog(this)"> 
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="/tamu-edit/{{ $t->id }}"
                                                class=" btn btn-warning font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" style="margin: 5px 0;"
                                                title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="tamu-delete/{{ $t->id }}"
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
                        <h5 class="modal-title text-white" id="exampleModalLabel">Detail Tamu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" id="nama">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Asal</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="alamat">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tujuan</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="Opsi_Tujuan">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama Tujuan</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="Opsi_lanjutan">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Keterangan</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                                id="Keterangan">
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
            const asal = updateModalDialog.querySelector('#alamat');
            const tujuan = updateModalDialog.querySelector('#Opsi_Tujuan');
            const b = updateModalDialog.querySelector('#Opsi_lanjutan');
            const keterangan = updateModalDialog.querySelector('#Keterangan');

            nama.innerText = element.getAttribute('nama');
            asal.innerText = element.getAttribute('alamat');
            tujuan.innerText = element.getAttribute('Opsi_Tujuan');
            b.innerText = element.getAttribute('Opsi_lanjutan');
            keterangan.innerText = element.getAttribute('Keterangan');
        }
    </script>
@endsection
{{-- footer --}}