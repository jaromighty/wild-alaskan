<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'description',
        'name',
        'slug',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($recipe) {
            $recipe->slug = $recipe->generateSlug();
        });
    }

    private function generateSlug(): string
    {
        $slug = Str::slug($this->getAttribute('name'));

        $slugCount = self::where('slug', 'like', $slug.'%')->count();
        if ($slugCount > 0) {
            $slug .= '-'.$slugCount + 1;
        }

        return $slug;
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
