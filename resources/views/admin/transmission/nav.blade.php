<nav class="panel panel-info col-xs-12 custom-nav-tabs">
    <div class="panel-body clearfix">
        <ul class="nav nav-tabs nav-justified panel-title">
            @if(Auth::user()->canDo('UPDATE_CHANNEL'))
                @if('admin_transmissions' == Route::currentRouteName())
                    <li role="presentation" class="active"><a class="">Online</a></li>
                @else
                    <li role="presentation"><a class="" href="{{ route('admin_transmissions') }}">Online</a></li>
                @endif
                @if('create_transmission' == Route::currentRouteName())
                    <li role="presentation" class="active"><a class="">Управління трансляціями</a></li>
                @else
                    <li><a href="{{ route('create_transmission') }}">Управління трансляціями</a></li>
                @endif
                @if('admin_card' == Route::currentRouteName())
                    <li role="presentation" class="active"><a class="" class="btn btn-default">Анонси</a></li>
                @else
                    <li role="presentation"><a class="" href="{{ route('admin_card') }}">Анонси</a></li>
                @endif
            @endif
        </ul>
    </div>
</nav>