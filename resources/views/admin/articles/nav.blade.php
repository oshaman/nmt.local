<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            @if('cats' == Route::currentRouteName())
                <li><a class="btn btn-default">Категорії</a></li>
            @else
                <li><a href="{{ route('cats') }}">Категорії</a></li>
            @endif
            {{--@if('create_article' == Route::currentRouteName())
                <li><a class="btn btn-default">Создать статью</a></li>
            @else
                <li><a href="{{ route('create_article') }}">Создать статью</a></li>
            @endif
            @if('tags_admin' == Route::currentRouteName())
                <li><a class="btn btn-default">Тэги</a></li>
            @else
                <li><a href="{{ route('tags_admin') }}">Тэги</a></li>
            @endif
            @if('menus' == Route::currentRouteName())
                <li><a class="btn btn-default">Меню</a></li>
            @else
                <li><a href="{{ route('menus') }}">Меню</a></li>
            @endif--}}
        </ul>
    </div>
</nav>