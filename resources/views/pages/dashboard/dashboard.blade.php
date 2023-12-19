@extends('components.main')
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
@endsection
@section('additional-js-top')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Calendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
@section('content')
    <!-- End Navbar -->
    @include('components.dashboard.statistic')

    @if (auth()->user()->hasRole('guru'))
        @if ($myData == null)
            <div class="row">
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card z-index-2 ">
                        <h4 style="text-align: center; width: 100%; padding: 40px 10px">Anda Tidak
                            memiliki informasi pribadi
                        </h4>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    {{-- <canvas id="chart-bars" class="chart-canvas" height="170"></canvas> --}}
                                    <h6 class="text-white text-capitalize ps-3">Data Guru
                                        {{-- {{ $kelas->guru_id ? 'ada' : 'tidak' }} --}}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="foto">
                                        <img src="{{ asset('storage/guru/img/' . $myData?->foto) ?? asset('storage/guru/img/default_img.png') }}"
                                            alt="" width="100%" height="auto">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">NIP</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->nip ?? '' }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Nama</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->nama ?? '' }}
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
                                                <div class="col-md-7">
                                                    {{ $myData->jenis_kelamin ?? '' }}
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
                                                <div class="col-md-7">
                                                    {{ $myData->tempat_lahir ?? '' }}
                                                    @if ($myData->tanggal_lahir)
                                                        {{ \Carbon\Carbon::parse($myData->tanggal_lahir)->format('d-m-Y') ?? '' }}
                                                    @endif
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
                                                <div class="col-md-7">
                                                    {{ $myData->no_telp ?? '' }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Agama</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->agama ?? '' }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Alamat</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->alamat ?? '' }}
                                                </div>
                                            </div>
                                        </li>
                                        @if ($myData)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <span class="float-start fw-bold">Wali Kelas</span>
                                                        <div class="float-end">:</div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        {{ $myData->kelas->nama_kelas ?? '' }}
                                                    </div>
                                                </div>
                                            </li>
                                        @else
                                        @endif
                                    </ul>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Pengumuman</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($pengumumans->isEmpty())
                                            <p class="text-muted">Tidak ada pengumuman saat ini.</p>
                                        @else
                                            <ul class="list-group">
                                                @foreach ($pengumumans as $pengumuman)
                                                    <li class="list-group-item">
                                                        <h5>{{ $pengumuman->title }}</h5>
                                                        <p>{{ $pengumuman->message }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="card-header">
                                        <h4 class="card-title">Pengumuman Tamu</h4>
                                    </div>
                                    <div class="card-body">

                                        @if ($tamu_pesans->where('status', '!=', 'pesan_telah_selesai')->isEmpty())

                                            <p class="text-muted">Tidak ada tamu saat ini.</p>
                                        @else
                                            <ul class="list-group">
                                                @foreach ($tamu_pesans as $tamu_pesan)
                                                    @if ($tamu_pesan->status !== 'pesan_telah_selesai')
                                                            <div class="row">
                                                                <div class="col-md-8">  <!-- Kolom untuk data -->
                                                                    <li class="list-group-item">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Nama Tamu </span>
                                                                                    <div class="float-end">:</div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->nama }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Alamat </span>
                                                                                    <div class="float-end">:</div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->alamat }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Keperluan </span>
                                                                                    <div class="float-end">: </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->Keterangan }}
                                                                                </div>
                                                                            </div>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-4"> <!-- Kolom untuk tombol -->
                                                                    <div class="col">
                                                                        <div class="col-md-6">
                                                                            <form action="{{ route('dashboard.terimaPesan', ['id' => $tamu_pesan->id]) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success">Pesan Diterima</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <form action="{{ route('dashboard.hapusPesan', ['id' => $tamu_pesan->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Hapus Pesan</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>                
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Kalender Akademik</h4>
                                    </div>
                                    <div class="card-body px-0 pb-2">
                                        <div class="table-responsive pb-2 px-3">
                                            <div id="calendar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @elseif(auth()->user()->hasRole('siswa'))
        @if ($myData == null)
            <div class="row">
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card z-index-2 ">
                        <h4 style="text-align: center; width: 100%; padding: 40px 10px">Anda Tidak
                            memiliki informasi pribadi
                        </h4>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 col-md-6 mb-4">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <div class="chart">
                                    <h6 class="text-white text-capitalize ps-3">Data Siswa</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="foto">
                                        <img src="{{ $myData->foto ? asset('storage/murid/img/' . $myData->foto) : asset('storage/murid/img/default_img.png') }}"
                                            alt="" width="100%" height="auto">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">NISN</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->nisn }}
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Nama</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->nama }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Kelas</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->kelas->nama_kelas }}

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
                                                <div class="col-md-7 text-capitalize">
                                                    {{ $myData->jenis_kelamin }}
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
                                                <div class="col-md-7">
                                                    {{ $myData->no_telp }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Agama</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->agama }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <span class="float-start fw-bold">Alamat</span>
                                                    <div class="float-end">:</div>
                                                </div>
                                                <div class="col-md-7">
                                                    {{ $myData->alamat }}

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Pengumuman</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($pengumumans->isEmpty())
                                            <p class="text-muted">Tidak ada pengumuman saat ini.</p>
                                        @else
                                            <ul class="list-group">
                                                @foreach ($pengumumans as $pengumuman)
                                                    <li class="list-group-item">
                                                        <h5>{{ $pengumuman->title }}</h5>
                                                        <p>{{ $pengumuman->message }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="card-header">
                                        <h4 class="card-title">Pengumuman Tamu</h4>
                                    </div>
                                    <div class="card-body">
                                        @if ($tamu_pesans->where('status', '!=', 'pesan_telah_selesai')->isEmpty())
                                            <p class="text-muted">Tidak ada tamu saat ini.</p>
                                        @else
                                            <ul class="list-group">
                                                @foreach ($tamu_pesans as $tamu_pesan)
                                                    @if ($tamu_pesan->status !== 'pesan_telah_selesai')
                                                            <div class="row">
                                                                <div class="col-md-8">  <!-- Kolom untuk data -->
                                                                    <li class="list-group-item">
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Nama Tamu </span>
                                                                                    <div class="float-end">:</div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->nama }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Alamat </span>
                                                                                    <div class="float-end">:</div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->alamat }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-2">
                                                                                    <span class="float-start">Keperluan </span>
                                                                                    <div class="float-end">: </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    {{ $tamu_pesan->Keterangan }}
                                                                                </div>
                                                                            </div>
                                                                    </li>
                                                                </div>
                                                                <div class="col-md-4"> <!-- Kolom untuk tombol -->
                                                                    <div class="col">
                                                                        <div class="col-md-6">
                                                                            <form action="{{ route('dashboard.terimaPesan', ['id' => $tamu_pesan->id]) }}" method="POST">
                                                                                @csrf
                                                                                <button type="submit" class="btn btn-success">Pesan Diterima</button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <form action="{{ route('dashboard.hapusPesan', ['id' => $tamu_pesan->id]) }}" method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-danger">Hapus Pesan</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4 class="card-title">Kalender Akademik</h4>
                                    </div>
                                    <div class="card-body px-0 pb-2">
                                        <div class="table-responsive pb-2 px-3">
                                            <div id="calendar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    @endif

    @if (auth()->user()->hasRole('guru') || auth()->user()->hasRole('siswa') )
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');
                    localStorage.setItem('kalender-start-date', moment(start).format('YYYY-MM-DD'));
                    localStorage.setItem('kalender-end-date', moment(end).format('YYYY-MM-DD'))
                },
                editable: true,
            });

        });
    </script>
    @endif

    {{-- Tamu status --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function hapusPesan(id) {
            // Lakukan permintaan Ajax untuk menghapus pesan
            $.ajax({
                url: '/dashboard/' + id,
                type: 'DELETE',
                success: function(response) {
                    // Sembunyikan elemen dengan ID yang sesuai
                    $('#pesan-' + id).hide();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>  --}}

@endsection
