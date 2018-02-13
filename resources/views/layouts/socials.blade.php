<div class="linky">
    <div class="link">
        {{--<div class="icon-blog insta-blog fb-share-button vertical" data-mobile-iframe="true" data-href="{{ url()->current() }}">--}}
        <a class="fb-xfbml-parse-ignore open-face-sharer" target="_blank"
           href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
           src="{{ asset('/') }}img/face-black.png"></a>
        {{--</div>--}}
    </div>
    <div class="link">
        <a href="{{ env('IG_LINK') }}">
            <img src="{{ asset('/') }}img/insta-black.png" alt="">
        </a>
    </div>
    <div class="widd"></div>
</div>