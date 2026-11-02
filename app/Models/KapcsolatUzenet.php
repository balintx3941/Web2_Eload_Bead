<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KapcsolatUzenet extends Model
{
    protected $table = 'kapcsolat_uzenets';

    protected $fillable = [
        'nev',
        'email',
        'targy',
        'uzenet',
    ];
}
