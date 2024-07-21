<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $query = Patient::where(function ($query) {
            // Patients with no consultations
            $query->orWhereDoesntHave('consultations')
            
            // Patients with latest consultation meeting specific stages
            ->orWhereHas('consultations', function ($subquery) {
                $subquery->where('id', function ($subsubquery) {
                    $subsubquery->select(DB::raw('MAX(id)'))
                                ->from('consultations')
                                ->whereColumn('patient_id', 'patients.id');
                })->where('order_status', 1)
                  ->where('lab_status', 1)
                  ->where('account_status', 1)
                  ->where('completed', 1);
            });
        });

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('occupation', 'LIKE', "%{$search}%")
                    ->orWhere('sex', 'LIKE', "%{$search}%");
            });
        }

        $patients = $query->orderBy('patients.created_at','desc')->paginate(10);
        $pagination = view('pagination', ['users' => $patients])->render();
        $privileges = Privilege::where('user_id', $userId)->first();
        if ($request->expectsJson()) {
            return response()->json([
                'patients' => $patients,
                'pagination' => $pagination,
                'privileges' => $privileges,
            ]);
        }
        return view('patients.index', compact('patients'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.add-patient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:15', 'unique:' . Patient::class],
            'address' => ['required', 'string','max:255'],
            'occupation' => ['required', 'string','max:255'],
        ]);

        $user = Patient::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'occupation' => $request->occupation,
        ]);

        return redirect()->route('patients.index')->with('status', 'Patient registred successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        Consultation::create([
            'patient_id'=>$patient->id,
        ]);

        return response()->json(['message' => 'Patient sent successfully', 'success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:15', 'unique:patients,phone,' . $patient->id],
            'address' => ['required', 'string', 'max:255',],
            'occupation' => ['required', 'string','max:255'],
        ]);

        $patient->update($request->all());

        return redirect()->back()->with(['status' => 'Patient updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'Patient deleted successfully', 'success' => true]);
    }
}
