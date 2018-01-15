<h2>Створення нового користувача:</h2>
{!! Form::open(['url'=>route('users_create'), 'class'=>'contact-form', 'method'=>'post']) !!}
<fieldset>
    <ul list-group>
        <li>
            <h4>{!! Form::label('name', 'Им\'я') !!}</h4>
            {!! Form::text('name', old('name') ? : '', ['class'=>'form-control', 'required'=>'required']) !!}
        </li>
        <li>
            <h4>{!! Form::label('email', 'Электронна пошта') !!}</h4>
            {!! Form::email('email', old('email') ? : '', ['class'=>'form-control', 'required'=>'required']) !!}
        </li>
        <li>
            <h4>{!! Form::label('pass', 'Пароль') !!}</h4>
            {!! Form::password('password') !!}
        </li>
        <li>
            <h4>{!! Form::label('cpass', 'Підтвердження пароля') !!}</h4>
            {!! Form::password('password_confirmation') !!}
        </li>
        <li>
            <h4>{!! Form::label('role', 'Роль') !!}</h4>
            <table class="table">
                @foreach($roles as $id=>$role)
                    <td>
                        <input name="roles[]" {{ $id == old('role') ? 'checked' : '' }}
                        type="checkbox" value="{{ $id }}">{{ trans('ru.' . $role) }}
                    </td>
                @endforeach
            </table>
        </li>
    </ul>
</fieldset>
<!-- Submit -->
{!! Form::button('Додати', ['class' => 'btn btn-success','type'=>'submit']) !!}
{!! Form::close() !!}