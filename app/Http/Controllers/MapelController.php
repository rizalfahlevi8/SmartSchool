<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::All();
        return view('pages.akademik.data-mapel.mapel', [
            'mapels'      => $mapel
        ])->with('title', 'Mapel');
    }
    public function store(Request $request)
    {
        Mapel::create([
            'nama_mapel' => $request->nama_mapel
        ]);
        return redirect()->route('mapel_main')->with('toast_success', 'Data berhasil ditambahkan !');
    }
    // edit
    public function update(Request $request, Mapel $mapel)
    {
        $mapel->update($request->all());
        return redirect()->route('mapel_main')->with('toast_success', 'Data berhasil diubah !');
    }
    // hapus
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('mapel_main')->with('toast_success', 'Data berhasil dihapus !');
    }
}
