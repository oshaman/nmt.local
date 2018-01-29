<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/') }}/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/date.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/main.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/main_sasha.css">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    @if(!empty($seo->seo_keywords))
        <meta name="keywords" content="{{ $seo->seo_keywords }}">
    @endif
    @if(!empty($seo->seo_description))
        <meta name="description" content="{{ $seo->seo_description }}">
    @endif
    @if(!empty($seo->og_title))
        <meta property="og:title" content="{{ $seo->og_title }}"/>
    @endif
    @if(!empty($seo->og_description))
        <meta property="og:description" content="{{ $seo->og_description }}"/>
    @endif
    <meta property="og:url" content="{{ url()->current() }}"/>
    @if(!empty($seo->og_image))
        <meta property="og:image" content="{{ $seo->og_image }}"/>
    @endif
    <title>
        @if(!empty($seo->seo_title))
            {{ env('APP_NAME') .' - '. $seo->seo_title }}
        @else
            {{ env('APP_NAME') .' - '. ($title ?? '') }}
        @endif
    </title>

</head>
<body @if('article' == Route::currentRouteName()) class="one_article"
      @elseif('main' == Route::currentRouteName()) class="main-page" @endif>

@yield('header')

@yield('content')

@yield('poll')

@yield('footer')

<script src="{{ asset('/') }}/js/jquery-3.2.1.min.js"></script>
<script src="{{ asset('/') }}/js/jquery.mCustomScrollbar.min.js"></script>
<script src="{{ asset('/') }}/js/datepicker.js"></script>
<script src="{{ asset('/') }}/js/main.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<div class="video-youtube">
    <div class="player-administration">
        <a href="/"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
        <div class="payer-new-window"><i class="fa fa-external-link" aria-hidden="true"></i></div>
        <div class="close-video-player"><i class="fa fa-times" aria-hidden="true"></i></div>
    </div>
    <div id="playerr"></div>
</div>

<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.


</script>


@yield('jss')
<script src="{{ asset('/') }}/js/player.js"></script>
</body>
</html>