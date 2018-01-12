@extends('layouts.main')

@section('header')
    {!! $header ?? ''!!}
@endsection

@section('content')
    <div class="container">
        <div class="oops-page-content">
            <strong class="simple-text">Вибачте, цієї сторінки більше не існує</strong>
            <strong class="text-404">404</strong>
            <img class="img-404" src="{{ asset('/') }}img/oops-page-bckgrnd.jpg" alt="">
        </div>
    </div>
    <div class="container">
        <div class="city-news">
            <h3 class="city-caption"><span>Можливо Вас зацікавить</span></h3>

            <div class="main-news">
                @forelse($articles as $article)
                    <div class="mainy">
                        <div class="hovvy"></div>
                        <div class="osnov main-hover">
                            <a href="{{ route('article', $article->alias) }}">
                                <div class="imgg-news">
                                    <img src="{{ asset('asset') }}/images/articles/middle/{{ $article->image->path }}"
                                         alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                    <div class="yelow-line">{{ $article->category->name }}</div>
                                    <div class="coments-news">
                                        <div class="left-coments">

                                            <img src="{{ asset('/') }}img/time-efir5.png" alt="">
                                            <div class="date-neww">{{ $article->date }}</div>
                                            <div class="times-newws">{{ $article->time }}</div>
                                        </div>
                                        <div class="right-coments">
                                            <img src="{{ asset('/') }}img/wath5.png" alt="">
                                            <span>{{ $article->view }}</span>
                                        </div>

                                    </div>
                                    <div class="fonn-hovy"></div>

                                </div>
                                <div class="content-news">

                                    <h3><span>{{ $article->title }}</span></h3>
                                    <div class="block-text neww">

                                        <p>{{  $article->preview }}</p>
                                        <div class="main-buty">
                                            <a href="{{ route('article', $article->alias) }}">
                                                читати далі<span class="linn"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="coments-news">
                                    <div class="left-coments">
                                        <img src="{{ asset('/') }}img/time-efir.png" alt="">
                                        <div class="date-neww">{{ $article->date }}</div>
                                        <div class="times-newws">{{ $article->time }}</div>
                                    </div>
                                    <div class="right-coments"><img src="{{ asset('/') }}img/wath.png" alt="">
                                        <span>{{ $article->view }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                @empty
                    404
                @endforelse
                <div class="clear"></div>

                <div class="main-buty">
                    <a href="{{ route('category') }}">всі новини<span class="linn"></span></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {!! $footer ?? ''!!}
@endsection