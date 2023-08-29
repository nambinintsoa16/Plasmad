$(document).ready(function() {
    $('#annuler').on('click', function(event) {
        event.preventDefault();
        $("input").val("");


    });
    $('#save_operateur').on('click', function(e) {
        e.preventDefault();
        let matricule = $('#OP_MATRICULES').val();
        let nom = $('#OP_NOM').val();
        let fonction = $('#OP_FONCTION option:selected').val();
        let machine = $('#OP_MACHINE option:selected').val();

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
            $.post(base_url + 'Controlleur/create_operateur', { matricule, nom, fonction, machine }, function() {
                $("input").val("");
                alertMessage("Succè!", "Opérateur enregistré", "success", "btn btn-success");
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