@include('admin.video.nav')
<h2>Додати відео</h2>
{!! Form::open(['url'=>route('create_video'), 'method'=>'POST', 'class'=>'form-horizontal']) !!}
<div class="">
    {{ Form::label('title', 'Заголовок відео') }}
    <div>
        {!! Form::text('title', old('title') ? : '' , ['placeholder'=>'Встановлення новорічної ялинки...',
                    'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('token', 'Токен відео') }}
    <div>
        {!! Form::text('token', old('token') ? : '',
         ['placeholder'=>'kXYiU_JCYtU', 'id'=>'token', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('channel', 'Канал') }}
    <div>
        {!! Form::select('channel', $channels ?? [],
            old('channel') ? : '' , [ 'class'=>'form-control', 'placeholder'=>'Канал'])
        !!}
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
<div class="row">
    <hr>
    {!! Form::button('Додати', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}
