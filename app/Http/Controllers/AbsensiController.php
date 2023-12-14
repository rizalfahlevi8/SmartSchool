<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Akademik;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use App\Models\Keteranganabsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class AbsensiController extends Controller
{
    public function showAbsensiAdmin()
{
    $absensis = Absensi::all();

    // Sort absensi by Tanggal (descending)
    $absensis = $absensis->sortByDesc('created_at');

    // Separate data for siswa and guru
    $siswaAbsensi = $absensis->filter(function ($absensi) {
        return $absensi->user->role == 'siswa';
    });

    $guruAbsensi = $absensis->filter(function ($absensi) {
        return $absensi->user->role == 'guru';
    });

    // Sort siswaAbsensi by Tanggal (descending), Kelas, Nama
    $siswaAbsensi = $siswaAbsensi->sortByDesc('created_at')->sortBy([
        function ($absensi) {
            return optional($absensi->siswa->kelas)->nama_kelas;
        },
        function ($absensi) {
            return optional($absensi->siswa)->nama;
        },
    ]);

    // Sort guruAbsensi by Tanggal (descending), Nama
    $guruAbsensi = $guruAbsensi->sortByDesc('created_at')->sortBy([
        function ($absensi) {
            return optional($absensi->guru)->nama;
        },
    ]);

    return view('pages.akademik.absensi.absensi-admin', [
        'siswaAbsensis' => $siswaAbsensi,
        'guruAbsensis' => $guruAbsensi,
    ])->with('title', 'Absensi Admin');
}



    public function deleteAbsensi($id) {
        try {
            // Lakukan penghapusan data absensi berdasarkan ID
            Absensi::findOrFail($id)->delete();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getAbsensiById($id) {
        try {
            // Ambil data absensi berdasarkan ID
            $absensi = Absensi::with(['siswa.kelas', 'guru'])->findOrFail($id);
    
            return response()->json(['success' => true, 'data' => $absensi]);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    

    public function updateAbsensi(Request $request, $id)
    {
        try {
            $absensi = Absensi::findOrFail($id);
            $absensi->update($request->all());

            return response()->json(['success' => true, 'message' => 'Absensi updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    

    public function showAbsensiSiswa(Request $request)
{
    $absensis = Absensi::all();

    // Sort absensi by Tanggal (descending)
    $absensis = $absensis->sortByDesc('created_at');

    if ($request->ajax()) {
        return response()->json($absensis);
    }

    return view('pages.akademik.absensi.absensi-siswa', compact('absensis'))->with('title', 'Absensi Siswa');
}

public function showAbsensiGuru(Request $request)
{
    $absensis = Absensi::all();

    // Sort absensi by Tanggal (descending)
    $absensis = $absensis->sortByDesc('created_at');

    if ($request->ajax()) {
        return response()->json($absensis);
    }

    return view('pages.akademik.absensi.absensi-guru', compact('absensis'))->with('title', 'Absensi Guru');
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
        'file' => 'nullable|mimes:pdf|max:5120', // Menambah validasi untuk file PDF
    ]);

    // Cek apakah pengguna telah melakukan presensi pada hari ini
    $userId = $request->input('id_user');
    $today = now()->format('Y-m-d');
    $absensi = Absensi::where('id_user', $userId)
                    ->whereDate('created_at', $today)
                    ->first();

    if ($absensi) {
        // Jika pengguna telah melakukan presensi pada hari ini, tampilkan pesan
        Log::info('Presensi hari ini sudah ada untuk user ' . $userId);
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

    // Handle unggahan file PDF (jika ada)
    if ($request->hasFile('file')) {
        $file = $request->file('file');
    
        // Log nama file yang diunggah
        Log::info('Uploaded file name: ' . $file->getClientOriginalName());
    
        $filePath = $file->storeAs('absensi_files', 'absensi_' . $absensi->id . '.' . $file->getClientOriginalExtension(), 'public');
    
        // Log path/nama file yang disimpan
        Log::info('File path saved: ' . $filePath);
    
        // Simpan path/nama file ke dalam kolom file_path
        $absensi->update(['file_path' => $filePath]);
    }

    return response()->json(['message' => 'Data absensi berhasil disimpan'], 201);
}

public function storeAdmin(Request $request)
{
    // Log data request
    Log::info('Absensi store admin request data:', $request->all());

    try {
        // Validasi request
        $request->validate([
            'status_absen' => 'required|in:masuk,sakit,izin',
            'role' => 'required|in:siswa,guru', // Sesuaikan dengan opsi yang mungkin dari frontend
            'nama_siswa' => 'required',
            'file' => 'nullable|mimes:pdf|max:5120',
        ]);

        // Cek apakah pengguna telah melakukan presensi pada hari ini
        $namaSiswa = $request->input('nama_siswa');
        $selectedRole = $request->input('role');

        // Menggunakan function getIdUserByNama yang telah kita buat sebelumnya
        $userId = $this->getIdUserByNama($namaSiswa, $selectedRole);

        // Log data sebelum membuat Absensi
        Log::info('Before creating Absensi:', [
            'status_absen' => $request->input('status_absen'),
            'role' => $selectedRole,
            'id_user' => $userId,
        ]);

        // Buat data absensi dengan mengisi semua kolom yang diperlukan
        $absensi = new Absensi([
            'status_absen' => $request->input('status_absen'),
            'role' => $selectedRole,
            'id_user' => $userId,
            'created_at' => now(),
        ]);

        // Simpan data absensi ke database
        $absensi->save();

        // Handle unggahan file PDF (jika ada)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
        
            // Log nama file yang diunggah
            Log::info('Uploaded file name: ' . $file->getClientOriginalName());
        
            $filePath = $file->storeAs('absensi_files', 'absensi_' . $absensi->id . '.' . $file->getClientOriginalExtension(), 'public');
        
            // Log path/nama file yang disimpan
            Log::info('File path saved: ' . $filePath);
        
            // Simpan path/nama file ke dalam kolom file_path
            $absensi->update(['file_path' => $filePath]);
        }

        return response()->json(['message' => 'Data absensi berhasil disimpan'], 201);
    } catch (\Exception $e) {
        // Log error jika terjadi kesalahan
        Log::error('Error in storeAdmin:', ['error' => $e->getMessage()]);
        return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data absensi'], 500);
    }
}




private function getIdUserByNama($namaUser, $role)
{
    try {
        if ($role == 'siswa') {
            $user = Siswa::where('nama', $namaUser)->first();
            return $user ? $user->id_user : null; // Perubahan disini
        } elseif ($role == 'guru') {
            $user = Guru::where('nama', $namaUser)->first();
            return $user ? $user->id_user : null; // Perubahan disini
        }
    } catch (\Exception $e) {
        // Log error jika terjadi kesalahan
        Log::error('Error in getIdUserByNama:', ['error' => $e->getMessage()]);
    }

    return null;
}


public function checkAndFillAbsentData()
{
    Log::info('checkAndFillAbsentData dijalankan pada ' . now());
    $userId = Auth::id();

    // Tentukan tanggal awal dan akhir untuk pengecekan
    $endDate = now()->subDays();
        $startDate = $endDate->copy()->subDays(8);

    $dataInserted = false; // Indikator apakah ada data tambahan yang dimasukkan

    // Looping untuk setiap tanggal
    while ($startDate <= $endDate) {
        // Pengecekan apakah hari ini bukan Sabtu (6) atau Minggu (0)
        $dayOfWeek = $startDate->dayOfWeek;
        if ($dayOfWeek != 6 && $dayOfWeek != 0) {
            // Periksa apakah sudah ada data absensi untuk tanggal ini
            $absensi = Absensi::where('id_user', $userId)
                ->whereDate('created_at', $startDate->format('Y-m-d'))
                ->first();

            // Jika belum ada data absensi, isi otomatis
            if (!$absensi) {
                $role = Auth::user()->role;
                $createdDate = $startDate->format('Y-m-d') . ' 16:00:00';

                Absensi::create([
                    'status_absen' => 'tidak masuk',
                    'role' => $role,
                    'id_user' => $userId,
                    'created_at' => $createdDate,
                ]);

                $dataInserted = true; // Set indikator bahwa ada data tambahan yang dimasukkan
            }
        }

        // Tambahkan satu hari untuk lanjut ke tanggal berikutnya
        $startDate->addDay();
    }

        // Cek apakah sudah ada data absensi untuk hari ini
    $absensiToday = Absensi::where('id_user', $userId)
    ->whereDate('created_at', now()->format('Y-m-d'))
    ->first();

    // Pengecekan apakah hari ini bukan Sabtu (6) atau Minggu (0)
    $dayOfWeekToday = now()->dayOfWeek;
    if (!$absensiToday && now()->format('H:i:s') >= '16:00:00' && $dayOfWeekToday != 6 && $dayOfWeekToday != 0) {
    $roleToday = Auth::user()->role;

    Absensi::create([
        'status_absen' => 'tidak masuk',
        'role' => $roleToday,
        'id_user' => $userId,
        'created_at' => now(),
    ]);

    $dataInserted = true; // Set indikator bahwa ada data tambahan yang dimasukkan

    // Aktifkan fungsi disablePresensiOption pada web page
    return response()->json(['success' => true, 'dataInserted' => $dataInserted, 'disablePresensiOption' => true]);
    }


    // Mengirim respons berdasarkan apakah ada data tambahan atau tidak
    return response()->json(['success' => true, 'dataInserted' => $dataInserted, 'disablePresensiOption' => false]);
}

public function tambahEvent(Request $request)
{
    $data = $request->validate([
        'tanggal' => 'required|date',
        'status' => 'required|in:weekend,libur',
        'keterangan' => 'nullable|string',
    ]);

    Keteranganabsensi::create($data);

    return redirect()->back()->with('success', 'Event berhasil ditambahkan.');
}

public function getEventsFromDatabase()
{
    Log::info('Attempting to fetch events from database...');
    try {
        // Mengambil semua data dari database
        $events = Keteranganabsensi::all();

        // Menyaring data untuk mendapatkan tanggal akhir pekan
        $weekendDates = $events->filter(function ($event) {
            return $event->status === 'weekend';
        })->pluck('tanggal')->toArray();

        Log::info('Filtered weekend dates:', $weekendDates);

        return response()->json($weekendDates);
    } catch (\Exception $e) {
        Log::error('Error fetching events from database: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to fetch events from database'], 500);
    }
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
