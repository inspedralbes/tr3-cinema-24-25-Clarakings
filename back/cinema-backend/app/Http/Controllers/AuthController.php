<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();

        $user->first_name = $fields['name'];
        $user->last_name = $fields['surname'];
        $user->birthday = $fields['birthday'];
        $user->phone_number = $fields['phone_number'];
        $user->email = $fields['email'];
        $user->password = bcrypt($fields['password']);

        $user->save();

        $token = $user->createToken($user['email'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check email
        $user = User::where('email', $fields['email'])->first();

        //Check password
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken($user['email'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
