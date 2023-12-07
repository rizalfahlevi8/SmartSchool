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
        $request->validate([
            'jumlah_barang' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            $barang = null;
            if ($request->has('nama_barang_cari')) {
                $namaBarang = $request->input('nama_barang_cari');
                $barang = Barang::where('nama_barang', 'LIKE', '%' . $namaBarang . '%')->first();

                if (!$barang) {
                    return redirect()->back()->with('error', 'Barang tidak ditemukan');
                }
                
                if ($barang && $request->has('jumlah_barang')) {
                    $barang->jumlah_seluruh_barang -= $request->jumlah_barang;
                    $barang->save();
                }
            }

            $inventaris = Inventaris::create([
                'ruang_id' => $id, 
                'barang_id' => $barang ? $barang->id : $request->barang_id ?? null,
                'nama_barang' => $barang ? $barang->nama_barang : $request->nama_barang ?? null,
                'tahun_pengadaan' => $barang ? $barang->tahun_pengadaan : $request->tahun_pengadaan ?? null,
                'jenis' => $barang ? $barang->jenis : $request->jenis ?? null,
                'jumlah_barang' => $request->jumlah_barang, 
            ]);

            DB::commit();

            return redirect()->route('atur-barang', $id)->with('toast_success', 'Data inventaris berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
   
    public function destroy($id)
    {
        try {
            $inventaris = Inventaris::findOrFail($id);
            $jumlahBarangDihapus = $inventaris->jumlah_barang;

            $inventaris->delete();

            $barang = Barang::findOrFail($inventaris->barang_id);
            $barang->jumlah_seluruh_barang += $jumlahBarangDihapus;
            $barang->save();

            return redirect()->back()->with('success', 'Inventaris berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus inventaris: ' . $e->getMessage());
        }
    }
    public function search(Request $request)
    {
        $searchTerm = $request->get('searchTerm');

        $barangs = Barang::where('nama_barang', 'like', '%' . $searchTerm . '%')->get();

        return response()->json($barangs);
    }
    public function getDetailByName(Request $request)
    {
        $selectedBarang = $request->input('selectedBarang');
        
        $barang = Barang::where('nama_barang', $selectedBarang)->first();

        if ($barang) {
            return response()->json([
                'barang_id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'tahun_pengadaan' => $barang->tahun_pengadaan,
                'jenis' => $barang->jenis,
                'image => $barang->image',
            ]);
        } else {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }
    }
    public function getAllBarang()
    {
        $barangs = Barang::all();

        return response()->json($barangs);
    }
}