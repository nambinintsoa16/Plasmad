$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault();
        let $this = $(this);
        let data = new FormData(this);
        let link = base_url + "controlleur/create_prix_appliquer";
        let methodOk = true;
        $(".input").each(function(index) {
            if ($(this).val() == "") {
                methodOk = false;
                label = $(this).prev().text();

                return false;
            }
        });

        if (methodOk) {
            $.ajax({
                type: 'POST',
                url: link,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    $('input').val("");
                    alertMessage("Succè!", "Prix enregistré", "success", "btn btn-success");
                },
                error: function(data) {
                    swal("Erreur ", "Veuillez réessayer!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                }
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