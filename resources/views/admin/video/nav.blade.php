<nav class="panel panel-info col-xs-12 custom-nav-tabs">
    <div class="panel-body clearfix">
        <ul class="nav nav-tabs nav-justified panel-title">
            @if(Auth::user()->canDo('UPDATE_VIDEO') || Auth::user()->canDo('UPDATE_CHANNEL'))
                @if('admin_videos' == Route::currentRouteName() || 'edit_video' == Route::currentRouteName())
                    <li class="active"><a>Cписки відео</a></li>
                @else
                    <li><a href="{{ route('admin_videos') }}">Cписки відео</a></li>
                @endif
                @if(Auth::user()->canDo('UPDATE_CHANNEL'))
                    @if('admin_channels' == Route::currentRouteName() || 'edit_channel' == Route::currentRouteName())
                        <li class="active"><a>Редагування каналів</a></li>
                    @else
                        <li><a href="{{ route('admin_channels') }}">Редагування каналів</a></li>
                    @endif
                @endif
                @if('create_video' == Route::currentRouteName())
                    <li class="active"><a>Створити відео</a></li>
                @else
                    <li><a href="{{ route('create_video') }}">Створити відео</a></li>
                @endif
            @endif
        </ul>
    </div>
</nav>