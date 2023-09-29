<?php

namespace App\Http\Controllers;

use App\Evaluation;
use Illuminate\Http\Request;
use App\Http\Resources\EvaluationResource;
use Exception;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $evaluations = Evaluation::all();
            return response()->json(EvaluationResource::collection($evaluations), 200);
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
        $validator = $this->validateEvaluationRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $evaluation = Evaluation::create($request->all());
            return response()->json(new EvaluationResource($evaluation), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        try{
            return response()->json(new EvaluationResource($evaluation), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $inputData = $request->only(array_keys($request->all()));
        $validationRules = [];
        foreach ($inputData as $field => $value) {
            if ($field == 'student_id') {
                $validationRules[$field] = 'required|exists:students,id';
            } else {
                $validationRules[$field] = 'required|numeric';
            }
        }
        $customMessages = [];
        foreach ($inputData as $field => $value) {
            $customMessages[$field.'.required'] = 'O campo '.$field.' é obrigatório.';
            $customMessages[$field.'.exists'] = 'Não existe Alunos com esse valor';
            $customMessages[$field.'.numeric'] = 'O campo score deve ser um número.';
        }
        $validator = Validator::make($request->all(), $validationRules, $customMessages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try{
            $evaluation->update($request->all());
            return response()->json(new EvaluationResource($evaluation), 200);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        try{
            $evaluation->delete();
            return response()->json(['message' => 'Evaluation deleted successfully'], 205);
        }catch(Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    private function validateEvaluationRequest(Request $request)
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'score' => 'required|numeric',
        ];
    
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'Não existe Alunos com esse valor',
            'numeric' => 'O campo score deve ser um número.',
        ];
    
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
