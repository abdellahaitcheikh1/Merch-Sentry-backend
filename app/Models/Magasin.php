<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'IdMagasin',
        'IdDepot',
        'IdVille',
        'Reference',
        'NomMagasin',
        'Adresse',
        'Tele',
        'Fax',
        'DateCreation',
        'DateModification',
        'Supprime',
        'ImageEP',
    ];
}
