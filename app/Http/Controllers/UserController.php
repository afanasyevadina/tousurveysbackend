<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('questions')->withCount('answers')->get();
        return view('users', [
            'users' => $users,
        ]);
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('user', [
            'user' => $user,
        ]);
    }
}
