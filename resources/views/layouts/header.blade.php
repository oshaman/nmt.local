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
            <li><a href="{{ route('category') }}">Новини<span class="linn"></span></a></li>
            <li><a href="">Опитування<span class="linn"></span></a></li>
            <li><a href="">Наша громада<span class="linn"></span></a></li>
            <li><a href="">Про проект<span class="linn"></span></a></li>
            <li><a href="">Контакти<span class="linn"></span></a></li>
        </ul>

    </div>
</header>