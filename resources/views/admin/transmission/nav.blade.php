<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if(Auth::user()->canDo('UPDATE_CHANNEL'))
                @if('admin_transmissions' == Route::currentRouteName())
                    <li><a class="btn btn-default">Online</a></li>
                @else
                    <li><a href="{{ route('admin_transmissions') }}">Online</a></li>
                @endif
                @if('create_transmission' == Route::currentRouteName())
                    <li><a class="btn btn-default">Управління трансляціями</a></li>
                @else
                    <li><a href="{{ route('create_transmission') }}">Управління трансляціями</a></li>
                @endif
                @if('admin_card' == Route::currentRouteName())
                    <li><a class="btn btn-default">Анонси</a></li>
                @else
                    <li><a href="{{ route('admin_card') }}">Анонси</a></li>
                @endif
            @endif
        </ul>
    </div>
</nav>