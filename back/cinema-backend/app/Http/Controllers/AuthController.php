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
            'name' => 'required|string',
            'surname' => 'required|string',
            'birthday' => 'required',
            'phone_number' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User();

        $user->name = $fields['name'];
        $user->surname = $fields['surname'];
        $user->birthday =$fields['birthday'];
        $user->phone_number = $fields['phone_number'];
        $user->email = $fields['email'];
        $user->password = bcrypt($fields['password']);

        if (isset($fields['type'])) {
            $user->type = $fields['type'];
        }

        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        //$u = Auth::user();
        //$user = User::where('email', $request->email)->firstOrFail();
        //$token = $user->createToken('auth_token')->plainTextToken;
        $user = User::find(Auth::id());
        $t = $user->createToken('auth_token');
        $token = $t->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
