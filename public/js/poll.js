$('.poll').bind('click', pollAjax);
var checkPoll = true;

function pollAjax() {
    if (!checkPoll) {
        return
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
                    checkPoll = false
                    _this.closest('.quest-four').siblings('.quest-five')
                        .html(resp);
                }
            })

        } else {
            _this.closest('.quest-four').siblings('.quest-five')
                .html('Выберите вариант ответа');
        }
    } else {
        console.log('----------------------')
    }
}