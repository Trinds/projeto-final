<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Resources\TestResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $tests = Test::with('test_type', 'evaluation')->get();
            return response()->json(TestResource::collection($tests), 200);
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
            $test = Test::create($request->all());
            return response()->json(new TestResource($test), 201);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        try{
            $test = Test::with('test_type')->findOrFail($test->id);
            return response()->json(new TestResource($test), 200);
        }catch(ModelNotFoundException $e) {
            return response()->json(['message' => 'Test not found'], 404);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        try{
            $test = Test::findOrFail($test->id);
            $test->update($request->all());
            $test->load('test_type');
            return response()->json(new TestResource($test), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        try{
            $test->delete();
            return response()->json(['Test deleted successfully'], 205);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
}
