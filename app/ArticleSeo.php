<?php

namespace Fresh\Nashemisto;

use Illuminate\Database\Eloquent\Model;

class ArticleSeo extends Model
{
    protected $fillable = ['seo_title', 'seo_keywords', 'seo_description',
        'seo_text', 'og_image', 'og_title', 'og_description'];
}
