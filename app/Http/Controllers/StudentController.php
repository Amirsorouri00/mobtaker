<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return response(['data' => $students ], 200);
    }

    public function store(StudentRequest $request)
    {
        $student = Student::create($request->all());

        return response(['data' => $student ], 201);

    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return response(['data', $student ], 200);
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return response(['data' => $student ], 200);
    }

    public function destroy($id)
    {
        Student::destroy($id);

        return response(['data' => null ], 204);
    }
}
