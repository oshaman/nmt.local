<div class="col-xs-12">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="info">
                    <th>Заголовок</th>
                    <th>Сторінка</th>
                    <th>Редагувати</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Повідомити новину</td>
                    <td>Повідомити новину</td>
                    <td>
                        {!! Form::open(['url' => route('update_informer'),'class'=>'form-horizontal','method'=>'GET']) !!}
                        {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @if (!empty($pages[0]))
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td>{{ trans('ua.'. $page->own) }}</td>
                            <td>
                                {!! Form::open(['url' => route('static_update',['static'=> $page->id]),'class'=>'form-horizontal','method'=>'GET']) !!}
                                {!! Form::button('Редагувати', ['class' => 'btn btn-warning','type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>