<div class="forr">
    <div class="container">
        <h3 class="city-caption"><span>Повідомити новину</span></h3>
        <div class="forj">


            <div class="fomm">


                @if ($errors->any())
                    <div class="alert alert-danger">

                        @foreach ($errors->toArray() as $key=>$error)
                            <p>
                                {!! str_replace(str_replace('_', ' ', $key), '<strong>' . trans('admin.' . $key) . '</strong>', $error[0]) !!}</br>
                            </p>

                        @endforeach
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>


            <div class="left-forr">
                {!! Form::open(['url'=>route('inform'), 'method'=>'post', 'class'=>'form-horizontal', 'files'=>true]) !!}

                <div class="form-page">
                    <div class="inpu">
                        {!! Form::text('name', old('name') ?? '',['placeholder'=>'Iм\'я та прізвище *', 'class'=>'name0']) !!}
                    </div>
                    <div class="inpu">
                        {!! Form::email('email', old('email') ?? '',['placeholder'=>'Email *']) !!}
                    </div>
                    <div class="inpu phon">
                        {!! Form::text('phone', old('phone') ?? '',['placeholder'=>'Телефон *','class'=>'numbb5']) !!}
                    </div>

                    <div class="inpu">
                        {!! Form::textarea('text', old('text') ?? '',['placeholder'=>'Новина *']) !!}
                        <p>* зірочкою помічені обов'язкові поля форми</p>
                    </div>
                </div>
                {{ Form::label('attachment', 'Ви можете завантажити до 5 файлів за 1 раз. Допустимі формати файлів: JPG, JPEG, PNG, DOC, DOCX, TXT, AVI, FLV, MP4, 3GP, MOV, ZIP, RAR, 7Z. Максимальний розмір кожного файлу - 25 Мб.') }}
                <div class="file">
                    <div class="fill">{!! Form::file('file[]', ['id'=>'form-control']) !!}
                        <label for="form-control" class="texx0">Оберіть файл</label>
                        <label for="form-control" class="texx">Файл не обрано</label>
                    </div>
                    {!! Form::button('+', ['class'=>'add-new']) !!}

                </div>
            <!--{{ Form::submit('Відправити') }}-->
                <div class="divv">
                    <div class="g-recaptcha" data-sitekey="{{ config('settings.captcha_site_key') }}"></div>
                    <div class="senn">Відправити<span class="linn"></span></div>
                </div>
                {!! Form::close()!!}
            </div>

            <div class="right-forr">
                {!! $text->text ?? '' !!}
            </div>
        </div>

    </div>
</div>