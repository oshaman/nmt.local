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
            console.log('+');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/get-more',
                type: 'POST',
                data: {'source': source, 'source_id': source_id, 'page': page},
                success: function (resp) {
                    resp ? $(resp).insertBefore('.more-before') : '';
                    page++;
                    if ($('.active-pagin-number').last().next().hasClass('pagin-number')) {
                        $('.active-pagin-number').last().next().addClass('active-pagin-number');
                    } else {
                        $('.active-pagin-number').last().clone().html(page).insertAfter($('.active-pagin-number').last());
                        if (page >= 4) {
                            $('.articles-pagination a').eq(2).html('&nbsp;&nbsp;&nbsp;.&nbsp;.&nbsp;.&nbsp;&nbsp;&nbsp;');
                        }
                        if (page >= 5) {
                            $('.articles-pagination a').eq(page - 2).remove();
                        }
                    }
                }
            })

        } else {
            return false;
        }
    } else {
        return false;
    }
}