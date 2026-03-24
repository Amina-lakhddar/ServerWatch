<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'message',
        'seuil',
        'statut',
        'date',
        'serveur_id'
    ];

    public function serveur()
    {
        return $this->belongsTo(Serveur::class);
    }
}
