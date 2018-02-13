<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Підтасовка</h3>

    @if(!empty($poll))
        {!! Form::open(['url'=>route('results_poll', $poll->id), 'method'=>'post', 'class'=>'form-horizontal panel-body']) !!}
        <div class="form-group">
            <h4>{{ $poll->answer1 }}</h4>
            {!! Form::number('n1', $poll->statistic->n1 ?? 0); !!}
        </div>

        <div class="form-group">
            <h4>{{ $poll->answer2 }}</h4>
            {!! Form::number('n2', $poll->statistic->n2 ?? 0); !!}
        </div>

        <div class="form-group">
            <h4>{{ $poll->answer3 }}</h4>
            {!! Form::number('n3', $poll->statistic->n3 ?? 0); !!}
        </div>

        <div class="form-group">
            <h4>{{ $poll->answer4 }}</h4>
            {!! Form::number('n4', $poll->statistic->n4 ?? 0); !!}
        </div>

        <div class="form-group">
            <h4>{{ $poll->answer5 }}</h4>
            {!! Form::number('n5', $poll->statistic->n5 ?? 0); !!}
        </div>

        <hr>

        <div class="form-group">
            {!! Form::button('Змахлювати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
        {!! Form::close() !!}
    @endif

</div>