<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Belajar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body>
    <center>
        <h5 class="text-uppercase">Laporan Hasil Belajar</h5>
        {{-- <h6 class="text-uppercase">Tahun Pelajaran
            {{ date('Y') }} / {{ date('Y') + 1 }}
        </h6> --}}

    </center>
    <br>

    <table style="width:100%">
        <tr>
            <td style="width:75%">
                <h6 style="font-size:15px;">Nama : {{ $siswa->fullname }}
                    <br>NISN &nbsp;: {{ $siswa->nisn }}
                </h6>
            </td>
            <td style="width:25%">
                <h6 style="font-size:15px;"> Kelas &nbsp; &nbsp; &nbsp; :
                    {{ $siswa->kelas->namakelas }} <br>Semester : {{ $semester == 1 ? '1/Ganjil' : '2/Genap' }}</h6>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" style="font-size: 13px">
        <thead class="table-primary">
            <tr>
                <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">No.</th>
                <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Mata Pelajaran</th>
                <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Nilai Pengetahuan</th>
                <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Predikat</th>
                {{-- <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Nilai Keterampilan</th>
                <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Predikat</th> --}}
                {{-- <th scope="col" class="text-center" style="border-color:rgb(27, 26, 26);">Rata-rata</th> --}}
            </tr>
        </thead>
        <tbody>

            @foreach ($raport as $r)
                @if ($r->mapel_id)
                    <tr>
                        <th class="text-center" style="font-weight:normal;border-color:rgb(27, 26, 26);">
                            {{ $loop->iteration }}</th>
                        <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ $r->mapel_id ? $r->mapel->nama_mapel : '' }}</th>
                        <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ $r-> }}</th>
                        <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ $r->nilai_huruf }}
                        </th>
                        {{-- <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ $r->nilai_ktr }}</th>
                        <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ $r->nilai_huruf_ktr }}
                        </th> --}}
                        {{-- <th class="text-center" style="font-weight:normal; border-color:rgb(27, 26, 26);">
                            {{ round(($r->nilai_pth + $r->nilai_ktr) / 2) }}
                        </th> --}}
                    </tr>
                @else
                @endif
            @endforeach

        </tbody>
    </table>



    <table style="width:100%">
        <tr>
            <td style="width:34%">
                <p class="text-uppercase" style="font-size:13px; font-weight:bolder">Ketidakhadiran</p>
                <table class="table"
                    style="font-size: 13px; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; margin-top:-10px">
                    <tbody>
                        <tr>
                            <th
                                style="font-weight:normal;border-color:rgb(27, 26, 26); padding:3px; padding-left:15px ">
                                Sakit</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px; ">
                                :</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px">
                                {{ $raport_ket }}</th>
                        </tr>
                        <tr>
                            <th
                                style="width:100px;font-weight:normal;border-color:rgb(27, 26, 26); padding:3px; padding-left:15px">
                                Ijin</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px">
                                :</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px">
                                {{ $raport_ket2 }}</th>
                        </tr>
                        <tr>
                            <th
                                style="width:150px; font-weight:normal;border-color:rgb(27, 26, 26); padding:3px; padding-left:15px">
                                Tanpa Keterangan</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px">
                                :</th>
                            <th class="text-center"
                                style="font-weight:normal; border-color:rgb(27, 26, 26); padding:3px">
                                {{ $raport_ket3 }}</th>
                        </tr>


                    </tbody>
                </table>
            </td>
            <td style="width:1%">

            </td>
            <td style="width:65%">
                <p class="text-uppercase" style="font-size:13px; font-weight:bolder">catatan wali kelas</p>
                <table class="table"
                    style="font-size: 13px; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; margin-top:-10px">
                    <tbody>
                        <tr style="">
                            <th style=" font-weight:normal; border-color:rgb(0, 0, 0); padding:27px">
                            </th>
                            <th class="text-center" style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                            </th>
                            <th class="text-center" style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                            </th>
                        </tr>
                        <tr>
                            <th style="font-weight:normal; border-color:white">
                            </th>
                            <th class="text-center" style="font-weight:normal; border-color:white">
                            </th>
                            <th class="text-center" style="font-weight:normal; border-color:white">
                            </th>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    @if ($semester == 2)
        <table style="width:100%">
            <tr>
                <td style="width:45%">
                    <p class="text-uppercase" style="font-size:13px; font-weight:bolder">Tanggapan Orang tua/wali</p>
                    <table class="table"
                        style="font-size: 13px; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; margin-top:-10px">
                        <tbody>
                            <tr style="">
                                <th style=" font-weight:normal; border-color:rgb(0, 0, 0); padding:27px">
                                </th>
                                <th class="text-center"
                                    style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                                </th>
                                <th class="text-center"
                                    style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight:normal; border-color:white">
                                </th>
                                <th class="text-center" style="font-weight:normal; border-color:white">
                                </th>
                                <th class="text-center" style="font-weight:normal; border-color:white">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width:1%">

                </td>
                <td style="width:45%">
                    <p class="text-uppercase" style="font-size:13px; font-weight:bolder"></p>
                    <table class="table"
                        style="font-size: 13px; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; margin-top:-10px">
                        <tbody>
                            <tr style="">
                                <th style=" font-weight:normal; border-color:rgb(0, 0, 0); padding-left:15px">
                                    Keputusan :
                                    <br>
                                    Berdasarkan pencapaian seluruh kompetensi, peserta didik dinyatakan :
                                    <br>
                                    @if ($status->status == 'naik')
                                        Naik / <span style="text-decoration: line-through;">Tidak Naik</span>
                                    @else
                                        <span style="text-decoration: line-through;">Naik</span> / Tidak Naik
                                    @endif
                                </th>
                                <th class="text-center" style="font-weight:normal;border-color:rgb(0, 0, 0);">
                                </th>
                                <th class="text-center" style="font-weight:normal;border-color:rgb(0, 0, 0);">

                                </th>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    @else
        <table style="width:100%">
            <tr>
                <td style="width:100%">
                    <p class="text-uppercase" style="font-size:13px; font-weight:bolder">Tanggapan Orang tua/wali</p>
                    <table class="table"
                        style="font-size: 13px; border-left: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black; margin-top:-10px">
                        <tbody>
                            <tr style="">
                                <th style=" font-weight:normal; border-color:rgb(0, 0, 0); padding:27px">
                                </th>
                                <th class="text-center"
                                    style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                                </th>
                                <th class="text-center"
                                    style="font-weight:normal;border-color:rgb(0, 0, 0);padding:20px ">
                                </th>
                            </tr>
                            <tr>
                                <th style="font-weight:normal; border-color:white">
                                </th>
                                <th class="text-center" style="font-weight:normal; border-color:white">
                                </th>
                                <th class="text-center" style="font-weight:normal; border-color:white">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>
        </table>

        <br><br>
        <table style="width:100%; font-size:15px">
            <tr>
                <td style="width:270px">
                    <p>Mengetahui</p>
                    <p style="margin-top:-20px">Orang Tua/Wali,</p>
                    <p style="margin-top: 60px">............................</p>
                </td>
                <td style="width:250px">
                    <p>Mengetahui</p>
                    <p style="margin-top:-20px">Kepala Sekolah</p>
                    <p style="margin-top: 60px; font-weight:bolder; text-decoration: underline"
                        class="text-capitalize">
                        {{ $kepsek->nama }}</p>
                    <p style="margin-top: -20px">NIP. {{ $kepsek->NIP }}</p>
                </td>
                <td style="width:33%">
                    <p>Jember, {{ $tanggal }}
                    </p>
                    <p style="margin-top:-20px">Wali Kelas, </p>
                    <p style="margin-top: 60px;font-weight:bolder; text-decoration: underline"
                        class="text-capitalize">
                        {{ $walikelasnama }}</p>
                    <p style="margin-top: -20px">NIP. {{ $walikelasnip }}</p>
                </td>
            </tr>
        </table>

    @endif

</body>
