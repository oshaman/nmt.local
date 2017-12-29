<header class="headers">
    <div class="container">
        <div class="city-line">

            <div class="main-block">
                <div class="city-name"><img src="{{ asset('/') }}img/belg.png"
                                            alt=""><span>Білгород-Дністровський</span></div>
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
                    <div class="links"><img src="{{ asset('/') }}img/face.png" alt=""></div>
                    <div class="links"><img src="{{ asset('/') }}img/insta.png" alt=""></div>
                </div>

            </div>
        </div>
    </div>

    <div class="main-menu">
        <ul>
            <li><a href="">Наше ТБ<span class="linn"></span></a></li>
            <li>
                @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                    <a href="" onclick="return false" rel="nofollow">Новини<span class="linn"></span></a>
                @else
                    <a href="{{ route('category') }}">Новини<span class="linn"></span></a>
                @endif
            </li>
            <li><a href="">Опитування<span class="linn"></span></a></li>
            <li><a href="">Наша громада<span class="linn"></span></a></li>
            <li>
                @if('pro-nas' !== Route::currentRouteName())
                    <a href="{{ route('pro-nas') }}">Про проект<span class="linn"></span></a>
                @else
                    <a href="" onclick="return false" rel="nofollow">Про проект<span class="linn"></span></a>
                @endif
            </li>
            <li><a href="#!">Контакти<span class="linn"></span></a></li>
        </ul>

    </div>


    <div class="line-fixed">
        <div class="city-line">

            <div class="main-block">
                <div class="city-name"><img src="{{ asset('/') }}img/belg.png"
                                            alt=""><span>Білгород-Дністровський</span></div>
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

            <!--div class="link-block">
                    <div class="links"><img src="{{ asset('/') }}img/searc.png" alt=""></div>
                    <div class="links"><img src="{{ asset('/') }}img/face.png" alt=""></div>
                    <div class="links"><img src="{{ asset('/') }}img/insta.png" alt=""></div>
                </div-->

            </div>
        </div>
    </div>
</header>