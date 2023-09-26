<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use Exception;
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
        try{
            $student->update($request->all());
            return response()->json(new StudentResource($student), 200);
        }catch(Exception $e){
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
}
