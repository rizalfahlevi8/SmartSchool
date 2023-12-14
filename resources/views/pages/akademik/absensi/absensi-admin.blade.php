@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Data Absensi</h6>
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    {{-- Template putih start--}}
    <div class="card my-4">
      {{-- Header absensi start--}}
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Absensi</h6>
        </div>
    </div>
    {{-- Header absensi end --}}
    {{-- Isi content start --}}
    <div class="d-flex align-items-center justify-content-center text-3xl" style="height: 400px">
        <div class="card">
            <div class="card-body">
                <div id="chart-demo-pie" class="chart-lg"></div>
            </div>
        </div>
    </div>

    <div class="mb-4 d-flex align-items-center justify-content-center">
      <div class="col-lg-10 pr-4 mr-2">

        {{-- Table Siswa --}}
        <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: 450px; max-height: 450px; position: relative;">
            <h5 class="position-relative" style="font-weight: bold; position: sticky; top: 0; background-color: white; z-index: 100;">
                Data Siswa
            </h5>
            <div class="input-group mb-3" style="position: sticky; top: 40px; background-color: white; z-index: 99;">
                <div style="margin-right: 20px;">
                    <input type="text" class="form-control rounded" placeholder="Search..." name="search" id="searchSiswa" style="border: 2px solid lightblue; width: 350px;">
                </div>
                <div class="col-2 mx-3 ml-5">
                    <select class="form-select rounded" name="dropdownkelas" id="dropdownkelas" style="border: 2px solid lightblue;">
                        <option value="semua">Semua Siswa</option>
                    </select>
                </div>
                <div class="col-2 mx-3" id="dropdownsiswacontainer" style="display: none;">
                    <select class="form-select rounded" name="dropdownnama" id="dropdownsiswa" style="border: 2px solid lightblue;">
                    </select>
                </div>
            </div>
            <div class="table-responsive small col-lg-12" style="flex: 1; overflow: auto;">
                <table id="absensiTableSiswa" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jam Absen</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBodySiswa">
                @foreach ($siswaAbsensis as $absensi)
                    @php
                        $user = \App\Models\User::find($absensi->id_user);
                    @endphp
                    @if ($user && $user->role == 'siswa')
                        @php
                            $siswa = \App\Models\Siswa::where('id_user', $absensi->id_user)->first();
                        @endphp
                        @if ($siswa)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($absensi->created_at)->locale('id')->isoFormat('dddd') }}</td>
                                <td>{{ optional($absensi->guru)->nama ?? $siswa->nama }}</td>
                                <td>{{ optional($siswa->kelas)->nama_kelas }}</td>
                                <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('H:i:s') }}</td>
                                <td>{{ $absensi->status_absen }}</td>
                                <td>
                                    @if ($absensi->file_path) <!-- Tambah kondisi untuk menampilkan jika ada file -->
                                        <a href="{{ asset('storage/' . $absensi->file_path) }}" class="btn btn-info btn-sm" target="_blank">Lihat File</a>
                                    @endif
                                    <button class="btn btn-warning" onclick="showEditModal({{ $absensi->id }})"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="deleteAbsensi({{ $absensi->id }})"><i class="fa fa-trash"></i></button>
                                    
                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
        
    <!-- Table for Data Guru -->
    <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: 450px; max-height: 450px; position: relative;">
        <h5 class="position-relative" style="font-weight: bold; position: sticky; top: 0; background-color: white; z-index: 100;">
            Data Guru
        </h5>
        <div class="input-group mb-3" style="position: sticky; top: 40px; background-color: white; z-index: 99;">
            <div style="margin-right: 20px;">
                <input type="text" class="form-control rounded" placeholder="Search..." name="search" id="searchGuru" style="border: 2px solid lightblue; width: 350px;">
            </div>
            <div class="col-2 mx-3 ml-5">
                <select class="form-select rounded" name="dropdownkelas" id="dropdownkelasGuru" style="border: 2px solid lightblue;">
                </select>
            </div>
        </div>
        <div class="table-responsive small col-lg-12" style="flex: 1; overflow: auto;">
            <table id="absensiTableguru" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jam Absen</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBodyGuru">
                    @foreach ($guruAbsensis as $absensi)
                        @php
                            $user = \App\Models\User::find($absensi->id_user);
                        @endphp
                        @if ($user && $user->role == 'guru')
                            @php
                                $guru = \App\Models\Guru::where('id_user', $absensi->id_user)->first();
                            @endphp
                            @if ($guru)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->created_at)->locale('id')->isoFormat('dddd') }}</td>
                                    <td>{{ optional($guru)->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('H:i:s') }}</td>
                                    <td>{{ $absensi->status_absen }}</td>
                                    <td>
                                        @if ($absensi->file_path) <!-- Tambah kondisi untuk menampilkan jika ada file -->
                                            <a href="{{ asset('storage/' . $absensi->file_path) }}" class="btn btn-info btn-sm" target="_blank">Lihat File</a>
                                        @endif
                                        <button class="btn btn-warning" onclick="showEditModal({{ $absensi->id }})"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger" onclick="deleteAbsensi({{ $absensi->id }})"><i class="fa fa-trash"></i></button>
                                        
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulir untuk menambahkan absensi -->
    <form id="absensiForm" enctype="multipart/form-data">
        <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: auto; max-height: 550px; position: relative;" id="presensiOptions">
            <h5 class="font-weight-bold mb-3">Tambahkan Absensi</h5>
            
            <!-- Radio button untuk memilih apakah absensi untuk "Siswa" atau "Guru" -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="roleRadio" id="siswaRadio" value="siswa" onclick="selectRole('siswa')">
                <label class="form-check-label" for="siswaRadio">
                    Siswa
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="roleRadio" id="guruRadio" value="guru" onclick="selectRole('guru')">
                <label class="form-check-label" for="guruRadio">
                    Guru
                </label>
            </div>
    
            <!-- Dropdown untuk memilih kelas (akan muncul jika role "Siswa" yang dipilih) -->
            <div class="mb-3" id="dropdownContainer" style="display: none;">
                <label for="dropdown1" class="form-label">Pilih Kelas:</label>
                <select class="form-select" id="dropdown1" name="dropdown1"></select>
                
                <!-- Dropdown2 untuk daftar nama siswa -->
                <div class="mb-3" id="dropdown2Container" style="display: none;">
                    <label for="dropdown2" class="form-label">Pilih Siswa:</label>
                    <select class="form-select" id="dropdown2" name="dropdown2"></select>
                </div>
            </div>
    
            <div class="d-flex justify-content-center">
                <!-- Opsi absensi -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" onclick="selectOption('masuk')">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Masuk
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" onclick="selectOption('sakit')">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Sakit
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" onclick="selectOption('izin')">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Izin
                    </label>
                </div>
            </div>
            
            <!-- File upload container -->
            <div class="file-upload-container" id="fileUploadContainer">
                <div class="mb-3">
                    <label for="fileInput" class="form-label">Unggah File (PDF):</label>
                    <input type="file" class="form-control" id="fileInput" name="file" accept=".pdf">
                </div>
            </div>
    
            <!-- Hidden input untuk menyimpan nilai status absen -->
            <input type="hidden" name="status_absen" id="statusInput" value="">
            
            <!-- Tombol Submit -->
            <div class="d-flex justify-content-end mt-3">
                <button type="button" class="submit-button" onclick="submitData()" id="submitButton">Submit</button>
                <div id="submitIndicator"></div>
            </div>
        </div>
    </form>
    

    <div class="bodycalendar">
        <div class="container">
            <div class="left">
            <div class="calendar">
                <div class="month">
                <i class="fas fa-angle-left prev"></i>
                <div class="date">december 2023</div>
                <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                <div>Minggu</div>
                <div>Senin</div>
                <div>Selasa</div>
                <div>Rabu</div>
                <div>Kamis</div>
                <div>Jumat</div>
                <div>Sabtu</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">
                <div class="goto">
                    <input type="text" placeholder="mm/yyyy" class="date-input" />
                    <button class="goto-btn">Go</button>
                </div>
                <button class="today-btn">Hari ini</button>
                </div>
            </div>
            </div>
            <div class="right">
            <div class="today-date">
                <div class="event-day">Kamis</div>
                <div class="event-date">6 Desember 2023</div>
            </div>
            <div class="events"></div>
            <div class="add-event-wrapper">
                <div class="add-event-header">
                <div class="title">Tambahkan Event</div>
                <i class="fas fa-times close"></i>
                </div>
                <div class="add-event-body">
                <div class="add-event-input">
                    <input type="text" placeholder="Event Name" class="event-name" />
                </div>
                <div class="add-event-input">
                    <input
                    type="text"
                    placeholder="Event Time From"
                    class="event-time-from"
                    />
                </div>
                <div class="add-event-input">
                    <input
                    type="text"
                    placeholder="Event Time To"
                    class="event-time-to"
                    />
                </div>
                </div>
                <div class="add-event-footer">
                <button class="add-event-btn">Tambahkan Event</button>
                </div>
            </div>
            </div>
            <button class="add-event">
            <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    
    </div>
    </div>
    {{-- Isi content end --}}
    </div>
    {{-- Template putih end --}}
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="namaEdit" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="namaEdit" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="kelasEdit" class="form-label">Kelas:</label>
                        <input type="text" class="form-control" id="kelasEdit" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalEdit" class="form-label">Tanggal:</label>
                        <input type="text" class="form-control" id="tanggalEdit" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jamAbsenEdit" class="form-label">Jam Absen:</label>
                        <input type="text" class="form-control" id="jamAbsenEdit" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="statusEdit" class="form-label">Status:</label>
                        <select class="form-select" id="statusEdit" name="status">
                            <option value="Masuk">Masuk</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Tidak Masuk">Tidak Masuk</option>
                        </select>
                    </div>
                    <input type="hidden" id="absensiId" name="absensiId">
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>

.form-check-label {
    font-size: 20px; /* Sesuaikan dengan ukuran teks yang diinginkan */
    margin-right: 10px; /* Sesuaikan dengan jarak yang diinginkan antara label dan tombol input */
}

.form-check {
    margin-right: 40px;
}

.file-upload-container {
    display: none;
    margin-top: 10px;
  }

  .absensi-button {
      border: none;
      border-radius: 50%;
      background-color: #ccc;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
  }

  .absensi-button.active {
      background-color: #007bff;
  }

  .submit-button {
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        cursor: pointer;
    }

        :root {
    --primary-clr: #b38add;
    }
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    }
    /* nice scroll bar */
    ::-webkit-scrollbar {
    width: 5px;
    }
    ::-webkit-scrollbar-track {
    background: #f5f5f5;
    border-radius: 50px;
    }
    ::-webkit-scrollbar-thumb {
    background: var(--primary-clr);
    border-radius: 50px;
    }

    .bodycalendar {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-bottom: 30px;
    background-color: #e2e1dc;
    }
    .container {
    position: relative;
    width: 1200px;
    min-height: 850px;
    margin: 0 auto;
    padding: 5px;
    color: #fff;
    display: flex;

    border-radius: 10px;
    background-color: #373c4f;
    }
    .left {
    width: 60%;
    padding: 20px;
    }
    .calendar {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: space-between;
    color: #878895;
    border-radius: 5px;
    background-color: #fff;
    }
    /* set after behind the main element */
    .calendar::before,
    .calendar::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 100%;
    width: 12px;
    height: 97%;
    border-radius: 0 5px 5px 0;
    background-color: #d3d4d6d7;
    transform: translateY(-50%);
    }
    .calendar::before {
    height: 94%;
    left: calc(100% + 12px);
    background-color: rgb(153, 153, 153);
    }
    .calendar .month {
    width: 100%;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 50px;
    font-size: 1.2rem;
    font-weight: 500;
    text-transform: capitalize;
    }
    .calendar .month .prev,
    .calendar .month .next {
    cursor: pointer;
    }
    .calendar .month .prev:hover,
    .calendar .month .next:hover {
    color: var(--primary-clr);
    }
    .calendar .weekdays {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    font-size: 1rem;
    font-weight: 500;
    text-transform: capitalize;
    }
    .weekdays div {
    width: 14.28%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .calendar .days {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 0 20px;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 20px;
    }
    .calendar .days .day {
    width: 14.28%;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--primary-clr);
    border: 1px solid #f5f5f5;
    }
    .calendar .days .day:nth-child(7n + 1) {
    border-left: 2px solid #f5f5f5;
    }
    .calendar .days .day:nth-child(7n) {
    border-right: 2px solid #f5f5f5;
    }
    .calendar .days .day:nth-child(-n + 7) {
    border-top: 2px solid #f5f5f5;
    }
    .calendar .days .day:nth-child(n + 29) {
    border-bottom: 2px solid #f5f5f5;
    }

    .calendar .days .day:not(.prev-date, .next-date):hover {
    color: #fff;
    background-color: var(--primary-clr);
    }
    .calendar .days .prev-date,
    .calendar .days .next-date {
    color: #b3b3b3;
    }
    .calendar .days .active {
    position: relative;
    font-size: 2rem;
    color: #fff;
    background-color: var(--primary-clr);
    }
    .calendar .days .active::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    box-shadow: 0 0 10px 2px var(--primary-clr);
    }
    .calendar .days .today {
    font-size: 2rem;
    }
    .calendar .days .event {
    position: relative;
    }
    .calendar .days .event::after {
    content: "";
    position: absolute;
    bottom: 10%;
    left: 50%;
    width: 75%;
    height: 6px;
    border-radius: 30px;
    transform: translateX(-50%);
    background-color: var(--primary-clr);
    }
    .calendar .days .day:hover.event::after {
    background-color: #fff;
    }
    .calendar .days .active.event::after {
    background-color: #fff;
    bottom: 20%;
    }
    .calendar .days .active.event {
    padding-bottom: 10px;
    }
    .calendar .goto-today {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 5px;
    padding: 0 20px;
    margin-bottom: 20px;
    color: var(--primary-clr);
    }
    .calendar .goto-today .goto {
    display: flex;
    align-items: center;
    border-radius: 5px;
    overflow: hidden;
    border: 1px solid var(--primary-clr);
    }
    .calendar .goto-today .goto input {
    width: 100%;
    height: 30px;
    outline: none;
    border: none;
    border-radius: 5px;
    padding: 0 20px;
    color: var(--primary-clr);
    border-radius: 5px;
    }
    .calendar .goto-today button {
    padding: 5px 10px;
    border: 1px solid var(--primary-clr);
    border-radius: 5px;
    background-color: transparent;
    cursor: pointer;
    color: var(--primary-clr);
    }
    .calendar .goto-today button:hover {
    color: #fff;
    background-color: var(--primary-clr);
    }
    .calendar .goto-today .goto button {
    border: none;
    border-left: 1px solid var(--primary-clr);
    border-radius: 0;
    }
    .container .right {
    position: relative;
    width: 40%;
    min-height: 100%;
    padding: 20px 0;
    }

    .right .today-date {
    width: 100%;
    height: 50px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    padding-left: 70px;
    margin-top: 50px;
    margin-bottom: 20px;
    text-transform: capitalize;
    }
    .right .today-date .event-day {
    font-size: 2rem;
    font-weight: 500;
    }
    .right .today-date .event-date {
    font-size: 1rem;
    font-weight: 400;
    color: #878895;
    }
    .events {
    width: 100%;
    height: 100%;
    max-height: 600px;
    overflow-x: hidden;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    padding-left: 4px;
    }
    .events .event {
    position: relative;
    width: 95%;
    min-height: 70px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    gap: 5px;
    padding: 0 20px;
    padding-left: 50px;
    color: #fff;
    background: linear-gradient(90deg, #3f4458, transparent);
    cursor: pointer;
    }
    /* even event */
    .events .event:nth-child(even) {
    background: transparent;
    }
    .events .event:hover {
    background: linear-gradient(90deg, var(--primary-clr), transparent);
    }
    .events .event .title {
    display: flex;
    align-items: center;
    pointer-events: none;
    }
    .events .event .title .event-title {
    font-size: 1rem;
    font-weight: 400;
    margin-left: 20px;
    color: #f5f5f5
    }
    .events .event i {
    color: var(--primary-clr);
    font-size: 0.5rem;
    }
    .events .event:hover i {
    color: #fff;
    }
    .events .event .event-time {
    font-size: 0.8rem;
    font-weight: 400;
    color: #878895;
    margin-left: 15px;
    pointer-events: none;
    }
    .events .event:hover .event-time {
    color: #fff;
    }
    /* add tick in event after */
    .events .event::after {
    content: "✓";
    position: absolute;
    top: 50%;
    right: 0;
    font-size: 3rem;
    line-height: 1;
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0.3;
    color: var(--primary-clr);
    transform: translateY(-50%);
    }
    .events .event:hover::after {
    display: flex;
    }
    .add-event {
    position: absolute;
    bottom: 30px;
    right: 30px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #878895;
    border: 2px solid #878895;
    opacity: 0.5;
    border-radius: 50%;
    background-color: transparent;
    cursor: pointer;
    }
    .add-event:hover {
    opacity: 1;
    }
    .add-event i {
    pointer-events: none;
    }
    .events .no-event {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 500;
    color: #878895;
    }
    .add-event-wrapper {
    position: absolute;
    bottom: 100px;
    left: 50%;
    width: 90%;
    max-height: 0;
    overflow: hidden;
    border-radius: 5px;
    background-color: #fff;
    transform: translateX(-50%);
    transition: max-height 0.5s ease;
    }
    .add-event-wrapper.active {
    max-height: 300px;
    }
    .add-event-header {
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    color: #373c4f;
    border-bottom: 1px solid #f5f5f5;
    }
    .add-event-header .close {
    font-size: 1.5rem;
    cursor: pointer;
    }
    .add-event-header .close:hover {
    color: var(--primary-clr);
    }
    .add-event-header .title {
    font-size: 1.2rem;
    font-weight: 500;
    }
    .add-event-body {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 20px;
    }
    .add-event-body .add-event-input {
    width: 100%;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    }
    .add-event-body .add-event-input input {
    width: 100%;
    height: 100%;
    outline: none;
    border: none;
    border-bottom: 1px solid #f5f5f5;
    padding: 0 10px;
    font-size: 1rem;
    font-weight: 400;
    color: #373c4f;
    }
    .add-event-body .add-event-input input::placeholder {
    color: #a5a5a5;
    }
    .add-event-body .add-event-input input:focus {
    border-bottom: 1px solid var(--primary-clr);
    }
    .add-event-body .add-event-input input:focus::placeholder {
    color: var(--primary-clr);
    }
    .add-event-footer {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    }
    .add-event-footer .add-event-btn {
    height: 40px;
    font-size: 1rem;
    font-weight: 500;
    outline: none;
    border: none;
    color: #fff;
    background-color: var(--primary-clr);
    border-radius: 5px;
    cursor: pointer;
    padding: 5px 10px;
    border: 1px solid var(--primary-clr);
    }
    .add-event-footer .add-event-btn:hover {
    background-color: transparent;
    color: var(--primary-clr);
    }

    /* media queries */

    @media screen and (max-width: 1000px) {
    body {
        align-items: flex-start;
        justify-content: flex-start;
    }
    .container {
        min-height: 100vh;
        flex-direction: column;
        border-radius: 0;
    }
    .container .left {
        width: 100%;
        height: 100%;
        padding: 20px 0;
    }
    .container .right {
        width: 100%;
        height: 100%;
        padding: 20px 0;
    }
    .calendar::before,
    .calendar::after {
        top: 100%;
        left: 50%;
        width: 97%;
        height: 12px;
        border-radius: 0 0 5px 5px;
        transform: translateX(-50%);
    }
    .calendar::before {
        width: 94%;
        top: calc(100% + 12px);
    }
    .events {
        padding-bottom: 340px;
    }
    .add-event-wrapper {
        bottom: 100px;
    }
    }
    @media screen and (max-width: 500px) {
    .calendar .month {
        height: 75px;
    }
    .calendar .weekdays {
        height: 50px;
    }
    .calendar .days .day {
        height: 40px;
        font-size: 0.8rem;
    }
    .calendar .days .day.active,
    .calendar .days .day.today {
        font-size: 1rem;
    }
    .right .today-date {
        padding: 20px;
    }
    }

    .credits {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    padding: 10px;
    font-size: 12px;
    color: #fff;
    background-color: #b38add;
    }
    .credits a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    }
    .credits a:hover {
    text-decoration: underline;
    }
</style>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk mengambil data dan menghitung jumlah
        function countStatusAbsen(rows, columnIndex) {
            let masukCount = 0;
            let sakitCount = 0;
            let izinCount = 0;
            let tidakMasukCount = 0;
    
            for (let i = 0; i < rows.length; i++) {
                const statusAbsen = rows[i].querySelector(`td:nth-child(${columnIndex})`).textContent;
    
                switch (statusAbsen.toLowerCase()) {
                    case 'masuk':
                        masukCount++;
                        break;
                    case 'sakit':
                        sakitCount++;
                        break;
                    case 'izin':
                        izinCount++;
                        break;
                    case 'tidak masuk':
                        tidakMasukCount++;
                        break;
                    // Tambahkan case untuk status_absen lain jika diperlukan
                }
            }
    
            return {
                masuk: masukCount,
                sakit: sakitCount,
                izin: izinCount,
                tidakMasuk: tidakMasukCount
            };
        }
    
        // Ambil data dari tabel siswa
        const absensiTableSiswa = document.getElementById('tableBodySiswa');
        const absensiRowsSiswa = absensiTableSiswa.getElementsByTagName('tr');
        const siswaData = countStatusAbsen(absensiRowsSiswa, 6); // Ganti 6 sesuai dengan indeks kolom status_absen pada tabel siswa
    
        // Ambil data dari tabel guru
        const absensiTableGuru = document.getElementById('tableBodyGuru');
        const absensiRowsGuru = absensiTableGuru.getElementsByTagName('tr');
        const guruData = countStatusAbsen(absensiRowsGuru, 5); // Ganti 5 sesuai dengan indeks kolom status_absen pada tabel guru
    
        // Gabungkan data dari kedua tabel
        const combinedData = {
            masuk: siswaData.masuk + guruData.masuk,
            sakit: siswaData.sakit + guruData.sakit,
            izin: siswaData.izin + guruData.izin,
            tidakMasuk: siswaData.tidakMasuk + guruData.tidakMasuk
        };
    
        // Inisialisasi pie chart dengan data yang dihitung
        window.ApexCharts && new ApexCharts(document.getElementById('chart-demo-pie'), {
            chart: {
                type: "donut",
                fontFamily: 'inherit',
                height: 400,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            series: [combinedData.masuk, combinedData.sakit, combinedData.izin, combinedData.tidakMasuk],
            labels: ["Masuk", "Sakit", "Izin", "Tidak Masuk"],
            tooltip: {
                theme: 'dark'
            },
            grid: {
                strokeDashArray: 4,
            },
            colors: ['#2845ff', '#Feef50', '#20f000', '#ff1818' ],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
            tooltip: {
                fillSeriesColor: false
            },
        }).render();
    });
    
    
    
        function Log(...messages) {
            // Menggabungkan pesan-pesan menjadi satu string
            const logMessage = messages.join(' ');
    
            // Mencetak pesan log ke konsol
            console.log(logMessage);
    
            // Jika Anda ingin menampilkan log pada halaman web, tambahkan elemen atau tampilan yang sesuai di sini
        }
    
        Log('Script loaded.');
    
        const calendar = document.querySelector(".calendar"),
        date = document.querySelector(".date"),
        daysContainer = document.querySelector(".days"),
        prev = document.querySelector(".prev"),
        next = document.querySelector(".next"),
        todayBtn = document.querySelector(".today-btn"),
        gotoBtn = document.querySelector(".goto-btn"),
        dateInput = document.querySelector(".date-input"),
        eventDay = document.querySelector(".event-day"),
        eventDate = document.querySelector(".event-date"),
        eventsContainer = document.querySelector(".events"),
        addEventBtn = document.querySelector(".add-event"),
        addEventWrapper = document.querySelector(".add-event-wrapper "),
        addEventCloseBtn = document.querySelector(".close "),
        addEventTitle = document.querySelector(".event-name "),
        addEventFrom = document.querySelector(".event-time-from "),
        addEventTo = document.querySelector(".event-time-to "),
        addEventSubmit = document.querySelector(".add-event-btn ");
    
        let today = new Date();
        let activeDay;
        let month = today.getMonth();
        let year = today.getFullYear();
    
        const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
        ];
    
        // const eventsArr = [
        //   {
        //     day: 13,
        //     month: 11,
        //     year: 2022,
        //     events: [
        //       {
        //         title: "Event 1 lorem ipsun dolar sit genfa tersd dsad ",
        //         time: "10:00 AM",
        //       },
        //       {
        //         title: "Event 2",
        //         time: "11:00 AM",
        //       },
        //     ],
        //   },
        // ];
    
        const eventsArr = [];
        const databaseEvents = [];
    
        getEvents();
        console.log(eventsArr);
    
        getEventsFromDatabase();
    
    
        //function to add days in days with class day and prev-date next-date on previous month and next month days and active on today
        function initCalendar() {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const prevLastDay = new Date(year, month, 0);
        const prevDays = prevLastDay.getDate();
        const lastDate = lastDay.getDate();
        const day = firstDay.getDay();
        const nextDays = 7 - lastDay.getDay() - 1;
    
        date.innerHTML = months[month] + " " + year;
    
        let days = "";
    
        for (let x = day; x > 0; x--) {
            days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
        }
    
        for (let i = 1; i <= lastDate; i++) {
            //check if event is present on that day
            let event = false;
            eventsArr.forEach((eventObj) => {
            if (
                eventObj.day === i &&
                eventObj.month === month + 1 &&
                eventObj.year === year
            ) {
                event = true;
            }
            });
            if (
            i === new Date().getDate() &&
            year === new Date().getFullYear() &&
            month === new Date().getMonth()
            ) {
            activeDay = i;
            getActiveDay(i);
            updateEvents(i);
            if (event) {
                days += `<div class="day today active event">${i}</div>`;
            } else {
                days += `<div class="day today active">${i}</div>`;
            }
            } else {
            if (event) {
                days += `<div class="day event">${i}</div>`;
            } else {
                days += `<div class="day ">${i}</div>`;
            }
            }
        }
    
        for (let j = 1; j <= nextDays; j++) {
            days += `<div class="day next-date">${j}</div>`;
        }
        daysContainer.innerHTML = days;
        addListner();
        }
    
        //function to add month and year on prev and next button
        function prevMonth() {
        month--;
        if (month < 0) {
            month = 11;
            year--;
        }
        initCalendar();
        }
    
        function nextMonth() {
        month++;
        if (month > 11) {
            month = 0;
            year++;
        }
        initCalendar();
        }
    
        prev.addEventListener("click", prevMonth);
        next.addEventListener("click", nextMonth);
    
        initCalendar();
    
        //function to add active on day
        function addListner() {
        const days = document.querySelectorAll(".day");
        days.forEach((day) => {
            day.addEventListener("click", (e) => {
            getActiveDay(e.target.innerHTML);
            updateEvents(Number(e.target.innerHTML));
            activeDay = Number(e.target.innerHTML);
            //remove active
            days.forEach((day) => {
                day.classList.remove("active");
            });
            //if clicked prev-date or next-date switch to that month
            if (e.target.classList.contains("prev-date")) {
                prevMonth();
                //add active to clicked day afte month is change
                setTimeout(() => {
                //add active where no prev-date or next-date
                const days = document.querySelectorAll(".day");
                days.forEach((day) => {
                    if (
                    !day.classList.contains("prev-date") &&
                    day.innerHTML === e.target.innerHTML
                    ) {
                    day.classList.add("active");
                    }
                });
                }, 100);
            } else if (e.target.classList.contains("next-date")) {
                nextMonth();
                //add active to clicked day afte month is changed
                setTimeout(() => {
                const days = document.querySelectorAll(".day");
                days.forEach((day) => {
                    if (
                    !day.classList.contains("next-date") &&
                    day.innerHTML === e.target.innerHTML
                    ) {
                    day.classList.add("active");
                    }
                });
                }, 100);
            } else {
                e.target.classList.add("active");
            }
            });
        });
        }
    
        todayBtn.addEventListener("click", () => {
        today = new Date();
        month = today.getMonth();
        year = today.getFullYear();
        initCalendar();
        });
    
        dateInput.addEventListener("input", (e) => {
        dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
        if (dateInput.value.length === 2) {
            dateInput.value += "/";
        }
        if (dateInput.value.length > 7) {
            dateInput.value = dateInput.value.slice(0, 7);
        }
        if (e.inputType === "deleteContentBackward") {
            if (dateInput.value.length === 3) {
            dateInput.value = dateInput.value.slice(0, 2);
            }
        }
        });
    
        gotoBtn.addEventListener("click", gotoDate);
    
        function gotoDate() {
        console.log("here");
        const dateArr = dateInput.value.split("/");
        if (dateArr.length === 2) {
            if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
            month = dateArr[0] - 1;
            year = dateArr[1];
            initCalendar();
            return;
            }
        }
        alert("Invalid Date");
        }
    
        //function get active day day name and date and update eventday eventdate
        function getActiveDay(date) {
        const day = new Date(year, month, date);
        const dayName = day.toString().split(" ")[0];
        eventDay.innerHTML = dayName;
        eventDate.innerHTML = date + " " + months[month] + " " + year;
        }
    
        //function update events when a day is active
        function updateEvents(date) {
        let events = "";
        eventsArr.forEach((event) => {
            if (
            date === event.day &&
            month + 1 === event.month &&
            year === event.year
            ) {
            event.events.forEach((event) => {
                events += `<div class="event">
                    <div class="title">
                    <i class="fas fa-circle"></i>
                    <h3 class="event-title">${event.title}</h3>
                    </div>
                    <div class="event-time">
                    <span class="event-time">${event.time}</span>
                    </div>
                </div>`;
            });
            }
        });
        if (events === "") {
            events = `<div class="no-event">
                    <h3>No Events</h3>
                </div>`;
        }
        eventsContainer.innerHTML = events;
        saveEvents();
        }
    
        //function to add event
        addEventBtn.addEventListener("click", () => {
        addEventWrapper.classList.toggle("active");
        });
    
        addEventCloseBtn.addEventListener("click", () => {
        addEventWrapper.classList.remove("active");
        });
    
        document.addEventListener("click", (e) => {
        if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
            addEventWrapper.classList.remove("active");
        }
        });
    
        //allow 50 chars in eventtitle
        addEventTitle.addEventListener("input", (e) => {
        addEventTitle.value = addEventTitle.value.slice(0, 60);
        });
    
        //allow only time in eventtime from and to
        addEventFrom.addEventListener("input", (e) => {
        addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
        if (addEventFrom.value.length === 2) {
            addEventFrom.value += ":";
        }
        if (addEventFrom.value.length > 5) {
            addEventFrom.value = addEventFrom.value.slice(0, 5);
        }
        });
    
        addEventTo.addEventListener("input", (e) => {
        addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
        if (addEventTo.value.length === 2) {
            addEventTo.value += ":";
        }
        if (addEventTo.value.length > 5) {
            addEventTo.value = addEventTo.value.slice(0, 5);
        }
        });
    
        //function to add event to eventsArr
        addEventSubmit.addEventListener("click", () => {
        const eventTitle = addEventTitle.value;
        const eventTimeFrom = addEventFrom.value;
        const eventTimeTo = addEventTo.value;
        if (eventTitle === "" || eventTimeFrom === "" || eventTimeTo === "") {
            alert("Please fill all the fields");
            return;
        }
    
        //check correct time format 24 hour
        const timeFromArr = eventTimeFrom.split(":");
        const timeToArr = eventTimeTo.split(":");
        if (
            timeFromArr.length !== 2 ||
            timeToArr.length !== 2 ||
            timeFromArr[0] > 23 ||
            timeFromArr[1] > 59 ||
            timeToArr[0] > 23 ||
            timeToArr[1] > 59
        ) {
            alert("Invalid Time Format");
            return;
        }
    
        const timeFrom = convertTime(eventTimeFrom);
        const timeTo = convertTime(eventTimeTo);
    
        //check if event is already added
        let eventExist = false;
        eventsArr.forEach((event) => {
            if (
            event.day === activeDay &&
            event.month === month + 1 &&
            event.year === year
            ) {
            event.events.forEach((event) => {
                if (event.title === eventTitle) {
                eventExist = true;
                }
            });
            }
        });
        if (eventExist) {
            alert("Event already added");
            return;
        }
        const newEvent = {
            title: eventTitle,
            time: timeFrom + " - " + timeTo,
        };
        console.log(newEvent);
        console.log(activeDay);
        let eventAdded = false;
        if (eventsArr.length > 0) {
            eventsArr.forEach((item) => {
            if (
                item.day === activeDay &&
                item.month === month + 1 &&
                item.year === year
            ) {
                item.events.push(newEvent);
                eventAdded = true;
            }
            });
        }
    
        if (!eventAdded) {
            eventsArr.push({
            day: activeDay,
            month: month + 1,
            year: year,
            events: [newEvent],
            });
        }
    
        // console.log(eventsArr);
        // addEventWrapper.classList.remove("active");
        addEventTitle.value = "";
        addEventFrom.value = "";
        addEventTo.value = "";
        updateEvents(activeDay);
        //select active day and add event class if not added
        const activeDayEl = document.querySelector(".day.active");
        if (!activeDayEl.classList.contains("event")) {
            activeDayEl.classList.add("event");
        }
        });
    
        //function to delete event when clicked on event
        eventsContainer.addEventListener("click", (e) => {
        if (e.target.classList.contains("event")) {
            if (confirm("Are you sure you want to delete this event?")) {
            const eventTitle = e.target.children[0].children[1].innerHTML;
            eventsArr.forEach((event) => {
                if (
                event.day === activeDay &&
                event.month === month + 1 &&
                event.year === year
                ) {
                event.events.forEach((item, index) => {
                    if (item.title === eventTitle) {
                    event.events.splice(index, 1);
                    }
                });
                //if no events left in a day then remove that day from eventsArr
                if (event.events.length === 0) {
                    eventsArr.splice(eventsArr.indexOf(event), 1);
                    //remove event class from day
                    const activeDayEl = document.querySelector(".day.active");
                    if (activeDayEl.classList.contains("event")) {
                    activeDayEl.classList.remove("event");
                    }
                }
                }
            });
            updateEvents(activeDay);
            }
        }
        });
    
        function saveEvents() {
        localStorage.setItem("events", JSON.stringify(eventsArr));
        logLocalStorageData();
        console.log('Events saved to localStorage:', eventsArr);
    
        setTimeout(() => {
            logLocalStorageData();
        }, 10);
    }
    
        function logLocalStorageData() {
        const localStorageData = localStorage.getItem("events");
        Log('Data in localStorage:', localStorageData);
    }
    
        function getEvents() {
        if (localStorage.getItem("events") === null) {
            return;
        }
        eventsArr.push(...JSON.parse(localStorage.getItem("events")));
        }
    
        function getEventsFromDatabase() {
        fetch('/api/events-from-database')
            .then(response => response.json())
            .then(data => {
                // Assign data dari databaseEvents
                databaseEvents.length = 0;
                databaseEvents.push(...data);
                Log('sebelum convert :', databaseEvents);
    
                // Konversi dan masukkan ke dalam eventsArr
                convertDatabaseEventsToEventsArr();
    
                Log('Data from database:', databaseEvents);
            })
            .catch(error => {
                console.error('Error fetching data from database:', error);
            });
    }
    
    function convertDatabaseEventsToEventsArr() {
        // ...
        databaseEvents.forEach((date) => {
            const day = new Date(date).getDate();
            const month = new Date(date).getMonth() + 1;
            const year = new Date(date).getFullYear();
    
            // Pengecekan apakah tanggal sudah ada di eventsArr
            const existingEventIndex = eventsArr.findIndex((event) => event.day === day && event.month === month && event.year === year);
    
            if (existingEventIndex !== -1) {
                // Pemeriksaan apakah acara "Weekend" sudah ada pada tanggal tersebut
                const existingWeekendEvent = eventsArr[existingEventIndex].events.find((event) => event.title === "Weekend");
    
                if (!existingWeekendEvent) {
                    // Jika belum ada, tambahkan acara "Weekend"
                    eventsArr[existingEventIndex].events.push({
                        title: "Weekend",
                        time: "00:00 AM - 23:59 PM"
                    });
                }
            } else {
                // Jika tanggal belum ada di eventsArr, tambahkan objek baru dengan acara "Weekend"
                eventsArr.push({
                    day: day,
                    month: month,
                    year: year,
                    events: [
                        {
                            title: "Weekend",
                            time: "00:00 AM - 23:59 PM"
                        }
                    ]
                });
            }
        });
    
        // Pastikan struktur data sama dengan eventsArr
        saveEvents();
    }
    
    
        function convertTime(time) {
        //convert time to 24 hour format
        let timeArr = time.split(":");
        let timeHour = timeArr[0];
        let timeMin = timeArr[1];
        let timeFormat = timeHour >= 12 ? "PM" : "AM";
        timeHour = timeHour % 12 || 12;
        time = timeHour + ":" + timeMin + " " + timeFormat;
        return time;
        }
    
        var dropdownKelas = document.getElementById("dropdownkelas");
        var dropdownSiswaContainer = document.getElementById("dropdownsiswacontainer");
        var dropdownSiswa = document.getElementById("dropdownsiswa");
        var dropdownKelasGuru = document.getElementById("dropdownkelasGuru");
        var searchInputSiswa = document.getElementById("searchSiswa");
        var searchInputGuru = document.getElementById("searchGuru");
    
        // Function to filter "Data Siswa" table by class
        function filterTableSiswaByKelas(selectedKelas) {
            var tableRowsSiswa = document.querySelectorAll("#tableBodySiswa tr");
    
            tableRowsSiswa.forEach(function (row) {
                var kelasCell = row.querySelector("td:nth-child(4)"); // Adjust based on your table structure
    
                // Display all rows if "Semua Siswa" is selected or class matches the selected one
                if (selectedKelas === "semua" || kelasCell.textContent.trim() === selectedKelas) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    
        // Function to filter "Data Siswa" table by student
        function filterTableSiswaBySiswa(selectedSiswa) {
            var tableRowsSiswa = document.querySelectorAll("#tableBodySiswa tr");
    
            tableRowsSiswa.forEach(function (row) {
                var siswaCell = row.querySelector("td:nth-child(3)"); // Adjust based on your table structure
    
                // Display all rows if "Semua Siswa" is selected or student name matches the selected one
                if (selectedSiswa === "Semua Siswa" || siswaCell.textContent.trim() === selectedSiswa) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    
        // Function to filter "Data Guru" table by teacher
        function filterTableGuruByGuru(selectedGuru) {
            var tableRowsGuru = document.querySelectorAll("#tableBodyGuru tr");
    
            tableRowsGuru.forEach(function (row) {
                var namaCellGuru = row.querySelector("td:nth-child(3)"); // Adjust based on your table structure
    
                // Display all rows if "Semua Guru" is selected or teacher name matches the selected one
                if (selectedGuru === "Semua Guru" || namaCellGuru.textContent.trim() === selectedGuru) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    
        // Function to perform live search on "Data Guru" table
        function liveSearchGuru(searchTerm) {
            var tableRowsGuru = document.querySelectorAll("#tableBodyGuru tr");
    
            tableRowsGuru.forEach(function (row) {
                var namaCellGuru = row.querySelector("td:nth-child(3)"); // Adjust based on your table structure
                var namaGuru = namaCellGuru.textContent.trim().toLowerCase();
    
                // Display row if it contains the search term or if the search term is empty
                if (namaGuru.includes(searchTerm.toLowerCase()) || searchTerm === "") {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    
        function liveSearchSiswa(searchTerm) {
            var tableRowsSiswa = document.querySelectorAll("#tableBodySiswa tr");
    
            tableRowsSiswa.forEach(function (row) {
                var namaCellSiswa = row.querySelector("td:nth-child(3)"); // Adjust based on your table structure
                var namaSiswa = namaCellSiswa.textContent.trim().toLowerCase();
    
                // Display row if it contains the search term or if the search term is empty
                if (namaSiswa.includes(searchTerm.toLowerCase()) || searchTerm === "") {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    
        // Initialization for "Data Siswa" dropdowns
        fetch('/get_kelas')
            .then(response => response.json())
            .then(data => {
                data.forEach(kelas => {
                    var option = document.createElement("option");
                    option.text = kelas;
                    dropdownKelas.add(option);
                });
            });
    
        // Event listener for changes in the selected class in "Data Siswa" dropdown
        dropdownKelas.addEventListener("change", function () {
            var selectedKelas = this.value;
    
            // Reset search input for "Data Siswa" table
            searchInputSiswa.value = '';
    
            if (selectedKelas === "semua") {
                dropdownSiswaContainer.style.display = "none";
                // Perform something with the selected value (e.g., filter "Data Siswa" table by class)
                filterTableSiswaByKelas(selectedKelas);
            } else {
                dropdownSiswaContainer.style.display = "block";
                // Fetch student data based on the selected class (replace with the appropriate endpoint)
                fetch('/get_siswa?kelas=' + selectedKelas)
                    .then(response => response.json())
                    .then(data => {
                        data.sort((a, b) => a.nama.localeCompare(b.nama));
                        dropdownSiswa.innerHTML = "";
                        var defaultOption = document.createElement("option");
                        defaultOption.text = "Semua Siswa";
                        dropdownSiswa.add(defaultOption);
                        data.forEach(siswa => {
                            var option = document.createElement("option");
                            option.text = siswa.nama;
                            dropdownSiswa.add(option);
                        });
                    })
                    .then(() => {
                        // Perform something with the selected value (e.g., filter "Data Siswa" table by class)
                        filterTableSiswaByKelas(selectedKelas);
                    });
            }
        });
    
        // Event listener for changes in the selected student in "Data Siswa" dropdown
        dropdownSiswa.addEventListener("change", function () {
            var selectedSiswa = this.value;
    
            // Perform something with the selected value (e.g., filter "Data Siswa" table by student)
            filterTableSiswaBySiswa(selectedSiswa);
        });
    
        // Initialization for "Data Guru" dropdowns
        fetch('/get_guru')
            .then(response => response.json())
            .then(data => {
                data.sort((a, b) => a.nama.localeCompare(b.nama));
                dropdownKelasGuru.innerHTML = "";
                var defaultOption = document.createElement("option");
                defaultOption.text = "Semua Guru";
                dropdownKelasGuru.add(defaultOption);
                data.forEach(guru => {
                    var option = document.createElement("option");
                    option.text = guru.nama;
                    dropdownKelasGuru.add(option);
                });
            });
    
        // Event listener for changes in the selected teacher in "Data Guru" dropdown
        dropdownKelasGuru.addEventListener("change", function () {
            var selectedKelasGuru = this.value;
    
            // Reset search input for "Data Guru" table
            searchInputGuru.value = '';
    
            // Perform something with the selected value (e.g., filter "Data Guru" table by teacher)
            filterTableGuruByGuru(selectedKelasGuru);
        });
    
        // Event listener for live search in "Data Guru" table
        searchInputGuru.addEventListener('input', function () {
            var searchTermGuru = this.value.trim();
    
            // Perform live search in "Data Guru" table
            liveSearchGuru(searchTermGuru);
        });
    
        // Event listener for live search in "Data Siswa" table
        searchInputSiswa.addEventListener('input', function () {
            var searchTermSiswa = this.value.trim();
    
            // Perform live search in "Data Siswa" table
            liveSearchSiswa(searchTermSiswa);
        });
    
        function deleteAbsensi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data absensi ini?')) {
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            // Include the CSRF token in the headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
    
            // Send the delete request
            $.ajax({
                type: 'DELETE',
                url: '/api/delete-absensi/' + id,
                success: function () {
                    // Refresh the page after successful deletion
                    location.reload();
                },
                error: function (error) {
                    console.error('Error deleting absensi:', error);
                    alert('Terjadi kesalahan saat menghapus data absensi.');
                }
            });
        }
    }
    
    
    function showEditModal(absensiId) {
        console.log('Memulai fungsi showEditModal');
    
        // Fetch data absensi dari server
        fetch(`/api/absensi/${absensiId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data yang diterima dari server:', data);
    
                // Set nilai pada elemen HTML
                $('#absensiId').val(data.data.id);
                $('#statusEdit').val(data.data.status_absen);
    
                // Konversi format tanggal dan jam
                const createdDate = new Date(data.data.created_at);
                const formattedDate = createdDate.getDate() + ' ' +
                    new Intl.DateTimeFormat('id-ID', { month: 'long' }).format(createdDate) + ' ' +
                    createdDate.getFullYear();
    
                const formattedTime = createdDate.getHours().toString().padStart(2, '0') + ':' +
                    createdDate.getMinutes().toString().padStart(2, '0') + ':' +
                    createdDate.getSeconds().toString().padStart(2, '0');
    
                // Set nilai pada elemen HTML
                $('#tanggalEdit').val(formattedDate);
                $('#jamAbsenEdit').val(formattedTime);
    
                // Periksa apakah data milik siswa atau guru
                if (data.data.role === 'siswa') {
                    // Ambil data siswa dari tabel siswas berdasarkan id_user
                    fetch(`/api/siswa-by-user/${data.data.id_user}`)
                        .then(response => response.json())
                        .then(siswaData => {
                            // Tampilkan nama dan kelas siswa
                            $('#namaEdit').val(siswaData.data.nama);
                            $('#kelasEdit').val(siswaData.data.kelas ? siswaData.data.kelas.nama_kelas : '');
    
                            // Munculkan popup
                            $('#editModal').modal('show');
                        })
                        .catch(error => console.error('Error:', error));
                } else if (data.data.role === 'guru') {
                    // Ambil data guru dari tabel guru berdasarkan id_user
                    fetch(`/api/guru-by-user/${data.data.id_user}`)
                        .then(response => response.json())
                        .then(guruData => {
                            // Tampilkan nama guru dan kosongkan kelas
                            $('#namaEdit').val(guruData.data.nama || '');
                            $('#kelasEdit').val('');
    
                            // Munculkan popup
                            $('#editModal').modal('show');
                        })
                        .catch(error => console.error('Error:', error));
                }
            })
            .catch(error => console.error('Error:', error));
    }
    
    
    
        function submitEditForm() {
            const absensiId = $('#absensiId').val();
            const status = $('#statusEdit').val();
    
            // Mengambil token CSRF dari meta tag
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            // Mengirim data perubahan ke server menggunakan AJAX
            fetch(`/api/update-absensi/${absensiId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify({ status_absen: status }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jika berhasil, sembunyikan modal dan lakukan refresh tabel atau operasi lain yang diperlukan
                    $('#editModal').modal('hide');
                    // location.reload(); // Implementasikan fungsi refreshTable sesuai kebutuhan
                } else {
                    console.error('Error:', data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    
            Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: 'Data absensi telah berhasil diubah',
        }).then(() => {
            // Setelah menutup notifikasi, refresh halaman
            location.reload();
        });
        }
    
        function formatDate(dateTimeString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateTimeString).toLocaleDateString('id-ID', options);
    }
    
    // Fungsi untuk memformat waktu
        function formatTime(dateTimeString) {
            return new Date(dateTimeString).toLocaleTimeString('id-ID');
        }
    
    let selectedOption = null;

    function selectOption(option) {
    // Mendapatkan nilai status absen
    selectedOption = option;

    // Menyimpan nilai status absen ke dalam hidden input
    const statusInput = document.getElementById('statusInput');
    statusInput.value = selectedOption;

    toggleFileUploadContainer();
    }

    function toggleFileUploadContainer() {
    const fileUploadContainer = document.getElementById('fileUploadContainer');

    if (selectedOption === 'sakit' || selectedOption === 'izin') {
        fileUploadContainer.style.display = 'block';
    } else {
        fileUploadContainer.style.display = 'none';
    }
    }


  var roleRadioButtons = document.querySelectorAll('input[name="roleRadio"]');
var dropdownContainer = document.getElementById('dropdownContainer');
var dropdown1 = document.getElementById('dropdown1');
var dropdown2Container = document.getElementById('dropdown2Container');
var dropdown2 = document.getElementById('dropdown2');

// Function untuk mendapatkan dan menampilkan daftar kelas
function refreshKelasDropdown() {
    fetch('/get_kelas')
        .then(response => response.json())
        .then(data => {
            refreshDropdown(dropdown1, data);
        })
        .catch(error => {
            console.error('Gagal mengambil daftar kelas:', error);
        });
}

// Function untuk mendapatkan dan menampilkan daftar nama siswa berdasarkan kelas
function refreshSiswaDropdown(selectedKelas) {
    fetch('/get_siswaadmin?kelas=' + selectedKelas)
        .then(response => response.json())
        .then(data => {
            refreshDropdown(dropdown2, data);
            dropdown2Container.style.display = "block";
        })
        .catch(error => {
            console.error('Gagal mengambil daftar siswa:', error);
        });
}

// Function untuk mendapatkan dan menampilkan daftar guru
function refreshGuruDropdown() {
    fetch('/get_gurunames')
        .then(response => response.json())
        .then(data => {
            refreshDropdown(dropdown1, data);
            dropdown2Container.style.display = "none"; // Sembunyikan dropdown2 untuk role guru
        })
        .catch(error => {
            console.error('Gagal mengambil daftar guru:', error);
        });
}

// Function untuk mendapatkan dan menampilkan dropdown
// Function untuk mendapatkan dan menampilkan dropdown
function refreshDropdown(dropdown, data) {
    console.log('Mengambil dan menampilkan dropdown...');
    dropdown.innerHTML = '<option value="">Pilih</option>';
    
    // Periksa apakah data adalah array
    if (Array.isArray(data)) {
        // Jika iya, proses data sebagai array
        data.forEach(item => {
            var option = document.createElement("option");
            option.text = item;
            dropdown.add(option);
        });
    } else {
        // Jika tidak, proses data langsung
        var option = document.createElement("option");
        option.text = data;
        dropdown.add(option);
    }
    
    console.log('Dropdown berhasil diisi.');
}


// Function untuk menangani perubahan role
function selectRole(role) {
    const selectedRole = role;
    console.log('Selected Role:', selectedRole);
    console.log('Role dipilih:', role);
    if (role === 'siswa') {
        // Jika role "Siswa" dipilih, tampilkan dan isi dropdown kelas serta dropdown siswa
        console.log('Menampilkan dan mengisi dropdown kelas...');
        dropdownContainer.style.display = "block";
        dropdown2Container.style.display = "block"; // Tampilkan dropdown2
        refreshKelasDropdown();
    } else if (role === 'guru') {
        // Jika role "Guru" dipilih, tampilkan dan isi dropdown guru, dan sembunyikan dropdown siswa
        console.log('Menampilkan dan mengisi dropdown guru...');
        dropdownContainer.style.display = "block";
        dropdown2Container.style.display = "none"; // Sembunyikan dropdown2 untuk role guru
        refreshGuruDropdown();
    } else if (role === 'on') {
        return; // Keluar dari fungsi untuk menghindari pengulangan data
    } else {
        // Untuk role selain "siswa", "guru", dan "on", sembunyikan dropdown dan dropdown2
        console.log('Sembunyikan dropdown dan dropdown2.');
        dropdownContainer.style.display = "none";
        dropdown2Container.style.display = "none";
    }
}

// Event listener untuk perubahan role pada radio button
roleRadioButtons.forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Hanya panggil selectRole jika radio button yang dicek adalah yang dipilih (checked)
        if (this.checked) {
            // Reset nilai dropdown saat role berubah
            dropdown1.value = '';
            dropdown2.value = '';
            // Panggil fungsi selectRole dengan role yang dipilih
            selectRole(this.value);
        }
    });
});

// Event listener untuk perubahan kelas pada dropdown1
// Event listener untuk perubahan pada dropdown1 (kelas)
dropdown1.addEventListener('change', function () {
    var selectedKelas = this.value;

    // Panggil fungsi refreshSiswaDropdown jika role yang dipilih adalah "siswa"
    if (roleRadioButtons[0].checked) { // Periksa apakah role yang dipilih adalah "siswa"
        refreshSiswaDropdown(selectedKelas);
    }
});

// Inisialisasi dropdown saat halaman dimuat
console.log('Inisialisasi dropdown...');
refreshDropdown(dropdown1, []); // Inisialisasi dropdown1
refreshDropdown(dropdown2, []); // Inisialisasi dropdown2

function submitData() {
    // Validasi
    const selectedOption = document.querySelector('input[name="flexRadioDefault"]:checked').value;
    const selectedRole = document.querySelector('input[name="roleRadio"]:checked').value;
    const selectedNama = selectedRole === 'siswa' ? document.getElementById('dropdown2').value : document.getElementById('dropdown1').value;
    const selectedStatus = document.getElementById('statusInput').value;

    if (!selectedOption || !selectedRole || !selectedNama) {
        alert('Isi semua informasi yang diperlukan.');
        return;
    }

    const fileInput = document.getElementById('fileInput');
    const formData = new FormData();

    if ((selectedOption === 'sakit' || selectedOption === 'izin') && !fileInput.files.length) {
        // Jika sakit atau izin dipilih dan file belum diunggah
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Anda memilih opsi Sakit/Izin. Mohon unggah file terlebih dahulu.',
        });
        return;
    }

    formData.append('status_absen', selectedStatus);
    formData.append('role', selectedRole);
    formData.append('nama_siswa', selectedNama);
    formData.append('file', fileInput.files[0]);

    const submitButton = document.getElementById('submitButton');
    submitButton.innerHTML = 'Submitting...';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch('{{ route('absensi.storeAdmin') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        submitButton.innerHTML = 'Submit';

        alert(data.message);
        location.reload();
    })
    .catch(error => {
        submitButton.innerHTML = 'Submit';

        // Menampilkan pesan error yang lebih informatif
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: 'Terjadi kesalahan karena data tidak lengkap. Silakan coba lagi.',
        });

        console.error('Error:', error);
    });
}




    </script>
@endsection