<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('deleted', 0)->orderBy('nama_kelas', 'asc')->get();
        $guruTersedia = DB::select('
        SELECT * FROM gurus WHERE id NOT IN (SELECT id_guru FROM kelas where deleted = false)
        ');

        return view('pages.sarana.data-kelas.kelas', [
            'daftar_kelas' => $kelas,
            'guruTersedia' => $guruTersedia,
            'list_guru' => Guru::all()
        ])->with('title', 'Data Kelas');
    }
    public function store(Request $request)
    {
        $kelas = Kelas::firstWhere('nama_kelas', strtoupper($request->nama_kelas));
        if ($kelas) {
            $kelas->update(['deleted' => 0]);
            return redirect()->route('kelas_main')->with('toast_success', 'Kelas terhapus telah aktif kembali!');
        }

        $request->validate([
            'nama_kelas' => 'required|unique:kelas',
            'id_guru' => 'required',
        ]);

        $id_akademik = Akademik::firstWhere('selected', 1)->id;
        $kelas = Kelas::create([
            'nama_kelas' => strtoupper($request->nama_kelas),
            'id_guru' => $request->id_guru,
        ]);
        foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $key => $hari) {
            Jadwal::create([
                'status' => 'Libur',
                'catatan' => 'Tidak Ada',
                'hari' => $hari,
                'id_kelas' => $kelas->id,
                'id_akademik' => $id_akademik,
            ]);
        }
        return redirect()->route('kelas_main')->with('toast_success', 'Data berhasil ditambahkan !');
    }
    public function update(Request $request, Kelas $kelas)
    {
        $validated_condition = [
            'nama_kelas' => 'required',
            'id_guru' => 'required',
        ];
        if ($kelas->nama_kelas != $request->nama_kelas) {
            $validated_condition['nama_kelas'] = 'required|unique:kelas';
        }
        $request->validate($validated_condition);

        $kelas_target = Kelas::where('id_guru', '=', $request->id_guru)->first();

        if ($kelas_target && $kelas->id_guru !== $kelas_target->id_guru) {
            $kelas_target->update(['id_guru' => null]);
        }
        $kelas->update([
            'nama_kelas' => strtoupper($request->nama_kelas),
            'id_guru' => $request->id_guru,
        ]);
        return redirect()->route('kelas_main')->with('toast_success', 'Data berhasil diubah !');
    }
    public function destroy(Kelas $kelas)
    {
        $kelas->update([
            'deleted' => 1
        ]);
        return redirect()->route('kelas_main')->with('toast_success', 'Data berhasil dihapus !');
    }
}
