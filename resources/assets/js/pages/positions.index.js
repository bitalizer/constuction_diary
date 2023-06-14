'use strict';
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#example").on("click", ".delete", function (e) {
        e.preventDefault();

        var tr = $(this).closest('tr');

        swal({
            title: 'Kas olete kindel?',
            text: "Seda tegevust ei saa pärast tühistada!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Jah, kustutata!',
            cancelButtonText: 'Tühista'
        }).then(function (result) {
            if (result) {

                $.ajax({
                    url: '/positions/delete',
                    type: 'POST',
                    data: {
                        id: tr.attr('data-id')
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        tr.detach();

                        swal(
                            'Kustutatud!',
                            'Positsioon on edukalt kustutatud.',
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
});