<?php
namespace App\Services;

use App\Models\Metric;
use App\Models\Alert;
use App\Jobs\SendAlertMailJob;
use App\Services\LogService;


class AlertService
{ 
    public function __construct(
        private LogService $logService
    ) {}
    private array $seuils =[
        'CPU' =>80,
        'RAM'=>85,
        'DISK'=>90,
    ];
    
    public function check(int $serveur_id) {
        foreach($this->seuils as $type=> $seuil){
            $metric=Metric:: where('serveur_id',$serveur_id)
                    ->where('type',$type)->latest()->first();
        if ($metric->valeur> $seuil){
             $alert = Alert::create([
                    'message'    => $type . ' critique: ' . $metric->valeur . '%',
                    'seuil'      => $seuil,
                    'statut'     => 'non_lue',
                    'date'       => now(),
                    'serveur_id' => $serveur_id,
                ]);
            SendAlertMailJob::dispatch($alert);
            $this->logService->logAlert($type, $metric->valeur);

        }
            
        }
    }
}
