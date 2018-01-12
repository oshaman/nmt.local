<header class="headers">
    <div class="container">
        <div class="city-line">
            <div class="under-line">
                <div class="ups-line">
                    <div class="mainy-line">
                        <div class="main-block">
                            <div class="city-name">
                                <div class="clik-city"><img src="{{ asset('/') }}img/belg.png" alt=""><span>Білгород-Дністровський</span>
                                </div>
                                <div class="homr-name">
                                    <div class="scrol-city">
                                        <div class="items-scrol">Авдеевка</div>

                                        <div class="items-scrol">Александрия</div>
                                        <div class="items-scrol">Балаклея</div>
                                        <div class="items-scrol">Балта</div>
                                        <div class="items-scrol">Белая Церковь</div>
                                        <div class="items-scrol">Валки</div>
                                        <div class="items-scrol">Великие Мосты</div>
                                        <div class="items-scrol">Верхнеднепровск</div>
                                        <div class="items-scrol">Гайворон</div>
                                        <div class="items-scrol">Городенка</div>

                                        <div class="items-scrol">Гайворон</div>
                                        <div class="items-scrol">Городенка</div>
                                        <div class="items-scrol">Александрия</div>
                                        <div class="items-scrol">Балаклея</div>
                                        <div class="items-scrol">Балта</div>
                                        <div class="items-scrol">Белая Церковь</div>
                                        <div class="items-scrol">Валки</div>
                                        <div class="items-scrol">Великие Мосты</div>
                                        <div class="items-scrol">Верхнеднепровск</div>
                                        <div class="items-scrol">Гайворон</div>
                                        <div class="items-scrol">Городенка</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-block">
                            @if('main' == Route::currentRouteName())
                                <img src="{{ asset('/') }}img/ourcity-logo.png" alt="">
                            @else
                                <a href="{{ route('main') }}">
                                    <img src="{{ asset('/') }}img/ourcity-logo.png" alt="">
                                </a>
                            @endif
                        </div>
                        <div class="main-block">
                            <div class="link-block">
                                <div class="links"><img src="{{ asset('/') }}img/searc.png" alt=""></div>
                                <div class="links">
                                    <a href="{{ env('FB_LINK') }}" target="_blank">
                                        <img src="{{ asset('/') }}img/face.png" alt="">
                                    </a>
                                </div>
                                <div class="links">
                                    <a href="{{ env('IG_LINK') }}" target="_blank">
                                        <img src="{{ asset('/') }}img/insta.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="menu">
                                <span class="menu-global menu-top"></span>
                                <span class="menu-global menu-middle"></span>
                                <span class="menu-global menu-bottom"></span>
                            </div>
                        </div>
                        {{---- Mobile Menu ----}}
                        <div class="block-menu">
                            <div class="new-menu">
                                <div class="name-menu">Меню</div>
                                <div class="centr">
                                    <ul>
                                        <li>
                                            @if('main' == Route::currentRouteName())
                                                <a href="" onclick="return false" rel="nofollow" class="active">
                                                    Наше ТБ<span class="linn"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('main') }}">Наше ТБ<span class="linn"></span></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                                                <a href="" onclick="return false" rel="nofollow"
                                                   class="active">Новини<span class="linn"></span></a>
                                            @else

                                                <a href="{{ route('category') }}">Новини<span class="linn"></span></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if('poll' === Route::currentRouteName() && empty(Request::segment(2)))
                                                <a href="" onclick="return false" rel="nofollow"
                                                   class="active">Опитування<span class="linn"></span></a>
                                            @else

                                                <a href="{{ route('poll') }}">Опитування<span class="linn"></span></a>
                                            @endif
                                        </li>
                                        <li><a href="">Наша громада<span class="linn"></span></a></li>
                                        <li>
                                            @if('pro-nas' !== Route::currentRouteName())
                                                <a href="{{ route('pro-nas') }}">Про проект<span
                                                            class="linn"></span></a>
                                            @else
                                                <a href="" onclick="return false" rel="nofollow" class="active">
                                                    Про проект<span class="linn"></span></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if('kontakty' !== Route::currentRouteName())
                                                <a href="{{ route('kontakty') }}">
                                                    Контакти<span class="linn"></span>
                                                </a>
                                            @else
                                                <a href="" onclick="return false" rel="nofollow" class="active">
                                                    Контакти<span class="linn"></span>
                                                </a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>

                                <div class="link-block neww-link">
                                    <div class="links">
                                        <a href="{{ env('FB_LINK') }}" target="_blank">
                                            <img src="http://13.j2landing.com/img/face.png" alt="">
                                        </a>
                                    </div>
                                    <div class="links">
                                        <a href="{{ env('IG_LINK') }}" target="_blank">
                                            <img src="http://13.j2landing.com/img/insta.png" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="down-block"></div>
                        </div>
                        {{---- Mobile Menu ----}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Main Menu--}}
    <div class="main-menu">
        <ul>
            <li>
                @if('main' == Route::currentRouteName())
                    <a href="" onclick="return false" rel="nofollow" class="active">Наше ТБ<span
                                class="linn"></span></a>
                @else
                    <a href="{{ route('main') }}">Наше ТБ<span class="linn"></span></a>
                @endif
            </li>
            <li>
                @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                    <a href="" onclick="return false" rel="nofollow" class="active">Новини<span class="linn"></span></a>
                @else
                    <a href="{{ route('category') }}">Новини<span class="linn"></span></a>
                @endif
            </li>
            <li>
                @if('poll' === Route::currentRouteName() && empty(Request::segment(2)))
                    <a href="" onclick="return false" rel="nofollow"
                       class="active">Опитування<span class="linn"></span></a>
                @else
                    <a href="{{ route('poll') }}">Опитування<span class="linn"></span></a>
                @endif
            </li>
            <li><a href="">Наша громада<span class="linn"></span></a></li>
            <li>
                @if('pro-nas' !== Route::currentRouteName())
                    <a href="{{ route('pro-nas') }}">Про проект<span class="linn"></span></a>
                @else
                    <a href="" onclick="return false" rel="nofollow" class="active">Про проект<span
                                class="linn"></span></a>
                @endif
            </li>
            <li>
                @if('kontakty' !== Route::currentRouteName())
                    <a href="{{ route('kontakty') }}">Контакти<span class="linn"></span></a>
                @else
                    <a href="" onclick="return false" rel="nofollow" class="active">Контакти<span
                                class="linn"></span></a>
                @endif
            </li>
        </ul>
    </div>
    {{--Main Menu--}}
</header>