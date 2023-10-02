<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\Data_angkatan;
use App\Models\Detail_nilai;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RaportController extends Controller
{
    public function input($id, $smt)
    {
        $siswa       = Siswa::where('id', $id)->first();
        $raport      = Nilai::where('siswa_id', $id)->where('semester', $smt)->whereNotNull('mapel_id')->get();
        $raport_ket  = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('sakit');
        $raport_ket2 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('ijin');
        $raport_ket3 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('tanpa_ket');
        $semester    = $smt;
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $idraport = Nilai::where('siswa_id', $id)->where('mapel_id', null)->where('semester', $smt)->first();
        $kelas = Kelas::All();
        return view('dataraport.input', [
            'siswa'         => $siswa,
            'raport'        => $raport,
            'mapel'         => $mapel,
            'raport_ket'    => $raport_ket,
            'raport_ket2'   => $raport_ket2,
            'raport_ket3'   => $raport_ket3,
            'idraport'      => $idraport,
            'semester'      => $semester,
            'kelas'         => $kelas
        ]);
    }

    public function tambahnilai(Request $request)
    {
        $nilai_pth = $request->nilai_pth;
        $nilai_ktr = $request->nilai_ktr;

        if ($nilai_pth >= 85 && $nilai_pth <= 100) {
            $nilai_huruf_pth = 'A';
        } elseif ($nilai_pth >= 70 && $nilai_pth < 85) {
            $nilai_huruf_pth = 'B';
        } elseif ($nilai_pth >= 55 && $nilai_pth < 70) {
            $nilai_huruf_pth = 'C';
        } elseif ($nilai_pth >= 40 && $nilai_pth < 55) {
            $nilai_huruf_pth = 'D';
        } else {
            $nilai_huruf_pth = 'E';
        }

        if ($nilai_ktr >= 85 && $nilai_ktr <= 100) {
            $nilai_huruf_ktr = 'A';
        } elseif ($nilai_ktr >= 70 && $nilai_ktr < 85) {
            $nilai_huruf_ktr = 'B';
        } elseif ($nilai_ktr >= 55 && $nilai_ktr < 70) {
            $nilai_huruf_ktr = 'C';
        } elseif ($nilai_ktr >= 40 && $nilai_ktr < 55) {
            $nilai_huruf_ktr = 'D';
        } else {
            $nilai_huruf_ktr = 'E';
        }


        Nilai::create([
            'sakit'             => 0,
            'ijin'              => 0,
            'tanpa_ket'         => 0,
            'nilai_pth'         => $request->nilai_pth,
            'nilai_ktr'         => $request->nilai_ktr,
            'nilai_huruf_pth'   => $nilai_huruf_pth,
            'nilai_huruf_ktr'   => $nilai_huruf_ktr,
            'siswa_id'          => $request->siswa_id,
            'mapel_id'          => $request->mapel_id,
            'guru_id'           => $request->guru_id,
            'semester'          => $request->semester

        ]);

        return Redirect::back();
    }
    public function destroy($id)
    {
        $raport = Nilai::find($id);
        $raport->delete();
        return Redirect::back();
    }
    public function store(Request $request)
    {
        // dd($request->idraport);
        if ($request->idraport == null) {
            Nilai::create($request->all());
        } else {
            $data = Nilai::where(
                [
                    "id" => $request->idraport
                ]
            )->first();
            $data->update($request->all());
        }
        $datasiswa = Siswa::where(
            [
                "id" => $request->siswa_id
            ]
        )->first();
        // $datasiswa->kelas_id = $request->kelassiswa;
        // // $datasiswa->kelas_id = $request->kelas;
        // $datasiswa->save();

        $semester = $request->semester;
        $siswaid = $request->siswa_id;
        return redirect('/data-cetak-raport/' . $semester . '/' . $siswaid);
    }
    public function cetak($smt, $id)
    {
        $data = Auth::guard('guru')->user()->id;

        $kelas = Kelas::where('guru_id', $data)->first();
        $kelasid = $kelas->id;
        $siswa = Siswa::where('kelas_id', $kelasid)->first();
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $raport = Nilai::where('siswa_id', $id)->where('semester', $smt)->whereNotNull('mapel_id')->get();
        $raport_ket = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('sakit');
        $raport_ket2 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('ijin');
        $raport_ket3 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('tanpa_ket');

        $status = Nilai::where('siswa_id', $id)->where('mapel_id', null)->where('semester', $smt)->first();

        $kepsek = User::where('jabatan', 'Kepala Sekolah')->first();
        $walikelas_nama = Auth::guard('guru')->user()->nama;
        $walikelas_nip = Auth::guard('guru')->user()->NIP;

        $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dataraport.cetak', [
            'kelas'             => $kelas,
            'siswa'             => $siswa,
            'mapel'             => $mapel,
            'raport'            => $raport,
            'raport_ket'        => $raport_ket,
            'raport_ket2'       => $raport_ket2,
            'raport_ket3'       => $raport_ket3,
            'kepsek'            => $kepsek,
            'tanggal'           => $tanggalSekarang,
            'walikelasnama'     => $walikelas_nama,
            'walikelasnip'      => $walikelas_nip,
            'semester'          => $smt,
            'status'            => $status
        ]);
        return $pdf->stream('Laporan hasil belajar - ' . $siswa->nisn . ' (' . $siswa->fullname . ') .pdf');
    }

    public function index()
    {
        $angkatan = Data_angkatan::All();

        return view('pages.akademik.data-raport.raport-admin', [
            'angkatans'      => $angkatan,
        ])->with('title', 'Raport');
    }
    public function show(Request $request, $jenis_nilai, Siswa $siswa)
    {
        $datas = null;
        if ($request->has('select_raport')) {
            $raport = Detail_nilai::all()->where('id_nilai', '=', $request->select_raport);
            $raport_list = Nilai::with('akademik')->where('id_siswa', '=', $siswa->id)->where('jenis_nilai', $jenis_nilai)->get();
            $datas = [
                'id_siswa' => $siswa->id,
                'raports' => $raport,
                'raport_lists' => $raport_list,
                'raport_selected' => $request->select_raport,
                'mapels' => Mapel::all(),
            ];
        } else {
            $id_raport = Nilai::all()->where('id_siswa', '=', $siswa->id)->sortDesc()->first()->id;
            $raport = Detail_nilai::all()->where('id_nilai', '=', $id_raport);
            $raport_list = Nilai::with('akademik')->where('id_siswa', '=', $siswa->id)->where('jenis_nilai', $jenis_nilai)->get();
            $datas = [
                'id_siswa' => $siswa->id,
                'raports' => $raport,
                'raport_lists' => $raport_list,
                'raport_selected' => $id_raport,
                'mapels' => Mapel::all(),
            ];
        }
        // return Detail_nilai::all();
        return view('pages.akademik.data-raport.show_raport', $datas)->with('title', 'Raport');
    }
    public function showRaportAngkatan(Data_angkatan $angkatan)
    {
        $siswa =  Siswa::all()->where("id_angkatan", $angkatan->id);
        return view('pages.akademik.data-raport.siswa', [
            'siswas'      => $siswa,
        ])->with('title', 'Raport ' . $angkatan->nama_angkatan);
    }
    public function cetakraport($id, $smt)
    {
        $siswa = Siswa::where('id', $id)->first();
        $dataraport = Nilai::where(
            [
                "siswa_id"  => $id,
                "semester"  => $smt
            ]
        )->first();

        if ($dataraport) {
            $raport = Nilai::where('siswa_id', $id)->where('semester', $smt)->whereNotNull('mapel_id')->get();
            $raport_ket = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('sakit');
            $raport_ket2 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('ijin');
            $raport_ket3 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('tanpa_ket');

            $status = Nilai::where('siswa_id', $id)->where('mapel_id', null)->where('semester', $smt)->first();

            $kepsek = User::where('jabatan', 'Kepala Sekolah')->first();
            $datawalikelas = Nilai::where('siswa_id', $id)->where('semester', $smt)->first();
            $walikelas = Guru::where('id', $datawalikelas->guru_id)->first();

            $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.dataraportadmin.cetak', [
                'siswa'             => $siswa,
                'raport'            => $raport,
                'raport_ket'        => $raport_ket,
                'raport_ket2'       => $raport_ket2,
                'raport_ket3'       => $raport_ket3,
                'kepsek'            => $kepsek,
                'tanggal'           => $tanggalSekarang,
                'semester'          => $smt,
                'status'            => $status,
                'walikelas'         => $walikelas,
            ]);
            return $pdf->stream('Laporan hasil belajar - ' . $siswa->nisn . ' (' . $siswa->fullname . ') .pdf');
        } else {
            return Redirect::back()->with('toast_error', 'Data raport belum ada');
        }
    }

    public function cetakraportsiswa($id, $smt)
    {
        $siswa = Siswa::where('id', $id)->first();
        $dataraport = Nilai::where(
            [
                "siswa_id"  => $id,
                "semester"  => $smt
            ]
        )->first();

        if ($dataraport) {
            $raport = Nilai::where('siswa_id', $id)->where('semester', $smt)->whereNotNull('mapel_id')->get();
            $raport_ket = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('sakit');
            $raport_ket2 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('ijin');
            $raport_ket3 = Nilai::where('siswa_id', $id)->where('semester', $smt)->sum('tanpa_ket');

            $status = Nilai::where('siswa_id', $id)->where('mapel_id', null)->where('semester', $smt)->first();

            $kepsek = User::where('jabatan', 'Kepala Sekolah')->first();
            $datawalikelas = Nilai::where('siswa_id', $id)->where('semester', $smt)->first();
            $walikelas = Guru::where('id', $datawalikelas->guru_id)->first();

            $tanggalSekarang = Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y');
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.dataraportadmin.cetak', [
                'siswa'             => $siswa,
                'raport'            => $raport,
                'raport_ket'        => $raport_ket,
                'raport_ket2'       => $raport_ket2,
                'raport_ket3'       => $raport_ket3,
                'kepsek'            => $kepsek,
                'tanggal'           => $tanggalSekarang,
                'semester'          => $smt,
                'status'            => $status,
                'walikelas'         => $walikelas,
            ]);
            return $pdf->stream('Laporan hasil belajar - ' . $siswa->nisn . ' (' . $siswa->fullname . ') .pdf');
        } else {
            return Redirect::back()->with('toast_error', 'Data raport belum ada');
        }
    }

    public function update_nilai_raport(Request $request, $id)
    {
        $detail_nilai = Detail_nilai::find($request->id_detail_nilai);
        $detail_nilai->update([
            'nilai_akademik' => $request->nilai_akademik,
        ]);
        return Redirect::back()->with('title', 'Raport');
    }
}
