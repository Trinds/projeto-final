<?php

namespace App\Http\Controllers;

use App\Course;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // GET /courses
    {
        try{
            $courses = Course::all();
            return response()->json(CourseResource::collection($courses), 200);
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
    public function store(Request $request) // POST /courses
    {
        $validator = $this->validateCourseRequest($request);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $course = Course::create($request->all());
            return response()->json(new CourseResource($course), 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course) // GET /courses/{course}
    {
        try{
            return response()->json(new CourseResource($course),200);
        }catch(Exception $e){
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course) // PUT /courses/{course}
    {
        $validator = $this->validateCourseRequest($request);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $course->update($request->all());
            return response()->json(new CourseResource($course), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course) // DELETE /courses/{course}
    {
        try{
            $course->delete();
            return response()->json(['message' => 'Course deleted successfully'],205);
        }catch(Exception $e){
            return response()->json(['error' => $e], 500);
        }
    }

    // Search courses by name
    public function search($search_term) 
    {
        try {
            return response()->json(CourseResource::collection(Course::where('name', 'like', '%' . $search_term . '%')->get()), 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    // Validate course request
    private function validateCourseRequest(Request $request)
    {
        $rules = [
            'name' => 'required|max:250',
        ];
        $customMessages = [
            'required' => 'O nome é obrigatório.',
            'max' => 'O nome não pode exceder :max caracteres.',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }

    // Get classrooms from a course
    public function getClassrooms($course_id) // GET /course/{course_id}/classrooms
    {
        try {
            $course = Course::find($course_id);
            if (!$course) {
                return response()->json(['error' => 'Curso não encontrado'], 404);
            }
            $course->load('classrooms');
            $data = [
                'course' => new CourseResource($course),
                'classrooms' => $course->classrooms()->get()
            ];
            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }
}
