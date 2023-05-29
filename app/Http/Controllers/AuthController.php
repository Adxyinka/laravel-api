<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
    ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];

        return \Response::json([
            'user' => $user,
            'token' => $token,
            'status' => 201
        ]);
    }

    public function login(Request $request) 
    {
        $fields = $request->validate([
            'email' => 'required|string|',
            'password' => 'required|string'
        ]);
            // Check email
            $user = User::where('email', $request->email)->first();

            // Check Password
            if(!$user || !Hash::check($fields['password'], $user->password) ) {
                return \Response::json([
                    'message' => 'Incorrect email or password',
                    'status' => 401
                ]);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;

            return \Response::json([
                'user' => $user,
                'token' => $token
            ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'User Logged out'
        ];
    }
}
