<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\School;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::latest()->get();

        return response(['data' => $schools ], 200);
    }

    public function store(SchoolRequest $request)
    {
        $school = School::create($request->all());

        return response(['data' => $school ], 201);

    }

    public function show($id)
    {
        $school = School::findOrFail($id);

        return response(['data', $school ], 200);
    }

    public function update(SchoolRequest $request, $id)
    {
        $school = School::findOrFail($id);
        $school->update($request->all());

        return response(['data' => $school ], 200);
    }

    public function destroy($id)
    {
        School::destroy($id);

        return response(['data' => null ], 204);
    }
}
