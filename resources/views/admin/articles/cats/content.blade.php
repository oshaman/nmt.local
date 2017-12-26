@include('admin.articles.nav')
<h1>Додати \ Відредагувати категорію</h1>

{!! Form::open(['url' => route('cats'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('name', 'Назва категорії') }}
    <div class="">
        {!! Form::text('name', old('name') ? : '' , ['placeholder'=>'Спорт...', 'id'=>'name', 'class'=>'form-control ru-title']) !!}
    </div>
    {{ Form::label('alias', 'ЧПУ') }}
    <div class="">
        {!! Form::text('alias', old('alias') ? : '' , ['placeholder'=>'sport...', 'id'=>'alias', 'class'=>'form-control eng-alias']) !!}
    </div>
    <div class="">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
@if(!empty($categories))
    <table class="table">
        <thead>
        <tr>
            <th>В меню</th>
            <th>Им'я</th>
            <th>ЧПУ</th>
            <th>Редагувати</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{!! $category->approved ? '<a><span class="glyphicon glyphicon-plus"></span></a>' : '' !!}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->alias }}</td>
                <td>
                    {!! Form::open(['url' => route('edit_cats',['cat'=> $category->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!--PAGINATION-->

    <div class="general-pagination group">

        @if($categories->lastPage() > 1)
            <ul class="pagination">
                @if($categories->currentPage() !== 1)
                    <li>
                        <a href="{{ $categories->url(($categories->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                    </li>
                @endif

                @for($i = 1; $i <= $categories->lastPage(); $i++)
                    @if($categories->currentPage() == $i)
                        <li><a class="selected disabled">{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $categories->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                @if($categories->currentPage() !== $categories->lastPage())
                    <li>
                        <a href="{{ $categories->url(($categories->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                    </li>
                @endif
            </ul>

        @endif

    </div>
@endif