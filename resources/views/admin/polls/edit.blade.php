<h1>Редагування опитування</h1>
<div class="">
    {!! Form::open(['url' => route('edit_poll', $poll->id), 'class'=>'form-horizontal','method'=>'POST', 'files'=>true ]) !!}
    <div class="">
        {{ Form::label('question', 'Запитання') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>
        <div>
            {!! Form::text('question', old('question') ? : ($poll->question ?? ''),
                ['placeholder'=>'Запитання...', 'id'=>'question', 'class'=>'form-control ru-title']) !!}
        </div>
    </div>
    <div class="">
        {{ Form::label('alias', 'ЧПУ опитування') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(латинські літери, цифри - максимум 255 символів)">?
        </button>
        <div>
            {!! Form::text('alias', old('alias') ? : ($poll->alias ?? ''),
             ['placeholder'=>'zapytannya', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
        </div>
    </div>
    <div class="">
        {{ Form::label('title', 'Заголовок опитування') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>
        <div>
            {!! Form::text('title', old('title') ? : ($poll->title ?? ''),
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
                    {!! Form::text('answer1', old('answer1') ? : ($poll->answer1 ?? ''),
                     ['placeholder'=>'Відповідь №1', 'id'=>'answer1', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                {{ Form::label('answer2', 'Відповідь №2') }}
                <div>
                    {!! Form::text('answer2', old('answer2') ? : ($poll->answer2 ?? ''),
                     ['placeholder'=>'Відповідь №2', 'id'=>'answer2', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('answer3', 'Відповідь №3') }}
                <div>
                    {!! Form::text('answer3', old('answer3') ? : ($poll->answer3 ?? ''),
                     ['placeholder'=>'Відповідь №3', 'id'=>'answer3', 'class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                {{ Form::label('answer4', 'Відповідь №4') }}
                <div>
                    {!! Form::text('answer4', old('answer4') ? : ($poll->answer4 ?? ''),
                     ['placeholder'=>'Відповідь №4', 'id'=>'answer4', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="">
            {{ Form::label('answer5', 'Відповідь №5') }}
            <div>
                {!! Form::text('answer5', old('answer5') ? : ($poll->answer5 ?? ''),
                 ['placeholder'=>'Відповідь №5', 'id'=>'answer5', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <!-- Approved -->
    <div class="row">
        @if(Auth::user()->canDo('CONFIRMATION_DATA'))
            <label>
                <input type="checkbox" {{ (old('confirmed') || !empty($poll->approved)) ? 'checked' : ''}} value="1"
                       name="confirmed">
                Опублікувати
            </label>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                    title="Не обов'язкове поле. Формат введення Рік-Місяць-Число Години:Хвилини">?
            </button>
            <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
            <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                <input type="text" name="outputtime" id="outputtime"
                       value="{{ old('outputtime') ? : ((date('Y-m-d H:i', strtotime($poll->created_at))) ?? date('Y-m-d H:i')) }}">
            </div>
        </div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                    title="Не обов'язкове поле. Формат введення Рік-Місяць-Число Години:Хвилини">?
            </button>
            <h4>{!! Form::label('cessation', 'Дата припинення опитування.') !!}</h4>
            <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                <input type="text" name="cessation" id="cessation"
                       value="@if(!empty(old('outputtime'))) {{ old('outputtime') }} @elseif(!empty($poll->cessation)) {{ date('Y-m-d H:i', strtotime($poll->cessation)) }} @else @endif">
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::label('description', 'Опис') }}
            <textarea name="description"
                      class="form-control editor">{!! old('description') ? : ($poll->description ?? '') !!}</textarea>
        </div>
        <div class="col-lg-6">
            {{ Form::label('img', 'Основне зображення') }}
            @if(!empty($poll->image))
                <div>
                    {{ Html::image(asset('/asset/images/polls').'/'.$poll->image,
                                'a picture', array('class' => 'img-thumbnail')) }}
                </div>
            @endif
            <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                    title="За потреби змінити зображення оберіть новий файл(не більше 5 Мбайт у форматі jpeg, jpg, png; бажаний ширина 1170px)">
                ?
            </button>
            <div>
                {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
            </div>
            <hr>
            {{ Form::label('img', 'Параметри зображення') }}
            <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                    title="Не обов'язкові поля: Alt та Title">?
            </button>
            <div class="">
                <div class="col-lg-6">
                    {!! Form::text('alt', old('alt') ? : ($poll->alt ?? ''),
                        ['placeholder'=>'Alt', 'id'=>'alt', 'class'=>'form-control']) !!}
                </div>
                <div class="col-lg-6">
                    {!! Form::text('imgtitle', old('imgtitle') ? : ($poll->imgtitle ?? ''),
                        ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
</div>