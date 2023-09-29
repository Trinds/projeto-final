<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Resources\ClassroomResource;
use Exception;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $classrooms = Classroom::all();
            return response()->json(ClassroomResource::collection($classrooms), 200);
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
        $validator = $this->validateClassroomRequest($request);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $classroom = Classroom::create($request->all());
            return response()->json(new ClassroomResource($classroom), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        try {
            return response()->json(new ClassroomResource($classroom), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $inputData = $request->only(array_keys($request->all()));
        $validationRules = [];

        foreach ($inputData as $field => $value) {
            if ($field === 'course_id') {
                $validationRules[$field] = 'required|exists:courses,id';
            } else if ($field === 'edition') {
                $validationRules[$field] = 'required|unique:classrooms,edition|max:50,' . $classroom->id;
            } else if ($field === 'start_date' || $field === 'end_date') {
                $validationRules[$field] = 'required|date';
            } else {
                $validationRules[$field] = 'required';
            }
                
        }
        $customMessages = [];
        foreach ($inputData as $field => $value) {
            $customMessages[$field . '.required'] = 'O campo ' . $field . ' é obrigatório.';
            $customMessages[$field . '.date'] = 'O campo ' . $field . ' deve ser uma data válida.';
            $customMessages[$field . '.unique'] = 'O campo ' . $field . ' deve ser único.';
            $customMessages[$field . '.exists'] = 'O campo ' . $field . ' deve existir na tabela cursos.';
            $customMessages[$field . '.max'] = 'O campo ' . $field . ' não pode exceder os 50 caracteres.';
        }
        $validator = Validator::make($inputData, $validationRules, $customMessages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        try {
            $classroom->update($inputData);
            $classroom->load('course');
            return response()->json(new ClassroomResource($classroom), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();
            return response()->json(['message' => 'Classroom deleted successfully'], 205);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function search($search_term)
    {
        try {
            return response()->json(ClassroomResource::collection(Classroom::where('edition', 'like', '%' . $search_term . '%')->get()), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    private function validateClassroomRequest(Request $request)
    {
        $rules = [
            'course_id' => 'required|exists:courses,id',
            'edition' => 'required',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
        ];
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'date' => 'A data deve ser válida.',
            'before' => 'A data de início deve ser anterior à data de fim.',
            'after' => 'A data de fim deve ser posterior à data de início.',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
