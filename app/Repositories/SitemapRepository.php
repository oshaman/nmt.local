<?php

namespace Fresh\Nashemisto\Repositories;

use App;
use Fresh\Nashemisto\Category;
use Fresh\Nashemisto\StaticPage;
use URL;
use Cache;
use DB;
use Fresh\Nashemisto\Article;

class SitemapRepository
{
    public function index()
    {
        // create new sitemap object
        $sitemap_article = App::make("sitemap");

//    Articles
        $posts = Article::where('approved', 1)
            ->with('image')->orderBy('updated_at', 'desc')->get();
        foreach ($posts as $post) {
            // get all images for the current post
            $images = array();

            $images[] = array(
                'url' => asset('\asset\images\articles\main\\') . $post->image->path,
                'title' => $post->image->title,
                'caption' => $post->image->alt
            );

            $sitemap_article->add(URL::to('article/' . $post->alias), $post->updated_at, '1.0', 'daily', $images);
        }

        $sitemap_article->store('xml', 'sitemap-articles');
//    Articles
//=============================================>Main
        $sitemap_main = App::make("sitemap");

        $sitemap_main->add(URL::to('/'), date('Y-m-d 00:00:00'), '0.6', 'daily');

        /*$statics = StaticPage::select('updated_at', 'own')->get();
        foreach ($statics as $page) {
            $sitemap_main->add(route($page->own), $page->updated_at, '0.8', 'monthly');
        }*/

//        categories
        $cats = Category::where('approved', 1)->get();

        foreach ($cats as $cat) {
            $sitemap_main->add(route('category', $cat->alias), $cat->updated_at, '0.8', 'weekly');
        }
//        categories
        $sitemap_main->store('xml', 'sitemap-main');
//=============================================>Main

        $sitemap = App::make("sitemap");

        $sitemap->addSitemap(URL::to('sitemap-articles.xml'));
        $sitemap->addSitemap(URL::to('sitemap-main.xml'));

        \Log::info('Sitemap updated - ' . date("d-m-Y H:i:s"));
        $sitemap->store('sitemapindex', 'sitemap');
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return DB::select('SELECT * FROM `cats_view`');
    }
}
