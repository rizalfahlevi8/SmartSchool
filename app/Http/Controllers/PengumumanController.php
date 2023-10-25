<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function create()
    {
        // Show a form to create a new notification
        return view('pengumumans.create');
    }
    public function store(Request $request)
    {
        if ($request->has('roles')) {
            foreach ($request->input('roles') as $rolePengumuman) {
                Pengumuman::create([
                    'title' => $request->input('title'),
                    'message' => $request->input('message'),
                    'role' => $rolePengumuman,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Pengumuman berhasil disimpan');
    }
    public function destroy($id)
    {
        $barang = Pengumuman::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $roles = $request->input('roles', []);
        $pengumuman->update([
            'title' => $request->title,
            'message' => $request->message,
            'roles' => $roles,
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
    }
}
