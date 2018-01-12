<footer class="footers">
    <div class="container">

        <div class="foter-left">
            <div class="foter-logo"><img src="{{ asset('/') }}img/logo-foter.png" alt=""></div>
            <ul>
                @if('ugoda' !== Route::currentRouteName())
                    <li><a href="{{ route('ugoda') }}">Угода про конфіденційність</a></li>
                @else
                    <li><a href="" onclick="return false" rel="nofollow">Угода про конфіденційність</a></li>
                @endif
                @if('pravyla' !== Route::currentRouteName())
                    <li><a href="{{ route('pravyla') }}">Правила користування сайтом</a></li>
                @else
                    <li><a href="" onclick="return false" rel="nofollow">Правила користування сайтом</a></li>
                @endif
                @if('reklama' !== Route::currentRouteName())
                    <li><a href="{{ route('reklama') }}">Реклама</a></li>
                @else
                    <li><a href="" onclick="return false" rel="nofollow">Реклама</a></li>
                @endif
                @if('redakciya' !== Route::currentRouteName())
                    <li><a href="{{ route('redakciya') }}">Редакція</a></li>
                @else
                    <li><a href="" onclick="return false" rel="nofollow">Редакція</a></li>
                @endif
            </ul>


        </div>
        <div class="foter-right">
            <div class="foter-news">
                <div class="news-item">
                    @if('main' == Route::currentRouteName())
                        <a href="" onclick="return false" rel="nofollow" class="active">
                            Наше ТБ<span class="linn"></span>
                        </a>
                    @else
                        <a href="{{ route('main') }}">Наше ТБ<span class="linn"></span></a>
                    @endif
                </div>
                <div class="news-item">
                    @if('category' === Route::currentRouteName() && empty(Request::segment(2)))
                        <a href="" onclick="return false" rel="nofollow">НОВИНИ<span class="linn"></span></a>
                    @else
                        <a href="{{ route('category') }}">НОВИНИ<span class="linn"></span></a>
                    @endif
                </div>
                <div class="news-item">
                    @if('poll' === Route::currentRouteName() && empty(Request::segment(2)))
                        <a href="" onclick="return false" rel="nofollow">ОПИТУВАННЯ<span class="linn"></span></a>
                    @else
                        <a href="{{ route('poll') }}">ОПИТУВАННЯ<span class="linn"></span></a>
                    @endif
                </div>
                <div class="news-item"><a href="/">НАША ГРОМАДА<span class="linn"></span></a></div>

                <div class="news-item">
                    @if('pro-nas' !== Route::currentRouteName())
                        <a href="{{ route('pro-nas') }}">ПРО ПРОЕКТ<span class="linn"></span></a>
                    @else
                        <a href="" onclick="return false" rel="nofollow">ПРО ПРОЕКТ<span class="linn"></span></a>
                    @endif
                </div>
                <div class="news-item">
                    @if('kontakty' !== Route::currentRouteName())
                        <a href="{{ route('kontakty') }}">КОНТАКТИ<span class="linn"></span></a>
                    @else
                        <a href="" onclick="return false" rel="nofollow">КОНТАКТИ<span class="linn"></span></a>
                    @endif
                </div>
                <div class="clear"></div>
            </div>
            <div class="foter-text">
                <p>
                    Наша мета - надавати якісну інформацію безкоштовно в зручному для вас місці і форматі.
                    Вам не треба шукати нас - ІА «MISTO» зустрічає читача щоранку по дорозі на роботу в метро,
                    ​​на транспортних розв'язках, у кафе і бізнес-центрах. Протягом усього дня на наших сторінках
                    в соцмережах і на сайті www.misto.ua ви отримуєте найважливіші новини вашого міста, країни та світу.
                </p>
            </div>
        </div>
        <div class="clear"></div>

        <div class="foter-bott">
            <div class="foot-item">

                <a href="{{ env('FB_LINK') }}" target="_blank"><img src="{{ asset('/') }}img/facce.png" alt=""></a>
                <a href="{{ env('IG_LINK') }}" target="_blank"><img src="{{ asset('/') }}img/instt.png" alt=""></a>
            </div>

            <div class="foot-item">МІСТО 2017. Все права захищені.</div>
            <div class="foot-item">
                <div class="fresh">
                    <div class="created">САЙТ РАЗРАБОТАН</div>

                    <a href="http://freshweb.agency/?utm_source=our-sites&utm_medium=nashe-misto" target="_blank">
                        <div class="fresh-logo"><span>F</span><span>R</span><span>E</span><span>S</span><span>H</span>
                        </div>
                    </a>
                    <div class="creative">CREATIVE WEB AGENCY</div>
                </div>
            </div>
        </div>
    </div>
</footer>