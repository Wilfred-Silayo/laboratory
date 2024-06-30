<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\DiseaseTest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'selected_tests' => 'required|array|min:1',
            'symptom' => 'required|string',
            'clinical_comment' => 'nullable',
        ]);

        $consultationId = $request->input('consultation_id');
        $selectedTests = $request->input('selected_tests');

        foreach ($selectedTests as $testId) {
            $test = DiseaseTest::findOrFail($testId);

            Order::create([
                'consultation_id' => $consultationId,
                'test_code' => $test->test_code,
                'test_price' => $test->test_price,
            ]);
        }

        // Update the order_status to 1
        $consultation = Consultation::findOrFail($consultationId);
        $consultation->order_status = 1;
        $consultation->order_comment=$request->clinical_comment;
        $consultation->save();

        return redirect()->route('consultations.index')->with('status', 'Tests successfully added to the order ready for payments.');
    }
}
