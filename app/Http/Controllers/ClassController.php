<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Class;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Class::latest()->get();

        return response(['data' => $classes ], 200);
    }

    public function store(ClassRequest $request)
    {
        $class = Class::create($request->all());

        return response(['data' => $class ], 201);

    }

    public function show($id)
    {
        $class = Class::findOrFail($id);

        return response(['data', $class ], 200);
    }

    public function update(ClassRequest $request, $id)
    {
        $class = Class::findOrFail($id);
        $class->update($request->all());

        return response(['data' => $class ], 200);
    }

    public function destroy($id)
    {
        Class::destroy($id);

        return response(['data' => null ], 204);
    }
}
