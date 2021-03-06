@include('admin.video.nav')
<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Редагувати канал</h3>

    {!! Form::open(['url' => route('edit_channel', $channel->id), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('title', 'Заголовок каналу') }}

        {!! Form::text('title', old('title') ? : ($channel->title ?? ''),
            ['placeholder'=>'Спорт...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('alias', 'ЧПУ каналу') }}
        
        {!! Form::text('alias', old('alias') ? : ($channel->alias ?? ''),
            ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>

    <hr>

    <div class="form-group">
        <label>
            <input type="checkbox" {{ (old('confirmed') || !empty($channel->approved)) ? 'checked' : '' }}
            value="1" name="confirmed">
            Вивести в меню
        </label>
        <label>
            {!! Form::number('priority', old('alias') ? : ($channel->priority ?? ''), ['min'=>1, 'max'=>255]) !!}
            Пріоритет.
        </label>
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле, меньше число - більший пріоритет(число від 1 до 255)">?
        </button>
    </div>

    <hr>

    <div class="form-group">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div