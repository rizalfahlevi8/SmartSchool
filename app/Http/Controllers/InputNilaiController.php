<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InputNilaiController extends Controller
{
    public function index($id)
    {
        $jadwal =  Jadwal::where("guru_id", $id)->groupBy("mapel_id", "kelas_id")->get();
        return view('datainputnilai.nilai', [
            'jadwal'      => $jadwal,

        ]);
    }
    public function atur($id, $smt)
    {
        $jadwal  = Jadwal::find($id);
        $kelas = $jadwal->kelas_id;
        $siswa = Siswa::where("kelas_id", $kelas)->get();
        $nilai = Nilai::where("kelas_id", $kelas)->get();
        $semester = $smt;

        // dd($kelas);
        // $siswa = Siswa::where()
        //Jadwal::distinct("mapel_id")->where("guru_id",$id)->get();
        return view('datainputnilai.inputnilai', [
            'jadwal'      => $jadwal,
            'nilai'       => $nilai,
            'siswa'       => $siswa,
            'semester'    => $semester

        ]);
    }
    public function input($idjadwal, $idsiswa, $idmapel, $smt)
    {
        $jadwal = Jadwal::find($idjadwal);
        $mapel = Mapel::find($idmapel);
        $siswa = Siswa::find($idsiswa);
        $semester = $smt;
        $nilai = Nilai::where(
            [
                "siswa_id"  => $idsiswa,
                "mapel_id"  => $idmapel,
                "semester"  => $smt
            ]
        )->first();
        return view('datainputnilai.inputnilaisiswa', [
            'mapel'      => $mapel,
            'siswa'      => $siswa,
            'jadwal'     => $jadwal,
            'nilai'      => $nilai,
            'semester'   => $semester
        ]);
    }
    public function detail($idjadwal, $idsiswa, $idmapel, $smt)
    {
        $jadwal = Jadwal::find($idjadwal);
        $mapel = Mapel::find($idmapel);
        $siswa = Siswa::find($idsiswa);
        $semester = $smt;
        $nilai = Nilai::where(
            [
                "siswa_id"   => $idsiswa,
                "mapel_id"   => $idmapel,
                "semester"   => $semester
            ]
        )->first();
        return view('datainputnilai.detailnilai', [
            'mapel'      => $mapel,
            'siswa'      => $siswa,
            'jadwal'     => $jadwal,
            'nilai'      => $nilai,
            'semester'   => $semester
        ]);
    }
    public function store(Request $request, $id_jadwal, $idsiswa, $idmapel, $smt)
    {

        $nilai = $request->all();
        $tugas1 = $request->input('tugas1');
        $tugas2 = $request->input('tugas2');
        $tugas3 = $request->input('tugas3');
        $tugas4 = $request->input('tugas4');
        $tugas5 = $request->input('tugas5');
        $uts = $request->input('uts');
        $uas = $request->input('uas');

        $ratatugas = ($tugas1 + $tugas2 + $tugas3 + $tugas4 + $tugas5) / 5;
        $persentugas = ($ratatugas * 40) / 100;
        $persenuts = ($uts * 30) / 100;
        $persenuas = ($uas * 30) / 100;
        $nilai_rata = $persentugas + $persenuts + $persenuas;

        if ($nilai_rata >= 85 && $nilai_rata <= 100) {
            $nilai_huruf_pth = 'A';
        } elseif ($nilai_rata >= 70 && $nilai_rata < 85) {
            $nilai_huruf_pth = 'B';
        } elseif ($nilai_rata >= 55 && $nilai_rata < 70) {
            $nilai_huruf_pth = 'C';
        } elseif ($nilai_rata >= 40 && $nilai_rata < 55) {
            $nilai_huruf_pth = 'D';
        } else {
            $nilai_huruf_pth = 'E';
        }

        $data = Nilai::where(
            [
                "siswa_id"  => $idsiswa,
                "mapel_id"  => $idmapel,
                "semester"  => $smt
            ]
        )->first();
        if ($data) {
            $tgs1 = $request->input('tugas1');
            $tgs2 = $request->input('tugas2');
            $tgs3 = $request->input('tugas3');
            $tgs4 = $request->input('tugas4');
            $tgs5 = $request->input('tugas5');
            $utss = $request->input('uts');
            $uass = $request->input('uas');

            $rttgs = ($tgs1 + $tgs2 + $tgs3 + $tgs4 + $tgs5) / 5;
            $persentgs = ($rttgs * 40) / 100;
            $prsnuts = ($uts * 30) / 100;
            $prsnuas = ($uas * 30) / 100;
            $nilairata = $persentgs + $prsnuts + $prsnuas;

            if ($nilairata >= 85 && $nilairata <= 100) {
                $nilai_huruf_pth = 'A';
            } elseif ($nilairata >= 70 && $nilairata < 85) {
                $nilai_huruf_pth = 'B';
            } elseif ($nilairata >= 55 && $nilairata < 70) {
                $nilai_huruf_pth = 'C';
            } elseif ($nilairata >= 40 && $nilairata < 55) {
                $nilai_huruf_pth = 'D';
            } else {
                $nilai_huruf_pth = 'E';
            }

            // dd($nilairata);
            $nilaii = [
                'tugas1'         => $request->tugas1,
                'tugas2'         => $request->tugas2,
                'tugas3'         => $request->tugas3,
                'tugas4'         => $request->tugas4,
                'tugas5'         => $request->tugas5,
                'uts'            => $request->uts,
                'uas'            => $request->uas,
                'semester'       => $request->semester,
                'siswa_id'       => $request->siswa_id,
                'kelas_id'       => $request->kelas_id,
                'guru_id'        => $request->guru_id,
                'mapel_id'       => $request->mapel_id,
                'rata_nilai'     => $nilairata,
                'nilai_huruf'    => $nilai_huruf_pth
            ];
            //update
            $data->update($nilaii);
        } else {
            //add
            // Nilai::create($nilai);
            Nilai::create([
                'tugas1'         => $request->tugas1,
                'tugas2'         => $request->tugas2,
                'tugas3'         => $request->tugas3,
                'tugas4'         => $request->tugas4,
                'tugas5'         => $request->tugas5,
                'uts'            => $request->uts,
                'uas'            => $request->uas,
                'semester'       => $request->semester,
                'siswa_id'       => $request->siswa_id,
                'kelas_id'       => $request->kelas_id,
                'guru_id'        => $request->guru_id,
                'mapel_id'       => $request->mapel_id,
                'rata_nilai'     => $nilai_rata,
                'nilai_huruf'    => $nilai_huruf_pth

            ]);
        }
        // Nilai::create($nilai);
        return Redirect('/data-nilai-atur/' . $id_jadwal . '/' . $smt)->with('toast_success', 'Data berhasil disimpan !');;
        // return Redirect::back()->with('toast_success','Data berhasil ditambahkan !');
    }
}
