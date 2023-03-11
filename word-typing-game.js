jQuery(document).ready(function($) {
    $('#word-typing-submit').on('click', function() {
        var input = $('#word-typing-input').val();
        var answer = $('#word-typing-game').data('answer');
        var message = $('#word-typing-message');

        if (input === answer) {
            message.html('Correct!').addClass('success').removeClass('error');
            setTimeout(function() {
                location.reload();
            }, 1000);
        } else {
            message.html('Incorrect. Please try again.').addClass('error').removeClass('success');
        }
    });

    // Store the answer in the data attribute for the game container
    var answer = $('#word-typing-game input').val();
    $('#word-typing-game').data('answer', answer);
});
