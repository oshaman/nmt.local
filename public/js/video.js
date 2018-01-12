$('.video-cat').bind('click', switchList);
$('.newss').bind('click', switchVideo);

function switchList() {

    _this = $(this);

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
    _this.addClass('active');
    _this.siblings('.active').removeClass("active");
    $(".vert[data-ch='" + old_id + "']").hide();
    $(".vert[data-ch='" + _this.attr('data-id') + "']").show();
}

function switchVideo() {
    _this = $(this);
    _this.siblings().removeClass('active');
    _this.addClass('active');
    $(".item-players p.main-video").html('<iframe src="//www.youtube.com/embed/' + _this.attr('data-token') + '?&autoplay=1" width="560" height="314"></iframe>');
}
