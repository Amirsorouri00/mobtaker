<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
use App\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->get();

        return response(['data' => $teachers ], 200);
    }

    public function store(TeacherRequest $request)
    {
        $teacher = Teacher::create($request->all());

        return response(['data' => $teacher ], 201);

    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return response(['data', $teacher ], 200);
    }

    public function update(TeacherRequest $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return response(['data' => $teacher ], 200);
    }

    public function destroy($id)
    {
        Teacher::destroy($id);

        return response(['data' => null ], 204);
    }
}
