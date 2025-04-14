<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $primaryKey = 'codefor';

    protected $fillable = [
        'nomfor',
        'prenomfor',
        'telfor',
        'emailfor',
        'adrfor'
    ];

    public function reservationSalleFormations()
    {
        return $this->hasMany(ReservationSalleFormation::class, 'formateur_codefor', 'codefor');
    }
}
