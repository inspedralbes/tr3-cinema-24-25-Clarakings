<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'hour',
        'movie_id',
        'audienceDay',
        'priceBase',
        'total_tickets',
        'tickets_sold'
    ];

    protected $primaryKey = 'id_session';

    public $timestamps = false;
}
