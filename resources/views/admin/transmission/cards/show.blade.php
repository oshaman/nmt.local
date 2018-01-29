@include('admin.transmission.nav')
<h1>Додати \ Відредагувати анонс</h1>
{!! Form::open(['url' => route('admin_card'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="alert alert-success">
    {{ Form::label('title', 'Заголовок') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('title', old('title') ? : '' ,
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
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
                <input type="text" name="outputtime" id="outputtime"
                       value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
            </div>
        </div>
    </div>
    <hr>
    <div class="">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
@if(!empty($cards))
    <hr>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Статус</th>
                <th>Дата</th>
                <th>Заголовок</th>
                <th>Редагувати</th>
                <th>Видалити</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cards as $card)
                <tr>
                    <td>{{ $card->approved }}</td>
                    <td>{{ $card->created_at }}</td>
                    <td>{{ $card->title }}</td>
                    <td>
                        {!! Form::open(['url' => route('edit_card',['transmission'=> $card->id]),
                            'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td class="col-md-1">
                        {!! Form::open(['url' => route('delete_card',['transmission'=> $card->id]),
                            'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif