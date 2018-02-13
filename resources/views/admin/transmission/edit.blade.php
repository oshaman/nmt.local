@include('admin.transmission.nav')

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Редагування трансляції</h3>

    {!! Form::open(['url' => route('edit_transmission', $transmission->id), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('title', 'Заголовок') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>
        {!! Form::text('title', old('title') ? : ($transmission->title ?? ''),
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {{ Form::label('token', 'Youtube-токен') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>

        {!! Form::text('token', old('token') ? : ($transmission->token ?? ''),
            ['placeholder'=>'kXYiU_JCYtU...', 'id'=>'token', 'class'=>'form-control']) !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::button('Збереження', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
</div>