<!DOCTYPE html>
<html>

<head>
    <title>Jadwal Mengajar {{ $guru->nama ?? '' }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5 class="text-uppercase">Jadwal Guru Kegiatan Belajar Mengajar</h5>
        <h6 class="text-uppercase">Tahun Pelajaran
            {{ date('Y') }} / {{ date('Y') + 1 }}


    </center>
    <br>

    <pre><h6>Nama        : {{ $guru->NIP ?? '' }}
NIP : {{ $guru->nama ?? '' }}</h6></pre>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="text-center" style="border-color:rgb(27, 26, 26); background-color:rgb(88, 243, 134)">HARI</th>
                <th class="text-center" style="border-color:rgb(27, 26, 26);background-color:rgb(88, 243, 134)">JAM KE-
                </th>
                <th class="text-center" style="border-color:rgb(27, 26, 26);background-color:rgb(88, 243, 134)">WAKTU
                </th>
                <th class="text-center" style="border-color:rgb(27, 26, 26);background-color:rgb(88, 243, 134)">KELAS
                </th>
                <th class="text-center" style="border-color:rgb(27, 26, 26);background-color:rgb(88, 243, 134)">
                    KETERANGAN</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $j)
                <tr>
                    <td class="text-center text-uppercase" rowspan="{{ count($j->detail) }}"
                        style="border-color:rgb(27, 26, 26);">
                        <b>
                            {{ $hari[$j->hari] }}
                        </b>
                    </td>
                    @if (count($j->detail) > 0)
                        <td class="text-center"
                            style="border-color:rgb(27, 26, 26); {{ $j->detail[0]->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">
                            1
                        </td>
                        <td class="text-center"
                            style="border-color:rgb(27, 26, 26); {{ $j->detail[0]->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">

                            {{ Carbon\Carbon::parse($j->detail[0]->jamawal)->format('G:i') }} -
                            {{ Carbon\Carbon::parse($j->detail[0]->jamaakhir)->format('G:i') }}
                        </td>

                        <td class="text-center"
                            style="border-color:rgb(27, 26, 26); {{ $j->detail[0]->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">

                            {{ $j->detail[0]->kelas->namakelas ?? '-' }}

                        </td>
                        <td class="text-center text-uppercase"
                            style="border-color:rgb(27, 26, 26); {{ $j->detail[0]->keterangan ? 'background-color:rgb(255, 231, 20)' : '' }}">

                            <b><i>{{ $j->detail[0]->keterangan ?? '' }}</i></b>

                        </td>
                    @endif
                </tr>
                @foreach ($j->detail as $index => $value)
                    @if ($index > 0)
                        <tr>
                            <td class="text-center"
                                style="border-color:rgb(27, 26, 26); {{ $value->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">
                                {{ $loop->iteration }}
                            </td>
                            <td class="text-center"
                                style="border-color:rgb(27, 26, 26); {{ $value->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">
                                {{ Carbon\Carbon::parse($value->jamawal)->format('G:i') }} -
                                {{ Carbon\Carbon::parse($value->jamaakhir)->format('G:i') }}
                            </td>
                            <td class="text-center"
                                style="border-color:rgb(27, 26, 26); {{ $value->kelas->namakelas ?? 'background-color:rgb(255, 231, 20)' }}">

                                {{ $value->kelas->namakelas ?? '-' }}

                            </td>
                            <td class="text-center text-uppercase"
                                style="border-color:rgb(27, 26, 26);  {{ $value->keterangan ? 'background-color:rgb(255, 231, 20)' : '' }}">

                                <b><i>{{ $value->keterangan ?? '' }}</i></b>

                            </td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>

</body>

</html>
