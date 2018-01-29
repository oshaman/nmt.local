{{--Опрос--}}
<div class="inter-news">
    <h1 class="city-caption"><span>Опитування</span></h1>
    @if(!empty($poll))
        <form action="{{ route('polls') }}" method="post">
            {{ csrf_field() }}
            <div class="form-inter">
                <div class="inter-quest quest-one">
                    <h5>{{ $poll->title }}</h5>
                    <div class="comm onny-scrol">
                        <div class="unit">{!! $poll->description !!}</div>
                    </div>
                </div>

                <div class="inter-quest quest-four">
                    <div class="aftys"></div>
                    <h5>{{ $poll->question }}</h5>
                    <input type="hidden" name="stats">
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
                        <img src="./img/why.png" alt="" style="margin: 79px auto;display: block;">
                        @if(!empty($poll->remains))
                            <h5>До кінця опитування залишилося {{ $poll->remains }}</h5>
                        @endif
                    @else
                        <div class="vote soon">
                            <h5>В опитуванні прийняли участь @if(count($statistic)<1)
                                    0 @else {{ array_sum($statistic) }} @endif осіб</h5>
                            <div class="unswers poll1 @if('poll1' == session('poll_id_' . $poll->id)) choosed @endif">
                                <div class="vote-verh">
                                    {{ $poll->answer1 .' - '. (round($statistic['n1']*100/array_sum($statistic))) ?? '0' }}
                                    %
                                </div>
                                <div class="vote-down"
                                     data-width="{{ round($statistic['n1']*100/array_sum($statistic)) }}">
                                    <div class="line-down"></div>
                                </div>
                            </div>
                            <div class="unswers poll2 @if('poll2' == session('poll_id_' . $poll->id)) choosed @endif">
                                <div class="vote-verh">
                                    {{ $poll->answer2 .' - '. (round($statistic['n2']*100/array_sum($statistic))) ?? '0' }}
                                    %
                                </div>
                                <div class="vote-down"
                                     data-width="{{ round($statistic['n2']*100/array_sum($statistic)) }}">
                                    <div class="line-down"></div>
                                </div>
                            </div>
                            <div class="unswers poll3 @if('poll3' == session('poll_id_' . $poll->id)) choosed @endif">
                                <div class="vote-verh">
                                    {{ $poll->answer3 .' - '. (round($statistic['n3']*100/array_sum($statistic))) ?? '0' }}
                                    %
                                </div>
                                <div class="vote-down"
                                     data-width="{{ round($statistic['n3']*100/array_sum($statistic)) }}">
                                    <div class="line-down"></div>
                                </div>
                            </div>
                            <div class="unswers poll4 @if('poll4' == session('poll_id_' . $poll->id)) choosed @endif">

                                <div class="vote-verh">
                                    {{ $poll->answer4 .' - '. (round($statistic['n4']*100/array_sum($statistic))) ?? '0' }}
                                    %
                                </div>
                                <div class="vote-down"
                                     data-width="{{ round($statistic['n4']*100/array_sum($statistic)) }}">
                                    <div class="line-down"></div>
                                </div>
                            </div>
                            <div class="unswers poll5 @if('poll5' == session('poll_id_' . $poll->id)) choosed @endif">
                                <div class="vote-verh">
                                    {{ $poll->answer5 .' - '. (round($statistic['n5']*100/array_sum($statistic))) ?? '0' }}
                                    %
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
            <div class="main-buty buty-opros">
                <a href="{{ route('poll') }}">Інші опитування<span class="linn"></span></a>
            </div>
        </form>
    @endif
</div>
{{--Опрос--}}