<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Fields that are mass assignable
     * @var array
     */
    protected $fillable = ['parent_id', 'title', 'label', 'url', 'order'];


    /**
     * Parent or current menu
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(static::class, 'id', 'parent_id');
    }

    /**
     * Children of current menu instance
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }


    /**
     * This function builds up the entire menu tree
     * @param $menu
     * @param int $parentid
     * @return null|string
     */
    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu as $item)
            if ($item->parent_id == $parentid) {
                $result .= "<li class='dd-item nested-list-item' data-order='{$item->order}' data-id='{$item->id}'>
	      <div class='dd-handle nested-list-handle'>
	        <span class='glyphicon glyphicon-move'></span>
	      </div>
	      <div class='nested-list-content'>{$item->label}
	        <div class='pull-right'>
	          <a href='" . url("admin/menu/edit/{$item->id}") . "'>Edit</a> |
	          <a href='#' class='delete_toggle' rel='{$item->id}'>Delete</a>
	        </div>
	      </div>" . $this->buildMenu($menu, $item->id) . "</li>";
            }
        return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
    }

    /**
     * This return the usefull html for the menu
     * @param $items
     * @return null|string
     */
    public function getHTML($items)
    {
        return $this->buildMenu($items);
    }

    /**
     * This returns the tree of the menu
     * @return mixed
     */
    public static function tree()
    {

        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', 0)->orderBy('order', 'desc')->get();

    }

}
