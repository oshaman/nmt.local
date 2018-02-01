<div class="content">
    <div class="container">
        <div class="city-tv">
            <h1 class="city-caption"><span>Наше Місто TV</span></h1>
            <div class="straight-block">
                <div class="straight-left video-cat" data-id="online">
                    <img class="black" src="{{ asset('/') }}img/play.png" alt="">
                    <img class="redd" src="{{ asset('/') }}img/play-red.png" alt="">
                    <span>Прямий ефір</span>
                </div>
                @if(!empty($channels))
                    <div class="straight-right">
                        @foreach($channels as $channel)
                            @continue($loop->index>6)
                            <div class="news-item video-cat" data-id="{{ $channel->id }}">
                                <a href="#!">{{ $channel->title }}<span class="linn"></span></a>
                            </div>
                        @endforeach
                        <div class="news-item hovv-news">
                            <a href="javascript:void(0);">
                                Інші категорії<span class="linn"></span>
                            </a>
                            @if(count($channels)>7)
                                <div class="vijen">
                                    <div class="tenka"></div>
                                    <div class="vijen-insid">
                                        <div class="closd"><img src="{{ asset('/') }}/img/krest.png" alt=""></div>
                                        @foreach($channels as $channel)
                                            @continue($loop->index<7)
                                            <div class="news-item video-cat"
                                                 data-id="{{ $channel->id }}">
                                                <a href="#!">{{ $channel->title }}<span class="linn"></span></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{--Adaptive Video--}}
                    <div class="strai-main">рубріки відео</div>
                    @include('static.adaptive_video', $channels)
                @endif
            </div>

            <div class="players-block">
                <div class="players-left">

                    <img src="{{ asset('/') }}img/news.png" alt="">
                    <div class="item-players video-removable">
                            <div id="player5"></div>
                        <div class="vids" data-token="{{ $transmission->token ?? 'yA30K3z5PSw' }}"></div>
                        <div class="curtail"></div>
                        <div class="bakkk"></div>
                        <div class="mutte"><img src="{{ asset('/') }}img/mute.png" alt=""></div>

                        <div class="line-video"><img src="{{ asset('/') }}img/line-video.png" alt=""></div>
                    </div>
                </div>
                {{--<div class="date">
                    <div class="name4">Сегодня открыли новый музей им. Булгакова</div>
                    <div class="date4"><img src="{{ asset('/') }}img/time.png" alt=""><span>29.11.2017   20:30</span>
                    </div>
                </div>--}}
                <div class="players-right">
                    <div class="tenka"></div>
                    <div class="short-name">
                        <div class="shorr">Прямий ефір</div>
                    </div>
                    {{--ONLINE--}}
                    <div class="vert" data-ch="online">
                        @if(!empty($cards) && $cards->isNotEmpty())
                            @foreach($cards as $card)
                                <div class="newss newss-online">
                                    <div class="names-neww">{{ $card->title }}</div>
                                    <div class="time-neww">
                                        <img class="badd" src="{{ asset('/') }}img/time-efir.png" alt="">

                                        <img class="loadd" src="{{ asset('/') }}img/play-efir.png" alt="">
                                        <span>{{ date('d-m-Y H:i', strtotime($card->created_at)) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {{--ONLINE--}}
                    @if(!empty($channels))
                        @foreach($channels as $channel)
                            <div class="vert" style="display: none;" data-ch="{{ $channel->id }}">
                                @if(!empty($channel->videos) && $channel->videos->isNotEmpty())
                                    @foreach($channel->videos as $video)
                                        <div class="newss" data-id="{{ $channel->id }}"
                                             data-token="{{ $video->token }}">
                                            <div class="names-neww">{{ $video->title }}</div>
                                            <div class="time-neww">
                                                <img class="badd" src="{{ asset('/') }}img/time-efir.png" alt="">

                                                <img class="loadd" src="{{ asset('/') }}img/play-efir.png" alt="">
                                                <span>{{ date('d-m-Y H:i', strtotime($video->created_at)) }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <div class="aroww-block">
                        <div class="upss-aroww"></div>
                        <div class="dowm-aroww"></div>
                    </div>
                </div>
            </div>
            <div class="city-news">
                <h3 class="city-caption"><span>Новини Нашої Громади</span></h3>
                {{--Категории--}}
                @include('layouts.categories', ['categories'=>$categories])
                {{--Категории--}}
                {{--Статьи--}}
                <div class="hovy-city">
                    <div class="city-mainy styl-city">всі новини</div>
                    <div class="city-mainy glavn-hover">рубріки новин</div>
                    <div class="hody">
                        <div class="sect-news soloo">
                            <div class="news-item switch-cat active " data-id="1">
                                <a href="http://13.j2landing.com/categories">Всі новини<span class="linn"></span></a>
                            </div>
                            <div class="news-item  switch-cat " data-id="2">
                                <a href="http://13.j2landing.com/categories/politika">Політика<span class="linn"></span></a>
                            </div>
                            <div class="news-item  switch-cat " data-id="3">
                                <a href="http://13.j2landing.com/categories/kultura">Культура<span class="linn"></span></a>
                            </div>
                            <div class="news-item  switch-cat " data-id="4">
                                <a href="http://13.j2landing.com/categories/misto">Місто<span class="linn"></span></a>
                            </div>
                            <div class="news-item  switch-cat " data-id="5">
                                <a href="http://13.j2landing.com/categories/sport">Спорт<span class="linn"></span></a>
                            </div>
                            <div class="news-item  switch-cat " data-id="6">
                                <a href="http://13.j2landing.com/categories/afisha">Афіша<span class="linn"></span></a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="main-news cat-removeble">
                    @if(!empty($articles))
                        @foreach($articles as $article)
                            @continue($loop->index > 5)
                            <div class="mainy @if($loop->index > 2) adaptiv-mainy @endif">
                                <div class="hovvy"></div>
                                <div class="osnov main-hover">
                                    <a href="{{ route('article', $article->alias) }}">
                                        <div class="imgg-news">
                                            <img src="{{ asset('/asset/images/articles/middle').'/'.$article->image->path }}"
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

                                            <h3><span>{{ str_limit($article->title, 64) }}</span></h3>
                                            <div class="block-text neww">
                                                <p>{{ $article->content }}</p>
                                                <div class="main-buty">
                                                    <span class="read-more">
                                                        детальніше
                                                        <span class="linn"></span>
                                                    </span>
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
                    <div class="other-news">
                        @if(!empty($articles))
                            @foreach($articles as $article)
                                @continue($loop->index < 3)
                                <div class="other-item">
                                    <a href="{{ route('article', $article->alias) }}">
                                        <div class="left-other">
                                            <img src="{{ asset('/asset/images/articles/small').'/'.$article->image->path }}"
                                                 alt="{{ $article->image->alt }}" title="{{ $article->image->title }}">
                                        </div>

                                        <div class="right-other">
                                            <h4>{{ str_limit($article->title, 64) }}</h4>
                                            <div class="left-coments">
                                                <img src="{{ asset('/') }}img/time-efir.png" alt="">
                                                <div class="date-neww">{{ $article->date }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                    </div>
                    <div class="main-buty">
                        <a href="{{ route('category') }}">всі новини<span
                                    class="linn"></span></a>
                    </div>
                    @endif
                    {{--Статьи--}}
                </div>
            </div>

        </div>


        <div class="video-bott">
            <div class="vidos"><img src="{{ asset('/') }}img/news.png" alt=""></div>
            <div class="play-vidos"><img src="{{ asset('/') }}img/play-white.png" alt=""></div>
            <div class="line-left"><img src="{{ asset('/') }}img/line-video7.png" alt=""></div>
            <div class="line-bott"></div>
        </div>
    </div>
</div>
