@include('admin.articles.nav')
<!-- START CONTENT -->
<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Пошук статті:</h3>

    {!! Form::open(['url' => route('admin_articles'), 'class'=>'form-horizontal panel-body','method'=>'GET' ]) !!}
    <div class="form-group">
        {{ Form::label('value', 'Параметр пошуку') }}
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Не обов'язкове до заповнення поле">?
        </button>
        {!! Form::text('value', old('value') ? : '' , ['placeholder'=>'title, link...', 'id'=>'value', 'class'=>'form-control']) !!}

    </div>

    <div class="form-group">
        {{ Form::label('param', 'Критерій пошуку') }}
        {!! Form::select('param',
                    [
                        1=>'Заголовок',
                        2=>'ЧПУ статті',
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
        {!! Html::link(route('create_article'),'Створити статтю',['class' => 'btn btn-primary']) !!}
    </div>
</div>
<hr>

<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>URL</th>
                    <th>Заголовок</th>
                    <th>Дата публикації</th>
                    <th>SEO</th>
                    <th>Редагувати</th>
                    <th>Видалити</th>
                </tr>
                </thead>
                @if (!empty($articles[0]))
                    <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td class="">{{ $article->id }}</td>
                            <td class="">{{ $article->alias }}</td>
                            <td class="">{{ $article->title }}</td>
                            <td class="">{{ $article->created_at }}</td>
                            <td class="">
                                @can('update', $article)
                                    {!! Form::open(['url' => route('admin_article_seo',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('SEO', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            <td class="">
                                @can('update', $article)
                                    {!! Form::open(['url' => route('edit_article',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            <td class="">
                                @can('delete', $article)
                                    {!! Form::open(['url' => route('delete_article',['article'=> $article->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
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
    @if(is_object($articles) && !empty($articles->lastPage()) && $articles->lastPage() > 1)
        @if($articles->lastPage() > 1)
            <ul class="pagination">
                @if($articles->currentPage() !== 1)
                    <li>
                        <a rel="prev" href="{{ $articles->url(($articles->currentPage() - 1)) }}"
                           class="prev">
                            <
                        </a>
                    </li>
                @endif
                @if($articles->currentPage() >= 3)
                    <li><a href="{{ $articles->url($articles->url(1)) }}">1</a></li>
                @endif
                @if($articles->currentPage() >= 4)
                    <li><a href="#">...</a></li>
                @endif
                @if($articles->currentPage() !== 1)
                    <li>
                        <a href="{{ $articles->url($articles->currentPage()-1) }}">{{ $articles->currentPage()-1 }}</a>
                    </li>
                @endif
                <li><a class="active disabled">{{ $articles->currentPage() }}</a></li>
                @if($articles->currentPage() !== $articles->lastPage())
                    <li>
                        <a href="{{ $articles->url($articles->currentPage()+1) }}">{{ $articles->currentPage()+1 }}</a>
                    </li>
                @endif
                @if($articles->currentPage() <= ($articles->lastPage()-3))
                    <li><a href="#">...</a></li>
                @endif
                @if($articles->currentPage() <= ($articles->lastPage()-2))
                    <li>
                        <a href="{{ $articles->url($articles->lastPage()) }}">{{ $articles->lastPage() }}</a>
                    </li>
                @endif
                @if($articles->currentPage() !== $articles->lastPage())
                    <li>
                        <a rel="next" href="{{ $articles->url(($articles->currentPage() + 1)) }}"
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