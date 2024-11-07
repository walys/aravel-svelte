<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('access_token');
            $dataUser = User::where('id', $token->accessToken['tokenable_id'])->get();
            return response()->json([
                'message' => 'Authorized',
                'token' => $token->plainTextToken,
                'dataAccessUser' => $dataUser,
            ],
            200
            );
        }
        return response()->json('Email ou password estão incorretos!', 403);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Token Revogado!', 200);
    }
}
