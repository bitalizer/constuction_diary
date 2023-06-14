'use strict';
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit').on('click', function (e) {
        e.preventDefault();

        var variables = [];

        $('.variables input').each(function () {
            variables.push({
                name: $(this).attr('data-name'),
                value: $(this).val()
            });
        });

        $.ajax({
            url: '/settings/store',
            type: 'POST',
            data: {
                variables: variables,
            },
            dataType: 'JSON',
            success: function (data) {
                swal({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
            },
            error: function (data) {
                var response = data.responseJSON;

                var errorString = '<ul class="list-unstyled">';
                $.each(response.errors, function (key, value) {
                    errorString += '<li>' + value + '</li>';
                });
                errorString += '</ul>';

                swal(data.responseJSON.message, errorString, "error");
            }
        });

        return false;
    });
});