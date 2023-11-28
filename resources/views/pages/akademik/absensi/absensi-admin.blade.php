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

        <div class="border border-2 rounded p-4 my-4 d-flex justify-content-center text-md" style="height: 300px; max-height: 300px">
          <div class="table-responsive small col-lg-12">
              <h5 class="position-relative" style="font-weight: bold;">
                  Data Siswa
              </h5>
              <div class="input-group mb-3">
                  <div class="col-5">
                      <input type="text" class="form-control rounded" placeholder="Search..." name="search" style="border: 2px solid lightblue;">
                  </div>

                  <div class="col-2 mx-3 ml-5">
                      <select class="form-select rounded" name="dropdownkelas" style="border: 2px solid lightblue;">
                          <option value="option1">Option 1</option>
                          <option value="option2">Option 2</option>
                          <option value="option3">Option 3</option>
                      </select>
                  </div>
                  <div class="col-2 mx-3">
                      <select class="form-select rounded" name="dropdownnama" style="border: 2px solid lightblue;">
                          <option value="optionA">Option 1</option>
                          <option value="optionB">Option 2</option>
                          <option value="optionC">Option 3</option>
                      </select>
                  </div>
              </div>
              
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
                  <tbody>
                      @foreach ($absensis as $absensi)
                          @if ($absensi->kelas == 'siswa')
                              <tr>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</td>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->locale('id')->isoFormat('dddd') }}</td>
                                  <td>
                                      {{ optional($absensi->guru)->nama ?? optional($absensi->siswa)->nama }}
                                  </td>
                                  <td>
                                      {{ optional($absensi->siswa->kelas)->nama_kelas }}
                                  </td>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('H:i:s') }}</td>
                                  <td>{{ $absensi->status_absen }}</td>
                                  <td>
                                      <a href="#" class="badge bg-info">1</a>
                                      <a href="#" class="badge bg-warning">2</a>
                                      <a href="#" class="badge bg-danger">3</a>
                                  </td>
                              </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
        
    <!-- Table for Data Guru -->
<div class="border border-2 rounded p-4 my-4 d-flex justify-content-center text-md" style="height: 300px; max-height: 300px">
  <div class="table-responsive small col-lg-12">
      <h5 class="position-relative" style="font-weight: bold;">
          Data Guru
      </h5>
      <div class="input-group mb-3">
          <div class="col-5">
              <input type="text" class="form-control rounded" placeholder="Search..." name="search" style="border: 2px solid lightblue;">
          </div>

          <div class="col-2 mx-3 ml-5">
              <select class="form-select rounded" name="dropdownkelas" style="border: 2px solid lightblue;">
                  <option value="option1">Option 1</option>
                  <option value="option2">Option 2</option>
                  <option value="option3">Option 3</option>
              </select>
          </div>
      </div>
      
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
          <tbody>
              @foreach ($absensis as $absensi)
                  @if ($absensi->kelas == 'guru')
                      <tr>
                          <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($absensi->created_at)->locale('id')->isoFormat('dddd') }}</td>
                          <td>
                            {{ optional($absensi->guru)->nama ?? optional($absensi->siswa)->nama }}
                          </td>
                          <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('H:i:s') }}</td>
                          <td>{{ $absensi->status_absen }}</td>
                          <td>
                              <a href="#" class="badge bg-info">1</a>
                              <a href="#" class="badge bg-warning">2</a>
                              <a href="#" class="badge bg-danger">3</a>
                          </td>
                      </tr>
                  @endif
              @endforeach
          </tbody>
      </table>
  </div>
</div>



        <div class="d-flex align-items-center justify-content-center">
          <div class="col-lg-8 bg-danger mt-4 d-flex align-items-center justify-content-center text-3xl" style="height: 300px;">
            Setting Absensi section
          </div>
        </div>
      </div>
    </div>
    {{-- Isi content end --}}
    </div>
    {{-- Template putih end --}}
  </div>
</div>
@endsection