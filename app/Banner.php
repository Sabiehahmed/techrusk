<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * fields tat are mass assignable
     * @var [array]
     */
    protected $fillable = [
        'alt', 'image'
    ];

}
