<div class="linky">
    <div class="link">
        {{--<div class="icon-blog insta-blog fb-share-button vertical" data-mobile-iframe="true" data-href="{{ url()->current() }}">--}}
        <a class="fb-xfbml-parse-ignore open-face-sharer" target="_blank"
           href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
           src="{{ asset('/') }}img/face-black.png"></a>
        {{--</div>--}}
    </div>
    <div class="link">

        <a href="https://twitter.com/intent/tweet?original_referer={{ url()->current() }}&ref_src=twsrc%5Etfw&text=NasheMisto%20-%20%D0%92%20%D0%91%D0%B5%D0%BB%D0%B3%D0%BE%D1%80%D0%BE%D0%B4-%D0%94%D0%BD%D0%B5%D1%81%D1%82%D1%80%D0%BE%D0%B2%D1%81%D0%BA%D0%BE%D0%BC%20%D1%80%D0%B0%D0%B9%D0%BE%D0%BD%D0%B5%20%D0%BD%D0%B5%20%D1%84%D0%B8%D0%BA%D1%81%D0%B8%D1%80%D1%83%D1%8E%D1%82%20%D0%BD%D0%BE%D0%B2%D1%8B%D1%85%20%D1%81%D0%BB%D1%83%D1%87%D0%B0%D0%B5%D0%B2%20%D0%B7%D0%B0%D0%B1%D0%BE%D0%BB%D0%B5%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F%20%D0%BA%D0%BE%D1%80%D1%8C%D1%8E&tw_p=tweetbutton&url={{ url()->current() }}&via=%D0%92%D0%B0%D1%88%20%D0%BD%D0%B8%D0%BA"
           target="_blank">
            <img src="{{ asset('/') }}img/twit.png" alt="">
        </a>
    </div>
    <div class="link">
        <a href="https://t.me/nashemistoBD" target="_blank">
            <img src="{{ asset('/') }}img/teleg.png" alt="">
        </a>
    </div>

    <div class="link">
        <a href="{{ env('IG_LINK') }}" target="_blank">
            <img src="{{ asset('/') }}img/insta-black.png" alt="">
        </a>
    </div>
    <!--a href="https://twitter.com/share"  class="twitter-share-button" data-via="Ваш ник" data-lang="ru">Твитнуть</a-->

    <div class="widd"></div>
</div>

<script>!function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = "//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, "script", "twitter-wjs");</script>
