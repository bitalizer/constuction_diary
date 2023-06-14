'use strict';
$(document).ready(function () {

    var table = $('#example');

    var datatable = table.DataTable({
        "order": [[ 0, "desc" ]],
        dom: "<'text-right'B><f>lr<'table-responsive't><'row'<'col-md-5 col-12'i><'col-md-7 col-12'p>>",
        buttons: [
            {
                extend: 'print',
                text: '<button class="btn btn-success layout_btn_prevent btn-responsive form_inline_btn_margin-top">Prindi</button>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'csv',
                text: '<button class="btn btn-success layout_btn_prevent btn-responsive form_inline_btn_margin-top">Salvesta .csv</button>',
                filename: 'Päevikute nimeriki',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],

        "language" : {
            "decimal":        "",
            "emptyTable":     "Tabelis puuduvad andmed",
            "info":           "Kuvatakse _START_ kuni _END_. Kokku on _TOTAL_ kirjet",
            "infoEmpty":      "Kuvatakse 0 sissekannet",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Näita _MENU_ kirjet",
            "loadingRecords": "Laeb...",
            "search":         "Otsing:",
            "zeroRecords":    "Ühtegi sobivat kirjet ei leitud",
            "paginate": {
                "first":      "Esimene",
                "last":       "Viimane",
                "next":       "Järgmine",
                "previous":   "Eelmine"
            },
            "aria": {
                "sortAscending":  ": aktiveerige veeru sorteerimiseks ülespoole",
                "sortDescending": ": aktiveerige veeru sortimiseks allapoole"
            }
        },

        "sPaginationType": "full_numbers"
    });

    $(".datepicker").datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        format: 'dd.mm.yyyy',
        showOn: "button",
    });

    var tableWrapper = $("#example_table_wrapper");
    tableWrapper.find(".dataTables_length select").select2({
        showSearchInput: false //hide search box with special css class
    }); // initialize select2 dropdown
    $("#example_table_wrapper .dt-buttons .btn").addClass('btn-secondary').removeClass('btn-default');
    $(".dataTables_wrapper").removeClass("form-inline");

    $('.clear').on('click', function (e) {
        e.preventDefault();
        window.location = window.location.href;
    });
});