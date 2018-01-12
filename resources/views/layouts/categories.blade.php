<div class="sect-news">
    @if(!empty($categories))
        <div class="news-item
            @if('main' == Route::currentRouteName()) switch-cat @endif
        @if('main' == Route::currentRouteName() || empty($cat)) active @endif"
             data-id="1">
            @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                <a href="" onclick="return false" rel="nofollow">Всі новини<span class="linn"></span></a>
            @else
                <a href="{{ route('category') }}">Всі новини<span class="linn"></span></a>
            @endif
        </div>
        @foreach($categories as $category)
            @if(!empty($cat))
                <div class="news-item
                     @if('main' == Route::currentRouteName()) switch-cat @endif
                @if($cat == $category->name) active @endif"
                     data-id="{{ $category->id }}">
                    <a href="{{ route('category', $category->alias) }}">{{ $category->name }}<span class="linn"></span></a>
                </div>
            @else
                <div class="news-item @if('main' == Route::currentRouteName()) switch-cat @endif"
                     data-id="{{ $category->id }}">
                    <a href="{{ route('category', $category->alias) }}">{{ $category->name }}<span class="linn"></span></a>
                </div>
            @endif
        @endforeach
    @endif
    <div class="news-item calen"><a class="hasl" href="javascript:void(0);">Архів<span class="dopp"></span><span
                    class="linn"></span></a>


        <div class="block-calendar">
            <div class="datepicker-here datepicker-promo">
                <div class="dont"></div>
            </div>
        </div>
        <div class="fonn-calendar"></div>
    </div>
    <div class="clear"></div>
</div>