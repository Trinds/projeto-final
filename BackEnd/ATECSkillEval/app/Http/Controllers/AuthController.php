<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        $request = $request->validated($request->all());

        $user = User::create(
            [
                'name' => $request['name'],
                'email' => $request['email'],
                'image' => $request['image'],
                'password' => ($request['password']),
            ]
        );

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }
    public function login(LoginUserRequest $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Attempt to authenticate the user
        $user = User::where('email', $request->email)->first();

        // Check if the password is correct

        if (!$user || $request->password !== $user->password) {
            return $this->error('Authentication failed', 'Email or password is incorrect', 401);
        }

        // Generate a personal access token for the user
        $token = $user->createToken('API token of ' . $user->name);
    
        return $this->success([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
}

}
