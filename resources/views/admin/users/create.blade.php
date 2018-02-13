<div class="panel panel-info col-xs-12">
    <h3 class="panel-heading">Створення нового користувача</h3>

    {!! Form::open(['url'=>route('users_create'), 'class'=>'contact-form panel-body', 'method'=>'post']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Им\'я') !!}

            {!! Form::text('name', old('name') ? : '', ['class'=>'form-control', 'required'=>'required']) !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::label('email', 'Электронна пошта') !!}

            {!! Form::email('email', old('email') ? : '', ['class'=>'form-control', 'required'=>'required']) !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::label('pass', 'Пароль') !!}

            {!! Form::password('password') !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::label('cpass', 'Підтвердження пароля') !!}

            {!! Form::password('password_confirmation') !!}
    </div>

    <hr>

    <div class="form-group">
        {!! Form::label('role', 'Роль') !!}
        <table class="table table-striped table-bordered table-hover">
                @foreach($roles as $id=>$role)
                    <td>
                        <input name="roles[]" {{ $id == old('role') ? 'checked' : '' }}
                        type="checkbox" value="{{ $id }}">{{ trans('ru.' . $role) }}
                    </td>
                @endforeach
            </table>
    </div>

    <hr>
    <!-- Submit -->
    <div class="form-group">
        {!! Form::button('Додати', ['class' => 'btn btn-primary','type'=>'submit']) !!}
    </div>

    {!! Form::close() !!}
</div>