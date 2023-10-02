@extends('components.main')
@section('title-content')
    Data Jadwal
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"></li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Atur Nilai </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-secondary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Input Nilai Siswa - Semester {{ $semester }}
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form
                        action="/data-input-nilai-siswa/{{ $jadwal->id }}/{{ $siswa->id }}/{{ $mapel->id }}/{{ $semester }}"
                        class="row g-3 py-1 px-4" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="siswa_id" class="form-control rounded-3" value="{{ $siswa->id }}">
                        <input type="hidden" name="kelas_id" class="form-control rounded-3" value="{{ $siswa->kelas_id }}">
                        <input type="hidden" name="mapel_id" class="form-control rounded-3" value="{{ $mapel->id }}">
                        <input type="hidden" name="guru_id" class="form-control rounded-3"
                            value=" {{ Auth::guard('guru')->user()->id }}">
                        <input type="hidden" name="semester" class="form-control rounded-3" value="{{ $semester }}">
                        <div class="col-md-3">
                            <label for="inputEmail4" class="form-label">NISN</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan NISN</label>
                                <input type="text" onkeypress="return hanyaAngka(event)" class="form-control rounded-3"
                                    value="{{ $siswa->nisn }}" readonly
                                    {{ $errors->has('nisn') ? 'autofocus="true"' : '' }}>
                            </div>
                            @if ($errors->has('nisn'))
                                <span class="text-danger">{{ $errors->first('nisn') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nama lengkap</label>
                                <input type="text" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $siswa->fullname }}" readonly
                                    {{ $errors->has('fullname') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Kelas</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan kelas</label>
                                <input type="text" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $siswa->kelas->namakelas }}" readonly
                                    {{ $errors->has('kelas') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan mata pelajaran</label>
                                <input type="text" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $mapel->namamapel }}" readonly
                                    {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Tugas 1</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai tugas 1</label>
                                <input type="text" name="tugas1" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->tugas1 : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Tugas 2</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai tugas 2</label>
                                <input type="text" name="tugas2" class="form-control rounded-3" id="inputEmail4"
                                    value=" {{ $nilai ? $nilai->tugas2 : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Tugas 3</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai tugas 3</label>
                                <input type="text" name="tugas3" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->tugas3 : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Tugas 4</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai tugas 4</label>
                                <input type="text" name="tugas4" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->tugas4 : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Tugas 5</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai tugas 5</label>
                                <input type="text" name="tugas5" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->tugas5 : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai UTS</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan nilai uts</label>
                                <input type="text" name="uts" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->uts : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai UAS</label>
                            <div class="input-group">
                                <label class="form-label">Masukkan uas</label>
                                <input type="text" name="uas" class="form-control rounded-3" id="inputEmail4"
                                    value="{{ $nilai ? $nilai->uas : '0' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"></label>
                            <div class="input-group">
                                <label class="form-label"></label>
                                <input type="hidden" class="form-control rounded-3" id="inputEmail4" value=""
                                    {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                            </div>
                        </div>

                        <br>
                        <div class="col text-right">
                            <button type="submit" onclick="return confirm('Apakah anda yakin data sudah benar?')"
                                class="btn btn-primary ml-5 text-sm rounded-3" style="float:right; ">
                                <i class="fa fa-save"></i>
                                Simpan
                            </button>
                            <a href="/data-nilai-atur/{{ $jadwal->id }}/{{ $semester }}" type="button"
                                class="btn btn-danger text-sm rounded-3" style="float: right;margin-right:10px"><i
                                    class="fa fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
