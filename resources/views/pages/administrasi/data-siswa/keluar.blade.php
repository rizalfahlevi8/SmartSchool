@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-siswa">Siswa</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa Keluar</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-danger shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Siswa Keluar</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <a href="/administrasi/siswa" type="submit" id="btntambah"
                            class="btn btn-primary font-weight-bold text-xs">
                            Siswa Aktif
                        </a>
                        <!-- Button trigger modal -->

                        {{-- <div class="row justify-content-center mb-3">
                            <div class="col-md-6">
                                <form action="/data-siswa-out" method="get">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-5">
                                            <label for="" class="form-label">Nama Lengkap</label>
                                            <input name="nama" type="text" class="form-control" placeholder=""
                                                value="{{ request('nama') }}">
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="" class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option selected value="">-- Pilih Status --</option>
                                                <option value="lulus" @if (old('status') == 'lulus' || request('status') == 'lulus' || (isset($_GET['status']) && $_GET['status'] == 'lulus')) selected @endif>
                                                    Lulus</option>
                                                <option value="mutasi" @if (old('status') == 'mutasi' || request('status') == 'mutasi' || (isset($_GET['status']) && $_GET['status'] == 'mutasi')) selected @endif>
                                                    Mutasi</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="submit"
                                                class="btn btn-primary font-weight-bold text-xs mt-4 pt-2">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        <table class="table align-items-center mb-0" id="example">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Lengkap
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Tanggal Keluar
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($siswas->count())
                                    @foreach ($siswas as $siswa)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="text-center">
                                                {{ $siswa->nama }}
                                            </td>
                                            <td class="text-center">
                                                {{ $siswa->status }}
                                            </td>
                                            <td class="text-center">
                                                {{ $siswa->updated_at }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button"data-bs-toggle="modal" data-bs-target="#detail-modal"
                                                    class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"
                                                    onclick="showDetailModal(this)" nama-siswa="{{ $siswa->nama }}"
                                                    nis="{{ $siswa->nis }}" nisn="{{ $siswa->nisn }}"
                                                    jenis-kelamin="{{ $siswa->jenis_kelamin }}"
                                                    kelas="{{ $siswa->kelas->nama_kelas }}" nik="{{ $siswa->nik }}"
                                                    tempat-lahir="{{ $siswa->tempat_lahir }}"
                                                    tanggal-lahir="{{ $siswa->tanggal_lahir }}"
                                                    nama-wali="{{ $siswa->nama_wali }}" no-telp="{{ $siswa->no_telp }}"
                                                    agama="{{ $siswa->agama }}" alamat="{{ $siswa->alamat }}"
                                                    foto="{{ asset('storage/murid/img/' . $siswa->foto) }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="data-siswa-edit/{{ $siswa->id }}"
                                                    class=" btn btn-warning font-weight-bold text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="data-siswa-hapus/{{ $siswa->id }}"
                                                    onclick="return confirm('Anda yakin akan menghapus data ini?')"
                                                    class=" btn btn-danger font-weight-bold text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Detail siswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="foto">
                                <img src="" alt="" width="100%" height="auto">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nama</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="nama-siswa">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">NISN</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="nisn">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">NIS</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="nis">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">NIK</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="nik">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Kelas</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="kelas">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Jenis
                                                Kelamin</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="jenis-kelamin">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Tempat,
                                                tanggal
                                                lahir</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="ttl">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Wali</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="wali">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">No Telepon
                                            </span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="no-telp">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Agama</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="agama">

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Alamat</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7" id="alamat">

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
    <script>
        function showDetailModal(element) {
            const detailModalDialog = document.getElementById('detail-modal');
            const nama_siswa = detailModalDialog.querySelector('#nama-siswa');
            const nis = detailModalDialog.querySelector('#nis');
            const nisn = detailModalDialog.querySelector('#nisn');
            const nik = detailModalDialog.querySelector('#nik');
            const wali = detailModalDialog.querySelector('#wali');
            const ttl = detailModalDialog.querySelector('#ttl');
            const alamat = detailModalDialog.querySelector('#alamat');
            const kelas = detailModalDialog.querySelector('#kelas');
            const jenis_kelamin = detailModalDialog.querySelector('#jenis-kelamin');
            const no_telp = detailModalDialog.querySelector('#no-telp');
            const agama = detailModalDialog.querySelector('#agama');
            const foto = detailModalDialog.querySelector('img');

            nama_siswa.innerText = element.getAttribute('nama-siswa');
            nis.innerText = element.getAttribute('nis');
            nisn.innerText = element.getAttribute('nisn');
            nik.innerText = element.getAttribute('nik');
            wali.innerText = element.getAttribute('nama-wali');
            ttl.innerText = `${element.getAttribute('tempat-lahir')}, ${element.getAttribute('tanggal-lahir')}`;
            alamat.innerText = element.getAttribute('alamat');
            agama.innerText = element.getAttribute('agama');
            kelas.innerText = element.getAttribute('kelas');
            jenis_kelamin.innerText = element.getAttribute('jenis-kelamin');
            no_telp.innerText = element.getAttribute('no-telp');
            foto.src = element.getAttribute('foto');
        }
    </script>
@endsection
{{-- footer --}}
