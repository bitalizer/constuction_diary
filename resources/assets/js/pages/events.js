"use strict";
$(document).ready(function () {

    $("#event_start, #event_end").datetimepicker({
        format: 'd.m.Y H:i',
    });

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function () {

            var eventObject = {
                title: $.trim($(this).text())
            };

            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true,
                revertDuration: 0
            });
        });
    }

    ini_events($('#external-events div.external-event'));
    var evt_obj;

    /* initialize the calendar */
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
        displayEventTime: false,
        locale: 'et',
        eventLimit: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        //Load events
        events: {
            url: '/events/load',
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
        },
        dayClick: function (date, jsEvent, view, resource_object) {
            $("#event_title").val('');
            $("#event_information").val('');
            $("#event_start").val('');
            $("#event_end").val('');

            colorChooser.css({
                "background-color": currColor,
                "border-color": currColor
            }).html('type <span class="caret"></span>');
            $('#evt_modal').modal('show').on("shown.bs.modal", function () {

                $("#event_title").focus();

                $("#employee_select").chosen({
                    allow_single_deselect: true,
                    placeholder_text_multiple: "Valige töötajad...",
                    no_results_text: "Kahjuks midagi pole leitud!"
                });

                $("#employee_select").val('').trigger("chosen:updated");

            }).on("hidden.bs.modal", function () {
                evt_obj = "";
            });
            $(".text_save").on("click", function () {
                evt_obj.title = $("#event_title").val();
                evt_obj.information = $("#event_information").val();
                evt_obj.start = $("#event_start").val();
                evt_obj.end = $("#event_end").val();
                evt_obj.backgroundColor = currColor;
                $('#calendar').fullCalendar('updateEvent', evt_obj);
                setTimeout(setpopover, 100);
            });
        },
        eventClick: function (calEvent, jsEvent, view) {
            evt_obj = calEvent;
            $("#event_title").val(evt_obj.title);
            $("#event_information").val(evt_obj.information);
            $("#event_start").val(evt_obj.start);
            $("#event_end").val(evt_obj.end);
            currColor = evt_obj.backgroundColor;
            colorChooser.css({
                "background-color": evt_obj.backgroundColor,
                "border-color": evt_obj.backgroundColor
            }).html('type <span class="caret"></span>');
            $('#evt_modal').modal('show').on("shown.bs.modal", function () {

                $("#event_title").focus();

                $.each(evt_obj.employees, function (i, employee) {
                    $("#employee_select option:contains(" + employee.name + ")").attr('selected', 'selected');
                });

                $("#employee_select").chosen({
                    allow_single_deselect: true,
                    placeholder_text_multiple: "Valige töötajad...",
                    no_results_text: "Kahjuks midagi pole leitud!"
                });





            }).on("hidden.bs.modal", function () {
                evt_obj = "";
            });
            $(".text_save").on("click", function () {
                evt_obj.title = $("#event_title").val();
                evt_obj.information = $("#event_information").val();
                evt_obj.start = $("#event_start").val();
                evt_obj.end = $("#event_end").val();
                evt_obj.backgroundColor = currColor;
                $('#calendar').fullCalendar('updateEvent', evt_obj);
                setTimeout(setpopover, 100);
            });
        },
        editable: true,
        droppable: false,
        eventResize: function () {
            setTimeout(setpopover, 100);
        }
    });

    /* ADDING EVENTS */
    var currColor = "#737373"; //default
    //Color chooser button
    var colorChooser = $(".color-chooser-btn");
    $(".color-chooser > li").on('click', function (e) {
        e.preventDefault();
        //Save color
        currColor = $(this).css("background-color");
        //Add color effect to button
        colorChooser
            .css({
                "background-color": currColor,
                "border-color": currColor
            })
            .html($(this).text() + ' <span class="caret"></span>');
    });
    $("#add-new-event").on('click', function (e) {
        e.preventDefault();
        //Get value and make sure it is not null
        var $newevent = $("#new-event");
        var val = $newevent.val();
        if (val.length == 0) {
            return;
        }

        //Create event
        var event = $("<div />");
        event.css({
            "background-color": currColor,
            "border-color": currColor,
            "color": "#fff"
        }).addClass("external-event");
        event.html(val).append(' <i class="fa fa-times event-clear" aria-hidden="true"></i>');
        $('#external-events').prepend(event);

        //Add draggable funtionality
        ini_events(event);

        //Remove event from text input
        $newevent.val("");
    });
    $("body").on("click", "#external-events .event-clear", function () {
        $(this).closest(".external-event").remove();
        return false;
    });
    $(".modal-dialog [data-dismiss='modal']").on('click', function () {
        $("#new-event").replaceWith('<input type="text" id="new-event" class="form-control" placeholder="Event">');
    });

    function setpopover() {
        $(".fc-month-view").find(".fc-event-container a").each(function () {
            $(this).popover({
                placement: 'top',
                html: true,
                content: $(this).text(),
                trigger: 'hover'
            });
        });
        $(".fc-month-button").on('click', function () {
            $(".fc-event-container a").each(function () {
                $(this).popover({
                    placement: 'top',
                    html: true,
                    content: $(this).text(),
                    trigger: 'hover'
                });
            });
            return false;
        })
    }

    $(".fc-center").find('h2').css('font-size', '18px');
    setpopover();
});