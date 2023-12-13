@extends('components.main')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Jadwal Pelajaran</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Jadwal :
                            {{ $kelas->nama_kelas }}
                            {{-- {{ $guru->nama ?? '' }} ({{ $guru->NIP ?? '' }}) --}}
                            {{-- {{ $j->mapel->namamapel ?? '' }} --}}
                        </h6>
                    </div>
                </div>


                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">
                        </div>
                        <div class="container mt-5">
                            <div class="row">
                                @foreach ($jadwals as $jadwal)
                                    @php
                                        $status = $jadwal->status;
                                    @endphp

                                    <div class="col-md-4" style="margin-bottom: 20px">

                                        <div class="card">
                                            <div class="card-header {{ $jadwal->hari == $hari_ini ? 'bg-success' : 'bg-primary' }}"
                                                style="display: flex; justify-content: space-between; align-items: center">
                                                <b style="color: rgb(255, 255, 255)">{{ ucfirst($jadwal->hari) }}
                                                    {{ $jadwal->hari == $hari_ini ? ' - Hari ini' : '' }}</b>
                                            </div>

                                            <div class="card-body">
                                                @if (strtolower($status) == 'libur')
                                                    <h5 class="card-title">Libur</h5>
                                                    <p class="card-text">Libur</p>
                                                @else
                                                    @foreach ($jadwal->detail_jadwal as $detail_jadwal)
                                                        <div
                                                            style="border-bottom: 1.5px dashed grey; padding-bottom: 10px; margin-top: 10px">
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
                                                    @endforeach
                                                @endif
                                                <div class="" style="margin-top: 10px">
                                                    <p><b>Catatan : </b>{{ $jadwal->catatan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Button trigger modal -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
