<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Akademik;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    public function showAbsensiAdmin(){
        return view('pages.akademik.absensi.absensi-admin', [
            'absensis'=>Absensi::all()
        ])->with('title', 'Absensi Admin');
    }
    public function showAbsensiSiswa(Request $request)
{
    $absensis = Absensi::all();

    if ($request->ajax()) {
        return response()->json($absensis);
    }

    return view('pages.akademik.absensi.absensi-siswa', compact('absensis'))->with('title', 'Absensi Siswa');
}

public function store(Request $request)
{
    // Log data request
    Log::info('Absensi store request data:', $request->all());
    Log::info('Before creating Absensi:', [
        'status_absen' => $request->input('status_absen'),
        'role' => $request->input('role'),
        'id_user' => $request->input('id_user'),
    ]);

    // Validasi request
    $request->validate([
        'status_absen' => 'required|in:masuk,sakit,izin',
        'role' => 'required',
        'id_user' => 'required',
    ]);

    // Cek apakah pengguna telah melakukan presensi pada hari ini
    $userId = $request->input('id_user');
    $today = now()->format('Y-m-d');
    $absensi = Absensi::where('id_user', $userId)
                      ->whereDate('created_at', $today)
                      ->first();

    if ($absensi) {
        // Jika pengguna telah melakukan presensi pada hari ini, tampilkan pesan
        return response()->json(['message' => 'Anda telah melakukan presensi pada hari ini'], 400);
    }

    // Buat data absensi dengan mengisi semua kolom yang diperlukan
    $absensi = new Absensi([
        'status_absen' => $request->input('status_absen'),
        'role' => $request->input('role'), // Set the role from the request
        'id_user' => $request->input('id_user'), // Set the user ID from the request
        'created_at' => now(),
    ]);

    Log::info('After creating Absensi:', $absensi->toArray());

    // Simpan data absensi ke database
    $absensi->save();

    return response()->json(['message' => 'Data absensi berhasil disimpan'], 201);
}


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
