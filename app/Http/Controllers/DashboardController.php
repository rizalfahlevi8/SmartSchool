<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $pegawai = User::get();
            $guru = Guru::where('deleted', 0)->get();
            $kelas = Kelas::where('deleted', 0)->get();
            $siswa = Siswa::where('status', 'belum lulus')->orWhere('status', 'mutasi')->get();

            $datas = array();
            $role = auth()->user()->current_role;
            switch ($role) {
                case 'admin':
                case 'kepsek':
                    $currentMonth = date('m');
                    $semester = $currentMonth >= '07' ? 'ganjil' : 'genap';
                    $tahun_ajaran = $semester == 'ganjil' ? now()->year . '%' : '%' . now()->year;

                    $existingRecord = DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', $semester)->first();

                    DB::statement("UPDATE akademiks SET selected = 0");

                    if ($existingRecord) {
                        if ($semester == 'ganjil') {
                            DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', '=', $semester)->update(['selected' => 1]);
                        } elseif ($semester == 'genap') {
                            DB::table('akademiks')->where('tahun_ajaran', 'like', $tahun_ajaran)->where('semester', '=', $semester)->update(['selected' => 1]);
                        }
                    } else {
                        DB::table('akademiks')->insert([
                            'tahun_ajaran' => now()->year . '/' . now()->year + 1,
                            'semester' => $semester,
                        ]);
                    }
                    $datas = [
                        'teknisi' => 0,
                        'guru' => $guru,
                        'kelas' => $kelas,
                        'siswa' => $siswa
                    ];
                    break;
                case 'guru':
                    $myData = Guru::all()->where('id_user', '=', auth()->user()->id)->load('kelas')->first();

                    $datas = [
                        'myData' => $myData
                    ];
                    break;
                case 'siswa':
                    $myData = Siswa::all()->where('id_user', '=', auth()->user()->id)->first();
                    $datas = [
                        'myData' => $myData
                    ];
                    break;
                default:
                    # code...
                    break;
            }

            return view('pages.dashboard.dashboard', $datas)->with('title', 'Dashboard');
        }
    }
}
