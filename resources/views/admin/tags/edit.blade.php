<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Редагування тега</h3>

    {!! Form::open(['url' => route('edit_tags', $tag->id), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('tag', 'Назва') }}

        {!! Form::text('tag', old('tag') ? : ($tag->name ?? ''),
                        ['placeholder'=>'Спорт', 'id'=>'tag', 'class'=>'form-control ru-title']) !!}
    </div>

    <div class="form-group">
        {!! Form::text('alias', old('alias') ? : ($tag->alias ?? ''),
                    ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>

    <div class="form-group">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>

    {!! Form::close() !!}
</div>