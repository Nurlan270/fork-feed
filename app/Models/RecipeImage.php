<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeImage extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeImageFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'path',
    ];

    protected function path(): Attribute
    {
        return Attribute::get(
            fn(string $value) => Storage::exists($value)
                ? Storage::url($value)
                : asset('media/404-image.webp')
        );
    }

    public function relativePath(): string
    {
        return Str::remove(Storage::url('/'), $this->path);
    }
}
