<h2>Редагування користувачів</h2>
<!-- START CONTENT -->
<div class="container">
    {!! Form::open(['url' => route('users_update', $user->id), 'class'=>'contact-form','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    <fieldset>
        <ul list-group>
            <li>
                <h4>{!! Form::label('email', 'Электронна пошта') !!}</h4>

                {!! Form::email('email', old('email') ? : $user->email, ['class'=>'form-control', 'required'=>'required']) !!}

            </li>
            <li>
                <h4>{!! Form::label('name', 'Им\'я') !!}</h4>

                {!! Form::text('name', old('name') ? : $user->name, ['class'=>'form-control', 'required'=>'required']) !!}

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
                <h4>{!! Form::label('roles', 'Роль') !!}</h4>
                <table class="table">
                    @foreach($roles as $id=>$role)
                        @if($user->hasRole($role))
                            <td>
                                <input checked name="roles[]" type="checkbox"
                                       value="{{ $id }}">{{trans('ru.' . $role) }}
                            </td>
                        @else
                            <td>
                                <input name="roles[]" type="checkbox" value="{{ $id }}">{{ trans('ru.' . $role) }}
                            </td>
                        @endif
                    @endforeach
                </table>
            </li>
        </ul>
    </fieldset>
    <!-- Submit -->
    {!! Form::button('Зберегти', ['class' => 'btn btn-success','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>
<!-- END CONTENT -->