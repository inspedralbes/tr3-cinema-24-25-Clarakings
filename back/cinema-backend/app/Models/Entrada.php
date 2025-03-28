<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'surname',
        'birthday',
        'phone_number',
    ];

    protected $table = 'tickets';

    public $timestamps = false;
}
