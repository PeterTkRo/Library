<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $author
 * @property string $ISBN
 * @property int $genre
 * @property string $publishing_house
 * @property $publication_date
 * @property $created_at
 * @property $updated_at
 */
class Book extends Model
{
    use HasFactory;

    /**
     * All genres
     *
     * @var array<string, int>
     */
    const GENRES = [
        'Fantasy' => 0,
        'Adventure' => 1,
        'Romance' => 2,
        'Contemporary' => 3,
        'Dystopian' => 4,
        'Mystery' => 5,
        'Horror' => 6,
        'Thriller' => 7,
        'Paranormal' => 8,
        'Historical fiction' => 9,
        'Science fiction' => 10,
        'Children’s' => 11,
        'Cookbook' => 12,
        'Memoir' => 13,
        'History' => 14,
        'Travel' => 15,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'author',
        'ISBN',
        'genre',
        'publishing_house',
        'publication_date',
    ];
}
