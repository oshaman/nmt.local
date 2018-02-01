$('.poll').bind('click', pollAjax);
var checkPoll = true;

function pollAjax() {
    if (!checkPoll) {
        return false;
    }
    _this = $(this);
    if (_this.siblings('input[name="stats"]').val().length == 0) {

        var selects = $(".quest-four input:checked").attr('id');
        var poll = _this.siblings('input[name="poll-id"]').attr('data-poll');

        if (("undefined" !== typeof selects) && ("undefined" !== typeof poll) && $.isNumeric(poll)) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/poll',
                type: 'POST',
                data: {'selects': selects, 'poll-id': poll},
                success: function (resp) {
                    checkPoll = false;
                    //_this.addClass('supp');

                    if ($(resp).find('.' + selects).length) {
                        div_resp = $(resp);
                        div_resp.find('.' + selects).addClass('choosed');
                    }

                    setTimeout(function () {
                        _this.closest('.quest-four').siblings('.quest-five')
                            .html(div_resp);
                        _this.closest('.form-inter').addClass('voiss');
                    }, 899);

                    setTimeout(function () {
                        _this.closest('.form-inter').addClass('lasty');
                    }, 1799);
                    _this.closest('.form-inter').addClass('voit');
                }
            })

        } else {
            _this.closest('.quest-four').siblings('.quest-five');
            $('.quest-four').addClass('q');
            setTimeout(function () {
                $('.quest-four').removeClass('q');
            }, 2099);
            /*.html('Выберите вариант ответа');*/
        }
    } else {
        console.log('----------------------')
    }
}