<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Akademik;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('pages.akademik.absensi.absensi', [
            'akademiks' => Akademik::groupBy('tahun_ajaran')->get(),
        ])->with('title', 'Absensi');
    }

    public function showKelasAbsensi(Request $request, $tahun_akademik, $kelas)
    {
        // return $request->selected_kelas;
        $tahun_akademik = str_replace('-', '/', $tahun_akademik);
        $kelas_list = Kelas::where('nama_kelas', 'LIKE', $kelas . ' %')->get();

        if ($request->has('selected_kelas') && $request->has('selected_semester')) {
            $akademik = Akademik::where('tahun_ajaran', $tahun_akademik)->where('semester', $request->selected_semester)->get();
            $absensis = Absensi::all()->where('id_akademik', $akademik->first()->id)->where('kelas', $request->selected_kelas);
        } else {
            $akademik = Akademik::where('tahun_ajaran', $tahun_akademik)->where('semester', 'ganjil')->get();
            $absensis = Absensi::all()->where('id_akademik', $akademik->first()->id)->where('kelas', $kelas_list->first()->id);
        }

        if (count($kelas_list) < 1 || count($akademik) < 1) {
            abort(404);
        }

        return view('pages.akademik.absensi.absensi-kelas', [
            'kelas_list' => $kelas_list,
            'selected_kelas' => $request->selected_kelas ?? null,
            'selected_semester' => $request->selected_semester ?? 'ganjil',
            'list_status' => ['tidak masuk', 'masuk', 'sakit', 'izin', 'telat'],
            'absensis' => $absensis,
        ])->with('title', 'Absensi');
    }

    public function apiUpdateAbsensi(Absensi $absensi, Request $request)
    {
        $absensi->update([
            'status_absen' => $request->status,
            'keterangan' => $request->status == 'izin' ? $request->keterangan_izin : '',
        ]);

        return back();
    }
}
