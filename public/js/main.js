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
        if (w_w < 1299) {
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


    $('.upss-aroww').click(function(event) {
event.preventDefault(event);
console.log('top');
        $('.vert').mCustomScrollbar("scrollTo", "+=150", {scrollInertia: 600, scrollEasing: "linear"});
});
$('.dowm-aroww').click(function(event) {
event.preventDefault(event);


    console.log('bottom');
    $('.vert').mCustomScrollbar("scrollTo", "-=150", {scrollInertia: 600, scrollEasing: "linear"});
});


    $('.main-hover').hover(
        function () {
            $(this).parent().addClass('playy');
        },
        function () {
            $(this).parent().removeClass('playy');
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
});


//var link = $('.linky');
//var ofset = link.offset();
//var top = ofset.top;
//
//
//
//var left = ofset.left;
//var bott = $(window).height() - link.height();
//bott = ofset.top - bott;
//var right = $(window).width() - link.width();
//
//right = ofset.left - right;
//
////console.log(bott); 2943


//// 3317


//jQuery(document).ready(function(){
//
//
//    if($('.linky').length){
//    var fixmeTop = $('.linky').offset().top;
//        $(window).scroll(function() {
//            var currentScroll = $(window).scrollTop();
//            if (currentScroll >= fixmeTop - 399) {
//                $('.linky').addClass('runns');
//
//            } else {    
//                $('.linky').removeClass('runns');
//            }
//        });
//    }
//});







