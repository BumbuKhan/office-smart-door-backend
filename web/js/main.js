$(document).ready(function () {
    var lock = $('.lock');
    var stateMessage = $('.state-message');
    var API_URL = lock.attr('data-api-url');
    var stateDelay = 4000;

    lock.on('click', function () {
        var _this = $(this);

        if (!_this.hasClass('lock__closed')) {
            return;
        }

        _this
            .removeClass('lock__closed')
            .addClass('lock__opening');

        stateMessage.text('Please wait...');

        // doing AJAX request...
        $.get(API_URL)
            .done(function (response) {
                /*
                response always has such structure:

                response = {
                    success: true || false,
                    message: 'Operation message',
                }
                */

                if (response) {
                    _this.removeClass('lock__opening');

                    if (response.success) {
                        _this.addClass('lock__opened');
                        stateMessage.text(response.message);

                        setTimeout(function () {
                            _this
                                .removeClass('lock__opened')
                                .addClass('lock__closed');

                            stateMessage.text('Tap to open');
                        }, stateDelay);
                    } else {
                        _this.addClass('lock__closed');
                        stateMessage.text(response.message);

                        setTimeout(function () {
                            stateMessage.text('Tap to open');
                        }, stateDelay);
                    }
                }

            })
            .fail(function () {
                alert("Something went wrong, please try later");
            });
    });
});