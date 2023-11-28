<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $daftarBarang = Barang::orderBy('id', 'asc')->get();
        return view('pages.sarana.data-barang.barang', [
            'daftarBarang' => $daftarBarang
        ])->with('title', 'Daftar Barang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string',
            'jumlah_seluruh_barang' => 'required|integer',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'jenis' => $request->jenis,
            'jumlah_seluruh_barang' => $request->jumlah_seluruh_barang,
        ]);

        return redirect()->route('barang_main')->with('success', 'Data daftar barang berhasil ditambahkan.');
    }

    public function create()
    {
        return view('pages.sarana.data-barang.tambah-barang', [
            'jenis_barang' => ['meubel', 'elektronik', 'atk'],
        ])->with('title', 'Tambah Barang');
    }
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang_main')->with('success', 'Data barang berhasil dihapus.');
    }
    public function edit(Barang $barang)
    {
        return view('pages.sarana.data-barang.edit-barang', [
            'barang' => $barang,
            'jenis_barang' => ['meubel', 'elektronik', 'atk'],
        ])->with('title', 'Update Barang');
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string',
            'jumlah_seluruh_barang' => 'required|integer',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'tahun_pengadaan' => $request->tahun_pengadaan,
            'jenis' => $request->jenis,
            'jumlah_seluruh_barang' => $request->jumlah_seluruh_barang,
        ]);

        return redirect()->route('barang_main')->with('success', 'Data barang berhasil diperbarui.');
    }
}
