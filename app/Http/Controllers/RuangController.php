<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{

    public function index()
    {
        $ruang = Ruang::all();
        return view('pages.sarana.data-ruang.ruang', [
            'ruangs'      => $ruang
        ])->with('title', 'Daftar Ruangan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|unique:ruangs',
            'luas' => 'required',
            'lokasi' => 'required',
        ]);

        Ruang::create([
            'nama_ruang'         => strtoupper($request->nama_ruang),
            'lokasi'         => ucfirst($request->lokasi),
            'luas'         => $request->luas
        ]);
        // return request('lokasi');
        return redirect()->route('ruang_main')->with('toast_success', 'Data Ruang Berhasil di Tambahkan');
    }

    public function update(Request $request)
    {
        $ruang = Ruang::find($request->id_ruang);

        $validated_condition = [
            'nama_ruang' => 'required',
            'lokasi' => 'required',
            'luas' => 'required',
        ];

        if ($ruang->nama_ruang != $request->nama_ruang) {
            $validated_condition['nama_ruang'] = 'required|unique:ruangs';
        }
        $request->validate($validated_condition);


        $data = [
            'nama_ruang' => strtoupper($request->nama_ruang),
            'luas' => $request->luas,
            'lokasi' => ucfirst($request->lokasi),
        ];

        $ruang->update($data);
        return redirect()->route('ruang_main')->with('toast_success', 'Data Ruang Berhasil di Ubah');
    }

    public function destroy(Ruang $ruang)
    {
        //delete data
        $ruang->delete();

        return redirect()->route('ruang_main')->with('toast_success', 'Data Ruang Berhasil di Hapus');
    }
}
