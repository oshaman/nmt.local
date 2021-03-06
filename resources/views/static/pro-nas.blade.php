<div class="content about-us">
    <div class="container">
        <div class="main-arti">
            {{--breadcrumbs--}}
            <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope
                 itemtype="http://schema.org/BreadcrumbList">
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <a href="{{ route('main') }}" itemprop="item">Головна</a>
                    <meta itemprop="position" content="1"/>
                </div>
                <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="button">
                    <span itemprop="name" class="label1">Про проект</span>
                    <meta itemprop="position" content="2"/>
                </div>
            </div>
            {{--breadcrumbs--}}
            <div class="part">
                {{--<div class="pro"></div>--}}
                <h4>Про проект</h4>

                <div class="conty">

                    {!! $article->text !!}

                    <div class="lucky"></div>
                </div>
            </div>

            <div class="city-news">
                <h3 class="city-caption"><span>Останні Новини Нашого Міста</span></h3>

                {{--Категории
                @include('layouts.categories', ['categories'=>$categories, 'cat'=>$article->category->name])
                Категории--}}

                <div class="main-news">

                    @if(!empty($articles))
                        @foreach($articles as $article)
                            <div class="mainy">
                                <div class="hovvy"></div>
                                <div class="osnov main-hover">
                                    <a href="{{ route('article', $article->alias) }}">
                                        <div class="imgg-news">
                                            <img src="{{ asset('asset') }}/images/articles/middle/{{ $article->image->path }}"
                                                 alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                            <div class="yelow-line @if($article->hasvideo) line-play @endif @if($article->hasimage) line-photo @endif">
                                                {{ $article->category->name }}
                                            </div>
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
                                                <p>{{ $article->content }}</p>
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
                                            <div class="right-coments">
                                                <img src="{{ asset('/') }}img/wath.png" alt="">
                                                <span>{{ $article->view }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    @endif
                    <div class="clear"></div>


                    <div class="main-buty"><a href="{{ route('category') }}">всі новини<span class="linn"></span></a>
                    </div>


                </div>
            </div>

        </div>


    </div> <!--Container-->


    <div class="video-bott">
        <div class="vidos"><img src="{{ asset('/') }}img/news.png" alt=""></div>
        <div class="play-vidos"><img src="{{ asset('/') }}img/play-white.png" alt=""></div>
        <div class="line-left"><img src="{{ asset('/') }}img/line-video7.png" alt=""></div>
        <div class="line-bott"></div>
    </div>
</div>