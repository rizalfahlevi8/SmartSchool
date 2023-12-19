@extends('components.main')
@section('title-content')
    Data Kerjasama
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item text-sm"><a aria-current="page" >MOU</a></li>
        {{-- <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li> --}}
    </ol>
    <h6 class="font-weight-bolder mb-0">Data MOU</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Daftar Kerjasama</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <a href="/add-mou" type="submit" id="btntambah"
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
                                        Nama Mitra
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Asal Mitra atau Instansi
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Deskripsi Singkat Mitra
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal Mulai Kerjasama
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal Berakhir Kerjasama
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        PT Mitra
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tujuan Mitra
                                    </th>


                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($mou as $m)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $m->nama_mitra }}
                                        </td>
                                        <td class="text-center">
                                            {{ $m->asal_mitra }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $m->Deskripsi_singkat_mitra }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $m->tanggal_mulai_kerjasama }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $m->tanggal_berakhir_kerjasama }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $m->PT_Mitra }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $m->tujuan_mitra }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#detail-modal"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded-circle"
                                                style="margin: 5px 0;" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Detail"  id="{{ $m->id }}" nama_mitra="{{ $m->nama_mitra }}"
                                                asal_mitra="{{ $m->asal_mitra }}" Deskripsi_singkat_mitra="{{ $m->Deskripsi_singkat_mitra }}"
                                                tanggal_mulai_kerjasama="{{ \Carbon\Carbon::parse($m->tanggal_mulai_kerjasama)->format('d/m/Y') }}"
                                                tanggal_berakhir_kerjasama="{{ \Carbon\Carbon::parse($m->tanggal_berakhir_kerjasama)->format('d/m/Y') }}"
                                                PT_Mitra="{{ $m->PT_Mitra }}" tujuan_mitra="{{ $m->tujuan_mitra }}"

                                                original_name_file="{{ $m->original_name_file }}" data-file="{{ $m->file }}"

                                                onclick="showModalDialog(this)">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <a href="/edit-mou/{{ $m->id }}"
                                                class=" btn btn-warning font-weight-bold text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" style="margin: 5px 0;"
                                                title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="delete-mou/{{ $m->id }}"
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
                        <h5 class="modal-title text-white" id="exampleModalLabel">Detail Kerjasama
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
                                                <span class="float-start fw-bold">Nama Mitra</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                            id="nama_mitra">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Asal Mitra atau Instansi</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                            id="asal_mitra">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Deskripsi Singkat Mitra</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                            id="Deskripsi_singkat_mitra">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tanggal Mulai Kerjasama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize"
                                                id="tanggal_mulai_kerjasama">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tanggal Berakhir Kerjasama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="tanggal_berakhir_kerjasama">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">PT Mitra</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="PT_Mitra">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tujuan Mitra</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="tujuan_mitra">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">File</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div class="col-md-7" style="text-transform: capitalize" id="original_name_file">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>

                        <div class="modal-footer">
                            <a id="file_link" href="#" target="_blank" class="btn btn-success" style="color: white;">Lihat File</a>
                            <a id="file_download" href="#" download class="btn btn-primary" style="color: white;">Download</a>
                            <button id="detail-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Tutup</button>
                        </div>

                        {{-- <div class="modal-footer">
                            <a href="{{ asset('storage/kerjasama/file/' . str_replace(' ', '%20', $m->file)) }}" target="_blank" class="btn btn-success" style="color: white;">Lihat File</a>
                            <a href="{{ asset('storage/kerjasama/file/' . str_replace(' ', '%20', $m->file)) }}" download="{{ $m->file }}" class="btn btn-primary" style="color: white;">Download</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>     --}}

                    </div>

                </div>
            </div>
        </div>


    </div>

    <script>



        function showModalDialog(element) {
            const updateModalDialog = document.getElementById('detail-modal');
            const nama_mitra = updateModalDialog.querySelector('#nama_mitra');
            const asal_mitra = updateModalDialog.querySelector('#asal_mitra');
            const Deskripsi_singkat_mitra = updateModalDialog.querySelector('#Deskripsi_singkat_mitra');
            const tanggal_mulai_kerjasama = updateModalDialog.querySelector('#tanggal_mulai_kerjasama');
            const tanggal_berakhir_kerjasama = updateModalDialog.querySelector('#tanggal_berakhir_kerjasama');
            const PT_Mitra = updateModalDialog.querySelector('#PT_Mitra');
            const tujuan_mitra = updateModalDialog.querySelector('#tujuan_mitra');
            const original_name_file = updateModalDialog.querySelector('#original_name_file');


            // const fileLink = updateModalDialog.querySelector('#file_link');
            // const fileDownload = updateModalDialog.querySelector('#file_download');


            nama_mitra.innerText = element.getAttribute('nama_mitra');
            asal_mitra.innerText = element.getAttribute('asal_mitra');
            Deskripsi_singkat_mitra.innerText = element.getAttribute('Deskripsi_singkat_mitra');
            tanggal_mulai_kerjasama.innerText = element.getAttribute('tanggal_mulai_kerjasama');
            tanggal_berakhir_kerjasama.innerText = element.getAttribute('tanggal_berakhir_kerjasama');
            PT_Mitra.innerText = element.getAttribute('PT_Mitra');
            tujuan_mitra.innerText = element.getAttribute('tujuan_mitra');
            original_name_file.innerText = element.getAttribute('original_name_file');

        // // Update link "Lihat File" dan "Download"
        // const fileName = element.dataset.file;
        // fileLink.href = `/storage/kerjasama/file/${encodeURIComponent(fileName)}`;
        // fileDownload.href = `/storage/kerjasama/file/${encodeURIComponent(fileName)}`;
        // fileDownload.download = fileName;

        // // Menampilkan modal
        // const modal = new bootstrap.Modal(updateModalDialog);
        // modal.show();

            }
    </script>
    <script>

        const fileLink = updateModalDialog.querySelector('#file_link');
        const fileDownload = updateModalDialog.querySelector('#file_download');

        // Update link "Lihat File" dan "Download"
        const fileName = element.dataset.file;
        fileLink.href = `/storage/kerjasama/file/${encodeURIComponent(fileName)}`;
        fileDownload.href = `/storage/kerjasama/file/${encodeURIComponent(fileName)}`;
        fileDownload.download = fileName;

        // Menampilkan modal
        const modal = new bootstrap.Modal(updateModalDialog);
        modal.show();

    </script>
@endsection
{{-- footer --}}
