<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adherent extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';

    protected $fillable = [
        'nom',
        'prenom',
        'profession',
        'email',
        'adresse',
        'tel1',
        'tel2',
        'datenaissance',
        'cin',
        'codetva',
        'raisonsoc',
        'idpointage',
        'societe_code'
    ];

    protected $casts = [
        'datenaissance' => 'date'
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class, 'societe_code', 'code');
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'adherent_code', 'code');
    }
}
