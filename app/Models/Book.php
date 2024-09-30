<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'author', 'description', 'cover_image', 'availability'];

    public function loans(): HasMany{
        return $this->hasMany(Loan::class);
    }

    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }
}