var ENTER_KEY = 13;

$(function() {
    $('#input-value').keypress(function (e) {
        if (e.which == ENTER_KEY) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/index.php',
                data: $('form#submit-form').serialize(),
                success: successHandler,
                error: errorHandler
            });
        }
    });

    function errorHandler(params) {
        var data = '<h3>' + params.responseJSON.error + '<h3>';
        $('#modal-body').html(data);
        $('#modal').modal('show');
    }

    function successHandler(params) {
        var source = $("#money-template").html();
        var template = Handlebars.compile(source);

        var object = {};
        object['data'] = params;

        $('#modal-body').html(template(object));
        $('#modal').modal('show');
    }
});
