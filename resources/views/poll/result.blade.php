@if(!empty($poll))
    <div class="vote">
        <h5>В опитуванні прийняли участь @if(count($stats)<1) 0 @else {{ array_sum($stats) }} @endif осіб</h5>
        <div class="unswers poll1">
            <div class="vote-verh">
                {{ $poll->answer1 .' - '. (round($stats['n1']*100/array_sum($stats))) ?? '0' }}%
            </div>
            <div class="vote-down" data-width="{{ round($stats['n1']*100/array_sum($stats)) }}">
                <div class="line-down"></div>
            </div>
        </div>
        <div class="unswers poll2">
            <div class="vote-verh">
                {{ $poll->answer2 .' - '. (round($stats['n2']*100/array_sum($stats))) ?? '0' }}%
            </div>
            <div class="vote-down" data-width="{{ round($stats['n2']*100/array_sum($stats)) }}">
                <div class="line-down"></div>
            </div>
        </div>
        <div class="unswers poll3">
            <div class="vote-verh">
                {{ $poll->answer3 .' - '. (round($stats['n3']*100/array_sum($stats))) ?? '0' }}%
            </div>
            <div class="vote-down" data-width="{{ round($stats['n3']*100/array_sum($stats)) }}">
                <div class="line-down"></div>
            </div>
        </div>
        <div class="unswers poll4">
            <div class="vote-verh">
                {{ $poll->answer4 .' - '. (round($stats['n4']*100/array_sum($stats))) ?? '0' }}%
            </div>
            <div class="vote-down" data-width="{{ round($stats['n4']*100/array_sum($stats)) }}">
                <div class="line-down"></div>
            </div>
        </div>
        <div class="unswers poll5">
            <div class="vote-verh">
                {{ $poll->answer5 .' - '. (round($stats['n5']*100/array_sum($stats))) ?? '0' }}%
            </div>
            <div class="vote-down" data-width="{{ round($stats['n5']*100/array_sum($stats)) }}">
                <div class="line-down"></div>
            </div>
        </div>
    </div>
@else
    <h5>Ви вже проголосували, дякуємо за Ваш голос</h5>
    <img src="./img/why.png" alt="" style="margin: 79px auto;display: block;">
@endif