<?php

namespace App\Http\Controllers;

use App\Models\KerjaSama;
use Illuminate\Http\Request;

class KerjaSamaController extends Controller
{
    public function lihat(){

        return view('pages.humas.data-mou.data-kerjasama', [
            'title' => 'data-kerjasama',
            'mou'=> KerjaSama::get(),
        ]);
    }

    public function create(){
        return view('pages.humas.data-mou.kerjasama-mou',[
            'title' =>  "Tambah Data MoU",
            'mou'=> KerjaSama::get(),
        ]);
    }

    public function store(Request $request){

        $mou = new KerjaSama();

        $mou->nama_mitra = $request->nama_mitra;
        $mou->asal_mitra = $request->asal_mitra;
        $mou->Deskripsi_singkat_mitra = $request->deskripsi_singkat_mitra;
        $mou->tanggal_mulai_kerjasama = $request->tgl_mulai_kerjasama;
        $mou->tanggal_berakhir_kerjasama = $request->tgl_berakhir_kerjasama;
        $mou->PT_Mitra = $request->pt_mitra;
        $mou->tujuan_mitra = $request->tujuan_mitra;
        $mou->save();

        return view('pages.humas.data-mou.kerjasama-mou',[
            'title' => 'Data Berhasil DiTambah',
        ]);
    }
    
    public function edit($id) {

        // dd(Kerjasama::get);
        // dd($mou);
        $mou = KerjaSama::find($id);

        return view('pages.humas.data-mou.edit-data-kerjasama',[

            'mou' => $mou,
            
        ])->with('title', 'Update Data Mou');
    }

    public function update(Request $request, $id){

        $mou = KerjaSama::find($id);

        $mou->nama_mitra = $request->nama_mitra;
        $mou->asal_mitra = $request->asal_mitra;
        $mou->Deskripsi_singkat_mitra = $request->deskripsi_singkat_mitra;
        $mou->tanggal_mulai_kerjasama = $request->tgl_mulai_kerjasama;
        $mou->tanggal_berakhir_kerjasama = $request->tgl_berakhir_kerjasama;
        $mou->PT_Mitra = $request->pt_mitra;
        $mou->tujuan_mitra = $request->tujuan_mitra;
        $mou->save();

        return view('pages.humas.data-mou.data-kerjasama',[
            'mou' => KerjaSama::get(),
        ])->with('title', 'Update Sukses');
    }

    public function destroy(KerjaSama $kerjasama){
        
        $kerjasama->update(['deleted' => 1]);
        User::find($kerjasama->id)->delete();

        return redirect('/mou')->with('toast_success', 'Data Guru Berhasil di Hapus');
    }

}   