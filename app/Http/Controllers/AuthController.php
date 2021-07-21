<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        if (Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();
            $token = $user->createToken('admin')->accessToken;

            $cookie = cookie('jwt', $token, 3600);
            // return[
            //     'token' => $token,
            // ];

            return response(['token' => $token])->cookie($cookie);
        }

        return response([
            'error' => 'Credenciales invalidos'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response(['message' => 'success'])->cookie($cookie);
    }

    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->only('first_name', 'last_name', 'email') + [
            'role_id' => 1,
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, Response:: HTTP_CREATED);
    }
}