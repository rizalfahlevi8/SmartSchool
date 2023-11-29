<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\Detail_jadwal;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function showJadwalAdmin()
    {
        $kelas = Kelas::All();
        return view('pages.akademik.data-jadwal.jadwal', [
            'daftar_kelas'      => $kelas,
        ])->with('title', 'Data Jadwal');
    }
    public function showJadwalGuru()
    {
    }
    public function showJadwalSiswa()
    {
        $jadwals = Jadwal::whereHas('akademik', function ($query) {
            $query->where('selected', 1);
        })->where('id_kelas', '=', auth()->user()->siswa->id_kelas)->get();

        return view('pages.data-jadwal.jadwal-kelas', [
            'jadwals' => $jadwals
        ])->with('title', 'Jadwal ' . auth()->user()->siswa->kelas->nama_kelas);
    }
    public function jadwalKelas(Request $request, Kelas $kelas)
    {
        if ($request->has('masuk')) {
            $jadwal = Jadwal::find($request->masuk);
            $jadwal->update([
                'status' => 'masuk'
            ]);
        } elseif ($request->has('libur')) {
            $jadwal = Jadwal::find($request->libur);
            $jadwal->update([
                'status' => 'libur'
            ]);
        }
        $jadwals = Jadwal::whereHas('akademik', function ($query) {
            $query->where('selected', 1);
        })->where('id_kelas', '=', $kelas->id)->get();

        return view('pages.akademik.data-jadwal.jadwal-kelas', [
            'kelas' => $kelas,
            'jadwals' => $jadwals,
            'mapels' => Mapel::all(),
            'gurus' => Guru::all(),
            'ruangs' => Ruang::all(),
        ])->with('title', 'Jadwal ' . $kelas->nama_kelas);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                'after:jam_mulai',
            ],
            'id_ruang' => 'required',
            'id_mapel' => 'required',
            'id_guru' => 'required',
        ], [
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        $toast_success_msg = 'Data berhasil ditambahkan!';
        $jamMulai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_mulai);
        $jamSelesai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_selesai);

        $jadwal_api = Jadwal::find($request->id_jadwal);
        $jadwal_hari = $jadwal_api->hari;
        $jadwal_akademik_id = $jadwal_api->akademik->id;
        $apiGuruWithNotSameMapel = Detail_jadwal::where('id_guru', $request->id_guru)->whereHas('jadwal', function ($query) use ($jadwal_hari, $jadwal_akademik_id) {
            $query->where('hari', $jadwal_hari)->whereHas('akademik', function ($query) use ($jadwal_akademik_id) {
                $query->where('id', $jadwal_akademik_id);
            });
        })->get();

        if (count($apiGuruWithNotSameMapel) > 0) {
            foreach ($apiGuruWithNotSameMapel as $key => $value) {
                if ($value->id_mapel != $request->id_mapel) {
                    $existingJamMulai = \Carbon\Carbon::createFromFormat('H:i:s', $value['jam_mulai']);
                    $existingJamSelesai = \Carbon\Carbon::createFromFormat('H:i:s', $value['jam_selesai']);

                    if (($jamMulai >= $existingJamMulai && $jamMulai < $existingJamSelesai) ||
                        ($jamSelesai > $existingJamMulai && $jamSelesai <= $existingJamSelesai) || ($jamMulai == $existingJamMulai && $jamSelesai == $existingJamSelesai)
                    ) {
                        return redirect()->back()->with('toast_error', $value->guru->nama . ' telah mengajar mapel ' . $value->mapel->nama_mapel . ' dikelas ' . $value->jadwal->kelas->nama_kelas . ' pada waktu ' . $value->jam_mulai  . ' sampai ' . $value->jam_selesai);
                    }
                } else {
                    $request['jam_mulai'] = $value['jam_mulai'];
                    $request['jam_selesai'] = $value['jam_selesai'];
                    $toast_success_msg = 'Data berhasil diubah! kelas ini digabung dengan kelas ' . $value->jadwal->kelas->nama_kelas . ' karena memiliki guru dan mapel yang sama dan dengan waktu yang saling tumpang tindih';
                    break;
                }
            }
        }

        $apiData = Detail_jadwal::where('id_jadwal', $request->id_jadwal)->get();

        $selisihMenit = $jamSelesai->diffInMinutes($jamMulai);

        if ($selisihMenit < 45) {
            return redirect()->back()->with('toast_error', 'Durasi pelajaran minimal 45 menit.');
        }

        foreach ($apiData as $data) {
            if ($data['id_jadwal'] == $request->id_jadwal) {
                $existingJamMulai = \Carbon\Carbon::createFromFormat('H:i:s', $data['jam_mulai']);
                $existingJamSelesai = \Carbon\Carbon::createFromFormat('H:i:s', $data['jam_selesai']);

                if (($jamMulai >= $existingJamMulai && $jamMulai < $existingJamSelesai) ||
                    ($jamSelesai > $existingJamMulai && $jamSelesai <= $existingJamSelesai) || ($jamMulai == $existingJamMulai && $jamSelesai == $existingJamSelesai)
                ) {
                    return redirect()->back()->with('toast_error', 'Jam yang Anda masukkan tumpang tindih dengan jadwal yang sudah ada.');
                }
            }
        }


        $jadwal = $request->all();
        Detail_jadwal::create($jadwal);

        return Redirect::back()->with('toast_success', $toast_success_msg);
    }
    public function update(Request $request, Detail_jadwal $detail_jadwal)
    {
        $this->validate($request, [
            'jam_mulai' => [
                'required',
                'date_format:H:i',
            ],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
            ],
            'ruang' => 'required',
            'mapel' => 'required',
            'guru' => 'required',
        ]);

        $toast_success_msg =  'Data berhasil diubah !';

        $jamMulai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_mulai);
        $jamSelesai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_selesai);

        $jadwal_api = Jadwal::find($detail_jadwal->id_jadwal);
        $jadwal_hari = $jadwal_api->hari;
        $jadwal_akademik_id = $jadwal_api->akademik->id;
        $apiGuruWithNotSameMapel = Detail_jadwal::where('id_guru', $request->guru)->where('id_jadwal', '!=', $jadwal_api->id)->whereHas('jadwal', function ($query) use ($jadwal_hari, $jadwal_akademik_id) {
            $query->where('hari', $jadwal_hari)->whereHas('akademik', function ($query) use ($jadwal_akademik_id) {
                $query->where('id', $jadwal_akademik_id);
            });
        })->get();

        if (count($apiGuruWithNotSameMapel) > 0) {
            foreach ($apiGuruWithNotSameMapel as $key => $value) {
                if ($value->id_mapel != $request->mapel) {
                    $existingJamMulai = \Carbon\Carbon::createFromFormat('H:i:s', $value['jam_mulai']);
                    $existingJamSelesai = \Carbon\Carbon::createFromFormat('H:i:s', $value['jam_selesai']);

                    if (($jamMulai >= $existingJamMulai && $jamMulai < $existingJamSelesai) ||
                        ($jamSelesai > $existingJamMulai && $jamSelesai <= $existingJamSelesai) || ($jamMulai == $existingJamMulai && $jamSelesai == $existingJamSelesai)
                    ) {
                        return redirect()->back()->with('toast_error', $value->guru->nama . ' telah mengajar mapel ' . $value->mapel->nama_mapel . ' dikelas ' . $value->jadwal->kelas->nama_kelas . ' pada waktu ' . $value->jam_mulai  . ' sampai ' . $value->jam_selesai);
                    }
                } else {
                    $request['jam_mulai'] = $value['jam_mulai'];
                    $request['jam_selesai'] = $value['jam_selesai'];
                    $toast_success_msg = 'Data berhasil diubah! kelas ini digabung dengan kelas ' . $value->jadwal->kelas->nama_kelas . ' karena memiliki guru dan mapel yang sama dan dengan waktu yang saling tumpang tindih';
                    break;
                }
            }
        }

        $apiData = Detail_jadwal::where('id_jadwal', $detail_jadwal->id_jadwal)->get();

        $selisihMenit = $jamSelesai->diffInMinutes($jamMulai);

        if ($jamSelesai->isBefore($jamMulai)) {
            return redirect()->back()->with('toast_error', "Jam mulai tidak valid");
        }
        if ($selisihMenit < 45 && $selisihMenit >= 0) {
            return redirect()->back()->with('toast_error', 'Durasi pelajaran minimal 45 menit.');
        }

        foreach ($apiData as $data) {
            if ($data['id'] != $detail_jadwal->id) {
                $existingJamMulai = \Carbon\Carbon::createFromFormat('H:i:s', $data['jam_mulai']);
                $existingJamSelesai = \Carbon\Carbon::createFromFormat('H:i:s', $data['jam_selesai']);

                if (($jamMulai >= $existingJamMulai && $jamMulai < $existingJamSelesai) ||
                    ($jamSelesai > $existingJamMulai && $jamSelesai <= $existingJamSelesai) || ($jamMulai == $existingJamMulai && $jamSelesai == $existingJamSelesai)
                ) {
                    return redirect()->back()->with('toast_error', 'Jam yang Anda masukkan tumpang tindih dengan jadwal yang sudah ada.');
                }
            }
        }

        $detail_jadwal->update([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'id_ruang' => $request->ruang,
            'id_mapel' => $request->mapel,
            'id_guru' => $request->guru,
        ]);
        // return $jadwaldata;
        return Redirect::back()->with('toast_success', $toast_success_msg);
    }
    public function destroy($id)
    {
        $jadwal = Detail_jadwal::find($id);
        $jadwal->delete();
        return Redirect::back()->with('toast_success', 'Data berhasil dihapus !');
    }

    public function cetak($id)
    {
        $jadwal =  Jadwal::select('hari', 'kelas_id')->where("kelas_id", $id)->groupBy('hari', 'kelas_id')->orderBy("hari", 'asc')->get();
        $data = [];
        $no = 0;
        foreach ($jadwal as $item) {
            $data[$no] = $item;
            $data[$no]->hari = $item->hari;
            $data[$no]->detail = Jadwal::where(['kelas_id' => $item->kelas_id, 'hari' => $item->hari])->get();
            $no++;
        }
        // echo json_encode($data);
        // die;
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $guru   =  Guru::select('id', 'nama')->get();

        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pages.data-jadwal.cetak', [
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $data,
            'kelas'     => $kelas,
            'hari' => $hari
        ]);
        return $pdf->stream('laporan-jadwal-pelajaran-pdf');
    }

    public function jadwalsiswa($id)
    {
        if ($id == 'null') {
            return back()->with('toast_warning', 'Fitur ini masih dikerjakan');
        }
        $kelasId = $id;
        // $detail_jadwal = Detail_jadwal::todaySchedule($guruId);
        $jadwal = Jadwal::with('detail_jadwal')->whereHas('akademik', function ($query) {
            $query->where('selected', 1);
        })->where('id_kelas', $kelasId)->whereHas('detail_jadwal', function ($query) {
            $query->with('mapel', 'ruang');
        })->get();

        $kelas = Kelas::find($id);
        $hari_list = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hari_ini = strtolower($hari_list[Carbon::now()->dayOfWeek]);

        // $all_jadwal = Detail_jadwal::with('jadwal', 'mapel', 'ruang')
        //     ->whereHas('guru', function ($query) use ($guruId) {
        //         $query->where('id', $guruId);
        //     })
        //     ->whereHas('jadwal', function ($query) use ($hari_ini) {
        //         $query->where('hari', $hari_ini);
        //     })
        //     ->orderBy('jam_mulai', 'asc')
        //     ->get();

        return view('pages.akademik.data-jadwal-siswa.jadwalsiswa', [
            'jadwals'    => $jadwal,
            'kelas' => $kelas,
            'hari_ini' => $hari_ini

        ])->with('title', 'Jadwal Pelajaran');
    }

    public function cetakjadwalsiswa($id)
    {
        $jadwal =  Jadwal::select('hari', 'kelas_id')->where("kelas_id", $id)->groupBy('hari', 'kelas_id')->orderBy("hari", 'asc')->get();
        $data = [];
        $no = 0;
        foreach ($jadwal as $item) {
            $data[$no] = $item;
            $data[$no]->hari = $item->hari;
            $data[$no]->detail = Jadwal::where(['kelas_id' => $item->kelas_id, 'hari' => $item->hari])->get();
            $no++;
        }
        // echo json_encode($data);
        // die;
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $guru   =  Guru::select('id', 'nama')->get();

        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pages.data-jadwal.cetaksiswa', [
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $data,
            'kelas'     => $kelas,
            'hari' => $hari
        ]);
        return $pdf->stream('laporan-jadwal-pelajaran-pdf');
    }

    public function lihat()
    {
        $kelas = Kelas::All();

        return view('pages.data-jadwal.lihat', [
            'kelas'      => $kelas,

        ]);
    }
    public function cekjadwal($id)
    {
        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id", $id)->orderBy("hari", 'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $guru   =  Guru::select('id', 'nama')->get();
        return view('pages.data-jadwal.cekjadwal', [
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }

    public function cek($id)
    {
        $hari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];
        $jadwal = Jadwal::where("kelas_id", $id)->orderBy("hari", 'asc')->get();
        $kelas  =  Kelas::find($id);
        $mapel  =  Mapel::select('id', 'namamapel')->get();
        $guru   =  Guru::select('id', 'nama')->get();
        return view('pages.datajadwalmengajar.cek', [
            'guru'      => $guru,
            'mapel'     => $mapel,
            'jadwal'    => $jadwal,
            'kelas'     => $kelas,
            'hari' => $hari

        ]);
    }
}
