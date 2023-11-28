<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
<<<<<<< HEAD
use App\Models\Pengumuman;
use App\Models\KalenderAkademik;
=======
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
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
<<<<<<< HEAD
            $rolePengumuman = [];

            $datas = array();
            $role = auth()->user()->current_role;

            //Kalender Akademik
            $events = array();
            $kalender = KalenderAkademik::all();
            foreach ($kalender as $k) {
                $color = null;
                if ($k->status == 'masuk') {
                    $color = '#924ACE';
                }
                if ($k->title == 'libur') {
                    $color = '#68B01A';
                }

                $events[] = [
                    'id'   => $k->id,
                    'title' => $k->title,
                    'start' => $k->start_date,
                    'end' => $k->end_date,
                    'status' => $k->status,
                    'color' => $color
                ];
            }

=======

            $datas = array();
            $role = auth()->user()->role;
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
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
<<<<<<< HEAD
                    $myData = Guru::all()->where('id_user', '=', auth()->user()->id)->load('kelas')->first();

                    $datas = [
                        'myData' => $myData,
                        'events' => $events
=======
                    $myData = Guru::all()->where('id_user', '=', auth()->user()->id)->first()->load('kelas');

                    $datas = [
                        'myData' => $myData
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
                    ];
                    break;
                case 'siswa':
                    $myData = Siswa::all()->where('id_user', '=', auth()->user()->id)->first();
                    $datas = [
<<<<<<< HEAD
                        'myData' => $myData,
                        'events' => $events
=======
                        'myData' => $myData
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
                    ];
                    break;
                default:
                    # code...
                    break;
            }
<<<<<<< HEAD
            if (Auth::check()) {
                $query = Pengumuman::orderBy('created_at', 'desc');
                // Admin
                if (auth()->user()->hasRole('admin', 'kepsek')) {
                    $pengumumans = $query->get();
                } else {
                    // Selain admin
                    $pengumumans = $query->where('role', auth()->user()->role)->get();
                }

                $datas['pengumumans'] = $pengumumans;
                $rolePengumuman = $pengumumans->pluck('role')->unique()->toArray();
            }

            return view('pages.dashboard.dashboard', ['rolePengumuman' => $rolePengumuman] + $datas)->with('title', 'Dashboard');
=======

            return view('pages.dashboard.dashboard', $datas)->with('title', 'Dashboard');
>>>>>>> 2dea7770bd9617e2022144e6bd759d21582ae3f7
        }
    }
}
