<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $table = 'complains';
    protected $fillable = ['total_complain', 'starting_datetime', 'ending_datetime'];

    public function getTotalComplainAttribute()
    {
        return $this->attributes['total_complain'];
    }
}
