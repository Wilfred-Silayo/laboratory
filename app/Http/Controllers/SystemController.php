<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $system = SystemSetting::where('id',1)->first();
        return view('system.index',['system'=>$system]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'system_name' => ['required', 'string','max:255'],
            'email' => ['required', 'string','max:255','unique:system_settings,email,' . $id],
            'phone' => ['required', 'string','max:255','unique:system_settings,phone,' . $id],
        ]);

        $record = SystemSetting::findOrFail($id);
        $record->update($request->all());

        return back()->with(['status'=>'System settings updated successfuly','type'=>'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
