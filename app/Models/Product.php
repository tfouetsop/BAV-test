<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'prix',
        'quantite',
        'image',
        'user_created_id',
        'user_updated_id',
    ];
}
