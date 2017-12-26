$('.video-cat').bind('click', switchList);
$('.newss').bind('click', switchVideo);

function switchList() {

    _this = $(this);

    old_id = _this.siblings('.active').attr('data-id');

    $(".vert[data-ch='" + old_id + "']").hide();
    _this.siblings('.active').removeClass("active");

    _this.addClass('active');
    $(".vert[data-ch='" + _this.attr('data-id') + "']").show();
}

function switchVideo() {
    _this = $(this);
    _this.siblings().removeClass('active');
    _this.addClass('active');
    $(".item-players p.main-video").html('<iframe src="//www.youtube.com/embed/' + _this.attr('data-token') + '?&autoplay=1" width="560" height="314"></iframe>');
}
