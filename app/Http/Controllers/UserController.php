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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->answers()->delete();
        foreach ($user->questions as $question) $question->variants()->delete();
        $user->questions()->delete();
        $user->delete();
        return redirect()->back();
    }
}
