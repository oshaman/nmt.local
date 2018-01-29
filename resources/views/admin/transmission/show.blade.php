@include('admin.transmission.nav')
<!-- START CONTENT -->


@if(!empty($transmissions) && count($transmissions)>0)
    {!! Form::open(['url'=>route('admin_transmissions')]) !!}
    <div>
        @foreach($transmissions as $transmission)
            <div @if(1==$transmission->approved) class="alert alert-info" @endif>
                <input @if(1==$transmission->approved) checked="checked" @endif name="transmission" type="radio"
                       value="{{ $transmission->id }}">
                <div>{{ $transmission->title }}</div>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
        <hr>
        <div class="row">
            {!! Form::button('Перемкнути', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>

    </div>
    {!! Form::close() !!}
@endif

<!-- END CONTENT -->