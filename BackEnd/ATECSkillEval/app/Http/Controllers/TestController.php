<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Resources\TestResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

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
        $validator =$this->validateTestRequest($request);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }
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
        $inputData = $request->only(array_keys($request->all()));
        $validationRules = [];
        foreach ($inputData as $field => $value) {
            if ($field == 'evaluation_id') {
                $validationRules[$field] = 'required|exists:evaluations,id';
            } else if ($field == 'test_type_id') {
                $validationRules[$field] = 'required|exists:test_types,id';
            } else if ($field == 'date') {
                $validationRules[$field] = 'required|date';
            } else {
                $validationRules[$field] = 'required';
            }
        }
        $customMessages = [];
        foreach ($inputData as $field => $value) {
            $customMessages[$field.'.required'] = 'O campo '.$field.' é obrigatório.';
            $customMessages[$field.'.exists'] = 'A '.$field.' introduzida não existe.';
            $customMessages[$field.'.date'] = 'A data introduzida não é válida.';
        }
        $validator = Validator::make($request->all(), $validationRules, $customMessages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

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

    private function validateTestRequest(Request $request)
    {
        $rules = [
            'evaluation_id' => 'required|exists:evaluations,id',
            'test_type_id' => 'required|exists:test_types,id',
            'date' => 'required|date',
        ];
    
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'A data introduzida não é válida.',
            'exists' => 'A :attribute introduzida não existe.',
            
        ];
    
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
