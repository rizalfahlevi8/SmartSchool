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

        // dd($request->all());

        // Validasi input
        $errors = $this->validate($request, [
            'nama_mitra' => 'required|string|max:255',
            'asal_mitra' => 'required|string|max:255',
            'deskripsi_singkat_mitra' => 'required|string',
            'tgl_mulai_kerjasama' => 'required|date',
            'tgl_berakhir_kerjasama' => 'required|date',
            'pt_mitra' => 'required|string|max:255',
            'tujuan_mitra' => 'required|string',
            'file_mitra' => 'nullable|mimes:doc,docx,pdf|max:2048', // Max file size 2048 KB (2 MB)
        ]);
        // dd($errors);

        try {
            // Simpan file
            $file = $request->file('file_mitra');
            $allowedExtensions = ['doc', 'docx', 'pdf'];
            $allowedMimeTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf'];

            if ($file && in_array($file->getClientOriginalExtension(), $allowedExtensions) && in_array($file->getMimeType(), $allowedMimeTypes)) {
                // File memiliki ekstensi dan tipe konten yang diizinkan, lanjutkan penyimpanan file
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('kerjasama/file', $fileName);
                // dd("Asda");
            } else {
                // Tampilkan pesan kesalahan jika ekstensi atau tipe konten file tidak valid
                return redirect()->back()->withInput()->withErrors(['file_mitra' => 'Format file tidak valid. Hanya diperbolehkan file dengan ekstensi doc, docx, atau pdf.']);
            }

            // Simpan data ke dalam database
  
            KerjaSama::create([
                'nama_mitra' => $request->nama_mitra,
                'asal_mitra' => $request->asal_mitra,
                'Deskripsi_singkat_mitra' => $request->deskripsi_singkat_mitra,
                'tanggal_mulai_kerjasama' => $request->tgl_mulai_kerjasama,
                'tanggal_berakhir_kerjasama' => $request->tgl_berakhir_kerjasama,
                'PT_Mitra' => $request->pt_mitra,
                'tujuan_mitra' => $request->tujuan_mitra,
                'file' => $file->getClientOriginalName(),
            ]);

            // Tampilkan data yang baru disimpan
            // dd(KerjaSama::latest()->first());

            // Redirect ke halaman /mou
            return redirect('/mou')->with('toast_success', 'Data Berhasil Ditambah');
            
        } catch (\Exception $e) {
            // Tangani exception jika ada
            dd($e->getMessage());
            // return response()->json(['error' => $e->getMessage()], 500);
        }

        // $mou = new KerjaSama();

        // $mou->nama_mitra = $request->nama_mitra;
        // $mou->asal_mitra = $request->asal_mitra;
        // $mou->Deskripsi_singkat_mitra = $request->deskripsi_singkat_mitra;
        // $mou->tanggal_mulai_kerjasama = $request->tgl_mulai_kerjasama;
        // $mou->tanggal_berakhir_kerjasama = $request->tgl_berakhir_kerjasama;
        // $mou->PT_Mitra = $request->pt_mitra;
        // $mou->tujuan_mitra = $request->tujuan_mitra;
        // $mou->file = $request->file_mitra;
        // $mou->save();

        // return view('pages.humas.data-mou.data-kerjasama',[
        //     'title' => 'Data Berhasil DiTambah',
        //     'mou'=> KerjaSama::get(),
        // ]);

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
        KerjaSama::find($kerjasama->id)->delete();

        return redirect('/mou')->with('toast_success', 'Data Kerjasma Berhasil di Hapus');
    }

}   