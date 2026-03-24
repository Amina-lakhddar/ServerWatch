<?php
namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\Serveur;
use App\Services\MetricService;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    
    protected MetricService $metricService;

    public function __construct(MetricService $metricService)
    {
        $this->metricService = $metricService;
    }

    public function index()
    {
        $metrics  = Metric::with('serveur')->latest()->paginate(15);
        $serveurs = Serveur::all();
        return view('metrics.index', compact('metrics', 'serveurs'));
    }

    public function collect(Request $request)
    {
        $request->validate([
            'serveur_id' => 'required|exists:serveurs,id'
        ]);

        $this->metricService->collect($request->serveur_id);

        return redirect()->route('metrics.index')
                         ->with('success', 'Métriques collectées!');
    }
}