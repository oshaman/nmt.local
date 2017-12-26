@include('admin.video.nav')
<h1>Редагувати канал</h1>

{!! Form::open(['url' => route('edit_channel', $channel->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Заголовок каналу') }}
    <div class="">
        {!! Form::text('title', old('title') ? : ($channel->title ?? ''),
            ['placeholder'=>'Спорт...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('alias', 'ЧПУ каналу') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($channel->alias ?? ''),
            ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div>
        <label>
            <input type="checkbox" {{ (old('confirmed') || !empty($channel->approved)) ? 'checked' : '' }}
            value="1" name="confirmed">
            Вивести в меню
        </label>
    </div>
    <hr>
    <div class="">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>