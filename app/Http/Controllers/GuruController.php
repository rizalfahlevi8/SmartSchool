<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::where('deleted', 0)->get();
        return view('pages.administrasi.data-guru.guru', [
            'gurus'      => $guru
        ])->with('title', 'Data Guru');
    }

    public function create()
    {
        return view('pages.administrasi.data-guru.tambah', [
            'agamas' => ['islam', 'kristen', 'buddha', 'konghucu', 'hindu'],
            'status_gurus' => ['honorer', 'tetap', 'magang'],
        ])->with('title', 'Tambah Data Guru');
    }

    public function store(Request $request)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'Data ini sudah digunakan',
            'required' => 'Harap isi kolom',
        ];

        $this->validate($request, [
            'nip' => 'required',
        ], $messages);

        //apakah NIP sudah terpakai
        $guru_new = Guru::where('nip', $request->nip)->where('deleted', 1);


        // jika sudah terpakai maka perbarui data
        if (count($guru_new->get()) > 0) {
            $user = User::create([
                'username' => $request->nip,
                'email' => $request->nip . '@school.teacher.com',
                'password' => Hash::make($request->nip),
                'role' => 'guru',
            ])->id;

            $guru_new->update(['deleted' => 0, 'id_user' => $user]);
            return redirect('/administrasi/guru')->with('toast_success', 'Data Guru Berhasil di Tambahkan')->with('title', 'Daftar Guru');
        }

        $this->validate($request, [
            'nama' => 'regex:/^[a-zA-Z\s.,]+$/',
            'nip' => 'required|unique:gurus',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required|unique:gurus',
            "agama" => 'required',
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required|date",
            "alamat.provinsi" => "required",
            "alamat.kabupaten" => "required",
            "alamat.kecamatan" => "required",
            "alamat.desa" => "required",
            "status" => "required",
            'signature' => 'required',
            "foto" => "required",
        ], $messages);

        $alamat_fix = '';
        $alamat_value_counter = 1;
        foreach ($request->input('alamat') as $key => $alamat_value) {
            // if (strtolower($key) !== 'lanjutan') {
            //     $alamat_fix .= ucfirst($key) . ' ' . $alamat_value;
            // } else {
            //     $alamat_fix .= $alamat_value;
            // }
            $alamat_fix .= ucfirst($alamat_value);
            if ($alamat_value_counter !== count($request->alamat)) {
                $alamat_fix .= ', ';
            }
            $alamat_value_counter += 1;
        }

        $filegambar = 'default_img.png';
        $filesignature = 'default_signature.png';

        if ($request->hasFile('foto')) {
            $tujuan_upload = 'storage/guru/img/';
            $file = $request->file('foto');
            $filegambar = time() . "_" . $file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload, $filegambar);
        }
        if ($request->has('signature')) {
            $signatureData = $request->input('signature');
            $file_path = 'storage/guru/signatures/';
            $filesignature = time() . "_$request->nip" . "_signature.png";
            $signature = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
            $result_file = file_put_contents($file_path . $filesignature, $signature);
            // $file_signature = Storage::disk('public')->put('storage/guru/signatures/' . $filesignature, $signature);
        }
        $user = User::create([
            'username' => $request->nip,
            'email' => $request->nip . '@school.teacher.com',
            'password' => Hash::make($request->nip),
            'role' => 'guru',
        ]);

        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'foto' => $filegambar,
            'alamat' => $alamat_fix,
            'signature' => $filesignature,
            'status' => $request->status,
            'id_user' => $user->id,
        ]);

        return redirect('/administrasi/guru')->with('toast_success', 'Data Guru Berhasil di Tambahkan')->with('title', 'Daftar Guru');
    }
    public function edit(Guru $guru)
    {
        return view('pages.administrasi.data-guru.edit', [
            'agamas' => ['islam', 'kristen', 'buddha', 'konghucu', 'hindu'],
            'status_gurus' => ['honorer', 'tetap', 'magang'],
            'guru'      => $guru
        ])->with('title', 'Update Data Guru');
    }
    public function update(Request $request, Guru $guru)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'Data ini sudah digunakan'
        ];

        $this->validate($request, [
            'nama' => 'regex:/^[a-zA-Z\s.,]+$/',
            "alamat" => "required",
            "alamat.provinsi" => "required",
            "alamat.kabupaten" => "required",
            "alamat.kecamatan" => "required",
            "alamat.desa" => "required",
            "status" => "required",
        ], $messages);

        $alamat_fix = '';
        $alamat_value_counter = 1;
        foreach ($request->input('alamat') as $key => $alamat_value) {
            // if (strtolower($key) !== 'lanjutan') {
            //     $alamat_fix .= ucfirst($key) . ' ' . $alamat_value;
            // } else {
            //     $alamat_fix .= $alamat_value;
            // }
            $alamat_fix .= ucfirst($alamat_value);
            if ($alamat_value_counter !== count($request->alamat)) {
                $alamat_fix .= ', ';
            }
            $alamat_value_counter += 1;
        }

        $data = [
            'nama'        => $request->nama,
            'alamat'      => $alamat_fix,
            'status'      => $request->status,
        ];

        if (count($guru->where('deleted', 0)->get()) > 0) {
            $guru->update($data);
        }
        return redirect('/administrasi/guru')->with('toast_success', 'Data Guru Berhasil di Ubah');
    }
    public function destroy(Guru $guru)
    {
        //delete data
        // $tujuan_upload = 'assets/img/pegawai/' . $guru->foto;
        // if (File::exists($tujuan_upload)) {
        //     File::delete($tujuan_upload);
        // }
        //delete data
        $guru->update(['deleted' => 1]);
        User::find($guru->user->id)->delete();

        return redirect('/administrasi/guru')->with('toast_success', 'Data Guru Berhasil di Hapus');
    }
}
