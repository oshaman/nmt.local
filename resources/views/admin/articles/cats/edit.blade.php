@include('admin.articles.nav')
<h1>Редагувати категорію</h1>

{!! Form::open(['url' => route('edit_cats', $category->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('name', 'Назва категорії') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(максимум 255 символів)">?
    </button>
    <div class="">
        {!! Form::text('name', old('name') ? : ($category->name ?? ''),
            ['placeholder'=>'Спорт...', 'id'=>'name', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('alias', 'ЧПУ категорії') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(латинські літери, цифри - максимум 255 символів)">?
    </button>
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($category->alias ?? ''),
            ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div>
        <label>
            <input type="checkbox" {{ (old('confirmed') || !empty($category->approved)) ? 'checked' : '' }} value="1"
                   name="confirmed">
            Вивести в меню
        </label>
    </div>
    <hr>
    <div class="">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>