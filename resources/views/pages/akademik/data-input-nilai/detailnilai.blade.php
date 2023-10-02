@extends('components.main')
@section('title-content')
    Dashboard
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Detail Nilai </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card z-index-2 ">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <div class="chart">
                            {{-- <canvas id="chart-bars" class="chart-canvas" height="170"></canvas> --}}
                            <h6 class="text-white text-capitalize ps-3">Detail Nilai Siswa - Semester {{ $semester }}
                                {{-- {{ $kelas->guru_id ? 'ada' : 'tidak' }} --}}
                            </h6>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">NISN</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $siswa->nisn }}
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
                                            {{ $siswa->fullname }}
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
                                            {{ $siswa->kelas->namakelas }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Mata Pelajaran</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $mapel->namamapel }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai Tugas 1
                                            </span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->tugas1 : '0' }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai Tugas 2</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->tugas2 : '0' }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai Tugas 3</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->tugas3 : '0' }}

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai Tugas 4</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->tugas4 : '0' }}

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai Tugas 5</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->tugas5 : '0' }}

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai UTS</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->uts : '0' }}

                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <span class="float-start fw-bold">Nilai UAS</span>
                                            <div class="float-end">:</div>
                                        </div>
                                        <div class="col-md-7">
                                            {{ $nilai ? $nilai->uas : '0' }}

                                        </div>
                                    </div>
                                </li>


                            </ul>
                        </div>
                    </div>
                    <div class="col text-right mt-3">
                        <a href="/data-nilai-atur/{{ $jadwal->id }}/{{ $semester }}" type="button"
                            class="btn btn-danger text-sm rounded-3" style="float: right;margin-right:10px"><i
                                class="fa fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
