@include('admin.transmission.nav')

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Додати \ Відредагувати анонс</h3>

    {!! Form::open(['url' => route('admin_card'), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('title', 'Заголовок') }}

        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Обов'язкове до заповнення поле(<=255 символів)">?
        </button>

        {!! Form::text('title', old('title') ? : '' ,
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>

    <!-- Approved -->
    <div class="checkbox">
        <label>
            <input type="checkbox" {{ old('confirmed') ? 'checked' : ''}} value="1" name="confirmed">
            Опублікувати
        </label>
    </div>

    <hr>

    <div class="form-group">
        {!! Form::label('outputtime', 'Дата публікації') !!}

        <div class="input-prepend"><span class="add-on"><i class="icon-time"></i></span>
            <input type="text" name="outputtime" id="outputtime"
                   value="{{ old('outputtime') ? : date('Y-m-d H:i') }}">
        </div>
    </div>

    <hr>

    <div class="form-group">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>

@if(!empty($cards))
    <div class="col-xs-12">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="info">
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
                            <td class="text-center">{!! $card->approved ? '<span class="glyphicon glyphicon-plus"></span>' : '-' !!}</td>
                            <td>{{ $card->created_at }}</td>
                            <td>{{ $card->title }}</td>
                            <td>
                                {!! Form::open(['url' => route('edit_card',['transmission'=> $card->id]),
                                    'class'=>'form-horizontal','method'=>'GET']) !!}
                                {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td class="">
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
        </div>
    </div>
@endif