<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('admin_channels' == Route::currentRouteName())
                <li><a class="btn btn-default">Канали</a></li>
            @else
                <li><a href="{{ route('admin_channels') }}">Канали</a></li>
            @endif
        </ul>
    </div>
</nav>