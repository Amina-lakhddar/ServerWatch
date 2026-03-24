<?php
namespace App\Services;

use App\Models\Metric;

class MetricService
{
    //  CPU réel
    private function getCPU(): float
    {
        $output = shell_exec("wmic cpu get loadpercentage /value");
        preg_match('/LoadPercentage=(\d+)/', $output, $matches);
        return isset($matches[1]) ? floatval($matches[1]) : 0.0;
    }

    //  RAM réel — pourcentage utilisé
    private function getRAM(): float
    {
        $totalOutput = shell_exec("wmic os get totalvisiblememorysize /value");
        $freeOutput  = shell_exec("wmic os get freephysicalmemory /value");

        preg_match('/TotalVisibleMemorySize=(\d+)/', $totalOutput, $totalMatch);
        preg_match('/FreePhysicalMemory=(\d+)/', $freeOutput, $freeMatch);

        $total = isset($totalMatch[1]) ? floatval($totalMatch[1]) : 1;
        $free  = isset($freeMatch[1])  ? floatval($freeMatch[1])  : 0;

        return round((($total - $free) / $total) * 100, 2);
    }

    //  Disk réel — drive C: pourcentage utilisé
    private function getDisk(): float
    {
        $output = shell_exec("wmic logicaldisk where DeviceID='C:' get size,freespace /value");

        preg_match('/FreeSpace=(\d+)/', $output, $freeMatch);
        preg_match('/Size=(\d+)/', $output, $sizeMatch);

        $free = isset($freeMatch[1]) ? floatval($freeMatch[1]) : 0;
        $size = isset($sizeMatch[1]) ? floatval($sizeMatch[1]) : 1;

        return round((($size - $free) / $size) * 100, 2);
    }

    //  Collecte + sauvegarde f DB
    public function collect(int $serveur_id): void
    {
        $date = now()->toDateString();

        foreach ([
            'CPU'  => $this->getCPU(),
            'RAM'  => $this->getRAM(),
            'Disk' => $this->getDisk(),
        ] as $type => $valeur) {
            Metric::create([
                'type'       => $type,
                'valeur'     => $valeur,
                'date'       => $date,
                'serveur_id' => $serveur_id
            ]);
        }
    }
}