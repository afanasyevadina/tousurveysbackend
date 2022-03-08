<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => collect($validator->errors())->map(function ($item) {
                    return $item[0];
                }),
            ])->setStatusCode(422);
        }
        $user = User::where('email', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            auth()->login($user);
            return response()->json([
                'data' => auth()->user()->only(['email', 'name', 'api_token']),
            ]);
        }
        return response()->json([
            'errors' => [
                'error' => 'Unauthorized',
            ]
        ])->setStatusCode(403);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => collect($validator->errors())->map(function ($item) {
                    return $item[0];
                }),
            ])->setStatusCode(422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(45),
        ]);
        auth()->login($user);
        return response()->json([
            'data' => auth()->user()->only(['email', 'name', 'api_token']),
        ]);
    }
}
