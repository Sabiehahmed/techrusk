<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{

    /**
     * Filed that are mass assignable
     * @var array
     */
    protected $fillable = ['title', 'category_id', 'type'];

    /**
     * Widget belongs to a category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }


}
