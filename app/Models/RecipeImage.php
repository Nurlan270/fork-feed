<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeImage extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeImageFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'name'
    ];
}
