<?php

namespace App\Models;

use App\Enums\ReactionType;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements CanResetPassword, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'banner',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function banner(): Attribute
    {
        return Attribute::get(
            fn($value) => $value
                ? Storage::url($value)
                : asset('media/default-banner.jpg')
        );
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    public function toSearchableArray(): array
    {
        return array_merge($this->toArray(), [
            'id'         => (string)$this->id,
            'created_at' => $this->created_at->timestamp,
        ]);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class)->latest();
    }

    public function reactions(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_reactions')
            ->withPivot('type');
    }

    public function likes(): BelongsToMany
    {
        return $this->reactions()->where('type', ReactionType::LIKE);
    }

    public function dislikes(): BelongsToMany
    {
        return $this->reactions()->where('type', ReactionType::DISLIKE);
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_bookmarks')
            ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'followers', 'user_id', 'follower_id')
            ->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')
            ->withTimestamps();
    }
}
