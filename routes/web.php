<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@show')->name('main');

Route::post('/poll', 'PollController@addToPolls')->name('polls');
Route::post('/get-articles', 'IndexController@getArticles');

Route::get('article/{article_alias}', 'ArticleController@show')->name('article')->where('article_alias', '[\w-]+');

Route::get('categories/{cat_alias?}', 'ArticleController@cats')->name('category')->where('cat_alias', '[\w-]+');
Route::get('tags/{tag_alias}', 'ArticleController@tags')->name('tag')->where('tag_alias', '[\w-]+');

Route::view('/welcome', 'index');
Route::view('/article1', 'article');
Route::view('/articles', 'articles');

//================================================= ADMIN ============================================================
/**
 * ADMIN PANEL
 */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'Admin\IndexController@show')->name('admin');
    /**
     *   Admin USERS
     */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Admin\UsersController@show')->name('users_admin');
        Route::match(['get', 'post'], 'edit/{user}', ['uses' => 'Admin\UsersController@edit', 'as' => 'users_update'])
            ->where('user', '[0-9]+');
        Route::match(['get', 'post'], 'create', 'Admin\UsersController@store')->name('users_create');
        Route::get('del/{user}', ['uses' => 'Admin\UsersController@destroy', 'as' => 'delete_user'])
            ->where('user', '[0-9]+');
    });
    /**
     *   Admin ARTICLES
     *
     */
    Route::group(['prefix' => 'articles'], function () {
        //  show articles list
        Route::get('/', ['uses' => 'Admin\ArticlesController@index', 'as' => 'admin_articles']);
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\ArticlesController@create', 'as' => 'create_article']);
        Route::match(['get', 'post'], 'edit/{article}', ['uses' => 'Admin\ArticlesController@edit', 'as' => 'edit_article'])
            ->where('article', '[0-9]+');
        Route::get('del/{article}', ['uses' => 'Admin\ArticlesController@del', 'as' => 'delete_article'])
            ->where('article', '[0-9]+');

        //SEO
        Route::match(['post', 'get'], 'seo/{article}', 'Admin\ArticleSeoController@updateSeo')
            ->name('admin_article_seo')->where('article', '[0-9]+');

    });
    /**
     *   Admin CATEGORIES
     */
    Route::group(['prefix' => 'cats'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\CatsController@index', 'as' => 'cats']);
        Route::match(['get', 'post'], 'edit/{cat}', ['uses' => 'Admin\CatsController@edit', 'as' => 'edit_cats'])
            ->where('cat', '[0-9]+');
    });
    /**
     *   Admin TAGS
     */
    Route::group(['prefix'=>'tags'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\TagsController@index', 'as' => 'admin_tags']);
        Route::match(['get', 'post'], 'edit/{tag}', ['uses' => 'Admin\TagsController@edit', 'as' => 'edit_tags'])
            ->where('tag', '[0-9]+');
        Route::get('delete/{tag}', ['uses' => 'Admin\TagsController@destroy', 'as' => 'delete_tag'])->where('tag', '[0-9]+');
    });
    /**
     *   Admin videos
     *
     */
    Route::group(['prefix' => 'videos'], function () {
        //  show videos list
        Route::get('/', ['uses' => 'Admin\VideosController@index', 'as' => 'admin_videos']);
        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\VideosController@create', 'as' => 'create_video']);
        Route::match(['get', 'post'], 'edit/{video}', ['uses' => 'Admin\VideosController@edit', 'as' => 'edit_video'])
            ->where('video', '[0-9]+');
        Route::get('del/{video}', ['uses' => 'Admin\VideosController@del', 'as' => 'delete_video'])
            ->where('video', '[0-9]+');
        /*
                //SEO
                Route::match(['post', 'get'], 'seo/{video}', 'Admin\videoseoController@updateSeo')
                    ->name('admin_video_seo')->where('video', '[0-9]+');*/

    });
    /**
     *   Admin CHANNELS
     */
    Route::group(['prefix' => 'channels'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\ChannelsController@index', 'as' => 'admin_channels']);
        Route::match(['get', 'post'], 'edit/{channel}', ['uses' => 'Admin\ChannelsController@edit', 'as' => 'edit_channel'])
            ->where('channel', '[0-9]+');
    });
    /**
     *   Admin POLLS
     */
    Route::group(['prefix' => 'polls'], function () {
        Route::match(['get', 'post'], '/', ['uses' => 'Admin\PollsController@index', 'as' => 'admin_polls']);

        Route::match(['get', 'post'], 'create', ['uses' => 'Admin\PollsController@create', 'as' => 'create_poll']);
        Route::match(['get', 'post'], 'edit/{poll}', ['uses' => 'Admin\PollsController@edit', 'as' => 'edit_poll'])
            ->where('poll', '[0-9]+');
        /* Route::get('delete/{poll}', ['uses' => 'Admin\PollsController@destroy', 'as' => 'delete_poll'])
             ->where('poll', '[0-9]+');*/
    });
    /**
     * Admin SEO
     */
    Route::group(['prefix' => 'seo'], function () {
        Route::get('/', 'Admin\SeoController@index')->name('seo_admin');
        Route::match(['post', 'get'], 'edit/{seo}', 'Admin\SeoController@edit')->name('seo_update')->where('seo', '[0-9]+');
    });

});
//================================================= ADMIN ============================================================
//Auth
Route::get('login', 'Auth\AuthController@showLoginForm')->name('login');
Route::post('login', 'Auth\AuthController@login');
Route::post('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\PasswordController@reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\PasswordController@showResetForm')->name('password.reset');