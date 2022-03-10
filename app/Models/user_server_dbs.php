<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_server_dbs extends Model
{
    use HasFactory;
    protected $fillable = [
        'url_name',
        'user_id',
        'status',
        'date_up',
        'date_down',
        'date_time_reset',
        'server_up_email',
        'server_down_email'
    ];
}
