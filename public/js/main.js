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


    $('.main-hover').bind('mouseenter', hoverEl);
    $('.main-hover').bind('mouseleave', mouseleveEl)

    function hoverEl() {
        if ($(window).width() > 1024) {
                $(this).parent().addClass('playy');
                setTimeout(function () {
                    $('.playy').addClass('hamm');
                }, 499);
            $('.animate').addClass('libo');
            $('.news-item.active').addClass('zindd');
        }
    }

    function mouseleveEl() {
        if ($(window).width() > 1024) {
                $(this).parent().addClass('crash');
                $(this).parent().removeClass('playy');
                $('.animate').removeClass('libo');
            $('.mainy').removeClass('hamm');
            $('.news-item.active').removeClass('zindd');
                setTimeout(function () {
                    $('.mainy').removeClass('crash');
                }, 699);
        }
    };
   

    $(function () {
        $('.switch-cat').bind('click', switchCat);
        $('.datepicker--cell').bind('click', switchCatByDay);
    });

    $('.datepicker--nav-action').click(function () {
        changeMounYear()
    })  
    
    $('.datepicker-here').datepicker({
        onChangeMonth: changeMounYear,
        onChangeYear: changeMounYear,
        onSelect: changeMounYear
    })

    function changeMounYear() {
        setTimeout(function () {
            $('.datepicker--cell').bind('click', switchCatByDay);
        }, 500)
    }
    function switchCat(e) {
        _this = $(this);
        e.preventDefault();
        _this.siblings('.active').removeClass("active");
        _this.addClass('active');
        $('.date-time-selected').html(' ');
        $('.archive').css({display: 'block'});

        cat_id = _this.attr('data-id');
        if (("undefined" !== typeof cat_id) && $.isNumeric(cat_id)) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/get-articles',
                type: 'POST',
                data: {'cat': cat_id},
                success: function (resp) {
                    resp ? $('.cat-removeble').html(resp) : '';
                    setTimeout(function () {
                        $('.main-hover').bind('mouseenter', hoverEl);
                        $('.main-hover').bind('mouseleave', mouseleveEl)
                    }, 50)
                    
                }
            })
        } else {
            return false;
        }
    }


    function switchCatByDay(e) {
        _this = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/get-articles-by-date',
            type: 'POST',
            data: {'day': _this.attr('data-date'), 'month': _this.attr('data-month'), 'year': _this.attr('data-year')},
            success: function (resp) {
                $('.news-item.switch-cat').removeClass("active");
                resp ? $('.cat-removeble').html(resp) : '';
                setTimeout(function () {
                    $('.main-hover').bind('mouseenter', hoverEl);
                    $('.main-hover').bind('mouseleave', mouseleveEl)
                }, 50)
            }
        })
    }

    $('.load-more').bind('click', loadAjax);

    function loadAjax() {
        _this = $(this);

        if (_this.siblings('input[name="stats"]').val().length == 0) {

            var source = _this.attr('data-source');
            var source_id = _this.attr('data-id');
            var page = $('.active-pagin-number').last().text();
            var cnt_page = $('.pagin-number').last().text();
            // console.log(page);
            // return false;

            if (page >= cnt_page) return false;
            if ((("undefined" !== typeof source) && $.isNumeric(source)) && (("undefined" == typeof source_id) || $.isNumeric(source_id))) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/get-more',
                    type: 'POST',
                    data: {'source': source, 'source_id': source_id, 'page': page},
                    success: function (resp) {
                        divs = $(resp).siblings('.mainy');
                        pag = $(resp).siblings('.articles-pagination').html();
                        divs ? divs.insertBefore('.more-before') : '';

                        $('.articles-pagination').html(pag);
                        page++;

                        if (page >= cnt_page) {
                            _this.remove();
                        }
                        setTimeout(function () {
                            $('.main-hover').bind('mouseenter', hoverEl);
                            $('.main-hover').bind('mouseleave', mouseleveEl)
                        }, 50)
                    }
                })

            } else {
                return false;
            }
        } else {
            return false;
        }
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
            var bodyy = $('body').height();
            console.log(bodyy);
            var city = $('.dinn').offset().top;
            var test = city - last - 399 - 159;
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


    /*$(window).scroll(function () {
        var currentScroll = $(window).scrollTop();console.log(currentScroll);
        var lime = $('.under-line').offset().top;console.log(lime);
        
        if (currentScroll >= lime) {
            $('.headers').addClass('goon');
            $('.headers').removeClass('domm');
        }

        else {
            $('.headers').removeClass('goon setup');
            $('.headers').addClass('domm');
        }
    });*/


    $(window).scroll(function () {
        var currentScroll = $(window).scrollTop();
        var lihe = $('.main-menu').offset().top;
        if (currentScroll >= lihe - 15) {
            $('.headers').addClass('opas');
            $('.headers').removeClass('hidd');
        }
        else {
            $('.headers').removeClass('opas goon');
//            $('.headers').addClass('hidd');
            setTimeout(function () {
                $('.menu').removeClass('clikk');
            }, 299);

        }
    });


    $(window).scroll(function () {
        var cupp = $(window).scrollTop();
        var liffe = $('.under-line').offset().top;

        if (cupp >= liffe) {
            $('.headers').addClass('goon noimg');
            $('.headers').removeClass('domm');
        }

        else {
            $('.headers').removeClass('goon setup');
            $('.headers').addClass('domm');
            setTimeout(function () {
                $('.headers').removeClass('noimg');
            }, 99);
        }
    });
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    var intro = '4';

    $('.menu').click(function () {
        if (intro === '4') {
            $('.headers').addClass('runny');
            $('.menu').addClass('clikk');
            $('body').addClass('overr');
            $('#jivo-iframe-container').addClass('zett');
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
            $('#jivo-iframe-container').removeClass('zett');
            $('html, body').unbind('touchmove');
            setTimeout(function () {
                $('.headers').removeClass('setup');
            }, 399);
            intro = '4';
        }

    });
    $('.down-block').click(function () {
        $('.headers').removeClass('runny');
        $('.menu').removeClass('clikk');
        $('body').removeClass('overr');
        $('html, body').unbind('touchmove');
        setTimeout(function () {
            $('.headers').removeClass('setup');
        }, 399);
        intro = '4';
    });

    $('.strai-main').click(function () {


        $('.efir-block').addClass('main-govy');
        $('body').addClass('ovyy');
        $('html, body').bind('touchmove', function (e) {
            e.preventDefault(e);
        });
    });


    $('.closy').click(function () {
        $('html, body').unbind('touchmove');
        $('.efir-block').removeClass('main-govy');
        $('body').removeClass('ovyy');
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




    $('.scrol-city, .onny-scrol').mCustomScrollbar({
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
            $('body').addClass('ggwp');
            setTimeout(function () {
                hexx = '4';
            }, 99);
        }
        if (hexx === '4') {
            $('.homr-name').css({'height': '0', 'transition-delay': '.39s'});
            $('.scrol-city').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
            $('body').removeClass('ggwp');
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
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html('0' + dates + '.' + osnv + '.' + year);
                } else {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html(dates + '.' + osnv + '.' + year);
                }
            }
            if (+osnv <= '9') {
                if (+osnv <= '9') {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html('0' + dates + '.' + '0' + osnv + '.' + year);
                } else {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html('0' + dates + '.' + osnv + '.' + year);
                }
            }
            if (+osnv <= '9') {
                if (+dates <= '9') {
                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html('0' + dates + '.' + '0' + osnv + '.' + year);
                } else {

                    $('.hasl').css({'font-family': 'SFUIDisplay-Bold'}).find('.date-time-selected').html(dates + '.' + '0' + osnv + '.' + year);
                }
            }
            $('.archive').css({'display': 'none'})
            $('.calen').css({'padding': '0 0 0 40px'});

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
        $('html, body').unbind('touchmove');
        $('body').removeClass('ovyy');
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


    /*FOOTERS*/

    /*$(window).scroll(function () {
        var mainyScrol = $(window).scrollTop();
        var scrolFoter = $('.footers').offset().top;
        var heighWind = $(window).height();
        var fotty = $('.footers').height();
        if (mainyScrol >= scrolFoter - heighWind) {

            $('.video-youtube').css({'position':'absolute','bottom':fotty,'transition':'0s'});
        }else {
            $('.video-youtube').css({'position':'fixed','bottom':'0px'});setTimeout(function(){$('.video-youtube').css({'transition':'.5s'}) },100);
        }

    });*/

    $('.verty .newss').click(function () {
        $('.efir-block').addClass('endd');
        $('body').removeClass('ovyy');
        setTimeout(function () {
            $('.efir-block').removeClass('runn-right endd main-govy');

        }, 700);
    });


    setInterval(function () {
        if ($(window).height() < 450) {
            $('.new-menu').addClass('adap-menn');

        } else {
            $('.new-menu').removeClass('adap-menn');
        }
    }, 1000);
    if ($('.content').hasClass('main-view')) {
        $('.animate').css({'display': 'none'});
    }


    $('.quest-four ul li input[type=radio]').click(function () {
        $(this).prop("checked", true);
        
        
    });


    $('.slosd').click(function () {
        $('.vijen').css({'height': '0', 'transition-delay': '.39s'});
        $('.vijen-insid').css({'opacity': '0', 'transition-delay': '0s', 'visibility': 'hidden'});
        $('.hovv-news').removeClass('linsa');
        ness = '7';
    });


    var hshka = $('.quest-one h5').height();
    var h = hshka + 70;
    $('.comm').css({'height': 'calc(100% - ' + h + 'px)'});

    var b = $('.rezz').height();
    var c = $('.morr').height();
    var a = b + c + 15;
    $('.pagee').css({'height': 'calc(100% - ' + a + 'px)'})
    var u = $('.quest-four ul').height() + $('.poll').height() + $('.quest-four h5').height();
    var m = u + 130;

    $('.inter-quest').css({'height': m});
     
//     var conty = $('.comm').height() + 30;
//setInterval(function() { 
//     
//    
//    
//    if($(window).width() < 759) {
//        
//        $('.comm').css({'height':conty});
//    }else{$('.comm').css({'height':'275px'});}
//
//},399 );
    
    
    
//          var tag = document.createElement('script');
//      tag.src = "https://www.youtube.com/iframe_api";
//      var firstScriptTag = document.getElementsByTagName('script')[0];
//      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.


    if ($(window).width() > 1024) {
    $('.poisk').hover(
        function () {
            $('.poisk').addClass('govv y');
        },
        function () {
            $('.poisk').removeClass('govv');
            setTimeout(function () {
                $('.poisk').removeClass('y');
            }, 199);
        });
    }


    $('.lisa7').click(function () {

        $('.hovv-news').removeClass('active');
    });

    $('.a-video-cat').click(function () {
        var k = $(this).attr('data-id');
        $('.players-phone').css({'display': 'none'});
        $('.chanel-' + k).css({'display': 'block'});
    });


    setInterval(function () {
        $('.inlineBlock').css({'position': 'absolute'});
    }, 55);


    if ($('.bread-crumbs').height() > 40) {
        $('.bread-crumbs').addClass('miss');
    }


    $('.newss').click(function () {
        $('.newss').removeClass('active');
        $(this).addClass('active');
    });


    $('.senn').click(function () {


        $('.form-page input').each(function () {
            var u = $(this);
            if (u.val().length) {
                u.parent().addClass('here');
            }
            if (u.val().length < 7) {
                u.parent().addClass('lose');
                setTimeout(function () {
                    u.parent().removeClass('lose');
                }, 1000);
            } else {
            }
//             else {
//                 u.parent().addClass('lose');setTimeout(function(){u.parent().removeClass('lose'); }, 1000);
//             }

        });
        $('.form-page textarea').each(function () {
            var p = $(this);
            if (p.val().length) {
                p.parent().addClass('here');
            } else {
                p.parent().addClass('lose');
                setTimeout(function () {
                    p.parent().removeClass('lose');
                }, 1000);
            }
        });


        if (!$('.form-page .lose').length) {
            $('.form-horizontal').trigger('submit');
        }

//         if($('.name0').val().length){
//        $('.form-horizontal').trigger('submit');
//         }else {}

    });
     
     
     
     
});//and ready























