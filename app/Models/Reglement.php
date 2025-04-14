<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $primaryKey = 'codereg';

    protected $fillable = [
        'datereg',
        'mtreg',
        'numchq',
        'numtraite',
        'commentaire',
        'abonnement_codeabo'
    ];

    protected $casts = [
        'datereg' => 'date',
        'mtreg' => 'decimal:2'
    ];

    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class, 'abonnement_codeabo', 'codeabo');
    }

    public function modaliteRegs()
    {
        return $this->hasMany(ModaliteReg::class, 'reglement_codereg', 'codereg');
    }
}
