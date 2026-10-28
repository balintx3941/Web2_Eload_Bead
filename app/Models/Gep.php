<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gep extends Model
{
    use HasFactory;

    protected $table = 'gepek';

    protected $fillable = [
        'gyarto',
        'tipus',
        'kijelzo',
        'memoria',
        'merevlemez',
        'videovezerlo',
        'ar',
        'processzorid',
        'oprendszerid',
        'db',
    ];

    public function processzor()
    {
        return $this->belongsTo(Processzor::class, 'processzorid');
    }

    public function oprendszer()
    {
        return $this->belongsTo(Oprendszer::class, 'oprendszerid');
    }
}
