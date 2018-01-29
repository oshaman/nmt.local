@include('admin.transmission.nav')
<h1>Додати \ Відредагувати трансляцію</h1>

{!! Form::open(['url' => route('create_transmission'), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
<div class="">
    {{ Form::label('title', 'Заголовок') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('title', old('title') ? : '' ,
            ['placeholder'=>'Засідання верховної ради...', 'id'=>'title', 'class'=>'form-control']) !!}
    </div>
    {{ Form::label('token', 'Youtube-токен') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення поле(<=255 символів)">?
    </button>
    <div class="">
        {!! Form::text('token', old('token') ? : '' , ['placeholder'=>'kXYiU_JCYtU...', 'id'=>'token', 'class'=>'form-control']) !!}
    </div>
    <hr>
    <div class="">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>
    {!! Form::close() !!}
</div>
@if(!empty($transmissions))
    <hr>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>Заголовок</th>
                <th>Токен</th>
                <th>Редагувати</th>
                <th>Видалити</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transmissions as $transmission)
                <tr>
                    <td>{{ $transmission->title }}</td>
                    <td>{{ $transmission->token }}</td>
                    <td>
                        {!! Form::open(['url' => route('edit_transmission',['transmission'=> $transmission->id]),
                            'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td class="col-md-1">
                        {!! Form::open(['url' => route('delete_transmission',['transmission'=> $transmission->id]),
                            'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{-- <!--PAGINATION-->

     <div class="general-pagination group">

         @if($transmissions->lastPage() > 1)
             <ul class="pagination">
                 @if($transmissions->currentPage() !== 1)
                     <li>
                         <a href="{{ $transmissions->url(($transmissions->currentPage() - 1)) }}">{{ Lang::get('pagination.previous') }}</a>
                     </li>
                 @endif

                 @for($i = 1; $i <= $transmissions->lastPage(); $i++)
                     @if($transmissions->currentPage() == $i)
                         <li><a class="selected disabled">{{ $i }}</a></li>
                     @else
                         <li><a href="{{ $transmissions->url($i) }}">{{ $i }}</a></li>
                     @endif
                 @endfor

                 @if($transmissions->currentPage() !== $transmissions->lastPage())
                     <li>
                         <a href="{{ $transmissions->url(($transmissions->currentPage() + 1)) }}">{{ Lang::get('pagination.next') }}</a>
                     </li>
                 @endif
             </ul>

         @endif

     </div>--}}
@endif