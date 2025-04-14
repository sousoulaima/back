<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationSalleFormation extends Model
{
    use HasFactory;

    protected $fillable = [
        'datereservation',
        'montantreservation',
        'salle_formation_codesalle',
        'formateur_codefor'
    ];

    protected $casts = [
        'datereservation' => 'date',
        'montantreservation' => 'decimal:2'
    ];

    public function salleFormation()
    {
        return $this->belongsTo(SalleFormation::class, 'salle_formation_codesalle', 'codesalle');
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_codefor', 'codefor');
    }
}
