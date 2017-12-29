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
                }
            })

        } else {
            return false;
        }
    } else {
        return false;
    }
}