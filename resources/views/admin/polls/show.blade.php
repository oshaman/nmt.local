<h1>Опитування</h1>

<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Пошук опитування:</h3>

    {!! Form::open(['url' => route('admin_polls'), 'class'=>'form-horizontal panel-body','method'=>'GET' ]) !!}

    <div class="form-group">
        {{ Form::label('value', 'Параметр пошуку') }}

        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}

    </div>

    <div class="form-group">
        {{ Form::label('param', 'Критерій пошуку') }}

        {!! Form::select('param',
                    [
                        1=>'Запитання',
                        2=>'ЧПУ опитування',
                        3 =>'На паузі',
                    ], old('val') ? : 1, ['class'=>'form-control'])
            !!}
    </div>

    <hr>
    <div class="form-group">
        {!! Form::button('Пошук', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>

<hr>

<div class="panel panel-info col-xs-12">
    <div class="panel-heading row">
        {!! Html::link(route('create_poll'),'Створити опитування',['class' => 'btn btn-primary']) !!}
    </div>
</div>

<hr>

<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>Запитання</th>
                    <th>Дата публикації</th>
                    <th>Редагувати</th>
                    <th>Підтасовка</th>
                </tr>
                </thead>
                @if (!empty($polls[0]))
                    <tbody>
                    @foreach ($polls as $poll)
                        <tr>
                            <td class="">{{ $poll->question }}</td>
                            <td class="">{{ $poll->created_at }}</td>
                            <td class="">
                                @can('update', $poll)
                                    {!! Form::open(['url' => route('edit_poll',['poll'=> $poll->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            <td class="">
                                @can('delete', $poll)
                                    {!! Form::open(['url' => route('results_poll',['poll'=> $poll->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('Підтасовка', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            {{--<td class="">
                                {!! Form::open(['url' => route('delete_poll',['poll'=> $poll->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
</div>

<!--PAGINATION-->
<div class="general-pagination group">
    @if(is_object($polls) && !empty($polls->lastPage()) && $polls->lastPage() > 1)
        @if($polls->lastPage() > 1)
            <ul class="pagination">
                @if($polls->currentPage() !== 1)
                    <li>
                        <a rel="prev" href="{{ $polls->url(($polls->currentPage() - 1)) }}"
                           class="prev">
                            <
                        </a>
                    </li>
                @endif
                @if($polls->currentPage() >= 3)
                    <li><a href="{{ $polls->url($polls->url(1)) }}">1</a></li>
                @endif
                @if($polls->currentPage() >= 4)
                    <li><a href="#">...</a></li>
                @endif
                @if($polls->currentPage() !== 1)
                    <li>
                        <a href="{{ $polls->url($polls->currentPage()-1) }}">{{ $polls->currentPage()-1 }}</a>
                    </li>
                @endif
                <li><a class="active disabled">{{ $polls->currentPage() }}</a></li>
                @if($polls->currentPage() !== $polls->lastPage())
                    <li>
                        <a href="{{ $polls->url($polls->currentPage()+1) }}">{{ $polls->currentPage()+1 }}</a>
                    </li>
                @endif
                @if($polls->currentPage() <= ($polls->lastPage()-3))
                    <li><a href="#">...</a></li>
                @endif
                @if($polls->currentPage() <= ($polls->lastPage()-2))
                    <li>
                        <a href="{{ $polls->url($polls->lastPage()) }}">{{ $polls->lastPage() }}</a>
                    </li>
                @endif
                @if($polls->currentPage() !== $polls->lastPage())
                    <li>
                        <a rel="next" href="{{ $polls->url(($polls->currentPage() + 1)) }}"
                           class="next">
                            >
                        </a>
                    </li>
                @endif
            </ul>
        @endif
        @endif
</div>