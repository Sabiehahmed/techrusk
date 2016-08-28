<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsHelper extends Model
{

    /**
     * @var array
     */
    private $items;

    /**
     * ItemsHelper constructor.
     * @param array $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Return html list of the model
     * @return string
     */
    public function htmlList()
    {
        return $this->htmlFromArray($this->itemArray());
    }


    /**
     * Returns an array of items
     * @return array
     */
    private function itemArray()
    {
        $result = array();
        foreach ($this->items as $item) {
            if ($item->parent_id == 0) {
                $result[$item->label] = $this->itemWithChildren($item);
            }
        }
        return $result;
    }

    /**
     * Checks the children of current item
     * @param $item
     * @return array
     */
    private function childrenOf($item)
    {
        $result = array();
        foreach ($this->items as $i) {
            if ($i->parent_id == $item->id) {
                $result[] = $i;
            }
        }
        return $result;
    }

    /**
     * Check is the item has children and returns it
     * @param $item
     * @return array
     */
    private function itemWithChildren($item)
    {
        $result = array();
        $children = $this->childrenOf($item);
        foreach ($children as $child) {
            $result[$child->label] = $this->itemWithChildren($child);
        }
        return $result;
    }


    /**
     * Returns html list from an array
     * @param $array
     * @return string
     */
    private function htmlFromArray($array)
    {
        $html = '';
        foreach ($array as $k => $v) {
            $html .= "<ul>";
            $html .= "<li>" . $k . "</li>";
            if (count($v) > 0) {
                $html .= $this->htmlFromArray($v);
            }
            $html .= "</ul>";
        }
        return $html;
    }
}