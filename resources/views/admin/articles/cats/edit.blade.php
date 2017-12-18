@include('admin.articles.nav')
<h1>Редагувати категорію</h1>

{!! Form::open(['url' => route('edit_cats', $category->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('name', 'Назва категорії') }}
    <div class="">
        {!! Form::text('name', old('name') ? : ($category->name ?? ''),
            ['placeholder'=>'Спорт...', 'id'=>'name', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('alias', 'ЧПУ категорії') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : ($category->alias ?? ''),
            ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>