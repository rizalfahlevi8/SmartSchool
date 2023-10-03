<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Inventaris;
use App\Models\DaftarBarang;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function showInventaris()
    {
        $dataRuangan = Ruang::all();
        return view('datainventaris.inventaris', compact('dataRuangan'));
    }

    public function aturBarang($id)
    {
        $ruang = Ruang::findOrFail($id);
        $inventaris = Inventaris::where('id_ruang', $id)->get();

        return view('datainventaris.inventaris', compact('inventaris', 'ruang'));
    }



    public function store(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'id_daftarbarang' => 'required|numeric',
            'nama_barang' => 'required|string|max:255',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string|max:255',
            'jumlah_baik' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
        ]);

        // Hitung jumlah_barang berdasarkan jumlah_baik dan jumlah_rusak
        $jumlah_barang = $request->jumlah_baik + $request->jumlah_rusak;

        // Simpan data inventaris
        Inventaris::create([
            'id_ruang' => $id,
            'id_daftarbarang' => $request->id_daftarbarang,
            'nama_barang' => $request->nama_barang,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'jenis' => $request->jenis,
            'jumlah_barang' => $jumlah_barang,
            'jumlah_baik' => $request->jumlah_baik,
            'jumlah_rusak' => $request->jumlah_rusak,
        ]);

        // Perbarui variabel $ruang untuk digunakan pada view
        $ruang = Ruang::findOrFail($id);

        return redirect()->route('atur-barang', $id)->with('success', 'Barang berhasil ditambahkan.');
    }

    public function hapusBarang($id)
    {
        // Hapus barang berdasarkan ID
        $barang = Inventaris::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
