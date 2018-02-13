<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Редагування сторінки - "{{ trans('ua.'.$page->own) }}"</h3>
    {!! Form::open(['url'=>route('static_update', $page->id), 'method'=>'post', 'class'=>'form-horizontal panel-body']) !!}
    <div class="form-group">
        {{ Form::label('text', 'Заголовок') }}

        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>

        {!! form::text('title', old('title') ? : ($page->title ?? '') , ['placeholder'=>'Заголовок', 'id'=>'title', 'class'=>'form-control']) !!}

    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('text', 'Контент') }}

        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Рекомендована ширина зображень - не більше 770px">?
        </button>

        {!! Form::textarea('text', old('text') ? : ($page->text ?? '') , ['placeholder'=>'text', 'id'=>'text', 'class'=>'form-control editor']) !!}
    </div>

    <hr>
    <div class="form-group">
        {!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    </div>

    {!! Form::close() !!}
</div>