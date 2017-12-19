<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'alias', 'content', 'category_id', 'created_at',
        'approved', 'view'];

    /**
     *  Get the category associated with the blog.
     */
    public function category()
    {
        return $this->belongsTo('Fresh\Nashemisto\Category');
    }

    /**
     *  Get the main_img associated with the blog.
     */
    public function image()
    {
        return $this->hasOne('Fresh\Nashemisto\Image');
    }

    public function seo()
    {
        return $this->hasOne('Fresh\Nashemisto\ArticleSeo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Fresh\Nashemisto\Tag', 'article_tag');
    }

    /**
     * @param $id
     * @return bool
     */
    public function hasTag($id)
    {
        foreach ($this->tags as $tag) {
            if ($tag->id == $id) {
                return true;
            }
        }
        return false;
    }
}
