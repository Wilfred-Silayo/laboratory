<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the latest 15 patients
        $latestPatients = Patient::orderBy('created_at', 'desc')->take(15)->get();

        // Fetch the latest 15 sales
        $latestSales = Account::with('consultation.patient')
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        return view('dashboard', compact('latestPatients', 'latestSales'));
    }
}
