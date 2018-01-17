<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if(Auth::user()->canDo('UPDATE_CHANNEL'))
                @if('admin_channels' == Route::currentRouteName())
                    <li><a class="btn btn-default">Канали</a></li>
                @else
                    <li><a href="{{ route('admin_channels') }}">Канали</a></li>
                @endif
            @endif
            @if('create_video' == Route::currentRouteName())
                <li><a class="btn btn-default">Створити відео</a></li>
            @else
                <li><a href="{{ route('create_video') }}">Створити відео</a></li>
            @endif
        </ul>
    </div>
</nav>