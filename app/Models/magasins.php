<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class magasins extends Model
{
    use HasFactory;
    protected $connection = "mysql_second";

    protected $fillabel = [
        'email',
        'password',
    ];
}
