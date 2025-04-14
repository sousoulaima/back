<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    
    protected $fillable = [
        'raisonsoc',
        'codetva',
        'adrsoc',
        'telsoc',
        'faxsoc',
        'mgsoc'
    ];

    public function adherents()
    {
        return $this->hasMany(Adherent::class, 'societe_code', 'code');
    }
}
