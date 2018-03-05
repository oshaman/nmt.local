<div class="linky">
    <div class="link">
        {{--<div class="icon-blog insta-blog fb-share-button vertical" data-mobile-iframe="true" data-href="{{ url()->current() }}">--}}
        <a class="fb-xfbml-parse-ignore open-face-sharer" target="_blank"
           href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
           src="{{ asset('/') }}img/face-black.png"></a>
        {{--</div>--}}
    </div>
    <div class="link">

        <a href="https://twitter.com/intent/tweet?original_referer={{ url()->current() }}&ref_src=twsrc%5Etfw&text=NasheMisto%20-{{ $title ?? '' }}&tw_p=tweetbutton&url={{ url()->current() }}&via=%D0%92%D0%B0%D1%88%20%D0%BD%D0%B8%D0%BA"
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
