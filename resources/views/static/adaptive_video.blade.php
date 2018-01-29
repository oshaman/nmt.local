<div class="efir-block">
    <div class="efir-onee">
        <div class="onne-block onny-scrol">
            <div class="closy"><img src="{{ asset('/') }}img/krest.png" alt=""></div>
            @foreach($channels as $channel)
                <div class="item-efir a-video-cat @if($loop->first) active @endif" data-id="{{ $channel->id }}">
                    <span>{{ $channel->title }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="efir-twoo">

        @if(!empty($channels))
            @foreach($channels as $channel)
                <div class="players-phone chanel-{{ $channel->id }}" style="display: none;">
                    <div class="back-butt">Назад</div>
                    <div class="closy7"><img src="{{ asset('img') }}/krest.png" alt=""></div>
                    <div class="short-name">
                        <div class="hard-shor">
                            <div class="shorr">{{ $channel->title }}</div>
                        </div>
                    </div>

                    {{--Videos--}}

                    <div class="verty scrol-city">
                        @if(!empty($channel->videos) && $channel->videos->isNotEmpty())
                            @foreach($channel->videos as $video)
                                <div class="newss" data-token="{{ $video->token }}">
                                    <div class="rght">
                                        <img src="{{ asset('img') }}/vidos.png" alt="">
                                    </div>
                                    <div class="names-neww">{{ $video->title }}</div>
                                    <div class="time-neww">
                                        <img class="badd mCS_img_loaded" src="{{ asset('/') }}img/time-efir.png" alt="">

                                        <img class="loadd mCS_img_loaded" src="{{ asset('/') }}img/play-efir.png"
                                             alt="">
                                        <span>{{ date('d-m-Y H:i', strtotime($video->created_at)) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>