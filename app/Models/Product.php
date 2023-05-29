<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
}
