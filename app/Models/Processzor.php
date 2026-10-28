<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processzor extends Model
{
    use HasFactory;

    protected $table = 'processzorok';

    protected $fillable = [
        'gyarto',
        'tipus',
    ];

    public function gepek()
    {
        return $this->hasMany(Gep::class, 'processzorid');
    }
}
