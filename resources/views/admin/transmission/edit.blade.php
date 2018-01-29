@include('admin.transmission.nav')
<h1>Редагування трансляції</h1>

{!! Form::open(['url' => route('edit_transmission', $transmission->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Заголовок') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('title', old('title') ? : ($transmission->title ?? ''),
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
    {{ Form::label('token', 'Youtube-токен') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('token', old('token') ? : ($transmission->token ?? ''),
            ['placeholder'=>'kXYiU_JCYtU...', 'id'=>'token', 'class'=>'form-control']) !!}
    </div>
    <hr>
    <div class="">
        {!! Form::button('Збереження', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>