<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeabo';
    public $incrementing = true;

    protected $fillable = [
        'dateabo',
        'totalhtabo',
        'totalremise',
        'totalht',
        'totalttc',
        'solde',
        'restepaye',
        'mtpaye',
        'datedeb',
        'datefin',
        'adherent_code',
        'type_abonnement_code',
        'categorie_abonnement_codecateg'
    ];

    protected $casts = [
        'dateabo' => 'date',
        'datedeb' => 'date',
        'datefin' => 'date',
        'solde' => 'boolean',
        'totalhtabo' => 'decimal:2',
        'totalremise' => 'decimal:2',
        'totalht' => 'decimal:2',
        'totalttc' => 'decimal:2',
        'restepaye' => 'decimal:2',
        'mtpaye' => 'decimal:2'
    ];

    public function adherent()
    {
        return $this->belongsTo(Adherent::class, 'adherent_code', 'code');
    }

    public function typeAbonnement()
    {
        return $this->belongsTo(TypeAbonnement::class, 'type_abonnement_code', 'code');
    }

    public function categorieAbonnement()
    {
        return $this->belongsTo(CategorieAbonnement::class, 'categorie_abonnement_codecateg', 'codecateg');
    }

    public function reglements()
    {
        return $this->hasMany(Reglement::class, 'abonnement_codeabo', 'codeabo');
    }
}
