<?php 

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\User;


use Illuminate\Http\Request;



class TamuController extends Controller 
{
    
    // ==============[ Daftar-tamu via Admin ]===============

    // Untuk Role
    public function getUsernamesByRole($role){
    
    $usernames = User::where('role', $role)->pluck('username')->toArray();
    return response()->json($usernames);
    
    }

    public function create(){
        // return view('pages.humas.tamu')->with('title', 'tamu');
        // dd(Tamu::get());

        // dd($userRoles);

        // $namaUserGuru = User::select('username')->where('role','guru')->get();
        // $namaUserSiswa = User::select('username')->where('role','siswa')->get();
        // // $filterRoles = $allRoles->reject(function ($role){
        // //     return $role->role == 'admin';
        // // });

        //  // Ambil semua role kecuali "admin"
        // $userRoles = User::where('role')->pluck('role')->toArray();

        // disesuaikan dengan role pada AdminSeeder
        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();

        // dd($userRoles);

        return view('pages.humas.tamu',[
            'title' =>  "tamu",
            'tamu'=> Tamu::get(),
            'userRoles' => $userRoles,
            
            // 'namaUserGuru' => $namaUserGuru,
            // 'namaUserSiswa' => $namaUserSiswa,
            
        ]);
    }
    
    public function kirim(Request $request){

        $tamu = new Tamu();

        $tamu->nama = $request->namaTamu;
        $tamu->alamat = $request->alamatTamu;
        $tamu->Opsi_Tujuan = $request->Opsi;
        $tamu->Keterangan = $request->keteranganTamu;
        $tamu->save();

        // disesuaikan dengan role pada AdminSeeder
        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();
        
        return view('pages.humas.data-tamu',[
            'tamus' => Tamu::get(),
            'title'=>"tamu",
            'userRoles' => $userRoles,

            // 'namaUserGuru' => User::select('username')->where('role', 'guru')->get(),
            // 'namaUserSiswa' => User::select('username')->where('role','siswa')->get(),
        ]);

    //     // Ambil opsi yang dipilih
    //     $selectedOption = Option::findOrFail($request->role);

    //     // Pastikan opsi yang dipilih bukan "admin"
    //     if ($selectedOption->name === 'admin') {
    //      return response()->json(['error' => 'Anda tidak dapat memilih opsi "admin"'], 422);
    // }

    }

    // ==============[ Data - tamu ]===============

    public function index() {

        // dd(Tamu::get());

        return view('pages.humas.data-tamu', [
    //        'data-tamu' => Tamu::orderBy('created_at')->get(),
    //    ])->with('title', 'data-tamu'); 
        'title' => 'data-tamu',
        'tamus' => Tamu::get()
        ]);
     }
  
     public function edit($id)
     {
        // dd($tamu);

        $userRoles = User::select('role')->distinct()->get();
        $tamu = Tamu::find($id);

        return view('pages.humas.tamu-edit', [
            'tamu' => $tamu,
            // 'tujuans' => ['Kepala Sekolah','Wakil Kepala Sekolah','Guru','Siswa'],
            'userRoles' => User::select('role')->distinct()->where('role', '!=', 'admin')->get(),
            // 'title' => 'tamu-edit'
        ])->with('title', 'Update Data Tamu');
     }
     public function update(Request $request, $id){

        $tamu = Tamu::find($id);

        $tamu->nama = $request->namaTamu;
        $tamu->alamat = $request->alamatTamu;
        $tamu->Opsi_Tujuan = $request->Opsi;
        $tamu->Keterangan = $request->keteranganTamu;
        $tamu->save();
        

        return view('pages.humas.data-tamu',[

            'tamus' => Tamu::get(),
            'userRoles' => User::select('role')->distinct()->get(),
            'userRoles' => User::select('role')->distinct()->where('role', '!=', 'admin')->get(),
        ])->with('title', 'update sukses');
        
        // return view('pages.humas.tamu-edit', [
        //     'id',
        //     'nama',
        //     'alamat',
        //     'Opsi_Tujuan' => ['Kepala Sekolah','Wakil Kepala Sekolah','Guru','Siswa'],
        //     'Keterangan',
        //     'tamu' => $tamu
        //  ])->with('title', 'Update Data Tamu', $tamu -> save());
     }
  
     public function delete(Tamu $tamu)
     {
        // $tamu = Tamu::find($id);
        
        $tamu->update(['deleted' => 1]);
        Tamu::find($tamu->id)->delete();

        return redirect('/data-tamu')->with('toast_success', 'Data Tamu Berhasil di Hapus');
  
        // return view('pages.humas.data-tamu',[
        //     'tamus' => Tamu::get(),
        // ])->with('title', 'Data Tamu Berhasil Dihapus');
        
     }

     // ==============[ Daftar-tamu dari login ]===============
   
     public function daftar(){

        $userRoles = User::select('role')->distinct()->get();
        $userRoles = User::select('role')->distinct()->where('role','!=','admin')->get();
        $namaUserGuru = User::select('username')->where('role','guru')->get();
        $namaUserSiswa = User::select('username')->where('role','siswa')->get();

        return view( 'pages.humas.daftar-tamu' ,[
            'userRoles' => $userRoles,
            'namaUserGuru' => $namaUserGuru,
            'namaUserSiswa' => $namaUserSiswa,
            'tamu'=> Tamu::get(),
            
        ]);
    }
    public function store(Request $request){

        $daftar_tamu = new Tamu();

        $daftar_tamu->nama = $request->namaTamu;
        $daftar_tamu->alamat = $request->alamatTamu;
        $daftar_tamu->Opsi_Tujuan = $request->Opsi;
        $daftar_tamu->Keterangan = $request->keteranganTamu;
        $daftar_tamu->save();
        
        return view('pages/humas/daftar-tamu',[
            'userRoles' => User::select('role')->distinct()->get(),
            'namaUserGuru' => User::select('username')->where('role', 'guru')->get(),
            'namaUserSiswa' => User::select('username')->where('role','siswa')->get(),
            'userRoles' => User::select('role')->distinct()->where('role','!=','admin')->get(),
        ]);
    }


}


 // ==============[ D a t a - cek]===============
    // public function index(){
    //     $tamu_table = Tamu::paginate(10);
    //     return response()->json([
    //         'data' => $tamu_table
    //     ]);
    // }
    // public function store(Request $request){
    //     $tamu= Tamu::create([
    //         'nama'=> $request->nama,
    //         'alamat'=> $request->alamat,
    //         'OpsiTujuan'=>$request->Opsi,
    //         'Keterangan'=>$request->Keterangan
    //     ]);
    //     return response()->json([
    //         'data' => $tamu
    //     ]);
    // }
    // public function show(Tamu $tamu){
    //     return response()->json([
    //         'data'=> $tamu
    //     ]);
    // }
    // public function update(Request $request, Tamu $tamu){
    //     $tamu->nama = $request->nama;
    //     $tamu->alamat = $request->alamat;
    //     $tamu->OpsiTujuan = $request->Opsi;
    //     $tamu->Keterangan = $request->Keterangan;
    //     $tamu->save();

    //     return response()->json([
    //         'data'=> $tamu
    //     ]);
    // }
    // public function destroy(Tamu $tamu){
    //     $tamu->delete();
    //     return response()->json([
    //         'message' => 'customer deleted'
    //     ]);

    // }

