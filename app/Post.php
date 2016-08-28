<?php

namespace App;

use App\Services\Markdowner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Tag;
use App\Category;
use Laravolt\Mural\CommentableTrait;

class Post extends Model
{
    use Notifiable;

    use CommentableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'subtitle', 'content_raw', 'page_image', 'meta_description',
        'layout', 'is_draft', 'published_at', 'user_id', 'promo_image'
    ];

    /**
     * Fields that are type of date
     * @var array
     */
    protected $dates = ['published_at'];


    /**
     * Published at mutator
     * @param $value
     * @return mixed
     */
    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('M-j-Y');
    }


    /**
     * Alias for content attribute
     * @param $value
     * @return mixed
     */
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }


    /**
     * The many-to-many relationship between posts and tags.
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag_pivot');
    }


    /**
     * The many-to-many relationship between posts and tags.
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_post_pivot');
    }

    /**
     * Set the title attribute and automatically the slug
     * @param string $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (!$this->exists) {
            $this->setUniqueSlug($value, '');
        }
    }

    /**
     * Recursive routine to set a unique slug
     * @param string $title
     * @param mixed $extra
     */
    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title . '-' . $extra);

        if (static::whereSlug($slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        $this->attributes['slug'] = $slug;
    }

    /**
     * Set the HTML content automatically when the raw content is set
     * @param string $value
     */
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);
    }

    /**
     * Sync tag relation adding new tags as needed
     * @param array $tags
     */
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);

        if (count($tags)) {
            $this->tags()->sync(
                Tag::whereIn('tag', $tags)->get(['id'])
            );
            return;
        }

        $this->tags()->detach();
    }


    /**
     * Sync categories relation adding new categories as needed
     * @param array $categories
     */
    public function syncCategories(array $categories)
    {
        Category::addNeededCategories($categories);




        if (count($categories)) {
            $this->categories()->sync(
                Category::whereIn('category', $categories)->get(['id'])
            );
            return;
        }

        $this->categories()->detach();
    }


    /**
     * Published at scope
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now()->addHour(5));
    }

    /**
     * Post which belongs to the author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
