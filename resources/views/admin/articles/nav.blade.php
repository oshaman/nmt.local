<nav class="panel panel-info col-xs-12 custom-nav-tabs">
    <div class="panel-body clearfix">
        <ul class="nav nav-tabs nav-justified panel-title">
            @if(Auth::user()->canDo('UPDATE_CATS') || Auth::user()->canDo('UPDATE_ARTICLES'))
                @if('admin_articles' == Route::currentRouteName())
                    <li class="active"><a>Редагування статей</a></li>
                @else
                    <li><a href="{{ route('admin_articles') }}">Редагування статей</a></li>
                @endif
                @if(Auth::user()->canDo('UPDATE_CATS'))
                    @if('cats' == Route::currentRouteName())
                        <li class="active"><a>Категорії</a></li>
                    @else
                        <li><a href="{{ route('cats') }}">Категорії</a></li>
                    @endif
                @endif
                @if(Auth::user()->canDo('UPDATE_PRIORITY'))
                    @if('admin_priority' == Route::currentRouteName())
                        <li class="active"><a>В топ</a></li>
                    @else
                        <li><a href="{{ route('admin_priority') }}">В топ</a></li>
                    @endif
                @endif
            @endif
            {{--@if('create_article' == Route::currentRouteName())
                <li><a class="btn btn-default">Создать статью</a></li>
            @else
                <li><a href="{{ route('create_article') }}">Создать статью</a></li>
            @endif
            @if('menus' == Route::currentRouteName())
                <li><a class="btn btn-default">Меню</a></li>
            @else
                <li><a href="{{ route('menus') }}">Меню</a></li>
            @endif--}}
        </ul>
    </div>
</nav>