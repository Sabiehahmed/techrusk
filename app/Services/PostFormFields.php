<?php

namespace App\Services;

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;


class PostFormFields
{


    /**
     * The id (if any) of the Post row
     *
     * @var integer
     */
    public $id;

    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    public $fieldList = [
        'title' => '',
        'subtitle' => '',
        'page_image' => '',
        'promo_image' => '',
        'content' => '',
        'meta_description' => '',
        'is_draft' => "0",
        'publish_date' => '',
        'publish_time' => '',
        'layout' => 'blog.layouts.post',
        'tags' => [],
        'categories' => [],
    ];

    /**
     * Create a new command instance.
     *
     * @param integer $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the command.
     *
     * @return array of fieldnames => values
     */
    public function getFields()
    {
        $fields = $this->fieldList;

        if ($this->id) {
            $fields = $this->fieldsFromModel($this->id, $fields);
        } else {
            $when = Carbon::now()->addHour(5);
            $fields['publish_date'] = $when->format('M-j-Y');
            $fields['publish_time'] = $when->format('g:i A');
        }

        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

//        dd(array_merge(
//            $fields,
//            ['allTags' => Tag::all('tag')->toArray(),
//                'allCategories' => Category::all('title')->toArray(),]
//        ));


         return array_merge(
            $fields,
            ['allTags' => Tag::all('tag'),
                'allCategories' => Category::all('category'),]
        );
    }

    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array $fields
     * @return array
     */
    public function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);

        $fieldNames = array_keys(array_except($fields, ['tags', 'categories']));

        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }

        $fields['tags'] = $post->tags()->all('tag');
        $fields['categories'] = $post->categories()->all('category');

        return $fields;
    }
}
