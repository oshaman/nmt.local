@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->toArray() as $key=>$error)
            {!! str_replace(str_replace('_', ' ', $key), '<strong>' . trans('admin.' . $key) . '</strong>', $error[0]) !!}</br>
            @endforeach
        </ul>
    </div>
@endif
@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="forr">


    <div class="container">
        <h3 class="city-caption"><span>Повідомити новину</span></h3>
        <div class="forj">
            <div class="left-forr">
                {!! Form::open(['url'=>route('inform'), 'method'=>'post', 'class'=>'form-horizontal', 'files'=>true]) !!}

                <div class="form-page">
                    <div class="inpu">
                        {!! Form::text('name', old('name') ?? '',['placeholder'=>'Iм\'я та Прізвище *', 'class'=>'name0']) !!}


                    </div>


                    <div class="inpu">
                        {!! Form::email('email', old('email') ?? '',['placeholder'=>'Email *']) !!}
                    </div>

                    <div class="inpu phon">
                        {!! Form::text('phone', old('phone') ?? '',['placeholder'=>'Телефон *']) !!}
                    </div>

                    <div class="inpu">
                        {!! Form::textarea('text', old('text') ?? '',['placeholder'=>'Новина *']) !!}
                        <p>зірочкою помічені обов'язкові поля форми</p>
                    </div>
                </div>
                {{ Form::label('attachment', 'Ви можете завантажити до 5 файлів за 1 раз. Допустимі формати файлів: JPG, JPEG, PNG, DOC, DOCX, TXT, AVI, FLV, MP4, 3GP, MOV, ZIP, RAR, 7Z. Максимальний розмір кожного файлу - 25 Мб.') }}
                <div class="file">
                    {!! Form::file('file[]', ['class'=>'form-control']) !!}
                    {!! Form::button('+', ['class'=>'add-new']) !!}
                </div>
            <!--{{ Form::submit('Відправити') }}-->
                <div class="divv">
                    <!--<button class="senn" type="submit">Відправити<span class="linn"></span></button>-->

                    <div class="senn">Відправити<span class="linn"></span></div>
                </div>
                {!! Form::close()!!}
            </div>

            <div class="right-forr">
                <p>Хочете стати частиною команди "Наше Місто" та робити новини разом з нами?
                    У вас є інформація, яка могла б стати цікавою для всієї країни? Тоді надсилайте нам свої
                    повідомлення, прикріплюйте відео або фото і ви зможете стати співавтором наших сюжетів! Можливо,
                    саме ваша новина стане темою дня. </p>

                <p>Для того щоб повідомити нам новина (прикріпити відео, фото та / або текстовий файл) необхідно
                    заповнити форму нижче. Ми будемо вдячні, якщо при відправці новини ви заповніть всі поля форми.
                    Можливо, для уточнення деяких деталей нам буде необхідно зв'язатися з вами особисто.
                    Конфіденційність гарантуємо.</p>
            </div>


        </div>
    </div>
</div>

<div class="sh" style="display: none">
    {!! Form::file('file[]', ['class'=>'form-control']) !!}
</div>