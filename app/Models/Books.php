<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Books extends Model
{

    use HasUlids;

    protected $fillable =[
        'title',
        'isbn',
        'publisher',
        'year_published',
        'stock'
    ];

    protected $table = 'books';

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'isbn' => 'string',
            'publisher' => 'string',
            'year_published' => 'string',
        ];
    }

    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loans::class,  'book_id');
    }

    public function bookAuthors(): HasMany
    {
        return $this->hasMany(BooksAuthor::class, 'book_id');
    }
}