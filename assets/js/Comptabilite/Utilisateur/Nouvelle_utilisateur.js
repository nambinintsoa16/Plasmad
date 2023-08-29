$(document).ready(function() {
    $('#save_user').on('click', function(event) {
        event.preventDefault();
        let nom = $("#nom").val();
        let prenom = $("#prenom").val();
        let matricule = $("#matricule").val();
        let fonction = $("#fonction option:selected").val();
        let societe = $("#societe option:selected").val();
        $.post(base_url + "controlleur/create_user", {
            nom,
            prenom,
            matricule,
            fonction,
            societe
        }, function(data) {

        }).done((event) => {
            $("#nom").val("");
            $("#prenom").val("");
            $("#matricule").val("");
        }).fail((data) => {
            alert(data);
        });

    });

    $('#btn-new-fonction').on('click', function(event) {
        event.preventDefault();
        $.confirm({
            title: "",
            content: "url:" + base_url + "controlleur/create_function_form",
            columnClass: "col-md-4",
            onContentReady: function() {

            },
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function(event) {
                        let fonction = $('#new_fonction').val();
                        $.post(base_url + "controlleur/create_fonction", { fonction }, function() {

                        }).done((data) => {
                            let des = data;
                            $("fonction").append("<option value=" + des + ">" + fonction + "</option>");
                            alertMessage("Succè!", "Fonction a été créée avec succè.", "success", "btn btn-success");
                        }).fail(() => {
                            alertMessage("Erreur!", "Une érreur s'est produite. Veuillez rééssayer.", icons, btn)
                        });
                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
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
});