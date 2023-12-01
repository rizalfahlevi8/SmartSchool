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
        @php
          use Illuminate\Support\Facades\Auth;
        @endphp
        <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: 300px; max-height: 300px; position: relative;">
          <h5 class="position-relative" style="font-weight: bold; position: sticky; top: 0; background-color: white; z-index: 100;">
              Data Presensi Siswa
          </h5>
          <div class="table-responsive small col-lg-12" style="flex: 1; overflow: auto;">
              <table class="table table-striped table-sm">
                  <thead>
                      <tr>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Hari</th>
                          <th scope="col">Jam Absen</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($absensis as $absensi)
                          @if ($absensi->id_user === Auth::id())
                              <tr>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('d-m-Y') }}</td>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->locale('id')->isoFormat('dddd') }}</td>
                                  <td>{{ \Carbon\Carbon::parse($absensi->created_at)->format('H:i:s') }}</td>
                                  <td>{{ $absensi->status_absen }}</td>
                                  <td>
                                      <a href="#" class="badge bg-warning">2</a>
                                  </td>
                              </tr>
                          @endif
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
        
            {{-- Section Setting Absensi --}}
            <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: auto; max-height: 300px; position: relative;">
              <h5 class="font-weight-bold mb-3">Presensi Absensi Siswa</h5>
              <div class="d-flex justify-content-center">
                <button class="absensi-button" onclick="selectOption('masuk')">Masuk</button>
                <button class="absensi-button" onclick="selectOption('sakit')">Sakit</button>
                <button class="absensi-button" onclick="selectOption('izin')">Izin</button>
            </div>
            <div class="d-flex justify-content-end mt-3">
              <button class="submit-button" onclick="submitData()" id="submitButton">Submit</button>
              <div id="submitIndicator"></div>
          </div>
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
</style>


<script>
  let selectedOption = null;

  function selectOption(option) {
      selectedOption = option;
      updateButtonState();
  }

  function updateButtonState() {
      const buttons = document.querySelectorAll('.absensi-button');
      buttons.forEach(button => {
          const option = button.textContent.toLowerCase();
          button.classList.toggle('active', selectedOption === option);
      });
  }

  function submitData() {
    if (!selectedOption) {
        alert('Pilih opsi absensi terlebih dahulu.');
        return;
    }

    // Tampilkan indikator submit (misalnya, spinner)
    const submitButton = document.getElementById('submitButton');
    submitButton.innerHTML = 'Submitting...';

    // Dapatkan CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const userId = @json(Auth::id());

    // Kirim data absensi menggunakan AJAX
    fetch('{{ route('absensi.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken, // Sertakan CSRF token dalam header
        },
        body: JSON.stringify({
            'status_absen': selectedOption,
            'role': 'siswa', // Ganti dengan nilai yang sesuai
            'id_user': userId, // Ganti dengan nilai yang sesuai dari Auth::id()
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Sembunyikan indikator submit
        submitButton.innerHTML = 'Submit';
        
        // Tampilkan pesan sukses atau error
        alert(data.message);
    })
    .catch(error => {
        // Sembunyikan indikator submit
        submitButton.innerHTML = 'Submit';

        // Tampilkan pesan error
        alert('Terjadi kesalahan saat mengirim data absensi.');
        console.error('Error:', error);
    });
}
</script>

@endsection