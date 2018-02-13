@include('admin.video.nav')

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Додати відео</h3>

    {!! Form::open(['url'=>route('create_video'), 'method'=>'POST', 'class'=>'form-horizontal panel-body']) !!}
    <div class="form-group">
        {{ Form::label('title', 'Заголовок відео') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>

        {!! Form::text('title', old('title') ? : '' , ['placeholder'=>'Встановлення новорічної ялинки...',
                    'id'=>'title', 'class'=>'form-control']) !!}

    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('token', 'Youtube-токен відео') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>

        {!! Form::text('token', old('token') ? : '',
        ['placeholder'=>'kXYiU_JCYtU', 'id'=>'token', 'class'=>'form-control']) !!}
        
    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('channel', 'Канал') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле.">?
        </button>

        {!! Form::select('channel', $channels ?? [],
            old('channel') ? : '' , [ 'class'=>'form-control', 'placeholder'=>'Канал'])
        !!}

    </div>

    <hr>

    <div class="row">
        <!-- Approved -->
        <div class="col-xs-12 col-sm-6">
            @if(Auth::user()->canDo('CONFIRMATION_VIDEO'))
                <label>
                    <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
                    Опублікувати
                </label>
            @endif
        </div>

        <div class="col-xs-12 col-sm-6">
            <h4>
                {!! Form::label('outputtime', 'Дата публікації') !!}
                <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                        title="Не обов'язкове до заповнення поле(Формат Рік-Місяць-Число Години:Хвилини)">?
                </button>
            </h4>
            <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                <input type="text" name="outputtime" id="outputtime"
                       value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
            </div>
        </div>

    </div>

    <div class="form-group">
        {!! Form::button('Додати', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>