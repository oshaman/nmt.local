{{--Опрос--}}
<div class="inter-news">
    <h1 class="city-caption"><span>Опитування</span></h1>
    @if(!empty($poll))
        <form action="{{ route('polls') }}" method="post">
            {{ csrf_field() }}
            <div class="form-inter">
                <div class="inter-quest quest-one">
                    <h5>{{ $poll->title }}</h5>
                    {!! $poll->description !!}
                </div>

                <div class="inter-quest quest-four">
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
                <div class="inter-quest quest-five">
                    @if(empty($statistic))
                        <h5>Довідайтеся про результат після того, як залишите свій голос</h5>
                        <img src="./img/why.png" alt="" style="margin: 79px auto;display: block;">
                    @else
                        <h5>Ви вже проголосували, дякуємо за Ваш голос</h5>
                        <div>1. {{ $poll->answer1 .' - '. $statistic->n1 ?? '0' }}</div>
                        <div>2. {{ $poll->answer2 .' - '. $statistic->n2 ?? '0' }}</div>
                        <div>3. {{ $poll->answer3 .' - '. $statistic->n3 ?? '0' }}</div>
                        <div>4. {{ $poll->answer4 .' - '. $statistic->n4 ?? '0' }}</div>
                        <div>5. {{ $poll->answer5 .' - '. $statistic->n5 ?? '0' }}</div>
                    @endif
                </div>
            </div>
            <div class="main-buty buty-opros"><a href="/">Інші опитування<span class="linn"></span></a></div>
        </form>
    @endif
</div>
{{--Опрос--}}