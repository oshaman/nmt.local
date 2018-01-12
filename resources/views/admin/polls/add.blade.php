<h2>Додати опитування</h2>
{!! Form::open(['url'=>route('create_poll'), 'method'=>'POST', 'class'=>'form-horizontal']) !!}
<div class="">
    {{ Form::label('question', 'Запитання') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(максимум 255 символів)">?
    </button>
    <div>
        {!! Form::text('question', old('question') ? : '',
            ['placeholder'=>'Запитання...', 'id'=>'question', 'class'=>'form-control ru-title']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('alias', 'ЧПУ опитування') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(латинські літери, цифри - максимум 255 символів)">?
    </button>
    <div>
        {!! Form::text('alias', old('alias') ? : '',
         ['placeholder'=>'zapytannya', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('title', 'Заголовок опитування') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(максимум 255 символів)">?
    </button>
    <div>
        {!! Form::text('title', old('title') ? : '',
            ['placeholder'=>'Встановлення новорічної ялинки...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<hr>
<div class="alert alert-info">
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкові до заповнення поля(максимум 255 символів)">?
    </button>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('answer1', 'Відповідь №1') }}
            <div>
                {!! Form::text('answer1', old('answer1') ? : '',
                 ['placeholder'=>'Відповідь №1', 'id'=>'answer1', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {{ Form::label('answer2', 'Відповідь №2') }}
            <div>
                {!! Form::text('answer2', old('answer2') ? : '',
                 ['placeholder'=>'Відповідь №2', 'id'=>'answer2', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {{ Form::label('answer3', 'Відповідь №3') }}
            <div>
                {!! Form::text('answer3', old('answer3') ? : '',
                 ['placeholder'=>'Відповідь №3', 'id'=>'answer3', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-6">
            {{ Form::label('answer4', 'Відповідь №4') }}
            <div>
                {!! Form::text('answer4', old('answer4') ? : '',
                 ['placeholder'=>'Відповідь №4', 'id'=>'answer4', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="">
        {{ Form::label('answer5', 'Відповідь №5') }}
        <div>
            {!! Form::text('answer5', old('answer5') ? : '',
             ['placeholder'=>'Відповідь №5', 'id'=>'answer5', 'class'=>'form-control']) !!}
        </div>
    </div>
</div>
<hr>
<div class="row">
    <!-- Approved -->
    <div class="col-lg-6">
        <label>
            <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
            Опублікувати
        </label>
    </div>
    <div class="col-lg-6">
        <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
        <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
            <input type="text" name="outputtime" id="outputtime" value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
        </div>
    </div>
</div>
<hr>
<div class="row">
    {{ Form::label('description', 'Опис') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле">?
    </button>
    <textarea name="description" class="form-control editor">{!! old('description') ? : '' !!}</textarea>
</div>
<div class="row">
    <hr>
    {!! Form::button('Додати', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
