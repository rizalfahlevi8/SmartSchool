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
        return view('pages.user.settings.password.ubah')->with('title', 'Ubah Password');
    }
    public function ubah(Request $request, User $user)
    {
        if (!Hash::check($request->get('old_password'), $user->password)) {
            return back()->with('toast_error', "Password lama yang dimasukkan salah!");
        } elseif (strcmp($request->get('old_password'), $request->new_password) == 0) {
            return redirect()->back()->with("toast_error", "Password baru tidak boleh sama dengan password lama!");
        } elseif ($request->new_password != $request->new_password_confirm) {
            return back()->with('toast_error', "Konfirmasi password baru salah!");
        } else {
            $user->password =  Hash::make($request->new_password);
            $user->save();
            return back()->with('toast_success', "Password berhasil diubah!");
        }
    }
}
