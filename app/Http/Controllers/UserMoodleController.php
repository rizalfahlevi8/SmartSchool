<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoodleUser;

class MoodleUserController extends Controller
{
    public function index()
{
    $users = MoodleUser::all();
    return view('administrasi.data-user-moodle.index-user-moodle', compact('users'));
}
}