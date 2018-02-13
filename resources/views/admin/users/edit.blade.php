<div class="container">
    <div class="panel panel-info col-xs-12">
        <h3 class="panel-heading">Редагування користувачів</h3>

        <!-- START CONTENT -->
        {!! Form::open(['url' => route('users_update', $user->id), 'class'=>'contact-form panel-body form-horizontal','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            {!! Form::label('email', 'Электронна пошта') !!}

                {!! Form::email('email', old('email') ? : $user->email, ['class'=>'form-control', 'required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', 'Им\'я') !!}

                {!! Form::text('name', old('name') ? : $user->name, ['class'=>'form-control', 'required'=>'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pass', 'Пароль') !!}

                {!! Form::password('password') !!}
        </div>

        <div class="form-group">
            {!! Form::label('cpass', 'Підтвердження пароля') !!}

                {!! Form::password('password_confirmation') !!}
        </div>

        <h4>{!! Form::label('roles', 'Роль') !!}</h4>
        <table class="table table-striped table-bordered table-hover">
            @foreach($roles as $id=>$role)
                @if($user->hasRole($role))
                    <td>
                        <input checked name="roles[]" type="checkbox"
                               value="{{ $id }}">{{trans('ua.' . $role) }}
                    </td>
                @else
                    <td>
                        <input name="roles[]" type="checkbox" value="{{ $id }}">{{ trans('ua.' . $role) }}
                    </td>
                @endif
            @endforeach
        </table>

        <!-- Submit -->
        {!! Form::button('Зберегти', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        {!! Form::close() !!}
    </div>
    <!-- END CONTENT -->
</div>