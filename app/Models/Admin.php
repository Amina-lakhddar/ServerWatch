<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'nom',
        'email',
        'motDePasse'
    ];

    protected $hidden = [
        'motDePasse'
    ];

    // Dire à Laravel d'utiliser 'motDePasse' au lieu de 'password'
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }
}