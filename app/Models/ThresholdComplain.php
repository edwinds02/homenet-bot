<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThresholdComplain extends Model
{
    use HasFactory;

    protected $table = 'threshold_complains';
    protected $fillable = ['total', 'webhook'];
}
