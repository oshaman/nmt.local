<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Додати опитування</h3>

    {!! Form::open(['url'=>route('create_poll'), 'method'=>'POST', 'class'=>'form-horizontal panel-body', 'files'=>true]) !!}
    <div class="form-group">
        {{ Form::label('question', 'Запитання') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>

        {!! Form::text('question', old('question') ? : '',
            ['placeholder'=>'Запитання...', 'id'=>'question', 'class'=>'form-control ru-title']) !!}
    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('alias', 'ЧПУ опитування') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(латинські літери, цифри - максимум 255 символів)">?
        </button>

        {!! Form::text('alias', old('alias') ? : '',
        ['placeholder'=>'zapytannya', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
        
    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('title', 'Заголовок опитування') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>

        {!! Form::text('title', old('title') ? : '',
            ['placeholder'=>'Встановлення новорічної ялинки...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>

    <hr>

    <div class="alert alert-info row">
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкові до заповнення поля(максимум 255 символів)">?
        </button>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                {{ Form::label('answer1', 'Відповідь №1') }}
                <div>
                    {!! Form::text('answer1', old('answer1') ? : '',
                    ['placeholder'=>'Відповідь №1', 'id'=>'answer1', 'class'=>'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                {{ Form::label('answer2', 'Відповідь №2') }}
                <div>
                    {!! Form::text('answer2', old('answer2') ? : '',
                    ['placeholder'=>'Відповідь №2', 'id'=>'answer2', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                {{ Form::label('answer3', 'Відповідь №3') }}
                <div>
                    {!! Form::text('answer3', old('answer3') ? : '',
                    ['placeholder'=>'Відповідь №3', 'id'=>'answer3', 'class'=>'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                {{ Form::label('answer4', 'Відповідь №4') }}
                <div>
                    {!! Form::text('answer4', old('answer4') ? : '',
                    ['placeholder'=>'Відповідь №4', 'id'=>'answer4', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                {{ Form::label('answer5', 'Відповідь №5') }}
                <div>
                    {!! Form::text('answer5', old('answer5') ? : '',
                    ['placeholder'=>'Відповідь №5', 'id'=>'answer5', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info row">
        <!-- Approved -->
        <div class="panel-heading">
            @if(Auth::user()->canDo('CONFIRMATION_DATA'))
                <label>
                    <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
                    Опублікувати
                </label>
            @endif
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="row">
                <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                        title="Не обов'язкове поле. Формат введення Рік-Місяць-Число Години:Хвилини">?
                </button>

                <h4>{!! Form::label('outputtime', 'Дата публікації опитування.') !!}</h4>

                <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                    <input type="text" name="outputtime" id="outputtime"
                           value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6">
            <div class="row">
                <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                        title="Не обов'язкове поле. Формат введення Рік-Місяць-Число Години:Хвилини">?
                </button>

                <h4>{!! Form::label('cessation', 'Дата припинення опитування.') !!}</h4>

                <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                    <input type="text" name="cessation" id="cessation" value="{{ old('cessation') ? : '' }}">
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="form-group">
                {{ Form::label('img', 'Параметри зображення') }}
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        {!! Form::text('alt', old('alt') ? : '' , ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
                    </div>

                    <div class="col-xs-12 col-sm-6">
                        {!! Form::text('imgtitle', old('imgtitle') ? : '' ,
                                    ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                {{ Form::label('img', 'Зображення') }}
                <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                        title="Не обов'язкове до заповнення поле(файл не більше 5 Мбайт у форматі jpeg, jpg, png; бажана ширина 340px)">
                    ?
                </button>
                <div>
                    {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
                </div>
            </div>

            <hr>
        </div>

        <div class="col-xs-12">
            <div class="form-group">
                {{ Form::label('description', 'Опис') }}
                <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                        title="Обов'язкове до заповнення поле">?
                </button>
                <textarea name="description" class="form-control editor">{!! old('description') ? : '' !!}</textarea>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::button('Додати', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>