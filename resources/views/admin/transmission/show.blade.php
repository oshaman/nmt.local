@include('admin.transmission.nav')
<!-- START CONTENT -->


@if(!empty($transmissions) && count($transmissions)>0)
    {!! Form::open(['url'=>route('admin_transmissions'), 'class'=>"form-horizontal col-xs-12 panel panel-info", "method"=>"POST"]) !!}
    <div class="panel-body">
        @foreach($transmissions as $transmission)
            <div class="radio">
                <label @if(1==$transmission->approved) class="alert alert-info" @endif>
                    <input @if(1==$transmission->approved) checked="checked" @endif name="transmission" type="radio"
                           value="{{ $transmission->id }}">
                    <div>{{ $transmission->title }}</div>
                </label>
            </div>
            @if(!$loop->last)
                <hr>
            @endif
        @endforeach
        <hr>

        <div class="panel-footer">
            {!! Form::button('Перемкнути', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>

    </div>
    {!! Form::close() !!}
@endif

<!-- END CONTENT -->