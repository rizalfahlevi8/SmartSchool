@extends('components.main')

@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Jadwal Mengajar</h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Jadwal Hari Ini :
                            {{ auth()->user()->guru->nama }} ({{ auth()->user()->guru->nip }})
                            {{-- {{ $guru->nama ?? '' }} ({{ $guru->NIP ?? '' }}) --}}
                            {{-- {{ $j->mapel->namamapel ?? '' }} --}}
                        </h6>
                    </div>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">
                        </div>
                        <!-- Button trigger modal -->
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Hari</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Mapel</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Jam
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Ruang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_jadwal as $jadwal)
                                    <tr>
                                        <td class="text-center">
                                            {{ $jadwal->jadwal->hari }}
                                        </td>

                                        <td class="text-center">
                                            {{ $jadwal->mapel->nama_mapel }}
                                        </td>

                                        <td class="text-center">
                                            {{ Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                            {{ Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $jadwal->ruang->nama_ruang }}
                                        </td>

                                        <td class="text-center">
                                            {{ $jadwal->keterangan ?? 'Tidak ada' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Jadwal Mengajar:
                            {{ auth()->user()->guru->nama }} ({{ auth()->user()->guru->nip }})
                            {{-- {{ $guru->nama ?? '' }} ({{ $guru->NIP ?? '' }}) --}}
                            {{-- {{ $j->mapel->namamapel ?? '' }} --}}
                        </h6>
                    </div>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">
                        <div class="col text-right">
                        </div>
                        <!-- Button trigger modal -->
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Hari</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Mapel</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Jam
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Ruang
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_jadwals as $jadwal)
                                    <tr>

                                        <td class="text-center"
                                            style= "background-color: {{ $jadwal->jadwal->hari == $hari_ini ? 'green' : '' }};color: {{ $jadwal->jadwal->hari == $hari_ini ? 'white' : '' }}">
                                            {{ $jadwal->jadwal->hari }}
                                        </td>

                                        <td class="text-center"
                                            style= "background-color: {{ $jadwal->jadwal->hari == $hari_ini ? 'green' : '' }};color: {{ $jadwal->jadwal->hari == $hari_ini ? 'white' : '' }}">
                                            {{ $jadwal->mapel->nama_mapel }}
                                        </td>

                                        <td class="text-center"
                                            style= "background-color: {{ $jadwal->jadwal->hari == $hari_ini ? 'green' : '' }};color: {{ $jadwal->jadwal->hari == $hari_ini ? 'white' : '' }}">
                                            {{ Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                            {{ Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td class="text-center"
                                            style= "background-color: {{ $jadwal->jadwal->hari == $hari_ini ? 'green' : '' }};color: {{ $jadwal->jadwal->hari == $hari_ini ? 'white' : '' }}">
                                            {{ $jadwal->ruang->nama_ruang }}
                                        </td>

                                        <td class="text-center"
                                            style= "background-color: {{ $jadwal->jadwal->hari == $hari_ini ? 'green' : '' }};color: {{ $jadwal->jadwal->hari == $hari_ini ? 'white' : '' }}">
                                            {{ $jadwal->keterangan ?? 'Tidak ada' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
