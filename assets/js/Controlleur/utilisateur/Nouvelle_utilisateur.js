$(document).ready(function() {
    $("#save_user").on('click', function(e) {
        e.preventDefault();
        let nom = $('#nom').val();
        let prenom = $('#prenom').val();
        let matricule = $('#matricule').val();
        let fonction = $('#fonction option:selected').text();
        let fonction_users = $('#fonction option:selected').val();
        let societe = $('#societe option:selected').val();
        $.post(base_url + "controlleur/create_user", { nom, prenom, matricule, fonction, societe, fonction_users }, function() {

        }).fail(() => {
            alertMessage("Erreur!", "Utilissateur non enregistré", "error", "btn btn-danger");
        }).done(() => {
            $("input").val("");
            $('#societe').val("PLASMAD");
            $('#fonction').val("1");
            alertMessage("Succè!", "utilisateur enregistré avec succè.", "success", "btn btn-success");
        });
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
})