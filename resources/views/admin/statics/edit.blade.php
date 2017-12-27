<h2>Редагування сторінки - "{{ trans('ua.'.$page->own) }}"</h2>
<hr>
{!! Form::open(['url'=>route('static_update', $page->id), 'method'=>'post', 'class'=>'form-horizontal']) !!}
<div class="">
    {{ Form::label('text', 'Заголовок') }}
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(максимум 255 символів)">?
    </button>
    <div>
        {!! form::text('title', old('title') ? : ($page->title ?? '') , ['placeholder'=>'Заголовок', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
{{ Form::label('text', 'Контент') }}
<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right"
        title="Рекомендована ширина зображень - не більше 770px">?
</button>
<div>
    {!! Form::textarea('text', old('text') ? : ($page->text ?? '') , ['placeholder'=>'text', 'id'=>'text', 'class'=>'form-control editor']) !!}
</div>

<hr>
{!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
{!! Form::close() !!}