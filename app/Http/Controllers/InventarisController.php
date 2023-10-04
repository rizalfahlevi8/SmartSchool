<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use App\Models\Inventaris;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class InventarisController extends Controller
{
    public function index()
    {
        $ruang = Ruang::all();
        return view('pages.sarana.data-inventaris.inventaris', [
            'ruangs' => $ruang,
        ])->with('title', 'Daftar Inventaris');
    }

    public function aturBarang($id)
    {
        $ruang = Ruang::findOrFail($id);
        $inventaris = Inventaris::where('ruang_id', $id)->get();

        return view('pages.sarana.data-inventaris.kelolabarang', [
            'ruangs' => $ruang,
            'inventaris' => $inventaris,
        ])->with('title', 'Daftar Inventaris');
    }

    public function store(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'jumlah_baik' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
        ]);

        // Hitung jumlah_barang berdasarkan jumlah_baik dan jumlah_rusak
        $jumlah_barang = $request->jumlah_baik + $request->jumlah_rusak;

        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Simpan data inventaris
            $inventaris = Inventaris::create([
                'nama_barang' => $request->nama_barang,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'jenis' => $request->jenis,
                'jumlah_barang' => $jumlah_barang,
                'jumlah_baik' => $request->jumlah_baik,
                'jumlah_rusak' => $request->jumlah_rusak,
            ]);

            // Simpan data ke tabel barangs
            Barang::create([
                'nama_barang' => $request->nama_barang,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'jenis' => $request->jenis,
                'jumlah_barang' => $jumlah_barang,
                
            ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('inventaris_main')->with('toast_success', 'Data inventaris Berhasil di Tambahkan');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi exception
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function hapusBarang($id)
    {
        $barang = Inventaris::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }
}
