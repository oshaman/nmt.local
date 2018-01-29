<div class="content main-view">
    <div class="container">

        <div class="bread-crumbs breadcrumbs mobile-display-none" id="breadcrumbs" itemscope=""
             itemtype="http://schema.org/BreadcrumbList">
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="button">
                <a href="http://13.j2landing.com" itemprop="item">Головна</a>
                <meta itemprop="position" content="1">
            </div>
            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="button">
                <a href="{{ route('poll') }}" itemprop="item">Опитування Нашого Міста</a>
                <meta itemprop="position" content="2">
            </div>

            <div itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="button">
                <span itemprop="name" class="label1">{{ $poll->question }}</span>
                <meta itemprop="position" content="3">
            </div>
        </div>

        {{--<=============== Main Poll ===============>--}}
        <div class="form-inter">
            <div class="inter-quest quest-one">
                <h5>{{ $poll->title }}</h5>
                <div class="comm onny-scrol">
                    <div class="unit">

                        @if(!empty($poll->image))
                            <img src="{{ asset('asset/images/polls').'/'.$poll->image }}"
                                 alt="{{ $poll->alt ?? '' }}" title="{{ $poll->imgtitle ?? '' }}">
                        @endif
                        {!! $poll->description !!}</div>
                </div>
            </div>

            <div class="inter-quest quest-four">
                <div class="aftys"></div>
                <h5>{{ $poll->question }}</h5>
                <input name="stats" type="hidden">
                <input type="hidden" name="poll-id" value="{{ $poll->id }}" data-poll="{{ $poll->id }}">
                <ul>
                    <li>
                        <input type="radio" id="poll1" name="selects" value="poll1" class="radio-poll">
                        <label for="poll1">
                            <span>1.</span><span>{{ $poll->answer1 }}<span class="linn"></span></span>
                        </label>
                        <div class="check"></div>
                    </li>
                    <li><input type="radio" id="poll2" name="selects" value="poll2" class="radio-poll">
                        <label for="poll2">
                            <span>2.</span><span>{{ $poll->answer2 }}<span class="linn"></span></span>
                        </label>
                        <div class="check"></div>
                    </li>

                    <li><input type="radio" id="poll3" name="selects" value="poll3" class="radio-poll">
                        <label for="poll3">
                            <span>3.</span><span>{{ $poll->answer3 }}<span class="linn"></span></span>
                        </label>
                        <div class="check"></div>
                    </li>

                    <li><input type="radio" id="poll4" name="selects" value="poll4" class="radio-poll">
                        <label for="poll4">
                            <span>4.</span><span>{{ $poll->answer4 }}<span class="linn"></span></span>
                        </label>
                        <div class="check"></div>
                    </li>

                    <li><input type="radio" id="poll5" name="selects" value="poll5" class="radio-poll">
                        <label for="poll5">
                            <span>5.</span><span>{{ $poll->answer5 }}<span class="linn"></span></span>
                        </label>
                        <div class="check"></div>
                    </li>
                </ul>

                <div class="main-buty poll">
                    <a href="" onclick="return false">Проголосувати<span class="linn"></span></a>
                </div>
            </div>
            {{--<---- Poll results ---->--}}
            <div class="inter-quest quest-five">
                @if(empty($statistic))
                    <h5>Довідайтеся про результат після того, як залишите свій голос</h5>
                    <img src="{{ asset('img') }}/why.png" alt="" style="margin: 79px auto;display: block;">
                    @if(!empty($poll->remains))
                        <h5>До кінця опитування залишилося {{ $poll->remains }}</h5>
                    @endif
                @else
                    <div class="vote soon">
                        <h5>В опитуванні прийняли участь @if(count($statistic)<1)
                                0 @else {{ array_sum($statistic) }} @endif осіб</h5>
                        <div class="unswers poll1 @if('poll1' == session('poll_id_' . $poll->id)) choosed @endif">
                            <div class="vote-verh">
                                {{ $poll->answer1 .' - '. (round($statistic['n1']*100/array_sum($statistic))) ?? '0' }}%
                            </div>
                            <div class="vote-down"
                                 data-width="{{ round($statistic['n1']*100/array_sum($statistic)) }}">
                                <div class="line-down"></div>
                            </div>
                        </div>
                        <div class="unswers poll2 @if('poll2' == session('poll_id_' . $poll->id)) choosed @endif">
                            <div class="vote-verh">
                                {{ $poll->answer2 .' - '. (round($statistic['n2']*100/array_sum($statistic))) ?? '0' }}%
                            </div>
                            <div class="vote-down"
                                 data-width="{{ round($statistic['n2']*100/array_sum($statistic)) }}">
                                <div class="line-down"></div>
                            </div>
                        </div>
                        <div class="unswers poll3 @if('poll3' == session('poll_id_' . $poll->id)) choosed @endif">
                            <div class="vote-verh">
                                {{ $poll->answer3 .' - '. (round($statistic['n3']*100/array_sum($statistic))) ?? '0' }}%
                            </div>
                            <div class="vote-down"
                                 data-width="{{ round($statistic['n3']*100/array_sum($statistic)) }}">
                                <div class="line-down"></div>
                            </div>
                        </div>
                        <div class="unswers poll4 @if('poll4' == session('poll_id_' . $poll->id)) choosed @endif">

                            <div class="vote-verh">
                                {{ $poll->answer4 .' - '. (round($statistic['n4']*100/array_sum($statistic))) ?? '0' }}%
                            </div>
                            <div class="vote-down"
                                 data-width="{{ round($statistic['n4']*100/array_sum($statistic)) }}">
                                <div class="line-down"></div>
                            </div>
                        </div>
                        <div class="unswers poll5 @if('poll5' == session('poll_id_' . $poll->id)) choosed @endif">
                            <div class="vote-verh">
                                {{ $poll->answer5 .' - '. (round($statistic['n5']*100/array_sum($statistic))) ?? '0' }}%
                            </div>
                            <div class="vote-down"
                                 data-width="{{ round($statistic['n5']*100/array_sum($statistic)) }}">
                                <div class="line-down"></div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
            {{--<---- Poll results ---->--}}
        </div>
        {{--<=============== Main Poll ===============>--}}

        <div class="vieww">

            <h1 class="city-caption"><span>Всі опитування</span></h1>
            <div class="main-news">
                @if(!empty($polls))
                    @foreach($polls as $poll)
                        <div class="mainy">
                            <div class="hovvy"></div>
                            <div class="osnov main-hover">
                                <a href="{{ route('poll', $poll->alias) }}">
                                    <div class="imgg-news">
                                        @if(!empty($poll->image))
                                            <img src="{{ asset('asset/images/polls').'/'.$poll->image }}"
                                                 alt="{{ $poll->alt ?? '' }}" title="{{ $poll->imgtitle ?? '' }}">
                                        @else
                                            <img src="{{ asset('img/default-img-poll.jpg') }}">
                                        @endif
                                        <div class="coments-news">
                                            <div class="left-coments">

                                                <img src="{{ asset('/') }}img/time-efir5.png" alt="">
                                                <div class="date-neww">{{ $poll->date }}</div>
                                                <div class="times-newws">{{ $poll->time }}</div>
                                            </div>
                                            <div class="right-coments">
                                                <img src="{{ asset('/') }}img/wath5.png" alt="">
                                                <span>{{ $poll->voited }}</span>
                                            </div>

                                        </div>
                                        <div class="fonn-hovy"></div>

                                    </div>
                                    <div class="content-news">

                                        <h3><span>{{ str_limit($poll->question, 64) }}</span></h3>
                                        <div class="block-text neww">
                                            <p>{!! strip_tags($poll->description) !!}</p>
                                            <div class="main-buty">
                                            <span class="read-more">
                                                проголосувати
                                                <span class="linn"></span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="coments-news">
                                        <div class="left-coments">
                                            <img src="{{ asset('/') }}img/time-efir.png" alt="">
                                            <div class="date-neww">{{ $poll->date }}</div>
                                            <div class="times-newws">{{ $poll->time }}</div>
                                        </div>
                                        <div class="right-coments">
                                            <img src="{{ asset('/') }}img/wath.png" alt="">
                                            <span>{{ $poll->voited }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div><!--end container--->
</div><!--end content-->