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

    /**
     * getRouteKeyName
     *
     * To be used in the route model binding.
     */
    public function getRouteKeyName(){
        return 'slug';
    }

    /**
     * Now we have added a relationship between the Post and the Category model.
     * And we have decided to call our relationship as category.
     * So we can access the category by calling $post->category via Laravel Eloquent.
     *
     * To archive that we are going to make a new method called category() in the Post model.
     */
    public function category(){
        // In Laravel Eloquent we have several relationship methods.
        /**
         * We have used belongsTo() method
         * belongsTo, belongsToMany, hasOne, hasMany, morphOne, morphMany, morphTo, and morphToMany.
         */
        // What is the relationship between Post and Category?
        // Post belongs to Category, in this case we are going to use belongsTo() method.
        return $this->belongsTo(Category::class);
    }

    // Adding User relations
    public function user(){
        return $this->belongsTo(User::class);
    }
}
