<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Teacher;
use App\Student;
use App\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{   
	public function __construct()
	{
		$this->middleware('auth:api');
    }
    
    public function assign_student(Request $request)
	{
        if ($request->user()->hasRole('Admin') || $request->user()->hasRole('SuperAdmin')) {
            $stdID = $request->input('student_id');
            $teacherID = $request->input('teacher_id');

            $student = Student::where('id', $stdID)->first();
            $teacher = Teacher::where('id', $teacherID)->first();

            $teacher->students()->save($student);
            return response(['data' => 'successfully added to the teacher'], 201);
        }
    }

    public function list(Request $request)
	{
        if ($request->user()->hasRole('Admin') || $request->user()->hasRole('SuperAdmin')) {
            $list = Teacher::with('students')->get();

            return response(['data' => $list], 201);
        }
        return response(['data' => $request->user()], 201);
    }
}