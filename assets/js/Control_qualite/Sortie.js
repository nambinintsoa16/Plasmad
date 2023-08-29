$(document).ready(function() {
    $('.auto').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        select: function(data, iteme) {
            let refnum_pe = iteme.item.value.trim();
            $.post(base_url + "Control_qualite/detail_commande_deuxiemeChoix", { refnum_pe }, function(data) {
                if (data.mesage == "false") {
                    alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                } else {
                    $('.dim').val(data.dim);
                    if (data.tail != "") {
                        $('.tail').empty();
                        data.tail.forEach(element => $('.tail').append("<option>" + element.tail + "</option>"));
                    }

                }
            }, 'json');
        }
    });

    $("form").on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        let methodOk = false;
        methodOk = $("#CS_DATE").val() != "";

        if (!methodOk) {
            alertMessage("Erreur!", "Date non valide.", "error", "btn btn-danger");
        }
        if (methodOk) {
            methodOk = $("#CS_PO").val() != "";
            if (!methodOk) {
                alertMessage("Erreur!", "Refnum commande non valide.", "error", "btn btn-danger");
            }
        }

        if (methodOk) {
            methodOk = $("#CS_QTT").val() != "";
            if (!methodOk) {
                alertMessage("Erreur!", "Quantite non valide.", "error", "btn btn-danger");
            }
        }

        if (methodOk) {
            methodOk = $("#CS_BL").val() != "";
            if (!methodOk) {
                alertMessage("Erreur!", "bon de livraison non valide.", "error", "btn btn-danger");
            }
        }


        if (methodOk) {
            $.ajax({
                type: 'POST',
                url: base_url + "Control_qualite/save_sortie_control_qualite",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    swal("Succé ", "Control enregistre", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });

                },
                error: function(data) {
                    swal("Erreur!", "Veuillez réessayer!", {
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

    function chargement() {
        var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });
    }

    function closeDialog() {
        $('.jconfirm').remove();
    }

});