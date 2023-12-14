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

    <div id="notification" class="notification-container"></div>

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
                <table id="absensiTable" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Absen</th>
                            <th scope="col">Status</th>
                            {{-- <th scope="col">Action</th> --}}
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
                                    {{-- <td>
                                        <a href="#" class="btn btn-warning" onclick="showEditModal({{ $absensi->id }})">Edit</a>
                                    </td> --}}
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
            {{-- Section Setting Absensi --}}
            <div class="border border-2 rounded p-4 my-4 d-flex flex-column text-md" style="height: auto; max-height: 300px; position: relative;" id="presensiOptions">
                <h5 class="font-weight-bold mb-3">Presensi Absensi Siswa</h5>
                <form id="absensiForm" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center">
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
                    
                    <div class="file-upload-container" id="fileUploadContainer">
                        <div class="mb-3">
                            <label for="fileInput" class="form-label">Unggah File (PDF):</label>
                            <input type="file" class="form-control" id="fileInput" name="file" accept=".pdf">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="submit-button" onclick="submitData()" id="submitButton">Submit</button>
                        <div id="submitIndicator"></div>
                    </div>
                </form>
            </div>
            
    </div>
    </div>
    </div>
    {{-- Isi content end --}}
    </div>
    {{-- Template putih end --}}
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
                        </select>
                    </div>
                    <input type="hidden" id="absensiId" name="absensiId">
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Simpan Perubahan</button>
                </form>
            </div>
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

    .notification-container {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}

.notification {
    background-color: #4CAF50;
    color: white;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.notification button {
    background-color: #555;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<script>

    document.addEventListener("DOMContentLoaded", function() {
        const absensiTable = document.getElementById('absensiTable');
    const absensiRows = absensiTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    let masukCount = 0;
    let sakitCount = 0;
    let izinCount = 0;
    let tidakMasukCount = 0;

    for (let i = 0; i < absensiRows.length; i++) {
        const statusAbsen = absensiRows[i].querySelector('td:nth-child(4)').textContent; // Ubah indeks sesuai dengan posisi kolom status_absen

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
                series: [masukCount, sakitCount, izinCount, tidakMasukCount],
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

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    window.addEventListener('load', function () {
    checkAndDisablePresensiOptions();
    checkPresensiStatus();

    fetch('{{ route('absensi.checkAndFillAbsentData') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken,
        },
    })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);

            // Setelah fungsi selesai, cek apakah ada data tambahan yang dimasukkan
            if (data.success && data.dataInserted) {
                // Jika ada, refresh tampilan tabel absensi
                refreshTable();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function refreshTable() {
    location.reload();
}


    let selectedOption = null;

    function selectOption(option) {
        selectedOption = option;
        updateButtonState();
        toggleFileUploadContainer();
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

    const submitButton = document.getElementById('submitButton');
    submitButton.innerHTML = 'Submitting...';

    const absensiForm = document.getElementById('absensiForm');
    const formData = new FormData(absensiForm);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const userId = @json(Auth::id());

    formData.append('status_absen', selectedOption);
    formData.append('role', 'siswa');
    formData.append('id_user', userId);

    fetch('{{ route('absensi.store') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        submitButton.innerHTML = 'Submit';

        const notificationContainer = document.getElementById('notification');
        const notification = document.createElement('div');
        notification.classList.add('notification', 'success');
        notification.innerHTML = `
            <p>${data.message}</p>
            <button onclick="closeNotification()">Tutup</button>
        `;
        notificationContainer.appendChild(notification);

        refreshTable();
        checkPresensiStatus(); // Perbarui status presensi setelah submit
        disablePresensiOptions(); // Nonaktifkan opsi jika diperlukan
    })
    .catch(error => {
        submitButton.innerHTML = 'Submit';

        // Handle error response from server
        error.json().then(data => {
            if (data && data.errors) {
                // Server validation error
                alert('Terjadi kesalahan validasi pada server: ' + data.errors.join(', '));
            } else {
                // General server error
                alert('Terjadi kesalahan saat mengirim data absensi.');
                console.error('Error:', error);
            }
        });
    });
}


    function closeNotification() {
        const notificationContainer = document.getElementById('notification');
        notificationContainer.innerHTML = ''; // Hapus notifikasi

        // Reload the entire page
        location.reload();
    }

    function checkPresensiStatus() {
        const userId = @json(Auth::id());

        // Mengecek apakah tanggal saat ini ada dalam localStorage
        if (isDateRestricted()) {
            // Menonaktifkan button option dan submit jika tanggal saat ini terbatas
            disablePresensiOptions();
        } else {
            // Kirim permintaan AJAX untuk mendapatkan data absensi terbaru
            fetch('{{ route('absensi.showAbsensiSiswa') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Periksa apakah sudah ada data presensi hari ini
                    const today = new Date();
                    const formattedDate = today.toISOString().split('T')[0];

                    const hasPresensiToday = data.some(absensi => {
                        const absensiDate = absensi.created_at.split(' ')[0];
                        return absensi.id_user === userId && absensiDate === formattedDate;
                    });

                    if (hasPresensiToday) {
                        // Jika sudah melakukan presensi, ubah tampilan dan hilangkan button option dan submit
                        disablePresensiOptions();
                    }
                })
                .catch(error => {disable
                    console.error('Error checking presensi status:', error);
                });
        }
    }

    function disablePresensiOptions() {
    const buttonsContainer = document.getElementById('presensiOptions');

    // Mengecek apakah tanggal saat ini ada dalam localStorage
    if (isDateRestricted()) {
        buttonsContainer.innerHTML = '<p>Tidak perlu melakukan absensi pada hari ini</p>';
    } else {
        buttonsContainer.innerHTML = '<p>Anda telah melakukan presensi hari ini</p>';
    }
}

function checkAndDisablePresensiOptions() {
    const buttonsContainer = document.getElementById('presensiOptions');
    const currentDate = new Date();
    const currentHour = currentDate.getHours();

    const opsiButton = document.getElementById('opsiButton'); // Ganti 'opsiButton' dengan ID yang sesuai
    const submitButton = document.getElementById('submitButton'); // Ganti 'submitButton' dengan ID yang sesuai

    if (currentHour < 7 || currentHour >= 16) {
        console.log('Kondisi: Anda tidak dapat melakukan presensi');
        buttonsContainer.innerHTML = '<p>Anda tidak dapat melakukan presensi</p>';
    }
}



    function isDateRestricted() {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        const localStorageData = localStorage.getItem("events");

        if (localStorageData) {
            const events = JSON.parse(localStorageData);

            // Mengecek apakah tanggal saat ini ada dalam localStorage
            const isRestrictedDate = events.some(event => event.day === today.getDate() &&
                event.month === today.getMonth() + 1 && event.year === today.getFullYear());

            return isRestrictedDate;
        }

        return false;
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
    console.log('Submitting form for absensiId:', absensiId);

    // Rest of the code...

    fetch(`/api/update-absensi-siswa/${absensiId}`, {
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
        console.log('Response from server:', data);

        // Rest of the code...
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

  function toggleFileUploadContainer() {
    const fileUploadContainer = document.getElementById('fileUploadContainer');

    if (selectedOption === 'sakit' || selectedOption === 'izin') {
      fileUploadContainer.style.display = 'block';
    } else {
      fileUploadContainer.style.display = 'none';
    }
  }
</script>


@endsection