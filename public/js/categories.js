$(function () {
    $('.switch-cat').bind('click', switchCat);
    $('.datepicker--cell').bind('click', switchCatByDay);
});

function switchCat(e) {
    _this = $(this);
    e.preventDefault();
    _this.siblings('.active').removeClass("active");
    _this.addClass('active');

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
            resp ? $('.cat-removeble').html(resp) : '';
        }
    })
}