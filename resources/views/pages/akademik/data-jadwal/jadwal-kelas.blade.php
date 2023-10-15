@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-jadwal">Jadwal Pelajaran</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">atur</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Atur Jadwal Pelajaran</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="/akademik/jadwal" type="button" id="btntambah"
                class="btn btn-secondary rounded-pill font-weight-bold text-xs text-white">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Atur Jadwal Pelajaran Kelas :
                            @if (auth()->user()->hasRole('admin'))
                                {{ $kelas->nama_kelas }}
                            @elseif (auth()->user()->hasRole('siswa'))
                                {{ auth()->user()->siswa->kelas->nama_kelas }}
                            @endif
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">
                            {{-- <button type="button" class="btn btn-primary font-weight-bold text-xs text-white"
                                style="float:left; " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="material-icons opacity-10">add</i>
                                Tambah
                            </button> --}}
                            {{-- <a href="/data-jadwal/cetak_pdf/{{ $kelas->id }}" target="_blank" type="button"
                                class="btn btn-cetak font-weight-bold text-xs text-white"
                                style="float: right;margin-right:10px; background-color:rgb(167, 72, 255);"
                                data-bs-toggle="tooltip" title="Cetak Jadwal"> <i
                                    class="material-icons opacity-10">print</i>
                                Cetak
                            </a> --}}
                        </div>
                        <!-- Button trigger modal -->
                        <div class="container mt-5">
                            <div class="row">
                                @foreach ($jadwals as $jadwal)
                                    @php
                                        $status = $jadwal->status;
                                    @endphp
                                    <div class="col-md-4" style="margin-bottom: 20px">
                                        <div class="card">
                                            <div class="card-header bg-info"
                                                style="display: flex; justify-content: space-between; align-items: center">
                                                <b>{{ ucfirst($jadwal->hari) }}</b>
                                                @if (auth()->user()->hasRole('admin'))
                                                    <div style="display: flex; column-gap: 10px;">
                                                        <form action="" method="POST">
                                                            @csrf
                                                            @if (strtolower($status) == 'libur')
                                                                <button type="submit" data-bs-toggle="modal"
                                                                    style="margin-bottom: 0"
                                                                    class="btn
                                        btn-success font-weight-bold btn--edit text-sm rounded "
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    name="masuk" value="{{ $jadwal->id }}"
                                                                    title="Masuk Sekolah">Masuk
                                                                </button>
                                                            @else
                                                                <button type="button" data-bs-toggle="modal"
                                                                    style="margin-bottom: 0" data-bs-target="#insert-modal"
                                                                    class="btn
                                            btn-primary font-weight-bold btn--edit text-sm rounded jadwal-insert-button"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Tambah jadwal hari ini"
                                                                    onclick="showInsertModalDialog(this)"
                                                                    id-kelas="{{ $kelas->id }}"
                                                                    id-jadwal="{{ $jadwal->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                                                    </svg>
                                                                </button>
                                                                <button type="submit" data-bs-toggle="modal"
                                                                    style="margin-bottom: 0"
                                                                    class="btn
                                        btn-danger font-weight-bold btn--edit text-sm rounded "
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    name="libur" value="{{ $jadwal->id }}"
                                                                    title="Liburkan hari ini">Liburkan
                                                                </button>
                                                            @endif
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                @if (strtolower($status) == 'libur')
                                                    <h5 class="card-title">Libur</h5>
                                                    <p class="card-text">Libur</p>
                                                @else
                                                    @foreach ($jadwal->detail_jadwal as $detail_jadwal)
                                                        <div>
                                                            <div>
                                                                @php
                                                                    $raw_timeMulai = new DateTime($detail_jadwal->jam_mulai);
                                                                    $timeMulai = $raw_timeMulai->format('H:i');
                                                                    $raw_timeSelesai = new DateTime($detail_jadwal->jam_selesai);
                                                                    $timeSelesai = $raw_timeSelesai->format('H:i');
                                                                @endphp
                                                                {{ $timeMulai }} -
                                                                {{ $timeSelesai }}
                                                                <b>({{ $detail_jadwal->ruang->nama_ruang }})</b>
                                                            </div>
                                                            <div>
                                                                <b>{{ $detail_jadwal->mapel->nama_mapel }}</b>
                                                                <span>({{ $detail_jadwal->guru->nama }})</span>
                                                            </div>
                                                        </div>
                                                        @if (auth()->user()->hasRole('admin'))
                                                            <div
                                                                style="display: flex; justify-content: end; column-gap: 10px; margin: 10px 0px; align-items: center">
                                                                <button type="button" data-bs-toggle="modal"
                                                                    jam-mulai="{{ $timeMulai }}"
                                                                    jam-selesai="{{ $timeSelesai }}"
                                                                    mapel="{{ $detail_jadwal->id_mapel }}"
                                                                    ruang="{{ $detail_jadwal->id_ruang }}"
                                                                    guru="{{ $detail_jadwal->id_guru }}"
                                                                    id-detail-jadwal="{{ $detail_jadwal->id }}"
                                                                    data-bs-target="#update-modal"
                                                                    class="btn
                                        btn-warning font-weight-bold btn--edit text-sm rounded "
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Edit" onclick="showUpdateModalDialog(this)"
                                                                    style="margin-bottom: 0">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <a href="/akademik/jadwal-hapus/{{ $detail_jadwal->id }}"
                                                                    onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                                                    type="button"
                                                                    class="btn
                                        btn-danger font-weight-bold btn--edit text-sm rounded "
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Hapus" style="margin-bottom: 0">
                                                                    <i class="fa fa-close"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                        <div class="border-top"
                                                            style="border-bottom: .5px dashed grey;margin: 20px 0px;">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="">
                                                    <p><b>Catatan : </b>{{ $jadwal->catatan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (auth()->user()->hasRole('admin'))
            <div class="modal fade" id="insert-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-custom fw-normal" role="alert"
                                style="background-color:rgb(255, 213, 151) !important;">
                                <i>NB : Tulis keterangan jadwal jika tidak ada mapel yang dipilih. Contoh : Upacara,
                                    Istirahat</i>
                            </div>
                            <form action="/akademik/jadwal-tambah" class="row g-3 px-4" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_kelas" class="form-control rounded-3" value="">
                                <input type="hidden" name="id_jadwal" class="form-control rounded-3" value="">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Mapel</label>
                                    <div class="input-group">
                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="id_mapel">
                                            <option value="0" selected disabled>-- Pilih Mapel --</option>
                                            @foreach ($mapels as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Guru</label>
                                    <div class="input-group">
                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="id_guru">
                                            <option value="0" selected disabled>-- Pilih Guru --</option>
                                            @foreach ($gurus as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Jam Awal</label>
                                    <div class="input-group">
                                        <input type="time" min="07:00" max="17:00" name="jam_mulai"
                                            class="form-control rounded-3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Jam Akhir</label>
                                    <div class="input-group">
                                        <input type="time" min="07:00" max="17:00" name="jam_selesai"
                                            class="form-control rounded-3" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Ruang</label>
                                    <div class="input-group">
                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="id_ruang">
                                            <option value="0" disabled>-- Pilih Ruang --</option>
                                            @foreach ($ruangs as $item)
                                                <option value="{{ $item->id }}"
                                                    @if (strtolower($item->nama_ruang) == strtolower($kelas->nama_kelas)) {{ 'selected' }} @endif>
                                                    {{ $item->nama_ruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

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
            <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Jadwal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-custom fw-normal" role="alert"
                                style="background-color:rgb(255, 213, 151) !important;">
                                <i>NB : Tulis keterangan jadwal jika tidak ada mapel yang dipilih. Contoh : Upacara,
                                    Istirahat</i>
                            </div>
                            <form action="/akademik/jadwal-update/" class="row g-3 px-4" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Mapel</label>
                                    <div class="input-group">
                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="mapel">
                                            <option value="0" selected disabled>-- Pilih Mapel --</option>
                                            @foreach ($mapels as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Guru</label>
                                    <div class="input-group">
                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="guru">
                                            <option value="0" selected disabled>-- Pilih Guru --</option>
                                            @foreach ($gurus as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Jam Mulai</label>
                                    <div class="input-group">
                                        <input type="time" min="07:00" max="17:00" name="jam_mulai"
                                            class="form-control rounded-3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Jam Selesai</label>
                                    <div class="input-group">
                                        <input type="time" min="07:00" max="17:00" name="jam_selesai"
                                            class="form-control rounded-3" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Ruang</label>
                                    <div class="input-group">
                                        <select required class="form-select rounded-3 form-control-lg text-sm"
                                            aria-label="Default select example" name="ruang">
                                            <option value="" selected disabled>-- Pilih Ruang --</option>
                                            @foreach ($ruangs as $ruang)
                                                <option value="{{ $ruang->id }}">{{ $ruang->nama_ruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Keterangan</label>
                                <div class="input-group">
                                    <input type="text" name="keterangan" class="form-control rounded-3">
                                </div>
                            </div> --}}
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
                function showInsertModalDialog(element) {
                    const insertModalDialog = document.getElementById('insert-modal');
                    const inputKelas_id = insertModalDialog.querySelector('input[name="id_kelas"]');
                    const inputJadwal_id = insertModalDialog.querySelector('input[name="id_jadwal"]');

                    inputKelas_id.value = element.getAttribute('id-kelas');
                    inputJadwal_id.value = element.getAttribute('id-jadwal');
                }

                function showUpdateModalDialog(element) {
                    const updateModalDialog = document.getElementById('update-modal');
                    const form = updateModalDialog.querySelector('form');
                    const inputMapel = updateModalDialog.querySelector('select[name="mapel"]');
                    const inputGuru = updateModalDialog.querySelector('select[name="guru"]');
                    const inputJamMulai = updateModalDialog.querySelector('input[name="jam_mulai"]');
                    const inputJamSelesai = updateModalDialog.querySelector('input[name="jam_selesai"]');
                    const inputRuang = updateModalDialog.querySelector('select[name="ruang"]');

                    form.setAttribute('action', '/akademik/jadwal-update/' + element.getAttribute('id-detail-jadwal'));
                    inputGuru.selectedIndex = element.getAttribute('guru');
                    inputJamMulai.value = element.getAttribute('jam-mulai');
                    inputJamSelesai.value = element.getAttribute('jam-selesai');
                    inputMapel.selectedIndex = element.getAttribute('mapel');
                    inputRuang.selectedIndex = element.getAttribute('ruang');
                }
            </script>
        @endif
    </div>
@endsection
{{-- footer --}}
