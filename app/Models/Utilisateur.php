<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable
{
    protected $fillable = [
        'nom',
        'email',
        'motDePasse'
    ];

    protected $hidden = [
        'motDePasse'
    ];

    public function getAuthPassword()
    {
        return $this->motDePasse;
    }
}