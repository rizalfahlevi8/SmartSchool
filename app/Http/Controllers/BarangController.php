<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        
        $data = $request->validate([
            'nama_barang' => 'required|string',
            'tahun_pengadaan' => 'required|date',
            'jenis' => 'required|string',
            'jumlah_seluruh_barang' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

   
        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/image', $fileName);
        $data['image'] = $fileName;

        Barang::create($data);

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
        Storage::delete('public/image'. $barang->image);

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
            'image' => 'nullable|image|file',
        ]);
    
        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'tahun_pengadaan' => $request->input('tahun_pengadaan'),
            'jenis' => $request->input('jenis'),
            'jumlah_seluruh_barang' => $request->input('jumlah_seluruh_barang'),
        ];
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/', $fileName);
    
            // Hapus gambar lama jika ada
            Storage::delete('public/' . $barang->image);
    
            // Update nama file gambar baru
            $data['image'] = $fileName;
        }
    
        $barang->update($data);
    
        return redirect()->route('barang_main')->with('success', 'Data barang berhasil diperbarui.');
    }
}