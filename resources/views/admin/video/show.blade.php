@include('admin.video.nav')
<!-- START CONTENT -->
<div class="">
    {!! Form::open(['url' => route('admin_videos'), 'class'=>'form-horizontal','method'=>'GET' ]) !!}
    <h3>Пошук статті:</h3>
    <div class="">
        {{ Form::label('value', 'Параметр пошуку') }}
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'id, link...', 'id'=>'value', 'class'=>'form-control']) !!}
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
    <div class="">
        {!! Form::button('Пошук', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
<hr>
<div class="">
    {!! Html::link(route('create_video'),'Створити відео',['class' => 'btn btn-success btn-block']) !!}
</div>
<hr>
<div class="">
    <table class="table">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Дата публикації</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        @if (!empty($videos[0]))
            <tbody>
            @foreach ($videos as $video)
                <tr>
                    <td class="col-md-3">{{ $video->title }}</td>
                    <td class="col-md-2">{{ $video->created_at }}</td>
                    <td class="col-md-1">
                        @can('update', $video)
                            {!! Form::open(['url' => route('edit_video',['video'=> $video->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                            {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                            {!! Form::close() !!}
                            @endif
                    </td>
                    <td class="col-md-1">
                        @can('delete', $video)
                            {!! Form::open(['url' => route('delete_video',['video'=> $video->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                            {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
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
        @endif
    </table>
</div>
<!-- END CONTENT -->