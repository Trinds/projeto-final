<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Exception;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json(UserResource::collection($users), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            $user->roles()->attach($request->role_id);
            return response()->json(new UserResource($user), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            $user->load('roles');
            return response()->json(new UserResource($user), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->update($request->all());
            $user->load('roles');
            return response()->json(new UserResource($user), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 205);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function search($search_term)
    {
        try {
            return response()->json(UserResource::collection(User::where('name', 'like', '%' . $search_term . '%')->get()), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }
}
