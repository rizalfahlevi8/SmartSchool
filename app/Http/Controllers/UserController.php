<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Import\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

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

        $role_from_db = explode(',', $user->role);
        $role_to_submit = [];
        $role_cocunter = count($request->roles);
        $updated_data = [];

        if (in_array('root', $role_from_db) && $user->id != auth()->user()->id) {
            return back()->with('toast_error', "Anda tidak memiliki akses untuk mengubah data ini");
        }

        foreach ($request->roles as $key => $role) {
            if (in_array($role, config('app.DB_user_roles'))) {
                array_push($role_to_submit, $role);
                if ($role_cocunter > 1) {
                    $role_cocunter -= 1;
                }
            }
        }

        if (in_array('root', $role_from_db) && !in_array('root', $role_to_submit)) {
            array_push($role_to_submit, 'root');
            if (!in_array('admin', $role_to_submit)) {
                array_push($role_to_submit, 'admin');
            }
        }

        if (count($role_to_submit) <= 0) {
            return back()->with('toast_error', "Role yang dimasukkan tidak ada yang valid");
        }

        if (!in_array($user->current_role, $role_to_submit)) {
            $updated_data['current_role'] = $role_to_submit[0];
        }

        $updated_data['role'] = implode(',', $role_to_submit);

        $user->update($updated_data);

        return back()->with('toast_success', "User: $user->username berhasil diperbarui");
    }
    public function reset(Request $request, User $user)
    {
        $hashedPassword = Hash::make($request->username);
        $data = [
            'password'      => $hashedPassword,
        ];
        $user->update($data);
        return redirect()->route('user_management')->with('toast_success', 'Password Berhasil di Reset');
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function showImportForm()
    {
        return view('pages.administrasi.data-user.import_form');
    }
    
    public function import(Request $request)
    {
        $file = $request->file('excel_file');
    
        Excel::import(new UsersImport(), $file, 'xlsx');
    
        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
