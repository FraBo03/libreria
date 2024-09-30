<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory;
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $fillable = ['book_id', 'user_id', 'borrowed_at', 'due_at', 'returned_at' ];
    
    public function book(): BelongsTo{
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
