<h2>Редагувати сторінку "Повідомити новину"</h2>
{!! Form::open(['url'=>route('update_informer'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
<textarea name="text" class="form-control editor">{!! old('text') ? : ($text->text ?? '') !!}</textarea>
<div class="row">
    <hr>
    {!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}