var mainPage = $('body').hasClass('main-page')
if ($('.item-players').length || $('.video-youtube').length) {
    var player5;
    var player;
    var vidos = mainPage ? $('.vids').attr('data-token') : sessionStorage.getItem('video-current');
    var nexty;
    var teamm = mainPage ? 0 : sessionStorage.getItem('video-time');
    var muted = sessionStorage.getItem('video-muted') || true;
    var mainScrolBef = 0;
    var playerBigPlay = true;
    var videoStoped = sessionStorage.getItem('video-stoped') ? sessionStorage.getItem('video-stoped') == 'true' ? true : false : false;
    var timer = 0;
    var l = sessionStorage.getItem('video-left') || null;
    var t = sessionStorage.getItem('video-top') || null;
    var playerDrag = document.querySelector('.video-youtube')
    var placeDrag = document.querySelector('.drag-layout');
    if ($('.item-players').length) {
        var mainScrol = $(window).scrollTop();
        var scrolBlock = $('.players-left').offset().top;
        var contHeigh = $('.players-left').height() - 250;
        if (mainScrol >= scrolBlock + contHeigh) {
            playerBigPlay = false;
        } else if (mainScrolBef > mainScrol) {
            playerBigPlay = true;
        }
    } else {
        playerBigPlay = false;
    }

    if (l || t) {
        playerDrag.style.left = l + 'px';
        playerDrag.style.top = t + 'px';
    }

    function onYouTubeIframeAPIReady() {
        allInOne();
    }

    function allInOne() {

        function bigVideoInit() {
            // 1 инит большого экрана teamm = 0
            player5 = new YT.Player('player5', {
                height: '350',
                width: '540',
                videoId: vidos,
                events: {
                    'onReady': bigPlayVideo,
                    'onStateChange': changeVid
                }
            });
        }

        bigVideoInit()

        function bigPlayVideo(e) {
            if (videoStoped || !playerBigPlay) {
                return
            }
            player5.seekTo(teamm, true);
            player5.playVideo();

            muted ? player5.mute() : player5.unMute();
            if (!timer) {
                timer++;
                getTimeVideo()
            }
        }


        function smallVideoInit() {
            // 1 инит малого экрана
            player = new YT.Player('playerr', {
                height: '350',
                width: '540',
                videoId: vidos,
                events: {
                    'onReady': smallPlayVideo,
                    'onStateChange': changeVid
                }
            });
        }

        smallVideoInit()

        function smallPlayVideo(e) {
            if (videoStoped || playerBigPlay || vidos == null) {
                return
            }
            if (!mainPage) {
                otherPage();
                return
            }

            player.playVideo();
            teamm ? player.seekTo(teamm, true) : '';
            muted ? player.mute() : player.unMute();
            $('.video-youtube').addClass('yout');
            if (!timer) {
                timer++;
                getTimeVideo()
            }

        }

        function otherPage() {
            player.loadVideoById({
                videoId: vidos,
                startSeconds: teamm
            })
            muted ? player.mute() : player.unMute();
            $('.video-youtube').addClass('yout');
            if (!timer) {
                timer++;
                getTimeVideo()
            }
        }

        function scrollFun(e) {
            if (videoStoped) {
                return
            }
            var mainScrol = $(window).scrollTop();
            var scrolBlock = $('.players-left').offset().top;
            var contHeigh = $('.players-left').height() - 250;
            if (mainScrol >= scrolBlock + contHeigh) {
                if (!playerBigPlay) {
                    return
                }
                scrollBottom();
            } else if (mainScrolBef > mainScrol) {
                if (playerBigPlay) {
                    return
                }
                $('.video-youtube').removeClass('yout');
                scrollTop();
            }

            mainScrolBef = mainScrol

        }

        function scrollListner() {
            if (mainPage) {
                $(window).bind('scroll', scrollFun);
            }
        }

        scrollListner();

        function scrollBottom() {
            playerBigPlay = false;
            sessionStorage.setItem('video-muted', player5.isMuted())
            muted = player5.isMuted();
            // считываем время большого видео
            teamm = player5.getCurrentTime() || 0;
            // пауза большого видео
            player5.pauseVideo();
            // smallVideoInit() с параметрами teamm = большое видео
            smallPlayVideo();
        }

        function scrollTop() {
            playerBigPlay = true;
            // пауза малого видео
            muted = player.isMuted();
            sessionStorage.setItem('video-muted', player.isMuted())

            if (player) {
                player.pauseVideo();
                // считываем время малого видео
                teamm = player.getCurrentTime() || 0;
            }

            // bigVideoInit() с параметрами teamm = большое видео
            bigPlayVideo();
        }

        /* переключение */
        function getNextVideo() {
            actVideo = $('.vert .active');
            if (actVideo.next().length) {
                nexty = actVideo.next().attr('data-token');
            } else {
                nexty = $('.vert .newss:first-of-type').attr('data-token');
            }
        }

        getNextVideo();

        function removActi() {
            actyv = $('.vert .newss.active');
            if (actyv.next().length) {
                actyv.next().addClass('active');
            } else {
                $('.vert .newss:first-of-type').addClass('active')
            }
            actyv.removeClass('active');
            getNextVideo();
        }

        $('.newss').click(function () {
            if (_this.hasClass('newss-online')) {
                return
            }
            var videoUrl = $(this).attr("data-token");
            teamm = 0;
            getNextVideo();
            vidos = videoUrl;
            player5.destroy()
            player.destroy()
            bigVideoInit();
            smallVideoInit();
            videoRecord(videoUrl)
        });


        function changeVid(e) {
            if (e.data === 1) {
                videoStop(false)
            } else if (e.data === 2) {
                videoStop(true)
            } else if (e.data === 0) {
                player.loadVideoById({
                    'videoId': nexty,
                    'startSeconds': 0,
                    'suggestedQuality': 'large'
                });
                player5.loadVideoById({
                    'videoId': nexty,
                    'startSeconds': 0,
                    'suggestedQuality': 'large'
                });
                vidos = nexty;
                videoRecord(nexty);
                removActi();
            }
        }
    }

    function videoStop(ev) {
        videoStoped = ev;
        sessionStorage.setItem('video-stoped', videoStoped);
    }

    function videoRecord(token) {
        sessionStorage.setItem('video-current', token);
    }

    videoRecord(vidos);

    function videoPosition(l, t) {
        sessionStorage.setItem('video-left', l);
        sessionStorage.setItem('video-top', t);
    }


    function getTimeVideo() {
        setTimeout(function () {
            window.requestAnimationFrame(getTimeVideo);
        }, 1000)
        if (playerBigPlay) {
            sessionStorage.setItem('video-time', player5.getCurrentTime())
        } else {
            sessionStorage.setItem('video-time', player.getCurrentTime())
        }
    }

    $(document).ready(function () {
        $('.mutte').click(function () {
            if (muted) {
                $('.city-caption').html('3424324')
                $(this).addClass('warr');
                muted = false;
                sessionStorage.setItem('video-muted', false)
                player5.unMute();
            } else {
                muted = true;
                sessionStorage.setItem('video-muted', true)
                $(this).removeClass('warr');
                player5.mute();
            }
    });
    })

    $('.close-video-player').click(function () {
        player.pauseVideo();
        $('.video-youtube').removeClass('yout');
        videoStop(true)
    })

    $('.payer-new-window').click(function () {
        var params = 'width=565, height=365, menubar=no, location=no, status=no, scrollbars=no, resizable=no';
        var str = '?p=0&time=' + sessionStorage.getItem('video-time') +
            '&muted=' + sessionStorage.getItem('video-muted') +
            '&video=' + sessionStorage.getItem('video-current');
        window.open('/video' + str, '_blank', params);
        player.pauseVideo();
        $('.video-youtube').removeClass('yout');
    })


    $('.video-cat').bind('click', switchList);
    $('.newss').bind('click', switchVideo);

    $('.straight-left').addClass('active');


    function switchList() {
        var _this = $(this);
        $('.news-item.video-cat.active').removeClass('active');
        _this.addClass('active');
        if (_this.attr('data-id') == 'online') {
            $('.shorr').html(_this.find('span').html());
            vidos = $('.vids').attr('data-token');
            videoRecord(vidos)
            player.loadVideoById({
                videoId: vidos,
                startSeconds: 0
            })
            player5.loadVideoById({
                videoId: vidos,
                startSeconds: 0
            });
            $('.straight-left').addClass('active');
            $('.news-item.video-cat').removeClass('on').removeClass('active');
            muted ? player.mute() : player.unMute();
            if (!timer) {
                timer++;
                getTimeVideo()
            }

            $(".vert").hide();
            $('.vert[data-ch="online"]').css({display: 'block'});
            return;
    }
    if (_this.parents().hasClass('hovv-news')) {
        if (_this.siblings('.active').attr('data-id')) {
            old_id = _this.siblings('.active').attr('data-id');
        } else {
            old_id = _this.closest('.hovv-news').siblings('.active').attr('data-id');
            _this.closest('.hovv-news').siblings().removeClass("active");
        }
        _this.closest('.hovv-news').addClass('active');
    } else {
        if (_this.siblings('.active').attr('data-id')) {
            old_id = _this.siblings('.active').attr('data-id');
        } else {
            old_id = _this.siblings('.hovv-news').find('.video-cat.active').attr('data-id');
            _this.siblings('.hovv-news').find('.video-cat').removeClass('active');
        }
    }

        $('.shorr').html(_this.find('a').html());
    $(".vert").hide();
    $(".vert[data-ch='" + _this.attr('data-id') + "']").show();
    }

    function switchVideo() {
    _this = $(this);
    if (_this.hasClass('newss-online')) {
        console.log('---------');
        return false;
    } else {
        $('.straight-left').removeClass('active');
        $('.news-item.video-cat').removeClass('on');
        $('.news-item.video-cat.active').addClass('on');
        // $('.news-item.video-cat').removeClass('active');

        _this.siblings().removeClass('active');
        _this.addClass('active');
    }
    }


    placeDrag.onmousedown = function (e) {
        moveAt(e);
        var t = (e.pageX - playerDrag.offsetLeft);
        var l = (e.pageY - playerDrag.offsetTop);

        function moveAt(e) {
            playerDrag.style.left = e.pageX - t + 'px';
            playerDrag.style.top = e.pageY - l + 'px';
            videoPosition(e.pageX - t, e.pageY - l)
        }

        document.onmousemove = function (e) {
            moveAt(e);
        }
        placeDrag.onmouseup = function () {
            document.onmousemove = null;
            placeDrag.onmouseup = null;
        }
    }


}
$('.open-face-sharer').click(function (e) {
    e.preventDefault(e)
    hr = $(this).attr('href')

    var params = 'width=565, height=365, menubar=no, location=no, status=no, scrollbars=no, resizable=no';
    var str = '?p=0&time=' + sessionStorage.getItem('video-time') +
        '&muted=' + sessionStorage.getItem('video-muted') +
        '&video=' + sessionStorage.getItem('video-current');
    window.open(hr, '_blank', params);

})




