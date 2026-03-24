<?php
namespace App\Http\Controllers;

use App\Models\Serveur;
use App\Models\Metric;
use App\Models\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $totalServeurs  = Serveur::count();
        $serveursActifs = Serveur::where('statut', 'actif')->count();
        $totalAlerts    = Alert::where('statut', 'non_lue')->count();
        $recentMetrics  = Metric::with('serveur')->latest()->take(10)->get();
        $recentAlerts   = Alert::with('serveur')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalServeurs',
            'serveursActifs',
            'totalAlerts',
            'recentMetrics',
            'recentAlerts'
        ));
    }
}