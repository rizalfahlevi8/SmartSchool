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
    
    // $usernames = User::where('role', $role)->pluck('username')->toArray();
    // return response()->json($usernames);

    $users = User::where('role', $role)->with(['guru', 'siswa'])->get();
    
    // Menggabungkan data dari model Guru dan Siswa
    $formattedUsers = $users->map(function ($user) {
        $nama = '';

        // Cek jika user memiliki relasi dengan model Guru atau Siswa
        if ($user->guru) {
            $nama = $user->guru->nama;
        } elseif ($user->siswa) {
            $nama = $user->siswa->nama;
        }

        return [
            'nama' => $nama,
            'username' => $user->username,
        ];
    });

    return response()->json($formattedUsers);

    }

    public function create(){

        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();

        // dd($userRoles);

        return view('pages.humas.tamu',[
            'title' =>  "tamu",
            'tamu'=> Tamu::get(),
            // 'tamus' => Tamu::latest('updated_at')->get(),
            'userRoles' => $userRoles,
            // 'usernamesWithNames' => $usernamesWithNames,
            
        ]);
    }
    
    public function kirim(Request $request){

        $tamu = new Tamu();

        // Dapatkan ID pengguna berdasarkan Opsi_lanjutan yang dipilih
        $selectedUsername = $request->Opsi_Lanjutan;
        $user = User::where('username', $selectedUsername)->first();

        if ($user) {
            $tamu->user_id = $user->id;
        }

        $tamu->nama = $request->namaTamu;
        $tamu->alamat = $request->alamatTamu;
        $tamu->Opsi_Tujuan = $request->Opsi;
        $tamu->Keterangan = $request->keteranganTamu;
        $tamu->Opsi_lanjutan = $request->Opsi_Lanjutan;
        $tamu->save();

        // dd($tamu);

        // disesuaikan dengan role pada AdminSeeder
        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();
        // dd($userRoles);

        $filteredTamus = Tamu::whereIn('Opsi_Tujuan', $userRoles)->get();
        // dd($filteredTamus);
        
        // return view('pages.humas.data-tamu',[
        //     // 'tamus' => Tamu::get(),
        //     // 'tamus' => Tamu::latest('updated_at')->get(),
        //     'tamus' => $filteredTamus,
        //     'title'=>"tamu",
        //     'userRoles' => $userRoles,

        // ]);
        return redirect('/data-tamu')->with([
            // 'tamus' => Tamu::get(),
            // 'tamus' => Tamu::latest('updated_at')->get(),
            'tamus' => $filteredTamus,
            'title'=>"tamu",
            'userRoles' => $userRoles,

        ]);

    }

    // ==============[ Data - tamu ]===============

    public function index() {

        // $userId = auth()->user()->id;
        // $selectedUsername = $request->input('Opsi_Lanjutan');

        // dd($selectedUsername);
    
        // if ($selectedUsername) {
        //     $tamu_tujuan = Tamu::with('user.guru', 'user.siswa')
        //         ->where('Opsi_lanjutan', $selectedUsername)
        //         ->orderByDesc('created_at')
        //         ->get();
        // } else {
        //     $tamu_tujuan = collect();
        // }

        // dd($tamu_tujuan);

        return view('pages.humas.data-tamu', [
    
        'title' => 'data-tamu',
        // 'tamus' => Tamu::get(),
        'tamus' => Tamu::latest('updated_at')->get(),

        ]);
     }
  
     public function edit($id)
     {
        // dd($tamu);

        $userRoles = User::select('role')->distinct()->get();
        $tamu = Tamu::find($id);

        return view('pages.humas.tamu-edit', [

            'tamu' => $tamu,
            // --- userRoles Sesuaikan dengan role pada AdminSeeder untuk menghilangkan admin
            'userRoles' => User::select('role')->distinct()->where('role', '!=', 'root,admin')->get(),

        ])->with('title', 'Update Data Tamu');
     }
     public function update(Request $request, $id){

        $tamu = Tamu::find($id);

        $selectedUsername = $request->Opsi_Lanjutan;
        $user = User::where('username', $selectedUsername)->first();

        if ($user) {
            $tamu->user_id = $user->id;
        }

        $tamu->nama = $request->namaTamu;
        $tamu->alamat = $request->alamatTamu;
        $tamu->Opsi_Tujuan = $request->Opsi;
        $tamu->Keterangan = $request->keteranganTamu;
        $tamu->Opsi_lanjutan = $request->Opsi_Lanjutan;
        $tamu->save();

        // dd($tamu);

        // disesuaikan dengan role pada AdminSeeder
        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();

        $filteredTamus = Tamu::whereIn('Opsi_Tujuan', $userRoles)->get();
        // dd($filteredTamus);
        

        return view('pages.humas.data-tamu',[

            'tamus' => $filteredTamus,
            'title'=>"tamu",
            'userRoles' => $userRoles,
            
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

        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();

        return view( 'pages.humas.daftar-tamu' ,[
            'userRoles' => $userRoles,
            'tamu'=> Tamu::get(),
            
        ]);
    }
    public function store(Request $request){

        $tamu = new Tamu();

        // Dapatkan ID pengguna berdasarkan Opsi_lanjutan yang dipilih
        $selectedUsername = $request->Opsi_Lanjutan;
        $user = User::where('username', $selectedUsername)->first();

        if ($user) {
            $tamu->user_id = $user->id;
        }

        $tamu->nama = $request->namaTamu;
        $tamu->alamat = $request->alamatTamu;
        $tamu->Opsi_Tujuan = $request->Opsi;
        $tamu->Keterangan = $request->keteranganTamu;
        $tamu->Opsi_lanjutan = $request->Opsi_Lanjutan;
        $tamu->save();

        // disesuaikan dengan role pada AdminSeeder
        $userRoles = User::select('role')->distinct()->where('role', '!=', 'root,admin')->get();
        // dd($userRoles);

        $filteredTamus = Tamu::whereIn('Opsi_Tujuan', $userRoles)->get();
        // dd($filteredTamus);
        
        return view('pages.auth.login',[

            'tamus' => $filteredTamus,
            // 'title'=>"tamu",
            'userRoles' => $userRoles,

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

