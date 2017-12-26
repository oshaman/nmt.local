@if(!empty($poll))
    <div>1. {{ $poll->answer1 .' - '. $stats->n1 ?? '0' }}</div>
    <div>2. {{ $poll->answer2 .' - '. $stats->n2 ?? '0' }}</div>
    <div>3. {{ $poll->answer3 .' - '. $stats->n3 ?? '0' }}</div>
    <div>4. {{ $poll->answer4 .' - '. $stats->n4 ?? '0' }}</div>
    <div>5. {{ $poll->answer5 .' - '. $stats->n5 ?? '0' }}</div>
@else
    <h5>Ви вже проголосували, дякуємо за Ваш голос</h5>
    <img src="./img/why.png" alt="" style="margin: 79px auto;display: block;">
@endif