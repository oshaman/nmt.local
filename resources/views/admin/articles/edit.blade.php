@include('admin.articles.nav')
<h2>Редагування статті</h2>
{!! Form::open(['url'=>route('edit_article', ['article' => $article->id]),
    'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true]) !!}
<div class="">
    {{ Form::label('title', 'Заголовок статті') }}
    <div>
        {!! Form::text('title', old('title') ? : ($article->title ?? ''),
                    ['placeholder'=>'Встановлення новорічної ялинки...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('alias', 'ЧПУ статті') }}
    <div>
        {!! Form::text('alias', old('alias') ? : ($article->alias ?? ''),
                    ['placeholder'=>'vstanovlennya-novorichnoyi-yalinki', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('category_id', 'Категорія') }}
    <div>
        {!! Form::select('category_id', $cats ?? [],
            old('category_id') ? : ($article->category_id ?? '') , [ 'class'=>'form-control', 'placeholder'=>'Категорія'])
        !!}
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
    {{ Form::label('img', 'Параметри зображення') }}
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
    <div>
        {!! Form::file('img', ['accept'=>'image/*', 'id'=>'img', 'class'=>'form-control']) !!}
    </div>
</div>
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
<div class="row">
    <div class="input-prepend col-lg-6"><span class="add-on"><i class="icon-time"></i></span>
        <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
        <input type="text" name="outputtime" id="outputtime"
               value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($article->created_at)) ?? date('Y-m-d H:i')) }}">
    </div>
</div>
<div class="">
    <label>
        <input type="checkbox" {{ (old('confirmed') || !empty($article->approved)) ? 'checked' : '' }} value="1"
               name="confirmed">Опублікувати</label>
</div>
<hr>
<div class="row">
    <textarea name="content" class="form-control editor">{!! old('content') ? : ($article->content ?? '') !!}</textarea>
    <hr>
    {!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
