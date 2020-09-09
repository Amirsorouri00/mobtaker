<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasssRequest;
use App\Classs;

class ClasssController extends Controller
{
    public function index()
    {
        $classses = Classs::latest()->get();

        return response(['data' => $classses ], 200);
    }

    public function store(ClasssRequest $request)
    {
        $classs = Classs::create($request->all());

        return response(['data' => $classs ], 201);

    }

    public function show($id)
    {
        $classs = Classs::findOrFail($id);

        return response(['data', $classs ], 200);
    }

    public function update(ClasssRequest $request, $id)
    {
        $classs = Classs::findOrFail($id);
        $classs->update($request->all());

        return response(['data' => $classs ], 200);
    }

    public function destroy($id)
    {
        Classs::destroy($id);

        return response(['data' => null ], 204);
    }
}
