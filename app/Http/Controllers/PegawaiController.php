<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('pages.datapegawai.pegawai', [
            'user'      => $user
        ]);
    }
    public function create()
    {
        return view('pages.datapegawai.tambah');
    }
    public function store(Request $request)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'data ini sudah digunakan'
        ];
        $this->validate($request, [
            'nama' => 'regex:/^[a-zA-Z\s]+$/',
            'nip' => 'required|unique:users',
            'notelp' => 'required|unique:users'
        ], $messages);

        $waka = User::where('jabatan', 'waka')->first();
        if ($request->input('jabatan') == 'Kepala Sekolah') {

            $kepsek = User::where('jabatan', 'Kepala Sekolah')->first();
            if ($kepsek) {
                return redirect('/data-pegawai-add')->with('toast_error', 'Data kepala sekolah sudah ada');
            }
        }
        if ($request->input('jabatan') == 'waka') {

            $wakakepsek = User::where('jabatan', 'waka')->first();
            if ($wakakepsek) {
                return redirect('/data-pegawai-add')->with('toast_error', 'Data wakil kepala sekolah sudah ada');
            }
        }
        $filegambar = null;

        if ($request->hasFile('foto')) {
            $tujuan_upload = 'assets/img/pegawai';
            $file = $request->file('foto');
            $filegambar = time() . "_" . $file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload, $filegambar);
        }


        User::create([
            'NIP'         => $request->nip,
            'password'    => Hash::make($request->nip),
            'nama'        => $request->nama,
            'jk'          => $request->input('jeniskelamin'),
            'agama'       => $request->agama,
            'notelp'      => $request->notelp,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir'    => $request->tgllahir,
            'foto'        => $filegambar,
            'alamat'      => $request->alamat,
            'jabatan'     => $request->jabatan,

        ]);
        return redirect('/data-pegawai')->with('toast_success', 'Data Pegawai Berhasil di Tambahkan');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.datapegawai.edit', [
            'user'      => $user
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = [
            'NIP'         => $request->nip,
            'password'    => Hash::make($request->nip),
            'nama'        => $request->nama,
            'jk'          => $request->input('jeniskelamin'),
            'agama'       => $request->agama,
            'notelp'      => $request->notelp,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir'    => $request->tgllahir,
            'alamat'      => $request->alamat,
            'jabatan'     => $request->jabatan,

        ];

        if ($request->hasFile('foto')) {
            @mkdir(base_path('public/assets/img/pegawai'), 0777, true);
            $tujuan_upload = base_path('public/assets/img/pegawai');
            $file = $request->file('foto');
            $filegambar = time() . "_" . $file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload, $filegambar);

            $folderDir1 = $tujuan_upload . '/' . $user->foto;
            File::delete($folderDir1);
            //update post with new image
            $data['foto'] = $filegambar;
        }

        $user->update($data);
        return redirect('/data-pegawai')->with('toast_success', 'Data Pegawai Berhasil di Ubah');
    }
    public function destroy($id)
    {
        $user = User::find($id);

        //delete data
        $tujuan_upload = 'assets/img/pegawai/' . $user->foto;
        if (File::exists($tujuan_upload)) {
            File::delete($tujuan_upload);
        }
        //delete data
        $user->delete();

        return redirect('/data-pegawai')->with('toast_success', 'Data Pegawai Berhasil di Hapus');
    }

    public function lihat()
    {
        $user = User::all();
        return view('pages.datapegawai.lihat', [
            'user'      => $user
        ]);
    }
}
