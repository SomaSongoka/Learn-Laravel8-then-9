<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Means mass assign is allowed for this model
    protected $guarded = [];

    /**
     * Get the posts for the category.
     *
     * This is a one-to-many relationship.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
