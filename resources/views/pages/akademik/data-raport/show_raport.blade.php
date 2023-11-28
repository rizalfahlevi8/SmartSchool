@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Raport</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <form action="">
                            <div style="display: flex; column-gap: 10px; align-items: center; justify-content: flex-end"
                                class="my-3">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="select_raport" id="" style="text-transform: capitalize; width: 200px">
                                    @foreach ($raport_lists as $raport_list)
                                        <option value="{{ $raport_list->id }}" style="text-transform: capitalize"
                                            @if ($raport_selected == $raport_list->id) {{ 'selected' }} @endif>
                                            {{ strtoupper($raport_list->jenis_nilai) }}
                                            {{ $raport_list->kelas_ke }}
                                            {{ $raport_list->akademik->semester }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary btn-sm"
                                    style="margin-bottom: 0">Cari</button>
                            </div>
                        </form>
                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Mapel</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nilai</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Grade</th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raports as $raport)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $raport->mapel->nama_mapel }}
                                        </td>
                                        <td class="text-center">
                                            {{ $raport->nilai_akademik }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $nilai_raw = $raport->nilai_akademik;
                                                if ($nilai_raw > 90) {
                                                    echo 'A';
                                                } elseif ($nilai_raw > 80 && $nilai_raw <= 90) {
                                                    echo 'B';
                                                } elseif ($nilai_raw > 70 && $nilai_raw <= 80) {
                                                    echo 'C';
                                                } else {
                                                    echo 'E';
                                                }
                                            @endphp
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm" style="margin-bottom: 0"
                                                mapel="{{ $raport->mapel->id }}" nilai="{{ $raport->nilai_akademik }}"
                                                id-detail-nilai="{{ $raport->id }}" data-bs-target="#update-modal"
                                                data-bs-toggle="modal" onclick="showUpdateModalDialog(this)">Ubah</button>
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
    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ubah Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/akademik/raport-update/{{ $id_siswa }}" class="row g-3 px-4" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_detail_nilai" class="form-control rounded-3" value="">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Mapel</label>
                            <div class="input-group">
                                <select class="form-select rounded-3 form-control-lg text-sm"
                                    aria-label="Default select example" name="id_mapel" disabled>
                                    <option value="0" selected disabled>-- Pilih Mapel --</option>
                                    @foreach ($mapels as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="nilai" class="form-label">Nilai</label>
                            <div class="input-group">
                                <input type="number" name="nilai_akademik" id="nilai" value=""
                                    class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function showUpdateModalDialog(element) {
                const updateModalDialog = document.getElementById('update-modal');
                const inputDetailNilai_id = updateModalDialog.querySelector('input[name="id_detail_nilai"]');
                const inputMapel_id = updateModalDialog.querySelector('select[name="id_mapel"]');
                const inputNilai = updateModalDialog.querySelector('input[name="nilai_akademik"]');

                inputDetailNilai_id.value = element.getAttribute('id-detail-nilai');
                inputMapel_id.selectedIndex = element.getAttribute('mapel');
                inputNilai.value = element.getAttribute('nilai');
            }
        </script>
    </div>
@endsection
{{-- footer --}}
