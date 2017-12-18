<h1>Cтворення \ Редагування тегів</h1>

{!! Form::open(['url' => route('admin_tags'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('tag', 'Назва') }}
    <div class="">
        {!! Form::text('tag', old('tag') ? : '',
                    ['placeholder'=>'Спорт...', 'id'=>'tag', 'class'=>'form-control ru-title']) !!}
    </div>
    <div class="">
        {!! Form::text('alias', old('alias') ? : '',
                    ['placeholder'=>'psihiatriya...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>

@if(!empty($tags))
    <table class="table">
        <thead>
        <tr><th>Им'я</th><th>ЧПУ</th><th>Редагувати</th><th></th></tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->alias }}</td>
                <td>
                    {!! Form::open(['url' => route('edit_tags',['cat'=> $tag->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['url' => route('delete_tag',['tag'=> $tag->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!--PAGINATION-->

    <div class="general-pagination group">

        @if($tags->lastPage() > 1)
            <ul class="pagination">
                @if($tags->currentPage() !== 1)
                    <li><a href="{{ $tags->url(($tags->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a></li>
                @endif

                @for($i = 1; $i <= $tags->lastPage(); $i++)
                    @if($tags->currentPage() == $i)
                        <li><a class="selected disabled">{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $tags->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                @if($tags->currentPage() !== $tags->lastPage())
                    <li><a href="{{ $tags->url(($tags->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a></li>
                @endif
            </ul>

        @endif

    </div>
@endif