<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.administrasi.data-user.index', [
            'users' => User::all(),
        ])->with('title', 'User Management');
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'roles' => 'required',
        ]);

        $role_str = '';
        $role_str_cocunter = count($request->roles);
        foreach ($request->roles as $key => $role) {
            if (in_array($role, config('app.DB_user_roles'))) {
                $role_str .= $role;
                if ($role_str_cocunter > 1) {
                    $role_str .= ',';
                    $role_str_cocunter -= 1;
                }
            }
        }

        if (strlen($role_str) <= 0) {
            return back()->with('toast_error', "Role yang dimasukkan tidak ada yang valid");
        }

        $user->update([
            'role' => $role_str,
        ]);

        return back()->with('toast_success', "User: $user->username berhasil diperbarui");
    }
}
