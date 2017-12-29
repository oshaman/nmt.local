<div class="sect-news">
    @if(!empty($categories))
        <div class="news-item switch-cat @if('main' == Route::currentRouteName() || empty($cat)) active @endif"
             data-id="1">
            @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                <a href="" onclick="return false" rel="nofollow">Всі новини<span class="linn"></span></a>
            @else
                <a href="{{ route('category') }}">Всі новини<span class="linn"></span></a>
            @endif
        </div>
        @foreach($categories as $category)
            @if(!empty($cat))
                <div class="news-item switch-cat @if($cat == $category->name) active @endif"
                     data-id="{{ $category->id }}">
                    <a href="{{ route('category', $category->alias) }}">{{ $category->name }}<span class="linn"></span></a>
                </div>
            @else
                <div class="news-item switch-cat" data-id="{{ $category->id }}">
                    <a href="{{ route('category', $category->alias) }}">{{ $category->name }}<span class="linn"></span></a>
                </div>
            @endif
        @endforeach
    @endif
    <div class="news-item"><a href="/">Архів<span class="linn"></span></a></div>
    <div class="clear"></div>
</div>