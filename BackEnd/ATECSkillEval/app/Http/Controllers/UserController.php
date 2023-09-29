<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Validator;
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
        $validator =$this->validateUserRequest($request);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
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
        $inputData = $request->only(array_keys($request->all()));
        $validationRules = [];
        foreach ($inputData as $field => $value) {
            if ($field == 'name' ) {
                $validationRules[$field] = 'required|max:50';
            }
            if ($field == 'email') {
                $validationRules[$field] = 'required|email|unique:users,email,' . $user->id . '|max:50';
            }
            if ($field == 'password') {
                $validationRules[$field] = 'required|max:50';
            }
            if ($field == 'role_id') {
                $validationRules[$field] = 'required|exists:roles,id';
            }
        }
        $customMessages = [];
        foreach ($inputData as $field => $value) {
            $customMessages[$field.'.required'] = 'O campo '.$field.' é obrigatório.';
            $customMessages[$field.'.email'] = 'O email introduzido não é válido.';
            $customMessages[$field.'.unique'] = 'O email introduzido já está em uso.';
            $customMessages[$field.'.exists'] = 'A role introduzida não existe.';
            $customMessages[$field.'.max'] = 'O campo '.$field.' não pode exceder :max caracteres.';
        }
        $validator = Validator::make($request->all(), $validationRules, $customMessages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
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

    private function validateUserRequest(Request $request)
    {
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|max:50',
            'role_id' => 'required|exists:roles,id',

        ];
    
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O email introduzido não é válido.',
            'unique' => 'O email introduzido já está em uso.',
            'exists' => 'A role introduzida não existe.',
            'max' => 'O campo :attribute não pode exceder :max caracteres.',
        ];
    
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
