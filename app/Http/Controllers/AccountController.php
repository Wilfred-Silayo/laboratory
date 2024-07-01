<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Consultation;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Consultation::where('account_status', 0)
            ->where('order_status', 1)
            ->where('lab_status', 0)
            ->where('completed', 0)
            ->with('patient')
            ->orderByDesc('visit_date');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
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

        return view('accounts.index', compact('consultations'));
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
            'consultation_id'=>'required|numeric',
            'total_amount'=>'required|numeric',
            'status'=>'required|string',
        ]);
        Account::create([
            'consultation_id'=>$request->consultation_id,
            'total_amount'=>$request->total_amount,
            'status'=>$request->status,
        ]);
        $consultation=Consultation::findOrFail($request->consultation_id);
        $consultation->update(['account_status'=>true]);

        return redirect()->route('accounts.edit',$request->consultation_id)->with('status','Payments successfully');
    }

    /**
     * Display the specified resource.
     */

    public function show($consultationId)
    {
        $system = SystemSetting::where('id', 1)->first();
        $consultation = Consultation::with(['patient', 'orders.test'])->findOrFail($consultationId);
        $orders = $consultation->orders;
        $totalAmount = $orders->sum(function ($order) {
            return $order->test_price;
        });

        $pdf = PDF::loadView('accounts.receipt', [
            'consultation' => $consultation,
            'orders' => $orders,
            'totalAmount' => $totalAmount,
            'system'=>$system,
        ]);

        return $pdf->download('receipt.pdf');
    }

    public function edit($consultationId)
    {
        $consultation = Consultation::with(['patient', 'orders.test'])->findOrFail($consultationId);
        $orders = $consultation->orders;
        $totalAmount = $orders->sum(function ($order) {
            return $order->test_price;
        });

        return view('accounts.show', [
            'consultation' => $consultation,
            'orders' => $orders,
            'totalAmount' => $totalAmount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

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
