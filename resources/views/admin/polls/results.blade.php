<h2>Підтасовка</h2>
@if(!empty($poll))
    {!! Form::open(['url'=>route('results_poll', $poll->id), 'method'=>'post', 'class'=>'form-horizontal']) !!}
    <div>
        <h4>{{ $poll->answer1 }}</h4>
        {!! Form::number('n1', $poll->statistic->n1 ?? 0); !!}
    </div>
    <div>
        <h4>{{ $poll->answer2 }}</h4>
        {!! Form::number('n2', $poll->statistic->n2 ?? 0); !!}
    </div>
    <div>
        <h4>{{ $poll->answer3 }}</h4>
        {!! Form::number('n3', $poll->statistic->n3 ?? 0); !!}
    </div>
    <div>
        <h4>{{ $poll->answer4 }}</h4>
        {!! Form::number('n4', $poll->statistic->n4 ?? 0); !!}
    </div>
    <div>
        <h4>{{ $poll->answer5 }}</h4>
        {!! Form::number('n5', $poll->statistic->n5 ?? 0); !!}
    </div>
    <hr>
    <div class="row">
        {!! Form::button('Змахлювати', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
@endif