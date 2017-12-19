<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Наше Місто</title>

    <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="./css/main.css">


</head>
<body>


@yield('header')

<div class="content">
    <div class="container">
        <div class="city-tv">
            <h1 class="city-caption"><span>Наше Місто TV</span></h1>


            <div class="straight-block">
                <div class="straight-left"><img src="./img/play.png" alt=""><span>Прямой эфир</span></div>
                <div class="straight-right">
                    <div class="news-item active"><a href="/">новости политики</a></div>
                    <div class="news-item"><a href="/">новости криминала</a></div>
                    <div class="news-item"><a href="/">новости культуры</a></div>

                    <div class="news-item"><a href="/">спорт и рекорды</a></div>
                    <div class="news-item"><a href="/">общество и культура</a></div>
                    <div class="news-item"><a href="/">новости города</a></div>
                    <div class="news-item"><a href="/">чтение и аналитика</a></div>
                    <div class="news-item"><a href="/">новости культуры</a></div>

                </div>
            </div>

            <div class="players-block">
                <div class="players-left">
                    {{--<img src="./img/news.png" alt="">--}}
                    <div class="item-players">
                        <p>
                            <iframe src="//www.youtube.com/embed/T5WCWpRpHDQ?&autoplay=1" width="560" height="314"
                                    allowfullscreen="allowfullscreen"></iframe>
                        </p>

                        {{--<div class="date">
                            <div class="name4">Сегодня открыли новый музей им. Булгакова</div>
                            <div class="date4"><img src="./img/time.png" alt=""><span>29.11.2017   20:30</span></div>
                        </div>
                        <div class="line-video"><img src="./img/line-video.png" alt=""></div>--}}
                    </div>
                </div>

                <div class="players-right">


                    <div class="vert">
                        <div class="newss">

                            <div class="names-neww">Важные новости из Министерства Здравоохранения</div>
                            <div class="time-neww"><img src="./img/play-efir.png" alt=""><span>ПРЯМОЙ ЭФИР</span></div>
                        </div>


                        <div class="newss">
                            <div class="names-neww">Сколько стоит гектар земли в Украине? Канал 1+1</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 10 мин</span></div>
                        </div>

                        <div class="newss">
                            <div class="names-neww">Важные новости из Министерства Здравоохранения</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 20 мин</span></div>
                        </div>


                        <div class="newss">
                            <div class="names-neww">Сколько стоит гектар земли в Украине? Канал 1+1</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 24 мин</span></div>
                        </div>

                        <div class="newss">
                            <div class="names-neww">Важные новости из Министерства Здравоохранения</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 34 мин</span></div>
                        </div>

                        <div class="newss">
                            <div class="names-neww">Сколько стоит гектар земли в Украине? Канал 1+1</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 35 мин</span></div>
                        </div>

                        <div class="newss">
                            <div class="names-neww">Важные новости из Министерства Здравоохранения</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 37 мин</span></div>
                        </div>

                        <div class="newss">
                            <div class="names-neww">Сколько стоит гектар земли в Украине? Канал 1+1</div>
                            <div class="time-neww"><img src="./img/time-efir.png"
                                                        alt=""><span>трансляция через 44 мин</span></div>
                        </div>


                    </div>


                    <div class="aroww-block">
                        <div class="upss-aroww"></div>
                        <div class="dowm-aroww"></div>
                    </div>
                </div>

            </div>


            <div class="city-news">
                <h1 class="city-caption"><span>Новини Нашого Міста</span></h1>

                <div class="sect-news">
                    <div class="news-item active"><a href="/">все новости</a></div>
                    <div class="news-item"><a href="/">новости политики</a></div>
                    <div class="news-item"><a href="/">новости политики</a></div>
                    <div class="news-item"><a href="/">новости криминала</a></div>
                    <div class="news-item"><a href="/">новости культуры</a></div>

                    <div class="news-item"><a href="/">спорт и рекорды</a></div>
                    <div class="news-item"><a href="/">архив</a></div>
                    <div class="clear"></div>
                </div>


                <div class="main-news">
                    <div class="mainy">
                        <div class="imgg-news"><img src="./img/krim.png" alt="">
                            <div class="yelow-line">криминал</div>
                        </div>

                        <div class="content-news">
                            <h3>Недоработали: киевлянам вернут деньги за часть коммунальных услуг</h3>
                            <p>Киевлянам сделают перерасчет за не предоставленные коммунальные услуги. Как пишет
                                "Вечерний Киев", речь идет про услуги по содержанию...</p></div>
                        <div class="coments-news">

                            <div class="left-coments">
                                <img src="./img/time-efir.png" alt="">
                                <div class="date-neww">19.11.2017</div>
                                <div class="times-newws">20:30</div>
                            </div>
                            <div class="right-coments"><img src="./img/wath.png" alt=""><span>1775</span></div>
                        </div>


                        <div class="other-news">
                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news1.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги за частькомунальных услуг</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news3.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги </h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news4.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mainy">
                        <div class="imgg-news"><img src="./img/boxx.png" alt="">
                            <div class="yelow-line">спорт</div>
                        </div>
                        <div class="content-news">

                            <h3>Недоработали: киевлянам вернут деньги за часть коммунальных услуг</h3>
                            <p>Киевлянам сделают перерасчет за не предоставленные коммунальные услуги. Как пишет
                                "Вечерний Киев", речь идет про услуги по содержанию...</p></div>
                        <div class="coments-news">

                            <div class="left-coments">
                                <img src="./img/time-efir.png" alt="">
                                <div class="date-neww">19.11.2017</div>
                                <div class="times-newws">20:30</div>
                            </div>
                            <div class="right-coments"><img src="./img/wath.png" alt=""><span>1775</span></div>
                        </div>


                        <div class="other-news">
                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/new04.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги за частькомунальных услуг</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/new05.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги </h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/new07.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="mainy">
                        <div class="imgg-news"><img src="./img/vili.png" alt="">
                            <div class="yelow-line">политика</div>
                        </div>
                        <div class="content-news">

                            <h3>Недоработали: киевлянам вернут деньги за часть коммунальных услуг</h3>
                            <p>Киевлянам сделают перерасчет за не предоставленные коммунальные услуги. Как пишет
                                "Вечерний Киев", речь идет про услуги по содержанию...</p></div>
                        <div class="coments-news">
                            <div class="left-coments">
                                <img src="./img/time-efir.png" alt="">
                                <div class="date-neww">19.11.2017</div>
                                <div class="times-newws">20:30</div>
                            </div>
                            <div class="right-coments"><img src="./img/wath.png" alt=""><span>1775</span></div>
                        </div>


                        <div class="other-news">
                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news1.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги за частькомунальных услуг</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news3.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги </h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>


                            <div class="other-item">
                                <div class="left-other">

                                    <img src="./img/news4.png" alt="">
                                </div>

                                <div class="right-other">
                                    <h4>Недоработали: киевлянам вернут деньги</h4>
                                    <div class="left-coments">
                                        <img src="./img/time-efir.png" alt="">
                                        <div class="date-neww">19.11.2017</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="main-buty"><a href="/">все новости<span class="linn"></span></a></div>
                </div>


            </div>

            <div class="inter-news">
                <h1 class="city-caption"><span>Опрос</span></h1>

            </div>

        </div>
    </div>
</div>

@yield('footer')

<script src="./js/jquery-3.2.1.min.js"></script>
<script src="./js/jquery.mCustomScrollbar.min.js"></script>
<script src="./js/main.js"></script>
</body>
</html>