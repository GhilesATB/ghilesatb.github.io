<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentification\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(
            array_merge(
                $request->except('password'), [
                    'password' => Hash::make($request->password)
                ]
            )
        );

        Auth::login($user);
        $token = $user->createToken("user")->plainTextToken;
        $cookie = cookie('token', $token, 3600);

        return response()->json(['token' => $token], Response::HTTP_OK)->withCookie($cookie);
    }
}
