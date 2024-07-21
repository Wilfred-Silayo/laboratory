<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Order;
use Illuminate\Http\Request;

class LabReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Consultation::where('account_status', 1)
            ->where('order_status', 1)
            ->where('lab_status', 0)
            ->where('completed', 0)
            ->with('patient')
            ->orderByDesc('visit_date');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('occupation', 'LIKE', "%{$search}%")
                    ->orWhere('sex', 'LIKE', "%{$search}%");
            });
        }

        $consultations = $query->paginate(10);

        if ($request->ajax()) {
            $pagination = view('pagination', ['users' => $consultations])->render();

            return response()->json([
                'accounts' => $consultations,
                'count' => $consultations->total(),
                'pagination' => $pagination,
            ]);
        }

        return view('labs.index', compact('consultations'));
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

        $request->validate([
            'lab_comment' => 'required|string',
            'test_comments' => 'array|required',
            'test_comments.*' => 'required|string',
        ]);

        // Find the consultation
        $consultation = Consultation::findOrFail($request->consultation_id);

        // Update the general lab comment
        $consultation->lab_comment = $request->input('lab_comment');
        $consultation->lab_status = 1;
        $consultation->save();

        // Update the comments for each order
        if ($request->has('test_comments')) {
            foreach ($request->input('test_comments') as $orderId => $comment) {
                $order = Order::findOrFail($orderId);
                $order->comment = $comment;
                $order->save();
            }
        }

        // Redirect back with a success message
        return redirect()->route('labreports.index')
            ->with('status', 'Lab results sent successfully')
            ->with('type', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $consultation = Consultation::with('patient', 'orders.test')->findOrFail($id);

        $orders = $consultation->orders;

        return view('labs.edit', compact('consultation', 'orders'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($consultationId)
    {
        
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
