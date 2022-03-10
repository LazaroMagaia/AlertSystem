<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class static_servers extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_id',
        'down_count',
        'up_count',
    ];
}
