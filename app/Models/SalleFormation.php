<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalleFormation extends Model
{
    use HasFactory;

    protected $primaryKey = 'codesalle';

    protected $fillable = [
        'designationsalle',
        'capacitesalle',
        'prives_n',
        'prives_j'
    ];

    protected $casts = [
        'prives_n' => 'boolean',
        'prives_j' => 'boolean'
    ];

    public function reservationSalleFormations()
    {
        return $this->hasMany(ReservationSalleFormation::class, 'salle_formation_codesalle', 'codesalle');
    }
}
