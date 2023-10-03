<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('courses', 'CourseController');
Route::apiResource('classrooms', 'ClassroomController');
Route::apiResource('users', 'UserController');
Route::apiResource('roles', 'RoleController');
Route::apiResource('students', 'StudentController');
Route::apiResource('tests', 'TestController');
Route::apiResource('test_types', 'TestTypeController');
Route::apiResource('evaluations', 'EvaluationController');
Route::get('/courses/search/{search_term}', 'CourseController@search');
Route::get('/classrooms/search/{search_term}', 'ClassroomController@search');
Route::get('/users/search/{search_term}', 'UserController@search');
Route::get('/students/search/{search_term}', 'StudentController@search');
Route::get('/course/{course_id}/classrooms', 'CourseController@getClassrooms');
Route::get('/classroom/{classroom_id}/students', 'ClassroomController@getStudents');
Route::get('/students/{student_id}/evaluations', 'StudentController@getEvaluations');

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');