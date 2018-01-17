jQuery(document).ready(function () {

    vert = $('.vert')


    function scrollInit(n) {
        if (n) {
            vert.mCustomScrollbar({
                theme: "rounded",


                callbacks: {
                    onScrollStart: function () {
                        $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').addClass('active');
                    },

                    onScroll: function () {
                        $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').removeClass('active');
                    }
                },
                advanced: {autoExpandHorizontalScroll: true, updateOnBrowserResize: true},

            });
        } else {
            vert.mCustomScrollbar({
                theme: "rounded",
                horizontalScroll: true,

                callbacks: {
                    onScrollStart: function () {
                        $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').addClass('active');
                    },

                    onScroll: function () {
                        $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').removeClass('active');
                    }
                },
                advanced: {autoExpandHorizontalScroll: true, updateOnBrowserResize: true},

            });
        }


    }

    function getScroll() {
        w_w = window.innerWidth
        if (w_w < 1024) {
            vert.mCustomScrollbar("destroy");
            scrollInit(false);
            $('.players-block').addClass('dest');
        } else {
            vert.mCustomScrollbar("destroy");
            scrollInit(true);
            $('.players-block').removeClass('dest');
        }
    }

    getScroll();

    window.onresize = function () {
        getScroll()
    }


    $('.upss-aroww').click(function (event) {
        event.preventDefault(event);
        console.log('top');
        $('.vert').mCustomScrollbar("scrollTo", "+=150", {scrollInertia: 600, scrollEasing: "linear"});
    });
    $('.dowm-aroww').click(function (event) {
        event.preventDefault(event);


        //console.log('bottom');
        $('.vert').mCustomScrollbar("scrollTo", "-=150", {scrollInertia: 600, scrollEasing: "linear"});
    });


    if ($(window).width() > 1024) {
        $('.main-hover').hover(
            function () {
                $(this).parent().addClass('playy');
                setTimeout(function () {
                    $('.playy').addClass('hamm');
                }, 499);
                $('.animate').addClass('libo');
            },
            function () {
                $(this).parent().addClass('crash');
                $(this).parent().removeClass('playy');
                $('.animate').removeClass('libo');
                $('.mainy').removeClass('hamm');
                setTimeout(function () {
                    $('.mainy').removeClass('crash');
                }, 699);
            });
    } else {
    }


    if ($('.linky').length) {
        var fixmeTop = $('.linky').offset().top;


        var last = $('.linky').height();


        $(window).scroll(function () {
            var currentScroll = $(window).scrollTop();
            var cont = $(window).height();
            var alls = window.innerHeight;
            if (currentScroll >= fixmeTop - 399) {
                $('.linky').addClass('runns');
            }
            else {
                $('.linky').removeClass('runns');
            }
        });

        $(window).scroll(function () {
            var currentScroll = $(window).scrollTop();
            var cont = $(window).height();
            var alls = window.innerHeight;

            var city = $('.city-news').offset().top;
            var test = city - last - 399 - 114;
            console.log(test);
            if (currentScroll >= test) {
                $('.linky').addClass('best');
            }
            else {
                $('.linky').removeClass('best');
            }

            console.log(currentScroll);
        });
    }


    $(window).scroll(function () {
        var currentScroll = $(window).scrollTop();
        var lime = $('.under-line').offset().top;
        if (currentScroll >= lime) {
            $('.headers').addClass('goon');
            $('.headers').removeClass('domm');
        }

        else {
            $('.headers').removeClass('goon setup');
            $('.headers').addClass('domm');
        }
    });


    $(window).scroll(function () {
        var currentScroll = $(window).scrollTop();
        var lihe = $('.main-menu').offset().top;
        if (currentScroll >= lihe - 15) {
            $('.headers').addClass('opas');
            $('.headers').removeClass('hidd');
        }
        else {
            $('.headers').removeClass('opas');
//            $('.headers').addClass('hidd');
            setTimeout(function () {
                $('.menu').removeClass('clikk');
            }, 299);

        }
    });


    /*    var Menu = {

      el: {
        ham: $('.menu'),
        menuTop: $('.menu-top'),
        menuMiddle: $('.menu-middle'),
        menuBottom: $('.menu-bottom')
      },

      init: function() {
        Menu.bindUIactions();
      },

      bindUIactions: function() {
        Menu.el.ham
            .on(
              'click',
            function(event) {
            Menu.activateMenu(event);
            event.preventDefault();
          }
        );
      },

      activateMenu: function() {
        Menu.el.menuTop.toggleClass('menu-top-click');
        Menu.el.menuMiddle.toggleClass('menu-middle-click');
        Menu.el.menuBottom.toggleClass('menu-bottom-click');



      }
    };

    Menu.init();*/
    var intro = '4';

    $('.menu').click(function () {
        if (intro === '4') {
            $('.headers').addClass('runny');
            $('.menu').addClass('clikk');
            $('body').addClass('overr');
            $('html, body').bind('touchmove', function (e) {
                e.preventDefault(e);
            });
            setTimeout(function () {
                $('.headers').addClass('setup');
                intro = '5';
            }, 399);

        }
        if (intro === '5') {
            $('.headers').removeClass('runny');
            $('.menu').removeClass('clikk');
            $('body').removeClass('overr');
            $('html, body').unbind('touchmove');
            setTimeout(function () {
                $('.headers').removeClass('setup');
            }, 399);
            intro = '4';
        }

    });


    $('.strai-main').click(function () {


        $('.efir-block').addClass('main-govy');
    });


    $('.closy').click(function () {
        $('.efir-block').removeClass('main-govy');
    });
    var ness = '7';
    var heyt = $('.vijen').height();
    console.log(heyt);


    $('.hovv-news').click(function () {
        if (ness === '7') {

            $('.vijen').css({'height': heyt, 'transition-delay': '0s'});
            $('.vijen-insid').css({'opacity': '1', 'transition-delay': '.39s', 'visibility': 'visible'});
            $('.hovv-news').addClass('linsa');
            setTimeout(function () {
                ness = '4';
            }, 99);
        }
        if (ness === '4') {
            $('.vijen').css({'height': '0', 'transition-delay': '.39s'});
            $('.vijen-insid').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            $('.hovv-news').removeClass('linsa');
            ness = '7';
        }
    });


    $('.video-cat').click(function () {
        var lisen = $(this).find('a').html();

        $('.shorr').html(lisen);
    });


    $('.scrol-city').mCustomScrollbar({
        theme: "rounded",
        callbacks: {
            onScrollStart: function () {
                $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').addClass('active');

            },
            onScroll: function () {
                $('.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar').removeClass('active');
            }
        }
    });

    var hexx = '7';
    $('.clik-city').click(function () {

        if (hexx === '7') {
            $('.homr-name').css({'height': '599px', 'transition-delay': '0s'});
            $('.scrol-city').css({'opacity': '1', 'transition-delay': '.39s', 'visibility': 'visible'});
            setTimeout(function () {
                hexx = '4';
            }, 99);
        }
        if (hexx === '4') {
            $('.homr-name').css({'height': '0', 'transition-delay': '.39s'});
            $('.scrol-city').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            hexx = '7';
        }
    });


    setTimeout(function () {

        $('.vijen').addClass('vidds');
    }, 199);


    setInterval(function () {
        if ($('.vote').length) {
            var down1 = $('.poll1').find('.vote-down').attr("data-width");

            var down2 = $('.poll2').find('.vote-down').attr("data-width");
            var down3 = $('.poll3').find('.vote-down').attr("data-width");
            var down4 = $('.poll4').find('.vote-down').attr("data-width");
            var down5 = $('.poll5').find('.vote-down').attr("data-width");

            $('.poll1').find('.line-down').css({'width': +down1 + '%'});
            $('.poll2').find('.line-down').css({'width': +down2 + '%'});
            $('.poll3').find('.line-down').css({'width': +down3 + '%'});
            $('.poll4').find('.line-down').css({'width': +down4 + '%'});

            $('.poll5').find('.line-down').css({'width': +down5 + '%'});
        }


    }, 55);


    $('.quest-five').find('.soon').parent().parent().addClass('noth');
    $('.hasl').click(function () {

        $('.calen').toggleClass('caldd');

    });


    $('.fonn-calendar').click(function () {
        $('.calen').removeClass('caldd');
    });
    setInterval(function () {

        $('.datepicker--cell').click(function () {

            $('.calen').removeClass('caldd');
            var dates = $(this).attr("data-date");
            var month = $(this).attr("data-month");
            var osnv = +month + 1;
            var year = $(this).attr("data-year");
            var cifra = 9;


            if (+osnv >= '10') {
                if (+dates <= '9') {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html('0' + dates + '.' + osnv + '.' + year);
                } else {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html(dates + '.' + osnv + '.' + year);
                }
            }


            if (+osnv <= '9') {
                if (+osnv <= '9') {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html('0' + dates + '.' + '0' + osnv + '.' + year);
                } else {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html('0' + dates + '.' + osnv + '.' + year);
                }
            }


            if (+osnv <= '9') {
                if (+dates <= '9') {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html('0' + dates + '.' + '0' + osnv + '.' + year);
                } else {

                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).html(dates + '.' + '0' + osnv + '.' + year);
                }
            }


        });
    }, 55);


    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".linsa"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('.vijen').css({'height': '0', 'transition-delay': '.39s'});
            $('.vijen-insid').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            $('.hovv-news').removeClass('linsa');
            ness = '7';
        }
    });


    var mexx = '7';
    $('.glavn-hover').click(function () {

        if (mexx === '7') {
            $('.hody').css({'height': '245px', 'transition-delay': '0s'});
            $('.soloo').css({'opacity': '1', 'transition-delay': '.39s', 'visibility': 'visible'});
            setTimeout(function () {
                mexx = '4';
            }, 99);
        }
        if (mexx === '4') {
            $('.hody').css({'height': '0', 'transition-delay': '.39s'});
            $('.soloo').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            mexx = '7';
        }
    });


    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div4 = $(".glavn-hover"); // тут указываем ID элемента
        if (!div4.is(e.target) // если клик был не по нашему блоку
            && div4.has(e.target).length === 0) { // и не по его дочерним элементам

            $('.hody').css({'height': '0', 'transition-delay': '.39s'});
            $('.soloo').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            mexx = '7';
        }
    });


    $('.item-efir').click(function () {

        $('.efir-block').addClass('runn-right');
    });

    $('.back-butt').click(function () {
        $('.efir-block').removeClass('runn-right');
    });

    $('.closy7').click(function () {
        $('.efir-block').addClass('endd');
        setTimeout(function () {
            $('.efir-block').removeClass('runn-right endd main-govy');
        }, 700);
    });


    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div4 = $(".clik-city"); // тут указываем ID элемента
        if (!div4.is(e.target) // если клик был не по нашему блоку
            && div4.has(e.target).length === 0) { // и не по его дочерним элементам

            $('.homr-name').css({'height': '0', 'transition-delay': '.39s'});
            $('.scrol-city').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            hexx = '7';
        }
    });


//          var tag = document.createElement('script');
//      tag.src = "https://www.youtube.com/iframe_api";
//      var firstScriptTag = document.getElementsByTagName('script')[0];
//      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    
     

});//and ready

var player5;
var player;
var vidos = 'yA30K3z5PSw';


$('.newss').click(function () {
    var videoUrl = $(this).attr("data-token");
    vidos = videoUrl;
    console.log(vidos);
    player5.destroy();

    player.destroy();
    bigVideo();
});


function onYouTubeIframeAPIReady() {
    bigVideo()
}

function bigVideo() {
    player5 = new YT.Player('player5', {
        height: '350',

        width: '540',

        videoId: vidos,
        events: {

            'onReady': onPlayerReady,
//            'onStateChange': onPlayerStateChange
        }
    });
    player = new YT.Player('playerr', {
        height: '360',
        width: '640',

        videoId: vidos,
        events: {
            'onReady': onPlayerReady,
//          'onStateChange': onPlayerStateChange
        }
    });


}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    //event.target.playVideo();
    smallMutePlay();
    smallMuteStop();
    biggMuteStop();
    biggMutePlay();
    //player.mute();
}


function smallMuteStop() {
    player.mute();
}

function smallMutePlay() {
    player.unMute();
}


function biggMuteStop() {
    player5.mute();
}

function biggMutePlay() {
    player5.unMute();
}


var done = true;
//      function onPlayerStateChange(event) {
//        
//       if (event.data == YT.PlayerState.PLAYING && !done) {
//          setTimeout(stopVideo, 1000);
//          done = false;
//        }
//      }
function stopVideo() {
    player5.stopVideo();
    player.stopVideo();
}


$(window).scroll(function () {
    var mainScrol = $(window).scrollTop();
    var scrolBlock = $('.players-left').offset().top;
    var contHeigh = $('.players-left').height();
    if (mainScrol >= scrolBlock + contHeigh) {
        $('.video-youtube').addClass('yout');
        smallMutePlay();
        biggMuteStop();

    } else {
        $('.video-youtube').removeClass('yout');

        smallMuteStop();
        biggMutePlay();
    }

});

     