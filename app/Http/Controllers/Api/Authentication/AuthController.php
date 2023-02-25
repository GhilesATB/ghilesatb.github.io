<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Exceptions\AuthFailException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentification\LoginRequest;
use App\Http\Requests\Authentification\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        if (!Auth::attempt($request->only(['name', 'password']))) {
            throw new AuthFailException('wrong credentials', Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken("user")->plainTextToken;
        $cookie = cookie('token', $token, 3600);

        return response()->json(['token' => $token], 200)->withCookie($cookie);
    }


    public function register(RegisterRequest $request): Response
    {
        $user = User::create(
            array_merge(
                $request->except('password'), [
                    'password' => Hash::make($request->password)
                ]
            )
        );

        return response($user, Response::HTTP_OK);
    }
}
