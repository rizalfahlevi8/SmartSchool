@extends('components.main')
@section('title-content')
    Data Raport
@endsection
@section('breadcrumbs')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/data-raport">Data Raport</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Nilai</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Input nilai </h6>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <a href="/data-raport" type="submit" id="btntambah"
                class="btn btn-secondary font-weight-bold text-xs rounded-pill">
                <i class="material-icons opacity-10">arrow_back</i>
                Kembali
            </a>
        </div>
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-violet shadow-secondary border-radius-lg pt-4 pb-3"
                        style="background-color: rgb(255, 255, 255);">
                        <h6 class="text-black text-capitalize ps-3">

                            NISN &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: {{ $siswa->nisn }}
                            <br>
                            Nama &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : {{ $siswa->fullname }}
                            <br>
                            Kelas &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: {{ $siswa->kelas->namakelas }}
                            <br>
                            Semester &nbsp : {{ $semester == '1' ? '1/Ganjil' : '2/Genap' }}
                        </h6>
                        {{-- <form action="/tambahnilai" class="row g-3 py-1 px-4" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="guru_id" value=" {{ Auth::guard('guru')->user()->id }}">
                            <input type="hidden" name="siswa_id" value=" {{ $siswa->id }}">
                            <input type="hidden" name="kelas_id" value=" {{ $siswa->kelas->id }}">
                            <input type="hidden" name="semester" value=" {{ $semester }}">
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Mata Pelajaran</label>
                                <div class="input-group">
                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                        aria-label="Default select example" name="mapel_id" required>
                                        <option value="" selected disabled>-- Pilih Mapel --</option>
                                        @foreach ($mapel as $item)
                                            <option value="{{ $item->id }}">{{ $item->namamapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nilai Pengetahuan</label>
                                <div class="input-group">
                                    <label class="form-label">Masukkan nilai</label>
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        maxlength="2" name="nilai_pth" class="form-control rounded-3" id="inputEmail4"
                                        required>


                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nilai Keterampilan</label>
                                <div class="input-group">
                                    <label class="form-label">Masukkan nilai</label>
                                    <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        maxlength="2" name="nilai_ktr" class="form-control rounded-3" id="inputEmail4"
                                        required value="{{ old('nama') }}"
                                        {{ $errors->has('tempatlahir') ? 'autofocus="true"' : '' }}>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-white">aaa</label>
                                <div class="input-group">
                                    <button type="submit" id="btntambah" class="btn btn-success font-weight-bold text-xs">
                                        <i class="material-icons opacity-10">add</i>
                                        Tambah Nilai
                                    </button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
                <div class="card-body px-0 pb-2">

                    <div class="table-responsive pb-2 px-3">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-center" scope="col">No.</th>
                                    <th class="text-center" scope="col">Mata Pelajaran</th>
                                    <th class="text-center" scope="col">Nilai Angka</th>
                                    <th class="text-center" scope="col">Nilai Huruf</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($raport as $r)
                                    @if ($r->mapel_id)
                                        <tr>
                                            <th class="text-center" style="font-weight:normal"> {{ $loop->iteration }}</th>
                                            <th class="text-center" style="font-weight:normal">
                                                {{ $r->mapel_id ? $r->mapel->namamapel : '' }}</th>
                                            <th class="text-center" style="font-weight:normal">{{ $r->rata_nilai }}</th>
                                            <th class="text-center" style="font-weight:normal">{{ $r->nilai_huruf }}
                                            </th>

                                            </th>

                                        </tr>
                                    @else
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                        <br>
                        <br>
                        <hr>
                        <form action="/data-raport-insert" class="row g-3 px-4" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="guru_id" value=" {{ Auth::guard('guru')->user()->id }}">
                            <input type="hidden" name="siswa_id" value=" {{ $siswa->id }}">
                            <input type="hidden" name="idraport" class="form-control rounded-3"
                                value="{{ $idraport ? $idraport->id : '' }}">
                            <input type="hidden" name="kelas_id" value=" {{ $siswa->kelas->id }}">
                            <input type="hidden" name="semester" value=" {{ $semester }}">
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="form-group row pt-3">
                                        <label for="team"
                                            class="col-2 text-end control-label col-form-label">Sakit</label>
                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <input type="text" class="form-control" id="team"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                maxlength="3" name="sakit" value="{{ $raport_ket }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="form-group row pt-2">
                                        <label for="team"
                                            class="col-2 text-end control-label col-form-label">Izin</label>
                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <input type="text" class="form-control"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                maxlength="3" name="ijin" value="{{ $raport_ket2 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-8 col-sm-12">
                                    <div class="form-group row pt-2">
                                        <label for="team" class="col-2 text-end control-label col-form-label">Tanpa
                                            Ket</label>
                                        <div class="col-lg-2 col-md-4 col-sm-4">
                                            <input type="number" name="tanpa_ket" class="form-control" id="team"
                                                value="{{ $raport_ket3 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($semester == 2)
                                <div class="row">
                                    <div class="col-lg-12 col-md-8 col-sm-12">
                                        <div class="form-group row pt-2">
                                            <label for="team"
                                                class="col-2 text-end control-label col-form-label">Status
                                                Kenaikan</label>
                                            <div class="col-lg-2 col-md-4 col-sm-4">
                                                <div class="input-group">
                                                    <select class="form-select rounded-3 form-control-lg text-sm"
                                                        aria-label="Default select example" name="status" required>
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="naik">Naik</option>
                                                        <option value="tidaknaik">Tidak Naik</option>
                                                        {{-- @foreach ($guru as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                    @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif
                            <div class="row">
                                <div class="col-md-12 text-right pt-2">
                                    <button type="submit" id="btntambah"
                                        class="btn btn-primary font-weight-bold text-xs" style="float: right">
                                        <i
                                            class="material-icons
                                        opacity-10">print</i>
                                        Simpan dan Cetak
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- footer --}}
