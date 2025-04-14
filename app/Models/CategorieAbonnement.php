<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieAbonnement extends Model
{
    use HasFactory;

    protected $primaryKey = 'codecateg';

    protected $fillable = [
        'designationcateg'
    ];

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'categorie_abonnement_codecateg', 'codecateg');
    }
}
