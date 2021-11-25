<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email','password');
        try {
            if (!JWTAuth::attempt($credentials)){
                $response['status'] = 0;
                $response['code'] = 400;
                $response['data'] = null;
                $response['message'] = 'E-mail ou mot de passe incorrect';
                return response()->json($response);
            }
        }catch (JWTException $e){
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Impossible de créer le Token';
            return response()->json($response);
        }

        $user = auth()->user();
        $data['token'] = auth()->claims([
            'user_id'            => $user->id,
            'email'              => $user->email
        ])->attempt($credentials);

        $response['data'] = $data;
        $response['status'] = 1;
        $response['code'] = 200;
        $response['message'] = 'Connectez-vous avec succès';
        return response()->json($response);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Déconnecté avec succès']);
    }

}
