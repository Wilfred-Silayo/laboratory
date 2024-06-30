<?php

namespace App\Http\Controllers;

use App\Models\DiseaseTest;
use Illuminate\Http\Request;

class DiseasesTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DiseaseTest::query();
    
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('test_code', 'LIKE', "%{$search}%")
                  ->orWhere('test_name', 'LIKE', "%{$search}%")
                  ->orWhere('test_for', 'LIKE', "%{$search}%");
            });
        }
    
        $tests = $query->paginate(10);
        $pagination = view('pagination', ['users' => $tests])->render();
    
        if ($request->expectsJson()) {
            return response()->json([
                'tests' => $tests,
                'pagination' => $pagination,
            ]);
        }
    
        return view('diseases.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diseases.add-test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'test_code'=>['required','max:10','unique:'.DiseaseTest::class],
            'test_name'=>['required','string'],
            'test_for'=>['required','string'],
            'test_price'=>['required','numeric'],
        ]);

        DiseaseTest::create([
            'test_code'=> $request->test_code,
            'test_name'=> $request->test_name,
            'test_for'=> $request->test_for,
            'test_price'=> $request->test_price,
        ]);

        return redirect()->back()->with(['status'=>'Test registered successfully.']);
    }


    public function destroy(DiseaseTest $test)
    {
        $test->delete();
        return response()->json(['message' => 'Test deleted successfully', 'success' => true]);
    }

    public function edit(DiseaseTest $test)
    {
        return view('Diseases.edit', compact('test'));
    }

    public function update(Request $request, DiseaseTest $test)
{
    // Validate the incoming request data
    $request->validate([
        'test_code' => ['required', 'max:10', 'unique:' . DiseaseTest::class . ',test_code,' . $test->id],
        'test_name' => ['required', 'string'],
        'test_for' => ['required', 'string'],
        'test_price' => ['required', 'numeric'],
    ]);

    // Update the DiseaseTest instance with new data
    $test->update([
        'test_code' => $request->test_code,
        'test_name' => $request->test_name,
        'test_for' => $request->test_for,
        'test_price' => $request->test_price,
    ]);

    // Redirect back with a status message
    return redirect()->back()->with(['status' => 'Test updated successfully.']);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
}
