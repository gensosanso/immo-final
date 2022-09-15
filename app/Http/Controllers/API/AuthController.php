<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            return ApiResponse::error('Désolé, ce compte n\'existe pas.');
        }

        $credentials = $request->only('email', 'password');

        $remember = false;

        if ($request->has('remember')) {
            if ($request->remember == 'on') {
                $remember = true;
            }
        }

        if (Auth::attempt($credentials, $remember)) {
            return ApiResponse::done(['authenticated' => true, 'user' => $user]);
        }
        
        return ApiResponse::error('Mot de passe incorrect.');
    }

    function register(Request $request)
    {
        
            $comptExist = User::where('email', $request->email)->first();

            if (!empty($comptExist)) {
                return ApiResponse::error("L\'email  est déjà utilisé pour un compte, veuillez réessayer.");
            }
    
                $compte = [
                    "nom" => $request->nom,
                    "prenom" => $request->prenom,
                    "email" => $request->email,
                    "genre" => $request->genre,
                    "telephone" => $request->telephone,
                    "password" => Hash::make($request->password)
                ];
                $user = User::create($compte);

                // $token = $user->createToken('LaravelAuthApp')->accessToken;

    
        return ApiResponse::done(["compte crée avec success",'user' => $user->id]);
    }


    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
