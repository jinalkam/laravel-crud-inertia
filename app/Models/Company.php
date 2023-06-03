<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'established_date',
        'confirmed'
    ];


    protected $casts = [
        'confirmed' => 'boolean',
        'established_date'=> 'datetime:Y-m-d'

    ];

 
}
