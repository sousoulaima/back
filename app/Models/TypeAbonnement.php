<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAbonnement extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';

    protected $fillable = [
        'designation',
        'nbmois',
        'nbjours',
        'acceslibre',
        'forfait',
        'nbseancesemaine'
    ];

    protected $casts = [
        'acceslibre' => 'boolean',
        'forfait' => 'decimal:2'
    ];

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'type_abonnement_code', 'code');
    }
}
