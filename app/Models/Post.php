<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Fillable
     *
     * This is the array of fillable columns that can be mass assignable.
     * In this list we have excluded id and created_at and updated_at columns.
     * Means those can not be mass assigned.
     *
     *
     */
    protected $fillable = [
        'title',
        'excerpt',
        'body',
    ];

    // Guarded is the opposite of fillable. = Means everything is fillable expect these
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //But another way is to set the guarded to empty array  protected $guarded = []; and never sent user submitted form as array to Method create()
}
