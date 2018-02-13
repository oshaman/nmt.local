@include('admin.transmission.nav')

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Редагування анонса</h3>

    {!! Form::open(['url' => route('edit_card', $card->id), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('title', 'Заголовок') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>

        {!! Form::text('title', old('title') ? : ($card->title ?? ''),
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>

    <!-- Approved -->
    <div class="checkbox">
        <label>
            <input type="checkbox" {{ (old('confirmed') || ($card->approved ?? '')) ? 'checked' : ''}} value="1"
                   name="confirmed">
            Опублікувати
        </label>
    </div>

    <hr>

    <div class="form-group">

        {!! Form::label('outputtime', 'Дата публікації') !!}

        <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
            <input type="text" name="outputtime" id="outputtime"
                   value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($card->created_at)) ?? date('Y-m-d H:i')) }}">
        </div>
    </div>

    <hr>

    <div class="form-group">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>