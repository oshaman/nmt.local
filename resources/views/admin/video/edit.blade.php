@include('admin.video.nav')
<h2>Редагування відео</h2>
{!! Form::open(['url'=>route('edit_video', ['video' => $video->id]),
    'method'=>'POST', 'class'=>'form-horizontal']) !!}
<div class="">
    {{ Form::label('title', 'Заголовок відео') }}
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right"
            title="Максимум 255 символів">?
    </button>
    <div>
        {!! Form::text('title', old('title') ? : ($video->title ?? '') , ['placeholder'=>'Встановлення новорічної ялинки...',
                    'id'=>'title', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('token', 'Токен відео') }}
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right"
            title="Наприклад - 1Sx8xqg1D4Q">?
    </button>
    <div>
        {!! Form::text('token', old('token') ? : ($video->token ?? ''),
         ['placeholder'=>'kXYiU_JCYtU', 'id'=>'token', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="">
    {{ Form::label('channel', 'Канал') }}
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right"
            title="Обов'язковий параметр">?
    </button>
    <div>
        {!! Form::select('channel', $channels ?? [],
            old('channel') ? : ($video->channel_id ?? ''), [ 'class'=>'form-control', 'placeholder'=>'Канал'])
        !!}
    </div>
</div>
<hr>
<div class="row">
    <!-- Approved -->
    <div class="col-lg-6">
        <label>
            <input type="checkbox" {{ (old('confirmed') || $video->approved) ? 'checked' : ''}} value="1"
                   name="confirmed">
            Опублікувати
        </label>
    </div>
    <div class="col-lg-6">
        <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
        <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
            <input type="text" name="outputtime" id="outputtime"
                   value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($video->created_at)) ?? date('Y-m-d H:i')) }}">
        </div>
    </div>
</div>
<div class="row">
    <hr>
    {!! Form::button('Зберегти', ['class' => 'btn btn-large btn-primary','type'=>'submit']) !!}
</div>
{!! Form::close() !!}