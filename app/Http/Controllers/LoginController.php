<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        // return view('pages.auth.login');
    }
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $role_array = array_values(array_filter(explode(',', auth()->user()->role), function ($value) {
                return $value !== 'root';
            }));

            if (auth()->user()->current_role == null) {
                DB::table('users')->where('id', '=', auth()->user()->id)->update(['current_role' => $role_array[0]]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('toast_error', 'Username atau Password salah !')->withInput();
    }

    public function setRole(Request $request)
    {
        $role = $request->role;

        if (!in_array($role, explode(',', auth()->user()->role))) {
            return back()->with('toast_error', 'Gagal mengubah role.');
        }
        DB::table('users')->where('id', '=', auth()->user()->id)->update(['current_role' => $role]);

        return redirect()->route('dashboard')->with('title', 'Dashboard')->with('toast_success', "Kamu sekarang " . ucfirst($role));
    }
}
