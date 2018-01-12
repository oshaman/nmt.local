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
$('.dowm-aroww').click(function(event) {
event.preventDefault(event);


    //console.log('bottom');
    $('.vert').mCustomScrollbar("scrollTo", "-=150", {scrollInertia: 600, scrollEasing: "linear"});
});


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


    /*if($('.widd').length){
    setInterval(function() {
    if ($(document).scrollTop() + $(window).height() > $('.widd').offset().top && $(document).scrollTop() - $('.widd').offset().top < $('.widd').height()){

        $('.linky').addClass('seen');$('.lucky').addClass('watch');
    }if($('.watch').length){if ($(document).scrollTop() + $(window).height() > $('.watch').offset().top && $(document).scrollTop() - $('.watch').offset().top < $('.watch').height()) {
        $('.linky').removeClass('seen');$('.lucky').removeClass('watch');
    }}else {

    }}, 50);
    }*/


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
        }

        else {
            $('.headers').removeClass('goon setup');
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
            $('.headers').removeClass('opas runny');
            $('.headers').addClass('hidd');
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
            setTimeout(function () {
                $('.headers').addClass('setup');
                intro = '5';
            }, 399);

        }
        if (intro === '5') {
            $('.headers').removeClass('runny');
            $('.menu').removeClass('clikk');
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
            var down5 = $('.poll3').find('.vote-down').attr("data-width");

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


    jQuery(function ($) {
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
    });


});//and ready