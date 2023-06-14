'use strict';
$(document).ready(function () {

    var url = window.location.pathname;
    var employee_id = url.substring(url.lastIndexOf('/') + 1);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#workers-table").on("change", "input, select", function (e) {
        e.preventDefault();

        var tr = $(this).closest('tr');

        $.ajax({
            url: '/accounting/payroll/update',
            type: 'POST',
            data: {
                project_id: tr.attr('data-project-id'),
                employee_id: employee_id,
                parameter: $(this).attr('id'),
                value: $(this).val()
            },
            dataType: 'JSON',
            success: function (data) {
                var currentDate = moment().format('DD.MM.YYYY');
                tr.find('td:last').html(currentDate);
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