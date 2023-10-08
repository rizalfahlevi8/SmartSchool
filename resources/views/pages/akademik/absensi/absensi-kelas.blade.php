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
                        <h6 class="text-white text-capitalize ps-3">Absensi</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <form action="" method="POST">
                            @csrf
                            <div class="d-flex align-items-center justify-content-end my-3"
                                style="flex-direction: column;row-gap: 10px;max-width: 350px">
                                <div style="display: flex;gap: 10px;width: 100%;">
                                    <div class="form-group mr-2" style="flex-grow: 1">
                                        <select class="form-control" name="selected_kelas" required
                                            style="text-transform: capitalize; width: 100%;">
                                            @foreach ($kelas_list as $kelas)
                                                <option value="{{ $kelas->id }}"
                                                    @if ($selected_kelas == $kelas->id) selected @endif>
                                                    {{ strtoupper($kelas->nama_kelas) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="" style="display: flex;align-items: center;gap: 10px"
                                        data-toggle="buttons">
                                        @foreach (['ganjil', 'genap'] as $semester)
                                            <label class="" style="margin: 0">
                                                <input type="radio" name="selected_semester" value="{{ $semester }}"
                                                    @if ($semester == $selected_semester) checked @endif required>
                                                {{ ucfirst($semester) }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary btn-sm ml-2"
                                    style="width: 100%">Cari</button>
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
                                        Nama Siswa</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status</th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $nama_siswa = $absensi->siswa->nama }}
                                        </td>
                                        <td class="text-center">
                                            @php $keterangan_absen = null; @endphp
                                            {{ ucfirst($status_absen = $absensi->status_absen) }} @if ($absensi->status_absen == 'izin')
                                                ({{ $keterangan_absen = $absensi->keterangan }})
                                            @endif
                                        </td>


                                        <td class="text-center" style="width: 20%;">
                                            <button type="button"data-bs-toggle="modal" data-bs-target="#update-modal"
                                                class="btn
                                                btn-warning font-weight-bold btn--edit text-sm rounded-circle"
                                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"
                                                onclick="showUpdateModal(this)"
                                                link-for-form="{{ route('api.update-absensi', ['absensi' => $absensi->id]) }}"
                                                nama-siswa="{{ $nama_siswa }}" status-absen="{{ $status_absen }}"
                                                keterangan-absen="{{ $keterangan_absen }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
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
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Kelas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>
                    <form action="" class="row g-3 px-4" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row g-2 align-items-center px-3" style="justify-content: space-between">
                            <div class="col-auto">
                                <label for="update-nama-siswa" class="col-form-label">Nama Siswa</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_siswa" class="form-control text-sm" value=""
                                    id="update-nama-siswa" required disabled readonly>
                            </div>

                        </div>
                        <br>

                        <div class="row g-2 align-items-center px-3" style="justify-content: space-between">
                            <div class="col-auto">
                                <label for="update-status" class="col-form-label">Status &nbsp&nbsp</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="status" id="update-status"
                                        onchange="showKeteranganIzin(this.value);">
                                        <option value="" disabled selected>-- Pilih Status --</option>
                                        @foreach ($list_status as $item)
                                            <option value="{{ $item }}">
                                                {{ ucfirst($item) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row g-2 align-items-center px-3" style="justify-content: space-between;display:none"
                            id="update-keterangan">

                        </div>

                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function showUpdateModal(element) {
            const updateModalForm = document.querySelector('#update-modal form');
            const nama_siswa = updateModalForm.querySelector('#update-nama-siswa');
            const status_izin = updateModalForm.querySelector('#update-status');
            const keterangan_izin = updateModalForm.querySelector('#update-keterangan');


            updateModalForm.setAttribute('action', element.getAttribute('link-for-form'));
            nama_siswa.value = element.getAttribute('nama-siswa');
            status_izin.querySelector('option[value="' + element.getAttribute('status-absen') + '"]').selected = true;
            keterangan_izin.value = element.getAttribute('keterangan-absen');

            if (element.getAttribute('status-absen') == 'izin') {
                keterangan_izin.style.display = 'flex';
                keterangan_izin.innerHTML = `
                <div class="col-auto">
                                <label for="update-keterangan" class="col-form-label">Keterangan</label>
                            </div>
                            <div class="col-md-9">
                                <input id="update-keterangan" type="text" name="keterangan_izin"
                                    class="form-control text-sm" value="${element.getAttribute('keterangan-absen')}" required>
                            </div>
                `;
            } else {
                keterangan_izin.style.display = 'none';
                keterangan_izin.innerHTML = '';
            }
        }

        function showKeteranganIzin(value) {
            const updateModalForm = document.querySelector('#update-modal form');
            const keterangan_izin = updateModalForm.querySelector('#update-keterangan');

            if (value == 'izin') {
                keterangan_izin.style.display = 'flex';
                keterangan_izin.innerHTML = `
            <div class="col-auto">
                                <label for="update-keterangan" class="col-form-label">Keterangan</label>
                            </div>
                            <div class="col-md-9">
                                <input id="update-keterangan" type="text" name="keterangan_izin"
                                    class="form-control text-sm" value="" required>
                            </div>
            `;
            } else {
                keterangan_izin.style.display = 'none';
                keterangan_izin.innerHTML = '';
            }
        }
    </script>
@endsection
{{-- footer --}}
