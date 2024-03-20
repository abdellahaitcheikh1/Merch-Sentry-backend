<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commercials extends Model
{
    use HasFactory;
    protected $connection = "mysql_second";

    protected $fillable=[
        'nom',
        'email',
        'password',
        'prenom',
        'télephone',
        'cin',
        'ville',
    ];
}
