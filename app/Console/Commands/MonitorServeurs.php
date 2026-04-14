<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MetricService;
use App\Services\LogService;
use App\Services\AlertService;
use App\Models\Serveur;

class MonitorServeurs extends Command
{
    protected $signature = 'monitor:serveurs';
    protected $description = 'Collecter métriques, logs et vérifier alertes';

    public function handle(): void
    {
        // ✅ Inject les services hna machi f constructor
        $metricService = app(MetricService::class);
        $logService    = app(LogService::class);
        $alertService  = app(AlertService::class);

        $serveurs = Serveur::all();

        foreach ($serveurs as $serveur) {
            $metricService->collect($serveur->id);
            $logService->collectLogs();
            $alertService->check($serveur->id);
        }
    }
}