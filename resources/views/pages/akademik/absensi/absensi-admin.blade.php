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
    <div class="row mt-4 mx-0 d-flex align-items-center justify-content-center">
      <div class="col-lg-5">
        <div class="bg-success d-flex align-items-center justify-content-center text-3xl" style="height: 300px; max-height: 300px">
          Pie Section
        </div>
      </div>

      <div class="col-lg-5">
        <div class="bg-danger d-flex align-items-center justify-content-center text-3xl" style="height: 300px; max-height: 300px">
          Calender Full Section
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
                <div class="col-5">
                    <input type="text" class="form-control rounded" placeholder="Search..." name="search" id="searchSiswa" style="border: 2px solid lightblue;">
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
                <table class="table table-striped table-sm">
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
                @foreach ($absensis as $absensi)
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
                                    <a href="#" class="badge bg-warning">2</a>
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
            <div class="col-5">
                <input type="text" class="form-control rounded" placeholder="Search..." name="search" id="searchGuru" style="border: 2px solid lightblue;">
            </div>
            <div class="col-2 mx-3 ml-5">
                <select class="form-select rounded" name="dropdownkelas" id="dropdownkelasGuru" style="border: 2px solid lightblue;">
                </select>
            </div>
        </div>
        <div class="table-responsive small col-lg-12" style="flex: 1; overflow: auto;">
            <table class="table table-striped table-sm">
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
                    @foreach ($absensis as $absensi)
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
                                        <a href="#" class="badge bg-warning">2</a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-lg-8 mt-4 d-flex align-items-center justify-content-center">
            <div id="fullCalendar"></div>
        </div>
    </div>

    </div>
    </div>
    {{-- Isi content end --}}
    </div>
    {{-- Template putih end --}}
  </div>
</div>

<style>
    #fullCalendar .fc-dayGridMonth-button {
      background-color: black; /* Ganti warna latar belakang sesuai keinginan Anda */
      color: white; /* Ganti warna teks sesuai keinginan Anda */
      border: none;
      text-decoration: none; /* Menghilangkan underline */
      cursor: pointer;
    }
  
    #fullCalendar .fc-day-today {
      background-color: green; /* Ganti warna latar belakang sesuai keinginan Anda */
      color: white; /* Ganti warna teks sesuai keinginan Anda */
      border: none;
      text-decoration: none; /* Menghilangkan underline */
      cursor: pointer;
    }
  
    #fullCalendar .fc-day {
      text-decoration: none; /* Menghilangkan underline */
      cursor: pointer;
    }
  </style>
  

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('fullCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        });
        calendar.render();
        });
</script>

<script>
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
</script>



@endsection