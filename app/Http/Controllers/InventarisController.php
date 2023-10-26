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
            'barang_id' => 'required|integer|min:0',
            'nama_barang' => 'required|string|max:255',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:0',
            'jumlah_baik' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
        ]);

        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Simpan data ke tabel barangs
            $barang = Barang::create([
                'barang_id' => $request->barang_id,
                'nama_barang' => $request->nama_barang,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'jenis' => $request->jenis,
                'jumlah_seluruh_barang' => $request->jumlah_barang,
                'id_ruang' => $id,  
            ]);

            // Simpan data ke tabel inventaris
            $inventaris = Inventaris::create([
                'ruang_id' => $id,
                'barang_id' => $barang->id, 
                'nama_barang' => $request->nama_barang,
                'tahun_pengadaan' => $request->tahun_pengadaan,
                'jenis' => $request->jenis,
                'jumlah_barang' => $request->jumlah_barang,
                'jumlah_baik' => $request->jumlah_baik,
                'jumlah_rusak' => $request->jumlah_rusak,
            ]);

            // Commit transaksi
            DB::commit();

            return redirect()->route('atur-barang')->with('toast_success', 'Data inventaris Berhasil di Tambahkan');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi exception
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }



    public function destroy($id)
    {
        try {
            // Temukan inventaris berdasarkan ID
            $inventaris = Inventaris::findOrFail($id);

            // Hapus inventaris
            $inventaris->delete();

            return redirect()->back()->with('success', 'Inventaris berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus inventaris: ' . $e->getMessage());
        }
    }

}
