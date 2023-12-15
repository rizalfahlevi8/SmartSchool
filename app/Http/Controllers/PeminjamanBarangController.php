<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman_barang;
use Illuminate\Http\Request;

class PeminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman_barang = Peminjaman_barang::whereDate('tanggal_pengembalian', '>=', now())
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();

        $hariini = Peminjaman_barang::whereDate('tanggal_peminjaman', '<=', now())
            ->whereDate('tanggal_pengembalian', '>=', now())
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();

        $barang = Barang::all();

        $peminjaman_barang = $peminjaman_barang->sortByDesc('created_at');

        return view('pages.humas.data-peminjaman-barang.index', [
            'hariini' => $hariini,
            'peminjaman' => $peminjaman_barang,
            'barang' => $barang,
        ])->with('title', 'Data Peminjaman Barang');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => ['numeric', 'unique:peminjaman_barangs,barang_id'],
            'jumlah' => ['numeric'],
            'nama_peminjam' => ['string'],
            'tanggal_peminjaman' => ['date'],
            'tanggal_pengembalian' => ['date'],
            'surat' => 'required',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $file = $request->file('surat');
        $fileName = time() . '.' . $file->getClientOriginalName();
        $file->storeAs('public/surat', $fileName);
        $validated['surat'] = $fileName;

        Peminjaman_barang::create($validated);

        return redirect()->route('peminjamanBarang.index')->with('toast_success', 'Data Ruang Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'id' => ['required'],
            'barang_id' => ['sometimes', 'numeric'],
            'jumlah' => ['sometimes', 'numeric'],
            'nama_peminjam' => ['sometimes', 'string'],
            'tanggal_peminjaman' => ['sometimes', 'date'],
            'tanggal_pengembalian' => ['sometimes', 'date'],
        ]);

    
        Peminjaman_barang::saved($validated);

        return redirect()->route('peminjamanBarang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Peminjaman_barang::find($id);
        $barang->deleteOrFail();

        return redirect()->route('peminjamanBarang.index');
    }
    // public function tampilkandata($id){

    //     $data = Peminjaman_barang::find($id);
    //     dd($data);
    // }
    public function history()
    {
        $peminjaman_barang = Peminjaman_barang::whereDate('tanggal_pengembalian', '<', now())
            ->get();

        return view('pages.humas.data-peminjaman-barang.history', compact('peminjaman_barang'))->with('title', 'Data Peminjaman Barang');
    }

    public function surat()
    {

    }

    public function confirm( $id)
    {
        
        $peminjaman_barang = Peminjaman_barang::find($id);

        if ($peminjaman_barang) {
            if ($peminjaman_barang->status) {
                $peminjaman_barang->status = 0;
            } else {
                $peminjaman_barang->status = 1;
            }

            $peminjaman_barang->save();
        }

        return back();
    }

    public function approve($id)
    {
        $peminjaman_barang = Peminjaman_barang::find($id);

        if ($peminjaman_barang) {
            $peminjaman_barang->status_pengajuan = true;
        }

        $peminjaman_barang->save();

        return back();
    }

    public function decline($id)
    {
        $peminjaman_barang = Peminjaman_barang::find($id);

        if ($peminjaman_barang) {
            $peminjaman_barang->status_pengajuan = false;
        }

        $peminjaman_barang->save();

        return back();
    }

}
