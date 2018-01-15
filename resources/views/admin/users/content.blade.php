<h2>Користувачі</h2>
<hr>
<div class="row">
    {!! Form::open(['url' => route('users_create'),'class'=>'form-horizontal','method'=>'GET']) !!}
    {!! Form::button('Створити нового користувача', ['class' => 'btn btn-success','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>
<hr>
<!-- START CONTENT -->
<table class="table">
    <thead>
    <th>ID</th>
    <th>Им'я</th>
    <th>Скринька</th>
    <th>Роль</th>
    <th>Редагувати</th>
    <th>Видалити</th>
    </thead>
    <tbody>
    @if(!empty($users))
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->implode('name', ', ') }}</td>
                <td>
                    {!! Form::open(['url' => route('users_update',['users'=> $user->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['url' => route('delete_user',['users'=> $user->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                    {!! Form::button('Видалити', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<!--PAGINATION-->
<div class="general-pagination group">
    @if($users->lastPage() > 1)
        <ul class="pagination">
            @if($users->currentPage() !== 1)
                <li><a href="{{ $users->url(($users->currentPage() - 1)) }}">{{ trans('pagination.previous') }}</a></li>
            @endif
            @for($i = 1; $i <= $users->lastPage(); $i++)
                @if($users->currentPage() == $i)
                    <li><a class="selected disabled">{{ $i }}</a></li>
                @else
                    <li><a href="{{ $users->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            @if($users->currentPage() !== $users->lastPage())
                <li><a href="{{ $users->url(($users->currentPage() + 1)) }}">{{ trans('pagination.next') }}</a></li>
            @endif
        </ul>
    @endif
</div>
<!-- END users -->