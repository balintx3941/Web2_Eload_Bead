<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oprendszer extends Model
{
    use HasFactory;

    protected $table = 'oprendszerek';

    protected $fillable = [
        'nev',
    ];

    public function gepek()
    {
        return $this->hasMany(Gep::class, 'oprendszerid');
    }

}
