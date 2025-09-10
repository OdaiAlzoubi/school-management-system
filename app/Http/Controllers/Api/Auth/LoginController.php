<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Soft\ApiResponse\Factories\ApiResponseFactory;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $data = $request->validated();
            if (!Auth::attempt($data))
                return ApiResponseFactory::error()->message('Invalid credentials')->statusCode(401)->toJson();
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return ApiResponseFactory::success()->data(['token' => $token,'role'=>$user->roles->first()->name])->statusCode(200)->toJson();
        });
    }
    public function logout()
    {
        return $this->handleApi(function () {
            Auth::user()->tokens()->delete();
            return ApiResponseFactory::success()->message('User logged out successfully')->statusCode(200)->toJson();
        });
    }
}
