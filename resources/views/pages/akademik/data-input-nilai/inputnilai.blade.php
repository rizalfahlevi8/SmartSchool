@extends('components.main')
@section('title-content')
    Data Jadwal
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Nilai</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Input Nilai </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="/data-inputnilai/{{ Auth::guard('guru')->user()->id }}" type="submit" id="btntambah"
                class="btn btn-secondary font-weight-bold text-xs rounded-pill">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
        </div>
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">

                        <h6 class="text-white text-capitalize ps-3">Nilai {{ $jadwal->mapel->namamapel }} (Kelas :
                            {{ $jadwal->kelas->namakelas }}) - Semester {{ $semester }}


                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive pb-2 px-3">

                        <table id="example" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        NISN</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Nama Siswa</th>

                                    <th
                                        class="
                                            text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $n)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ $n->nisn }}
                                        </td>
                                        <td class="text-center">
                                            {{ $n->fullname }}
                                        </td>

                                        <td class="text-center">
                                            <a href="/data-detail-nilai/{{ $jadwal->id }}/{{ $n->id }}/{{ $jadwal->mapel_id }}/{{ $semester }}"
                                                class="btn
                                                btn-info font-weight-bold btn--edit text-sm rounded text-capitalize">
                                                <i class="fa fa-eye"></i> Detail Nilai
                                            </a>
                                            <a href="/data-input-nilai/{{ $jadwal->id }}/{{ $n->id }}/{{ $jadwal->mapel_id }}/{{ $semester }}"
                                                class="btn
                                                btn-warning font-weight-bold btn--edit text-sm rounded text-capitalize">
                                                <i class="fa fa-edit"></i> Input Nilai
                                            </a>

                                            </button>
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
