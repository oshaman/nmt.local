<div class="content">
    <div class="container">
        <div class="city-tv">
            <h1 class="city-caption"><span>Наше Місто TV</span></h1>
            <div class="straight-block">
                <div class="straight-left"><img src="{{ asset('/') }}img/play.png" alt=""><span>Прямий эфір</span></div>
                <div class="straight-right">
                    @if(!empty($channels))
                        @foreach($channels as $channel)
                            <div class="news-item video-cat @if($loop->first) active @endif"
                                 data-id="{{ $channel->id }}">
                                <a href="#!">{{ $channel->title }}<span class="linn"></span></a>
                            </div>
                        @endforeach
                    @endif
                    <div class="news-item"><a href="#!">Інші категорії<span class="linn"></span></a></div>
                </div>
            </div>
            <div class="players-block">
                <div class="players-left">

                    <img src="{{ asset('/') }}img/news.png" alt="">
                    <div class="item-players video-removable">
                        {{-- <p>
                             <iframe src="//www.youtube.com/embed/T5WCWpRpHDQ?&autoplay=1" width="560" height="314"
                                     allowfullscreen="allowfullscreen"></iframe>
                         </p>--}}
                        <p class="main-video">
                            <iframe src="//www.youtube.com/embed/yA30K3z5PSw?&autoplay=1" width="560" height="314"
                                    allowfullscreen="allowfullscreen"></iframe>
                        </p>

                        <div class="line-video"><img src="{{ asset('/') }}img/line-video.png" alt=""></div>
                    </div>
                </div>
                <div class="date">
                    <div class="name4">Сегодня открыли новый музей им. Булгакова</div>
                    <div class="date4"><img src="{{ asset('/') }}img/time.png" alt=""><span>29.11.2017   20:30</span>
                    </div>
                </div>
                <div class="players-right">


                    {{--<div class="newss active">
                        <div class="names-neww">
                            <iframe src="//www.youtube.com/embed/T5WCWpRpHDQ?modestbranding=1&controls=0&autohide=1"
                                    width="250" height="150"></iframe>
                            Важные новости из Министерства Здравоохранения
                        </div>
                        <div class="time-neww"><img src="{{ asset('/') }}img/play-efir.png" alt=""><span>ПРЯМОЙ ЭФИР</span></div>
                    </div>--}}
                    @if(!empty($channels))
                        @foreach($channels as $channel)
                            <div class="vert" @if(!$loop->first) style="display: none;"
                                 @endif data-ch="{{ $channel->id }}">
                                @if(!empty($channel->videos) && $channel->videos->isNotEmpty())
                                    @foreach($channel->videos as $video)
                                        <div class="newss" data-id="{{ $video->id }}" data-token="{{ $video->token }}">
                                            <div class="names-neww">{{ $video->title }}</div>
                                            <div class="time-neww">
                                                <img src="{{ asset('/') }}img/time-efir.png" alt="">
                                                <span>трансляція - {{ $video->created_at }}</span>
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
                <h3 class="city-caption"><span>Новини Нашого Міста</span></h3>
                {{--Категории--}}
                @include('layouts.categories', ['categories'=>$categories])
                {{--Категории--}}
                {{--Статьи--}}
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
                                                <div class="main-buty"><a
                                                            href="{{ route('article', $article->alias) }}">детальніше<span
                                                                class="linn"></span></a></div>

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
