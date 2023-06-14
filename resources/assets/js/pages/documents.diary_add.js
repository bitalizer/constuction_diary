'use strict';
$(document).ready(function () {

    $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd.mm.yyyy'
    });

    $('.clockpicker').clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now'
    });

    $("#object_select").chosen({
        allow_single_deselect: true,
        placeholder_text_single: "Valige objekt...",
        no_results_text: "Kahjuks midagi pole leitud!"
    });


    $("#weather_select").chosen({
        allow_single_deselect: true,
        placeholder_text_multiple: "Valige ilmastik...",
        no_results_text: "Kahjuks midagi pole leitud!"
    });


    $("#workers-table").on("click", ".table-remove", function () {
        $(this).parents('tr').detach();
    });

    $('#responsive').on('shown.bs.modal', function (e) {
        $("#worker_select").chosen({
            allow_single_deselect: true,
            placeholder_text_multiple: "Valige töötajad...",
            no_results_text: "Kahjuks midagi pole leitud!"
        });

        $("#responsive .form-control").val('');
        $("#worker_select").val('').trigger("chosen:updated");

        $('#responsive .clockpicker').clockpicker({
            align: 'left',
            autoclose: true,
            'default': 'now'
        });
    });

    $('#responsive').on('hidden.bs.modal', function () {
        $('#add_worker_form').trigger("reset");
    });

    $('#add_new_worker').click(function () {

        var workers_count = $('#worker_select option:selected').length;
        var start_time = $('#start_time').val();
        var end_time = $('#end_time').val();
        var hours = $('#hours').val();

        if (workers_count < 1 || start_time.length < 4 || end_time.length < 4 || hours.length < 1) {
            swal("Midagi on puudu...", "Kontrollige üle parameetrid märgitud tärniga", "warning");
            return;
        }

        //Validate start and end time
        /*var regExp = /(\d{1,2})\:(\d{1,2})/;
        if (parseInt(end_time.replace(regExp, "$1$2")) < parseInt(start_time.replace(regExp, "$1$2"))) {
            swal("Oops...", "Start time is greater than end time", "warning");
            return;
        }*/

        $('#responsive').modal('hide');

        $("#worker_select option:selected").each(function () {
            var id = $(this).val();
            var name = $(this).text();
            var note = $('#note').val();

            $('#workers-table tbody').append('<tr data-id="' + id + '"><td>' + name + ' <span class="table-remove fa fa-remove"></span></td><td>' + start_time + '</td><td>' + end_time + '</td><td contenteditable="true">' + hours + '</td><td contenteditable="true">' + note + '</td></tr>');
        });

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $('#submit').on('click', function () {

        // iterate over each of the <tr> elements
        var workers = $('tbody tr').map(function (i, row) {

            // creating an Object to return:
            return {
                'id': parseInt(row.dataset.id),
                'name': row.cells[0].textContent,
                'start_time': row.cells[1].textContent,
                'end_time': row.cells[2].textContent,
                'hours': row.cells[3].textContent,
                'note': row.cells[4].textContent
            }
            // converting the map into an Array:
        }).get();

        $.ajax({
            url: '/documents/diary/store',
            type: 'POST',
            data: {
                project_id: $('#object_select').val(),
                mechanisms: $('#mechanisms').val(),
                equipment: $('#equipment').val(),
                work_description: $('#work_description').val(),
                comments: $('#comments').val(),
                instructions: $('#instructions').val(),
                acts_and_documents: $('#acts_and_documents').val(),
                control: $('#control').val(),
                weather_time: $('#weather_time').val(),
                weather_temperature: $('#weather_temperature').val(),
                weather: $("#weather_select").chosen().val(),
                date: $('#date').val(),
                workers: workers
            },
            dataType: 'JSON',
            success: function (data) {
                swal({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                }).catch(function(timeout) {
                    location.reload();
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
    });

});