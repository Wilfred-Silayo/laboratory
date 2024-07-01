<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\SystemSetting;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    public function show(Request $request)
    {
        $month = $request->input('month');

        $consultations = Consultation::with(['patient', 'orders', 'account'])
            ->whereMonth('visit_date', Carbon::parse($month)->month)
            ->whereYear('visit_date', Carbon::parse($month)->year)
            ->where('completed', true)
            ->get();
        
        $system = SystemSetting::where('id', 1)->first();
        
        $pdf = PDF::loadView('reports.financial-pdf', [
            'consultations' => $consultations,
            'system'=>$system,
        ]);

        return $pdf->download('financial_report.pdf');
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
    public function generate(Request $request)
    {
        $month = $request->get('month');
        $consultations = Consultation::whereMonth('visit_date', $month)->get();

        $data = [
            'consultations' => $consultations,
        ];

        $view = view('reports.financial-pdf', $data)->render();

        // Initialize Dompdf with custom options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('financial_report.pdf');
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
