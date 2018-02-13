@include('admin.video.nav')

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Додати \ Відредагувати канал</h3>

    {!! Form::open(['url' => route('admin_channels'), 'class'=>'form-horizontal panel-body','method'=>'POST' ]) !!}
    <div class="form-group">
        {{ Form::label('', 'Заголовок каналу') }}

        {!! Form::text('title', old('title') ? : '' , ['placeholder'=>'Спорт...', 'id'=>'title', 'class'=>'form-control ru-title']) !!}
    </div>

    <hr>

    <div class="form-group">
        {{ Form::label('alias', 'ЧПУ') }}
        
        {!! Form::text('alias', old('alias') ? : '' , ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>

    {!! Form::close() !!}
</div>

@if(!empty($channels))
    <div class="col-xs-12">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="info">
                        <th>В меню</th>
                        <th>Им'я</th>
                        <th>ЧПУ</th>
                        <th>Редагувати</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{!! $channel->approved ? '<a><span class="glyphicon glyphicon-plus"></span></a>' : '' !!}</td>
                            <td>{{ $channel->title }}</td>
                            <td>{{ $channel->alias }}</td>
                            <td>
                                {!! Form::open(['url' => route('edit_channel',['channel'=> $channel->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--PAGINATION-->

    <div class="general-pagination group">

        @if($channels->lastPage() > 1)
            <ul class="pagination">
                @if($channels->currentPage() !== 1)
                    <li>
                        <a href="{{ $channels->url(($channels->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                    </li>
                @endif

                @for($i = 1; $i <= $channels->lastPage(); $i++)
                    @if($channels->currentPage() == $i)
                        <li><a class="selected disabled">{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $channels->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                @if($channels->currentPage() !== $channels->lastPage())
                    <li>
                        <a href="{{ $channels->url(($channels->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                    </li>
                @endif
            </ul>

        @endif

    </div>
@endif