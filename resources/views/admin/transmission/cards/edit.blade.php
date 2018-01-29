@include('admin.transmission.nav')
<h1>Редагування анонса</h1>

{!! Form::open(['url' => route('edit_card', $card->id), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="alert alert-success">
    {{ Form::label('title', 'Заголовок') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('title', old('title') ? : ($card->title ?? ''),
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
    <div class="row">
        <!-- Approved -->
        <div class="col-lg-6">
            <label>
                <input type="checkbox" {{ (old('confirmed') || ($card->approved ?? '')) ? 'checked' : ''}} value="1"
                       name="confirmed">
                Опублікувати
            </label>
        </div>
        <div class="col-lg-6">
            <h4>{!! Form::label('outputtime', 'Дата публікації') !!}</h4>
            <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
                <input type="text" name="outputtime" id="outputtime"
                       value="{{ old('outputtime') ? : (date('Y-m-d H:i', strtotime($card->created_at)) ?? date('Y-m-d H:i')) }}">
            </div>
        </div>
    </div>
    <hr>
    <div class="">
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>