<div class="animate"></div>
<footer class="footers">
    <div class="container">

        <div class="foter-left">
            <div class="foter-logo"><img src="{{ asset('/') }}img/logo-fote.svg" alt=""></div>
            <!--       <div class="pxWindow">
                       <p class="pxWindow1"></p>
                       <p class="pxWindow2"></p>
                   </div>-->
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
                <div class="news-item"><a href="/">НАША ГРОМАДА<span class="linn"></span></a></div>
                <div class="news-item">
                    @if('main' == Route::currentRouteName())
                        <a href="" onclick="return false" rel="nofollow" class="active">
                            Наше TV<span class="linn"></span>
                        </a>
                    @else
                        <a href="{{ route('main') }}">Наше TV<span class="linn"></span></a>
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

                <a href="{{ env('FB_LINK') }}" class="icon" target="_blank"><img src="{{ asset('/') }}img/f.png" alt=""></a>
                <a href="https://twitter.com/intent/tweet?original_referer={{ url()->current() }}&ref_src=twsrc%5Etfw&text=NasheMisto%20-{{ $title ?? '' }}&tw_p=tweetbutton&url={{ url()->current() }}&via=%D0%92%D0%B0%D1%88%20%D0%BD%D0%B8%D0%BA"
                   class="icon"><img src="{{ asset('/') }}img/tw.png" alt=""></a>
                <a href="{{ env('IG_LINK') }}" class="icon" target="_blank"><img src="{{ asset('/') }}img/telg.png"
                                                                                 alt=""></a>
                <a href="{{ env('IG_LINK') }}" class="icon" target="_blank"><img src="{{ asset('/') }}img/inst.png"
                                                                                 alt=""></a>
            </div>

            <div class="foot-item">МІСТО 2017. Всі права захищені.</div>
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


<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = "//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, "script", "twitter-wjs");</script>




