<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $storeUserRequest)
    {
        $storeUserRequest->validated($storeUserRequest->only(['name', 'email', 'password']));

        $user = User::create([
            'name' => $storeUserRequest->name,
            'email' => $storeUserRequest->email,
            'password' => Hash::make($storeUserRequest->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function login(LoginUserRequest $loginUserRequest)
    {
        $loginUserRequest->validated($loginUserRequest->only('email', 'password'));

        if (!Auth::attempt($loginUserRequest->only(['email', 'password']))) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $loginUserRequest->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        return response()->json('this is my logout method');
    }
}
