<?php

namespace App\Http\Controllers;

use App\Models\Data_angkatan;
use App\Models\Detail_siswa;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas')->where('status', 'bukan pindahan')->orWhere('status', 'pindahan')->filter(request(['status', 'kelas']))->get();;
        $kelas = Kelas::all();
        return view('pages.administrasi.data-siswa.siswa', [
            'siswas'      => $siswa,
            'kelas'      => $kelas
        ])->with('title', 'Data Siswa');
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('pages.administrasi.data-siswa.tambah', [
            'agamas' => ['islam', 'kristen', 'buddha', 'konghucu', 'hindu'],
            'list_kelas'      => $kelas
        ])->with('title', 'Tambah siswa');
    }
    public function store(Request $request)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'data ini sudah digunakan'
        ];
        $validate_data = [
            'nama' => 'regex:/^[a-zA-Z\s]+$/',
            'nik' => 'required|unique:siswas',
            'nis' => 'required|unique:siswas',
            'nisn' => 'required|unique:siswas',
            "no_pendaftar" => 'required',
            "tempat_lahir" => 'required',
            "tanggal_lahir" => 'required',
            "jenis_kelamin" => 'required',
            "agama" => 'required',
            "nama_ayah" => 'required',
            "nama_ibu" => 'required',
            "nama_wali" => 'required',
            "kelas" => 'required',
            "no_telp" => 'required',
            "status" => 'required',
            "alamat" => 'required',
            "foto" => 'required',
        ];

        if ($request->status == 'pindahan') {
            $validate_data['asal_sekolah'] = 'required';
        }

        $this->validate(
            $request,
            $validate_data,
            $messages
        );


        $filegambar = null;

        if ($request->hasFile('foto')) {
            $tujuan_upload = 'storage/murid/img';
            $file = $request->file('foto');
            $filegambar = time() . "_" . $file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload, $filegambar);
        }

        $user_new = User::create([
            'username' => $request->nis,
            'email' => $request->nis . '@student.sch.id',
            'password'    => Hash::make($request->nis),
            'role' => 'siswa',
        ])->id;

        $siswa_new = Siswa::create([
            'nis'         => $request->nis,
            'nisn'        => $request->nisn,
            'nik'         => $request->nik,
            'no_pendaftar' => $request->no_pendaftar,
            'nama'    => $request->nama,
            'nama_ayah'    => $request->nama_ayah,
            'nama_ibu'    => $request->nama_ibu,
            'nama_wali'    => $request->nama_wali,
            'jenis_kelamin'          => $request->jenis_kelamin,
            'agama'       => $request->agama,
            'no_telp'      => $request->no_telp,
            'status'      => $request->status == 'pindahan' ? 'mutasi' : 'belum_lulus',
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'foto'        => $filegambar,
            'alamat'      => $request->alamat,
            'id_kelas'       => $request->kelas,
            'id_angkatan'       => Data_angkatan::firstWhere('tahun_masuk', now()->year)->id,
            'id_user'       => $user_new,
        ])->id;

        if ($request->status == 'pindahan') {

            $tanggal_masuk = now()->format('Y-m-d');
            $kelas = Kelas::find($request->kelas)->first()->nama_kelas;

            if ($request->has('tanggal_masuk')) {
                $tanggal_masuk = $request->tanggal_masuk;
            }
            Detail_siswa::create([
                'asal_sekolah' => $request->asal_sekolah,
                'tanggal_masuk' => $tanggal_masuk,
                'kelas_awal' => $kelas,
                'id_siswa' => $siswa_new,
            ]);
        }
        return redirect()->route('siswa_main')->with('toast_success', 'Data Siswa Berhasil di Tambahkan');
    }
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('pages.administrasi.data-siswa.edit', [
            'siswa'      => $siswa,
            'kelas_list'      => $kelas,
            'status_siswa' => ['lulus', 'belum lulus', 'mutasi', 'keluar'],
        ])->with('title', 'Data Siswa');
    }
    public function update(Request $request, Siswa $siswa)
    {
        $messages = [
            'regex' => ':attribute harus diisi dengan huruf saja',
            'unique' => 'data ini sudah digunakan'
        ];
        $validate_data = [
            'nama' => 'regex:/^[a-zA-Z\s]+$/',
            'nik' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            "tempat_lahir" => 'required',
            "tanggal_lahir" => 'required',
            "jenis_kelamin" => 'required',
            "agama" => 'required',
            "nama_ayah" => 'required',
            "nama_ibu" => 'required',
            "nama_wali" => 'required',
            "kelas" => 'required',
            "no_telp" => 'required',
            "alamat" => 'required',
        ];

        $validate_data['nik'] = $request->nik != $siswa->nik ? 'required|unique:siswas' : 'required';
        $validate_data['nis'] = $request->nis != $siswa->nis ? 'required|unique:siswas' : 'required';
        $validate_data['nisn'] = $request->nisn != $siswa->nisn ?  'required|unique:siswas' : 'required';

        $this->validate(
            $request,
            $validate_data,
            $messages
        );

        $data = [
            'nis'         => $request->nis,
            'nisn'        => $request->nisn,
            'nik'         => $request->nik,
            'nama'    => $request->nama,
            'nama_ayah'    => $request->nama_ayah,
            'nama_ibu'    => $request->nama_ibu,
            'nama_wali'    => $request->nama_wali,
            'jenis_kelamin'          => $request->jenis_kelamin,
            'agama'       => $request->agama,
            'no_telp'      => $request->no_telp,
            'status'      => $request->status,
            'sekolah'      => $request->asal_sekolah,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'alamat'      => $request->alamat,
            'id_kelas'       => $request->kelas,
        ];

        if ($request->hasFile('foto')) {
            $tujuan_upload = 'storage/murid/img/';
            $file = $request->file('foto');
            $filegambar = time() . "_ $siswa->nis _" . $file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload, $filegambar);

            $old_file = $tujuan_upload . $siswa->foto;
            File::delete($old_file);
            //update post with new image
            $data['foto'] = $filegambar;
        }

        $siswa->update($data);
        return redirect()->route('siswa_main')->with('toast_success', 'Data Siswa Berhasil di Ubah');
    }

    public function out_page()
    {
        $siswa = Siswa::where(function ($query) {
            $query->where('status', 'keluar')
                ->orWhere('status', 'lulus');
        })->filter(request(['nama', 'status']))->get();
        return view('pages.administrasi.data-siswa.keluar', [
            'siswas'      => $siswa
        ])->with('title', 'Siswa Keluar');
    }

    public function out(Request $request, Siswa $siswa)
    {
        $data = [
            'status'      => $request->status,
            'kelas'       => ''
        ];
        $siswa->update($data);
        return redirect()->route('siswa_out')->with('toast_success', 'Data Siswa Berhasil di Ubah');
    }
    public function destroy(Siswa $siswa)
    {
        //delete data
        $tujuan_upload = 'storage/murid/img' . $siswa->foto;
        if (File::exists($tujuan_upload)) {
            File::delete($tujuan_upload);
        }
        //delete data
        $siswa->delete();

        return redirect()->route('siswa_out')->with('toast_success', 'Data Siswa Berhasil di Hapus');
    }
}
