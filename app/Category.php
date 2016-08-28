<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    /**
     * Fields that are mass assignable
     * @var [array]
     */
    protected $fillable = [
        'title', 'slug', 'category', 'meta_keywords', 'meta_description', 'image'
    ];


    /**
     * The many-to-many relationship between category and posts.
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'category_post_pivot');
    }


    /**
     * The Has Many relationship between widgets and categorys.
     * @return BelongsToMany
     */
    public function widgets()
    {
        return $this->hasMany('App\Widget');
    }


    /**
     * Add any categories needed from the list
     * @param array $categories List of categories to check/add
     */
    public static function addNeededCategories(array $categories)
    {


//        if (count($categories) === 0) {
//            return;
//        }
//
//        dd(static::whereIn('category', $categories)->all('category')->toArray());
//
//        $found = static::whereIn('category', $categories)->get('category')->toArray();
//
//
//
//        foreach (array_diff($categories, $found) as $category) {
//            static::create([
//                'category' => $category,
//                'title' => $category,
//                'slug' => Str::slug($category),
//            ]);
//        }
    }
}
