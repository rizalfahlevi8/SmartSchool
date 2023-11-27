@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-siswa">Siswa</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Data Siswa</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <a href="/administrasi/siswa-tambah" type="submit" id="btntambah"
                            class="btn btn-primary font-weight-bold text-xs">
                            <i class="material-icons opacity-10">add</i>
                            Tambah
                        </a>
                        <a href="/administrasi/siswa-keluar" type="submit" id="btntambah"
                            class="btn btn-danger font-weight-bold text-xs">
                            Siswa Keluar
                        </a>
                        <!-- Button trigger modal -->

                        {{-- Filter search --}}
                        {{-- <form action="/administrasi/siswa" method="get">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Nama Lengkap</label>
                                    <input name="nama" type="text" class="form-control" placeholder=""
                                        value="{{ request('nama') }}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Kelas</label>
                                    <select name="kelas" class="form-select">
                                        <option selected value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                @if (old('kelas') == '{{ $k->id }}' || request('kelas') == $k->id || (isset($_GET['kelas']) && $_GET['kelas'] == '{{ $k->d }}')) selected @endif>{{ $k->namakelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option selected value="">-- Pilih Status --</option>
                                        <option value="diterima" @if (old('status') == 'diterima' || request('status') == 'diterima' || (isset($_GET['status']) && $_GET['status'] == 'diterima')) selected @endif>Diterima
                                        </option>
                                        <option value="pindahan" @if (old('status') == 'pindahan' || request('status') == 'dipindah' || (isset($_GET['status']) && $_GET['status'] == 'pindahan')) selected @endif>Pindahan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit"
                                        class="btn btn-primary font-weight-bold text-xs mt-4 pt-2">Search</button>
                                </div>
                            </div>
                        </form> --}}
                        <form action="/administrasi/siswa" method="get">
                            <div style="display: flex; column-gap: 10px; align-items: center; justify-content: flex-start"
                                class="my-3">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="kelas" id="" style="text-transform: capitalize; width: 200px">
                                    <option selected value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" @if (old('kelas') == '{{ $k->id }}' ||(request('kelas') == $k->id)|| (isset($_GET['kelas']) && $_GET['kelas'] == '{{ $k->d }}')) selected @endif>{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="display: flex; column-gap: 10px; align-items: center; justify-content: flex-start"
                                class="my-3">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                    name="status" id="" style="text-transform: capitalize; width: 200px">
                                    <option selected value="">-- Pilih Status --</option>
                                        <option value="bukan pindahan" @if (old('status') == 'bukan pindahan' || request('status') == 'bukan pindahan' || (isset($_GET['status']) && $_GET['status'] == 'bukan pindahan')) selected @endif>Bukan Pindahan
                                        </option>
                                        <option value="pindahan" @if (old('status') == 'pindahan' || request('status') == 'pindahan' || (isset($_GET['status']) && $_GET['status'] == 'pindahan')) selected @endif>Pindahan
                                        </option>
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
                                        NIS
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Lengkap
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Kelas
                                    </th>
                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        status
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
                                                {{ $siswa->nis }}
                                            </td>
                                            <td class="text-center">
                                                {{ $siswa->nama }}
                                            </td>
                                            <td class="text-center">
                                                {{ $siswa->kelas->nama_kelas }}
                                            </td>
                                            <td class="text-center">
                                                {{ $status_siswa = $siswa->status }}
                                            </td>
                                            <td class="text-center" style="display: flex; gap: 10px;">
                                                <button type="button"data-bs-toggle="modal" data-bs-target="#detail-modal"
                                                    class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    style="margin-bottom: 0" title="Detail" nama-siswa="{{ $siswa->nama }}"
                                                    nis="{{ $siswa->nis }}" nisn="{{ $siswa->nisn }}"
                                                    jenis-kelamin="{{ $siswa->jenis_kelamin }}"
                                                    kelas="{{ $siswa->kelas->nama_kelas }}" nik="{{ $siswa->nik }}"
                                                    tempat-lahir="{{ $siswa->tempat_lahir }}"
                                                    tanggal-lahir="{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/M/Y') }}"
                                                    nama-wali="{{ $siswa->nama_wali }}" no-telp="{{ $siswa->no_telp }}"
                                                    agama="{{ $siswa->agama }}" alamat="{{ $siswa->alamat }}"
                                                    status-siswa="{{ $status_siswa = $siswa->status }}"
                                                    @if ($status_siswa == 'mutasi') sekolah-asal = "{{ $siswa->detail_siswa->asal_sekolah }}" tahun-masuk = "{{ \Carbon\Carbon::parse($siswa->detail_siswa->tanggal_masuk)->format('d/M/Y') }}" @endif
                                                    foto="{{ asset('storage/murid/img/' . $siswa->foto) }}"
                                                    onclick="showModalDetail(this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a href="/administrasi/siswa-update/{{ $siswa->id }}"
                                                    class=" btn btn-warning font-weight-bold text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    style="margin-bottom: 0" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button"data-bs-toggle="modal" data-bs-target="#leave-modal"
                                                    class="btn btn-danger font-weight-bold text-sm rounded-circle"
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    style="margin-bottom: 0" title="Detail" id-siswa="{{ $siswa->id }}" nama-siswa="{{ $siswa->nama }}"
                                                    nis="{{ $siswa->nis }}" nisn="{{ $siswa->nisn }}"
                                                    kelas="{{ $siswa->kelas->nama_kelas }}"
                                                    onclick="showModalLeave(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="5" class="text-center">No found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal detail siswa --}}
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
                                            <div id="nama-siswa" class="col-md-7" style="text-transform: uppercase">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NISN</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="nisn" class="col-md-7">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NIS</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="nis" class="col-md-7">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">NIK</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="nik" class="col-md-7">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Kelas</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="kelas" class="col-md-7" style="text-transform: uppercase">

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
                                            <div id="jenis-kelamin" class="col-md-7" style="text-transform: capitalize">

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
                                            <div id="ttl" class="col-md-7" style="text-transform: uppercase">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Nama
                                                    Wali</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="wali" class="col-md-7" style="text-transform: capitalize">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Status</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="status-siswa" class="col-md-7" style="text-transform: capitalize">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="display: none" id="mutasi-detail">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Sekolah asal</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="sekolah-asal" class="col-md-7" style="text-transform: uppercase">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item" style="display: none" id="mutasi-detail">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Tahun masuk</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="tahun-masuk" class="col-md-7">

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
                                            <div id="no-telp" class="col-md-7">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Agama</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="agama" class="col-md-7" style="text-transform: capitalize">

                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <span class="float-start fw-bold">Alamat</span>
                                                <div class="float-end">:</div>
                                            </div>
                                            <div id="alamat" class="col-md-7" style="text-transform: capitalize">

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

        {{-- modal leave --}}

        <div class="modal fade" id="leave-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Siswa Keluar
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="siswaForm" class="row g-3 py-1 px-4" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Nama</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div id="nama-siswa" class="col-md-7" style="text-transform: uppercase">
    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">NISN</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div id="nisn" class="col-md-7">
    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">NIS</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div id="nis" class="col-md-7">
    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Kelas</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div id="kelas" class="col-md-7" style="text-transform: uppercase">
    
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Status
                                                        Keluar</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <select class="form-select rounded-3 form-control-lg text-sm"
                                                            aria-label="Default select example" name="status"
                                                            id="status">
                                                            <option selected>-- Pilih Status --</option>
                                                            <option value="lulus"
                                                                @if (old('status') == 'lulus') {{ 'selected' }} @endif>
                                                                Lulus</option>
                                                            <option value="mutasi"
                                                                @if (old('status') == 'mutasi') {{ 'selected' }} @endif>
                                                                Mutasi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Tanggal Keluar</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="date" name="tanggal_keluar" class="form-control rounded-3" id="tanggal_keluar" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <br>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger ml-5 text-sm rounded-3"
                                    style="float:right; ">
                                    <i class="fa fa-save"></i>
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
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

        function showModalDetail(element) {
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

            const mutasi_detail = detailModalDialog.querySelectorAll('#mutasi-detail');
            const status_siswa = detailModalDialog.querySelector('#status-siswa');
            const sekolah_asal = detailModalDialog.querySelector('#mutasi-detail #sekolah-asal');
            const tahun_masuk = detailModalDialog.querySelector('#mutasi-detail #tahun-masuk');

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
            status_siswa.innerText = element.getAttribute('status-siswa');
            foto.src = element.getAttribute('foto');

            if (element.getAttribute('status-siswa') == 'mutasi') {
                sekolah_asal.innerText = element.getAttribute('sekolah-asal');
                tahun_masuk.innerText = element.getAttribute('tahun-masuk');
                mutasi_detail.forEach(value => {
                    value.style.display = 'block';
                    value.style.display = 'block';
                });
            } else {
                mutasi_detail.forEach(value => {
                    value.style.display = 'none';
                    value.style.display = 'none';
                });
            }
        }
        function showModalLeave(element) {
    const detailModalDialog = document.getElementById('leave-modal');
    const nama_siswa = detailModalDialog.querySelector('#nama-siswa');
    const nis = detailModalDialog.querySelector('#nis');
    const nisn = detailModalDialog.querySelector('#nisn');
    const kelas = detailModalDialog.querySelector('#kelas');
    const form = document.getElementById("siswaForm");
    const statusDropdown = detailModalDialog.querySelector('#status');
    const tanggalKeluarInput = detailModalDialog.querySelector('#tanggal_keluar');

    // Mengasumsikan idSiswa adalah variabel yang ingin Anda gunakan
    const idSiswa = element.getAttribute("id-siswa");

    form.action = "/administrasi/siswa-keluar/" + idSiswa;

    nama_siswa.innerText = element.getAttribute('nama-siswa');
    nis.innerText = element.getAttribute('nis');
    nisn.innerText = element.getAttribute('nisn');
    kelas.innerText = element.getAttribute('kelas');

    // Menambahkan nilai status ke dropdown "Status Keluar"
    statusDropdown.value = element.getAttribute('status');

    // Mengatur nilai default "Tanggal Keluar" berdasarkan status yang dipilih
    tanggalKeluarInput.value = new Date().toISOString().split('T')[0];

}
    </script>
@endsection
{{-- footer --}}
