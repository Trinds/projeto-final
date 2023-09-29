<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use Exception;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $roles = role::all();
            return response()->json(RoleResource::collection($roles), 200);
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
        $validator =$this->validateRoleRequest($request);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try{
            $role = role::create($request->all());
            return response()->json(new RoleResource($role), 201);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        try{
            return response()->json(new RoleResource($role), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator =$this->validateRoleRequest($request);
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 400);
            }
        try{
            $role->update($request->all());
            return response()->json(new RoleResource($role), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try{
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully'],205);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    private function validateRoleRequest(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
        ];
    
        $customMessages = [
            'required' => 'O campo role é obrigatório.',
            'max' => 'O campo role deve ter no máximo 50 caracteres.',
        ];
    
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
