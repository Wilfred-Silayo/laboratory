<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Privilege;

class PrivilegeController extends Controller
{
    public function index()
    {
        $privileges = Privilege::all();
        return response()->json($privileges);
    }

    public function store(Request $request)
    {
        $privilege = Privilege::create($request->all());
        return response()->json($privilege, 201);
    }

    public function show($id)
    {
        $privilege = Privilege::find($id);
        return response()->json($privilege);
    }

    public function update(Request $request, $id)
    {
        $privilege = Privilege::findOrFail($id);
        $privilege->update($request->all());
        return response()->json($privilege, 200);
    }

    public function destroy($id)
    {
        Privilege::destroy($id);
        return response()->json(null, 204);
    }
}
