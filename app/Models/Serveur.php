<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serveur extends Model
{
    protected $fillable = [
        'nom',
        'adressIP', // ✅ capital IP
        'statut'
    ];

    public function metrics()
    {
        return $this->hasMany(Metric::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class); // ✅ lowercase alerts
    }
}