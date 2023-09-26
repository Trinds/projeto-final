<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\User;

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
    public function login()
    {
        return 'this is my login';
    }
}
