$(document).ready(function(){
    var lock = $('.lock');
    var stateMessage = $('.state-message');
    var API_URL = lock.attr('data-api-url');

    lock.on('click', function(){
        var _this = $(this);

        _this
            .removeClass('lock__closed')
            .addClass('lock__opening');

        stateMessage.text('Please wait...');

        // doing AJAX request... imitating for now...
        setTimeout(function(){
            _this
                .removeClass('lock__opening')
                .addClass('lock__opened');

            stateMessage.text('Welcome to office!');
        }, 3000);

        setTimeout(function(){
            _this
                .removeClass('lock__opened')
                .addClass('lock__closed');

            stateMessage.text('Tap to open');
        }, 6000);

    });
});