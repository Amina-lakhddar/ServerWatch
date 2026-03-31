<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\MetricService; 
// use App\Services\LogService;
use App\Services\AlertService; 
use App\Models\Serveur;

class MonitorServeurs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monitor-serveurs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'collecte mmetrics, logs, verifier les alerts';

    public function __construct(
         private MetricService $metricService,
        //  private LogService $logService,
         private AlertService $alertService,
    )
    
       
    {
        return parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle($serveur_id)
    {
        $serveurs = Serveur::all();
        foreach($serveurs as $serveur){
            $this->metricService->collect($serveur_id);
            // $this->logService->collectLogs();
            $this->alertService->check($serveur_id);
        }
    }
}
