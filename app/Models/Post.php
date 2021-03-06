<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Fill able
     *
     * This is the array of fill able columns that can be mass assignable.
     * In this list we have excluded id and created_at and updated_at columns.
     * Means those can not be mass assigned.
     *
     */
    protected $fillable = [
        'title',
        'excerpt',
        'body',
    ];

    // Guarded is the opposite of fill able. = Means everything is fill able expect these
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //But another way is to set the guarded to empty array  protected $guarded = []; and never sent user submitted form as array to Method create()

    // We can load a relationship everything we do a query in this Model class by using $with
    protected $with = [
        // Once we do this we no longer have to refer the category inside ->load()
        'category',
    ];

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

    /**
     * Now we want our relationship to be Post->author instead of now Post->user.
     *
     * Note that Laravel bu default assumes user means the foreign key must be user_id
     * so when we change to author we have to change the foreign key to author_id or pass additional parameter to the method callback
     */
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Query Scope is defined by the method name. scope[scopename]
     * Eg: scopePublished() will  be reffered as Post::newQuery()->published()
     * - our scope will receive the query object as first parameter
     *
     */
    public function scopeFilter($query,array $filters)
    {
        // We can also use when query builder,
        // WHEN == execute only when the condition is true
        //Using PHP 8 we can switch this function to arrow function
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query
                ->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%"));

        /*
        // PHP 8 way of handling nullable values if(isset($filters['search'])) php 7.x way of handling nullable values
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('body', 'like', '%' . $filters['search'] . '%'); // Check on Title and Body
            // The above code can be $posts->where('title', 'like', '%' . request('search') . '%');
        }
        */

        // In case we wish to find category using GET request we can utilise same approach
        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            //But remember category is passed as slag and we do not have slug in Post table
            // So we need to check the slug via the category table
            // Now thre is several ways to do this, inner join etc but for now let's look at exist
            /**
             * Using Exist
             * SELECT * FROM posts WHERE
             *      EXISTS(
             *              SELECT*FROM categories
             *                  WHERE categories.id=posts.category_id AND categories.slug="ut-sit-culpa-mollitia")

            $query->whereExists(fn ($query) =>
                $query->from('categories')
                    ->whereColumn('categories.id', '=', 'posts.category_id') // whereColumn('categories.id',  'posts.category_id')
                    // ->whereRaw('categories.id=posts.category_id') Optional
                    ->where('categories.slug', $category)));
             */

            // Using whereHas
            /**
             * Since we are already add Relationship between Post and Category using belongsTo() method under  category() method
             * We can utilise the whereHas() method to check if the post belongs to the category
             */
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)));
    }
}
