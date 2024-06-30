<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reports.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $month = $request->input('month');

        $consultations = Consultation::with(['patient', 'orders', 'account'])
            ->whereMonth('visit_date', Carbon::parse($month)->month)
            ->whereYear('visit_date', Carbon::parse($month)->year)
            ->get();

        return view('reports.financial', compact('consultations'));
    }

    public function generateReport(Request $request)
    {
        $month = $request->input('month');

        $consultations = Consultation::with(['patient', 'orders.test'])
            ->whereMonth('created_at', $month)
            ->where('account_status', true)
            ->get();

        $pdf = PDF::loadView('reports.financial_report_pdf', [
            'consultations' => $consultations
        ]);

        return $pdf->download('financial_report.pdf');
    }

    public function showReport(Request $request)
    {
        $month = $request->input('month');

        $consultations = Consultation::with(['patient', 'orders.test'])
            ->whereMonth('created_at', $month)
            ->where('account_status', true)
            ->get();

        return view('reports.financial_report', [
            'consultations' => $consultations
        ]);
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
