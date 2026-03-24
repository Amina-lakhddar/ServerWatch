<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = [
        'type',
        'valeur',
        'date',
        'serveur_id'
    ];

    public function serveur()
    {
        return $this->belongsTo(Serveur::class); // ✅ capital S
    }
}