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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'Authc@login');
    Route::post('register', 'Authc@register');
    Route::post('logout', 'Authc@logout');
    Route::post('refresh', 'Authc@refresh');
    Route::get('user-profile', 'Authc@userProfile');
});

Route::prefix('admin')->group(function () {
    Route::post('assign/student', 'AdminController@assign_student');
    Route::get('user/list', 'AdminController@list');
});

Route::prefix('superadmin')->group(function () {
    Route::post('add/school', 'SuperAdminController@add_school');
    Route::post('neareststudent/teacher', 'SuperAdminController@teacher_students');
    Route::get('user/list', 'SuperAdminController@list');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('schools', 'SchoolController'); 
Route::apiResource('teachers', 'TeacherController'); 
Route::apiResource('classes', 'ClasssController'); 
Route::apiResource('students', 'StudentController'); 
Route::apiResource('courses', 'CourseController'); 
