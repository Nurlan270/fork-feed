<?php

namespace App\Models;

use App\Enums\ReactionType;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory, Sluggable, Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'views',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function toSearchableArray(): array
    {
        return array_merge($this->toArray(), [
            'id'         => (string)$this->id,
            'created_at' => $this->created_at->timestamp,
        ]);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(RecipeReaction::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'recipe_reactions')
            ->where('type', ReactionType::LIKE);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function limitedIngredients()
    {
        return $this->belongsToMany(Ingredient::class)->limit(8);
    }

    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }

    public function firstImage()
    {
        return $this->hasOne(RecipeImage::class)->orderBy('id');
    }
}
