<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();

        return response(['data' => $courses ], 200);
    }

    public function store(CourseRequest $request)
    {
        $course = Course::create($request->all());

        return response(['data' => $course ], 201);

    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        return response(['data', $course ], 200);
    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());

        return response(['data' => $course ], 200);
    }

    public function destroy($id)
    {
        Course::destroy($id);

        return response(['data' => null ], 204);
    }
}
