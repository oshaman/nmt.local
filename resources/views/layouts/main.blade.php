<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/') }}/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="{{ asset('/') }}/css/main.css">
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
            {{ env('APP_NAME') .' - '. $title }}
        @endif
    </title>

</head>
<body>

@yield('header')

@yield('content')

@yield('poll')

@yield('footer')

<script src="{{ asset('/') }}/js/jquery-3.2.1.min.js"></script>
<script src="{{ asset('/') }}/js/jquery.mCustomScrollbar.min.js"></script>
<script src="{{ asset('/') }}/js/main.js"></script>
@yield('jss')
</body>
</html>