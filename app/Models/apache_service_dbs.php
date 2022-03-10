<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apache_service_dbs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_url',
        'time_search',
        'status',
    ];
}
