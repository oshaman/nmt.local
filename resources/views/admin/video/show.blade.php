@include('admin.video.nav')
<!-- START CONTENT -->
<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Пошук відео:</h3>

    {!! Form::open(['url' => route('admin_videos'), 'class'=>'form-horizontal panel-body','method'=>'GET' ]) !!}

    <div class="form-group">
        {{ Form::label('value', 'Параметр пошуку') }}

        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}
    </div>

    <div class="form-group">

        {{ Form::label('param', 'Критерій пошуку') }}

        {!! Form::select('param',
                    [
                        1=>'Заголовок',
                        2=>'ЧПУ відео',
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
        {!! Html::link(route('create_video'),'Створити відео',['class' => 'btn btn-primary']) !!}
    </div>
</div>

<hr>

<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>Заголовок</th>
                    <th>Дата публикації</th>
                    <th>Редагувати</th>
                    <th>Видалити</th>
                </tr>
                </thead>
                @if (!empty($videos[0]))
                    <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td class="">{{ $video->title }}</td>
                            <td class="">{{ $video->created_at }}</td>
                            <td class="">
                                @can('update', $video)
                                    {!! Form::open(['url' => route('edit_video',['video'=> $video->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                    @endif
                            </td>
                            <td class="">
                                @can('delete', $video)
                                    {!! Form::open(['url' => route('delete_video',['video'=> $video->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
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
    @if(is_object($videos) && !empty($videos->lastPage()) && $videos->lastPage() > 1)
        @if($videos->lastPage() > 1)
            <ul class="pagination">
                @if($videos->currentPage() !== 1)
                    <li>
                        <a rel="prev" href="{{ $videos->url(($videos->currentPage() - 1)) }}"
                           class="prev">
                            <
                        </a>
                    </li>
                @endif
                @if($videos->currentPage() >= 3)
                    <li><a href="{{ $videos->url($videos->url(1)) }}">1</a></li>
                @endif
                @if($videos->currentPage() >= 4)
                    <li><a href="#">...</a></li>
                @endif
                @if($videos->currentPage() !== 1)
                    <li>
                        <a href="{{ $videos->url($videos->currentPage()-1) }}">{{ $videos->currentPage()-1 }}</a>
                    </li>
                @endif
                <li><a class="active disabled">{{ $videos->currentPage() }}</a></li>
                @if($videos->currentPage() !== $videos->lastPage())
                    <li>
                        <a href="{{ $videos->url($videos->currentPage()+1) }}">{{ $videos->currentPage()+1 }}</a>
                    </li>
                @endif
                @if($videos->currentPage() <= ($videos->lastPage()-3))
                    <li><a href="#">...</a></li>
                @endif
                @if($videos->currentPage() <= ($videos->lastPage()-2))
                    <li>
                        <a href="{{ $videos->url($videos->lastPage()) }}">{{ $videos->lastPage() }}</a>
                    </li>
                @endif
                @if($videos->currentPage() !== $videos->lastPage())
                    <li>
                        <a rel="next" href="{{ $videos->url(($videos->currentPage() + 1)) }}"
                           class="next">
                            >
                        </a>
                    </li>
                @endif
            </ul>
                @endif
    @endif
</div>
<!-- END CONTENT -->