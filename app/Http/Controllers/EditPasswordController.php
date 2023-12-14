<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditPasswordController extends Controller
{
    public function index()
    {
        return view('ubahpassword.ubah');
    }
    public function ubah(Request $request,$id)
    {
        
        $guru = Guru::where('id',$id)->first();
        // $guruu = $guru->nama;
        // dd($guruu);
        // dd($request->pwdbaru);
        if (!Hash::check($request->get('pwdlama'), $guru->password)) 
        {
            return back()->with('toast_error', "Password lama yang dimasukkan salah!");
        }elseif (strcmp($request->get('pwdlama'), $request->pwdbaru) == 0) 
        {
            return redirect()->back()->with("toast_error", "Password baru tidak boleh sama dengan password lama!");
        }elseif($request->pwdbaru != $request->pwdbaru2){

            return back()->with('toast_error', "Konfirmasi password baru salah!");

        }else{
            $guru->password =  Hash::make($request->pwdbaru);
            $guru->save();
            return back()->with('toast_success', "Password berhasil diubah!");
        }
   
    }
    public function ubahpwdsiswa(Request $request,$id)
    {
        
        $siswa = Siswa::where('id',$id)->first();
        // $guruu = $guru->nama;
        // dd($guruu);
        // dd($request->pwdbaru);
        if (!Hash::check($request->get('pwdlama'), $siswa->password)) 
        {
            return back()->with('toast_error', "Password lama yang dimasukkan salah!");
        }elseif (strcmp($request->get('pwdlama'), $request->pwdbaru) == 0) 
        {
            return redirect()->back()->with("toast_error", "Password baru tidak boleh sama dengan password lama!");
        }elseif($request->pwdbaru != $request->pwdbaru2){

            return back()->with('toast_error', "Konfirmasi password baru salah!");

        }else{
            $siswa->password =  Hash::make($request->pwdbaru);
            $siswa->save();
            return back()->with('toast_success', "Password berhasil diubah!");
        }
   
    }

}
