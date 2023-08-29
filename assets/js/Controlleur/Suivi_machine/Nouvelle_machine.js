$(document).ready(function() {
    $('#annuler').on('click', function(event) {
        event.preventDefault();
        $("input").val("");
        $("#specification").val("EXTRUSION");

    });
    $('#save_machine').on('click', function(e) {
        e.preventDefault();
        let designation = $('#designation').val();
        let vitesse = $('#vitesse').val();
        let capacite = $('#capacite').val();
        let dimension = $('#dimension').val();
        let specification = $('#specification option:selected').val();
        let methodOk = true;
        var label = "";
        $(".input").each(function(index) {
            if ($(this).val() == "") {
                methodOk = false;
                label = $(this).prev().text();

                return false;
            }
        });

        if (methodOk) {
            $.post(base_url + 'Controlleur/create_machine', { designation, vitesse, capacite, dimension, specification }, function() {
                $("input").val("");
                $("#specification").val("EXTRUSION");
                alertMessage("Succè!", "Machine enregistré", "success", "btn btn-success");
            });
        }

        if (!methodOk) {
            alertMessage("Erreur!", "Champs '" + label + "' obligatoire", "error", "btn btn-danger");
        }
    });

    function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn
                }
            },
        });

    }

});