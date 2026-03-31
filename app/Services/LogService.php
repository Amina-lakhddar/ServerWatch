<?php
namespace App\Services;

use App\Models\Log;

class LogService
{
    private string $logPath = 'C:\\xampp\\apache\\logs\\access.log';

    
    public function collectLogs()
    {
        if (!file_exists($this->logPath)) return;
        //array
        $lines = file($this->logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!$lines) return;

        foreach ($lines as $line) {
            $this->parseLine($line);
        }
    }

    public function logMetric(string $type, float $valeur, int $serveur_id)
    {
        Log::create([
            'message' => "$type: {$valeur}% — Serveur ID: $serveur_id",
            'date'    => now()->toDateString(),
        ]);
    }

    
    public function logAlert(string $type, float $valeur)
    {
        Log::create([
            'message' => "Alert critique: $type {$valeur}%",
            'date'    => now()->toDateString(),
        ]);
    }

    
    private function parseLine(string $line)
    {
        $pattern = '/^(\S+) \S+ \S+ \[([^\]]+)\] "(\S+) (\S+) \S+" (\d+)/';

        if (!preg_match($pattern, $line, $matches)) return;

        $ip      = $matches[1];
        $date    = $this->parseDate($matches[2]);
        $methode = $matches[3];
        $url     = $matches[4];
        $status  = intval($matches[5]);
 
        if ($status < 400) return;

        $message = "[$status] $methode $url — IP: $ip";

        // eviter les doublons (si message where date =$date not exists )
        $exists = Log::where('message', $message)
                     ->where('date', $date)
                     ->exists();
    
        if (!$exists) {
            Log::create([
                'message' => $message,
                'date'    => $date,
            ]);
        }
    }

    
    private function parseDate(string $apacheDate): string
    {
        try {
            $date = \DateTime::createFromFormat('d/M/Y:H:i:s O', $apacheDate);
            return $date ? $date->format('Y-m-d') : now()->toDateString();
        } catch (\Exception $e) {
            return now()->toDateString();
        }
    }
}
