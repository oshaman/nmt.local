@include('admin.articles.nav')
<h2>Додати в топ</h2>
<div class="">
    {!! Form::open(['url' => route('admin_priority'), 'class' => 'form-horizontal', 'method' => 'post']) !!}
    {{ Form::label('category', 'Категорія') }}
    <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
            title="Обов'язкове до заповнення">?
    </button>
    <div>
        {!! Form::select('category', $cats ?? [],
            old('category') ? : '' , [ 'class'=>'form-control', 'placeholder'=>'Категорія'])
        !!}
    </div>
    <!-- Submit -->
    <hr>
    {!! Form::button('Знайти', ['class' => 'btn btn-success','type'=>'submit']) !!}
    {!! Form::close() !!}
</div>
@if(!empty($priority))
    <h4>Додати статті</h4>
    <hr>
    <div class="">
        <button type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="right"
                title="Ввести ID статті">?
        </button>
        {!! Form::open(['url' => route('update_priority', $priority->id), 'class' => 'form-horizontal', 'method' => 'post']) !!}
        <div class="row">
            <div class="col-lg-4">
                {{ Form::label('top1', 'Саття №1') }}<br>
                {!! Form::number('top1', old('top1') ?? ($priority->top1 ?? '') ) !!}
            </div>
            <div class="col-lg-4">
                {{ Form::label('top2', 'Саття №2') }}<br>
                {!! Form::number('top2', old('top2') ?? ($priority->top2 ?? '') ) !!}
            </div>
            <div class="col-lg-4">
                {{ Form::label('top3', 'Саття №3') }}<br>
                {!! Form::number('top3', old('top3') ?? ($priority->top3 ?? '') ) !!}
            </div>
        </div>
        <hr>
        {!! Form::button('Зберегти', ['class' => 'btn btn-success','type'=>'submit']) !!}
        {!! Form::close() !!}
    </div>
@endif