"use strict";
$(document).ready(function () {

    $('#calendar').fullCalendar({
        defaultDate: Date(),
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        locale: 'et',
        events: {
            url: '/attendances/calendar/load',
            type: 'POST',
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        }
    });
});