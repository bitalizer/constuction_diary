'use strict';
$(document).ready(function () {

    var url = window.location.pathname;
    var last_param = url.substring(url.lastIndexOf('/') + 1);
    var id = isInt(last_param) ? last_param : null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function isInt(value) {
        return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
    }

    $('#submit').on('click', function (e) {
        e.preventDefault();

        var permissions = [];

        $('#example').find('tr').each(function () {
            var row = $(this);
            if (row.find('input[type="checkbox"]').is(':checked')) {
                permissions.push(row.attr('data-name'));
            }
        });

        $.ajax({
            url: '/positions/store',
            type: 'POST',
            data: {
                id: id,
                name: $('#name').val(),
                display_name: $('#display_name').val(),
                description: $('#description').val(),
                permissions : permissions
            },
            dataType: 'JSON',
            success: function (data) {
                swal({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 4000
                }).catch(function(timeout) {
                    window.location.replace("/positions");
                });
            },
            error: function(data){
                var response = data.responseJSON;

                var errorString = '<ul class="list-unstyled">';
                $.each( response.errors, function( key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                swal(data.responseJSON.message, errorString, "error");
            }
        });

        return false;
    });
});