<h1>Редагування тега</h1>

{!! Form::open(['url' => route('edit_tags', $tag->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('tag', 'Назва') }}
    <div class="">
        {!! Form::text('tag', old('tag') ? : ($tag->name ?? ''),
                        ['placeholder'=>'Спорт', 'id'=>'tag', 'class'=>'form-control ru-title']) !!}
    </div>
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($tag->alias ?? ''),
                    ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>