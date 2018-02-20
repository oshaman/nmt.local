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
                        <div class="yelow-line @if($article->hasvideo) line-play @endif @if($article->hasimage) line-photo @endif">{{ $article->category->name }}</div>
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
                            <div class="main-buty"><a href="{{ route('article', $article->alias) }}">детальніше<span
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
    <a href="{{ route('category', $cat->alias ?? '') }}">всі новини<span class="linn"></span></a>
</div>
@endif