<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>Cторінка</th>
                    <th>Редагувати</th>
                </tr>
                </thead>
                @if (!empty($seos[0]))
                    <tbody>
                    @foreach ($seos as $seo)
                        <tr>
                            <td>{{ trans('admin.' . $seo->uri) }}</td>
                            <td>
                                {!! Form::open(['url' => route('seo_update',['seo'=> $seo->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
</div>