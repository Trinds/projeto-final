<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use Exception;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $students = Student::all();
            return response()->json(StudentResource::collection($students), 200);
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
        $validator = $this->validateStudentRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $student = Student::create($request->all());
            return response()->json(new StudentResource($student), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
            
            try{
                $student->load('classroom');
                return response()->json(new StudentResource($student), 200);
            }catch(Exception $e){
                return response()->json(['message' => $e], 500);
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $inputData = $request->only(array_keys($request->all()));
        $validationRules = [];
        foreach ($inputData as $field => $value) {
            if ($field === 'student_number') {
                $validationRules[$field] = 'required|max:50';
            } else if ($field === 'classroom_id') {
                $validationRules[$field] = 'required|exists:classrooms,id|max:50';
            } else if ($field === 'email') {
                $validationRules[$field] = 'required|email|unique:students,email|max:50,' . $student->id;
            } else if ($field === 'name') {
                $validationRules[$field] = 'required|max:50';
            } elseif ($field === 'birth_date') {
                $validationRules[$field] = 'required|date|before:today';
            }

        }
        $customMessages = [];
        foreach ($inputData as $field => $value) {
            $customMessages[$field . '.required'] = 'O campo ' . $field . ' é obrigatório.';
            $customMessages[$field . '.max'] = 'O campo ' . $field . ' não pode exceder os 50 caracteres.';
            $customMessages[$field . '.email'] = 'Deve introduzir um email válido.';
            $customMessages[$field . '.unique'] = 'O email introduzido já existe.';
            $customMessages[$field . '.exists'] = 'Não existe uma turma com esse valor.';
            $customMessages[$field . '.date'] = 'Deve introduzir uma data válida.';
            $customMessages[$field . '.before'] = 'A data introduzida deve ser anterior à data atual.';
        }
        $validator = Validator::make($inputData, $validationRules, $customMessages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        try {
            $student->update($inputData);
            $student->load('classroom');
            return response()->json(new StudentResource($student), 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try{
            $student->delete();
            return response()->json(null, 204);
        }catch(Exception $e){
            return response()->json(['message' => 'Student deleted successfully'], 205);
        }
    }

    public function search($search_term)
    {
        try {
            return response()->json(StudentResource::collection(Student::where('name', 'like', '%' . $search_term . '%')->get()), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    private function validateStudentRequest(Request $request)
    {
        $rules = [
            'student_number' => 'required|max:50',
            'classroom_id' => 'required|exists:classrooms,id',
            'email' => 'required|email',
            'name' => 'required|max:50',
            'birth_date' => 'required|date|before:today',
        ];
    
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O nome não pode ter mais de :max caracteres.',
            'email' => 'O email deve ser válido.',
            'date' => 'A data introduzida deve ser válida.',
            'before' => 'A data inserida deve ser anterior à data atual.',
            'exists' => 'Não existe uma turma com esse valor.',
        ];
    
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
