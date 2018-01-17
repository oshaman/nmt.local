@include('admin.articles.nav')
<h2 class="h2">Редагування статті</h2>
{!! Form::open(['url'=>route('edit_article', ['article' => $article->id]),
    'method'=>'POST', 'class'=>'form-horizontal col-xs-12', 'files'=>true]) !!}
<div class="">
    <div class="form-group">
        {{ Form::label('title', 'Заголовок статті') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(максимум 255 символів)">?
        </button>
    </div>

    <div class="form-group">
        {!! Form::text('title', old('title') ? : ($article->title ?? ''),
                    ['placeholder'=>'Встановлення новорічної ялинки...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
</div>

<div class="">
    <div class="form-group">
        {{ Form::label('alias', 'ЧПУ статті') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(латинські літери, цифри - максимум 255 символів)">?
        </button>
    </div>

    <div class="form-group">
        {!! Form::text('alias', old('alias') ? : ($article->alias ?? ''),
                    ['placeholder'=>'vstanovlennya-novorichnoyi-yalinki', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>

<div class="">
    <div class="form-group">
        {{ Form::label('category_id', 'Категорія') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле">?
        </button>
    </div>

    <div class="form-group">
        {!! Form::select('category_id', $cats ?? [],
            old('category_id') ? : ($article->category_id ?? ''), [ 'class'=>'form-control', 'placeholder'=>'Категорія'])
        !!}
    </div>
</div>

<div class="">
    <div class="form-group">
        {{ Form::label('preview', 'Анонс') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(рекомендована кількість символів - 600)">?
        </button>
    </div>

    <div class="form-group">
            <textarea name="preview" class="form-control myPreview">
                {!! old('preview') ? : ($article->preview ?? '') !!}
            </textarea>
    </div>
</div>

<div class="">
    {{ Form::label('img', 'Основне зображення') }}
    @if(!empty($article->image))
        <div>
            {{ Html::image(asset('/asset/images/articles/main').'/'.$article->image->path,
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
            {!! Form::text('imgalt', old('imgalt') ? : ($article->image->alt ?? ''),
                ['placeholder'=>'Alt', 'id'=>'imgalt', 'class'=>'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::text('imgtitle', old('imgtitle') ? : ($article->image->title ?? ''),
                ['placeholder'=>'Title', 'id'=>'imgtitle', 'class'=>'form-control']) !!}
        </div>
    </div>
</div>
<hr>
<div class="">
    {{ Form::label('tags', 'Тэги') }}
    @if(!empty($tags))
        <div>
            <table class="table tags">
                @foreach($tags as $id=>$tag)
                    <td>
                        <input name="tags[]" type="checkbox"
                               @if(!empty(old('tags')))
                               @foreach(old('tags') as $val)
                               @if($val == $id)
                               checked
                               @endif
                               @endforeach
                               @elseif($article->hasTag($id))
                               checked
                               @endif
                               value="{{ $id }}"> {{ $tag }}
                    </td>
                @endforeach
            </table>
        </div>
    @endif
</div>
<hr>
<div class="row">
    <div class="input-prepend col-lg-6"><span class="add-on"><i class="icon-time"></i></span>
        <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
        <input type="text" name="outputtime" id="outputtime"
               value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($article->created_at)) ?? date('Y-m-d H:i')) }}">
    </div>
    <div class="col-lg-6">
        @if(Auth::user()->canDo('UPDATE_VIEW'))
            <h4>{!! Form::label('view', 'Кількість переглядів') !!}</h4>
            <div class="input-prepend col-lg-6">
                <input type="text" name="view" id="view"
                       value="{{ old('view') ? : $article->view }}">
            </div>
        @endif
    </div>
</div>
<div class="">
    @if(Auth::user()->canDo('CONFIRMATION_DATA'))
        <label>
            <input type="checkbox" {{ (old('confirmed') || !empty($article->approved)) ? 'checked' : '' }} value="1"
                   name="confirmed">Опублікувати
        </label>
    @endif
</div>
<hr>
<div class="row">
    <textarea name="content" class="form-control editor">{!! old('content') ? : ($article->content ?? '') !!}</textarea>
    <hr>
    {!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}