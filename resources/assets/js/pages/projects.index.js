'use strict';
$(document).ready(function () {

    var table = $('#example');

    table.DataTable({
        dom: "<'text-right'B><f>lr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
        buttons: [
            {
                extend: 'print',
                text: '<button class="btn btn-success layout_btn_prevent btn-responsive form_inline_btn_margin-top">Prindi</button>',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'csv',
                text: '<button class="btn btn-success layout_btn_prevent btn-responsive form_inline_btn_margin-top">Salvesta .csv</button>',
                filename: 'Objektide nimeriki',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }
        ],

        "language": {
            "decimal": "",
            "emptyTable": "Tabelis puuduvad andmed",
            "info": "Kuvatakse _START_ kuni _END_. Kokku on _TOTAL_ kirjet",
            "infoEmpty": "Kuvatakse 0 sissekannet",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Näita _MENU_ kirjet",
            "loadingRecords": "Laeb...",
            "search": "Otsing:",
            "zeroRecords": "Ühtegi sobivat kirjet ei leitud",
            "paginate": {
                "first": "Esimene",
                "last": "Viimane",
                "next": "Järgmine",
                "previous": "Eelmine"
            },
            "aria": {
                "sortAscending": ": aktiveerige veeru sorteerimiseks ülespoole",
                "sortDescending": ": aktiveerige veeru sortimiseks allapoole"
            }
        },
    });
    var tableWrapper = $("#example_table_wrapper");
    tableWrapper.find(".dataTables_length select").select2({
        showSearchInput: false //hide search box with special css class
    }); // initialize select2 dropdown
    $("#example_table_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
    $(".dataTables_wrapper").removeClass("form-inline");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#example").on("click", ".archive", function (e) {
        e.preventDefault();

        var button = $(this);
        var tr = button.closest('tr');
        var archived = tr.hasClass("archived");

        swal({
            title: 'Kas olete kindel?',
            text: (archived ? 'Taastada' : 'Arhiveerida') + " valitud objekt",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Jah!',
            cancelButtonText: 'Tühista'
        }).then(function (result) {
            if (result) {

                $.ajax({
                    url: '/projects/archive',
                    type: 'POST',
                    data: {
                        id: tr.attr('data-id')
                    },
                    dataType: 'JSON',
                    success: function (data) {

                        if (archived) {
                            tr.removeClass('archived');
                            button.attr("data-original-title", "Arhiveeri" );
                            button.children().first().removeClass('fa-refresh text-info').addClass('fa-trash text-danger');
                        }
                        else {
                            tr.addClass('archived');
                            button.attr("data-original-title", "Taasta" );
                            button.children().first().removeClass('fa-trash text-danger').addClass('fa-refresh text-info');
                        }

                        swal(
                            archived ? 'Taastatud' : 'Arhiveeritud' + '!',
                            'Objekt on edukalt ' + (archived ? 'taastatud.' : 'arhiveeritud.'),
                            'success'
                        );
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

            }
        });

        return false;
    });

    $("#example").on("click", ".edit", function (e) {
        e.preventDefault();

        var id = $(this).closest('tr').attr('data-id');

        $('#edit_object_modal > input').val('');

        $.ajax({
            url: '/projects/load',
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function (data) {
                $('#edit_object_modal').attr("data-id", id);
                $('#edited-name').val(data.name);
                $('#edited-location').val(data.location);
                $('#edit_object_modal').modal('show');
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

    $('#add_new_object').on('click', function () {

        $.ajax({
            url: '/projects/add',
            type: 'POST',
            data: {
                name: $('#name').val(),
                location: $('#location').val(),
            },
            dataType: 'JSON',
            success: function (data) {
                swal({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 4000
                });
                location.reload();
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

    $('#edit_object').on('click', function () {

        $.ajax({
            url: '/projects/edit',
            type: 'POST',
            data: {
                id: $('#edit_object_modal').attr('data-id'),
                name: $('#edited-name').val(),
                location: $('#edited-location').val(),
            },
            dataType: 'JSON',
            success: function (data) {
                swal({
                    type: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                location.reload();
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