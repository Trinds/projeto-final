<?php

namespace App\Http\Controllers;

use App\Test_type;
use Illuminate\Http\Request;
use App\Http\Resources\TestTypeResource;
use Exception;

class TestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $test_types = Test_type::all();
            return response()->json(TestTypeResource::collection($test_types), 200);
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
try {
            $test_type = Test_type::create($request->all());
            return response()->json(new TestTypeResource($test_type), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test_type  $test_type
     * @return \Illuminate\Http\Response
     */
    public function show(Test_type $test_type)
    {
        try{
            return response() -> json(new TestTypeResource($test_type), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test_type  $test_type
     * @return \Illuminate\Http\Response
     */
    public function edit(Test_type $test_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test_type  $test_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test_type $test_type)
    {
        try{
            $test_type->update($request->all());
            return response()->json(new TestTypeResource($test_type), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test_type  $test_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test_type $test_type)
    {
        try{
            $test_type->delete();
            return response()->json(['message' => 'TestType deleted successfully'], 205);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
}
