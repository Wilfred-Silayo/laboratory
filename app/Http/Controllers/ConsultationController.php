<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\DiseaseTest;
use App\Models\Order;
use App\Models\Patient;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\View;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Consultation::query()
            ->where(function ($q) {
                // Consultations where all statuses are 0
                $q->where('order_status', 0)
                    ->where('lab_status', 0)
                    ->where('account_status', 0)
                    ->where('completed', 0);
            })
            ->orWhere(function ($q) {
                // Consultations where all statuses are 1 except completed
                $q->where('order_status', 1)
                    ->where('lab_status', 1)
                    ->where('account_status', 1)
                    ->where('completed', 0);
            })
            ->with('patient');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('sex', 'LIKE', "%{$search}%");
                });
            });
        }

        $consultations = $query->orderBy('created_at', 'desc')->paginate(10); // Adjust pagination limit as needed
        $pagination = view('pagination', ['users' => $consultations])->render();
        
        if ($request->expectsJson()) {
            return response()->json([
                'pagination' => $pagination,
                'consultations' => $consultations,
                'count' => $consultations->total(),
            ]);
        }

        return view('consultations.index', compact('consultations', 'pagination'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function saveResult(Request $request, Consultation $consultation)
    {
        $request->validate([
            'result_comment' => 'required|string|max:255',
        ]);

        // Update the consultation's lab_comment field
        $consultation->result_comment = $request->input('result_comment');
        $consultation ->completed = 1;
        $consultation->save();

        $results = Order::where('consultation_id', $consultation->id)->get();
        return view('consultations.result', ['consultation' => $consultation, 'results' => $results])
            ->with('status', 'Result comment saved successfully.')
            ->with('type', 'success');
    }



    public function print(Consultation $consultation)
    {
        $system = SystemSetting::where('id', 1)->first();
        $results = Order::where('consultation_id', $consultation->id)->get();
        $pdf = PDF::loadView('labs.results', compact('consultation', 'results', 'system'));

        return $pdf->download('consultation_results.pdf');
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
    public function history(Patient $patient)
    {
        $patient = Patient::findOrFail($patient->id);
        $consultations = $patient->consultations()->with(['orders.test'])->get();

        return view('consultations.show', compact('consultations', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $tests = DiseaseTest::all();
        $results = Order::where('consultation_id', $consultation->id)->get();
        if (
            $consultation->order_status && $consultation->account_status
            && $consultation->lab_status && !$consultation->completed
        ) {
            return view('consultations.result', ['consultation' => $consultation, 'results' => $results]);
        }
        return view('consultations.edit', ['consultation' => $consultation, 'tests' => $tests]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
