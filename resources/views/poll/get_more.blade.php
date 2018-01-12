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
{{--Pagination--}}
@if(is_object($polls) && !empty($polls->lastPage()) && $polls->lastPage() > 1)
    <div class="articles-pagination">
        @if($polls->lastPage() > 1)
            @if($polls->currentPage() !== 1)
                <a href="{{ $polls->url(($polls->currentPage() - 1)) }}" class="forward-back"></a>
            @endif
            @if($polls->currentPage() >= 3)
                <a class="pagin-number active-pagin-number">1</a>
            @endif
            @if($polls->currentPage() >= 4)
                <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
            @endif
            @if($polls->currentPage() !== 1)
                <a class="pagin-number active-pagin-number">{{ $polls->currentPage()-1 }}</a>
            @endif
            <a class="active-pagin-number pagin-number">{{ $polls->currentPage() }}</a>
            @if($polls->currentPage() !== $polls->lastPage())
                <a href="{{ $polls->url($polls->currentPage()+1) }}"
                   class="pagin-number">{{ $polls->currentPage()+1 }}</a>
            @endif
            @if($polls->currentPage() <= ($polls->lastPage()-3))
                <a>&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;</a>
            @endif
            @if($polls->currentPage() <= ($polls->lastPage()-2))
                <a href="{{ $polls->url($polls->lastPage()) }}"
                   class="pagin-number">{{ $polls->lastPage() }}</a>
            @endif
            @if($polls->currentPage() !== $polls->lastPage())
                <a rel="next" href="{{ $polls->url(($polls->currentPage() + 1)) }}"
                   class="forward"></a>
            @endif
        @endif
    </div>
@endif