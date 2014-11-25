var ENTER_KEY = 13;

$(function() {
    $('#input-value').keypress(function (e) {
        if (e.which == ENTER_KEY) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/index.php',
                data: $('form#submit-form').serialize(),
                success: successHandler
            });
        }
    });

    function successHandler(params) {
        alert(params);
    }
});