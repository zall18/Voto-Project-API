<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validate)) {
            $auth = Auth::user();
            $token = $auth->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'success to login account',
                'token' => $token,
                'data' => $auth
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'failed to login account'
            ], 400);
        }
        // }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'success to logout'
        ], 200);
    }

    public function dataMe(Request $request)
    {
        return response()->json($request->user());
    }
}
