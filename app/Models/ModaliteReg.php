<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModaliteReg extends Model
{
    use HasFactory;

    protected $primaryKey = 'codemod';

    protected $fillable = [
        'designationmod',
        'reglement_codereg'
    ];

    public function reglement()
    {
        return $this->belongsTo(Reglement::class, 'reglement_codereg', 'codereg');
    }
}
