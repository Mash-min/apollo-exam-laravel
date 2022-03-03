<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'random_id'
    ];

    public function random()
    {
        return $this->belongsTo(Random::class, 'random_id');
    }
}
