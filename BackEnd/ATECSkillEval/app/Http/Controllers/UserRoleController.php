<?php

namespace App\Http\Controllers;

use App\User_role;
use Illuminate\Http\Request;
use App\Http\Resources\User_RoleResource;
use Exception;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $user_roles = User_role::all();
            return User_RoleResource::collection($user_roles);
        }catch(Exception $e){
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
        try{
            $user_role = User_role::create($request->all());
            return response()->json(new User_RoleResource($user_role), 201);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function show(User_role $user_role)
    {
        try{
            return response()->json(new User_RoleResource($user_role), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function edit(User_role $user_role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_role $user_role)
    {
        try{
            $user_role->update($request->all());
            return response()->json(new User_RoleResource($user_role), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User_role  $user_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_role $user_role)
    {
        try{
            $user_role->delete();
            return response()->json(['message' => 'UserRole deleted successfully'],205);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
}
