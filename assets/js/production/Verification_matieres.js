$(document).ready(function() {
    $("#refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        select: function(items, reponse) {
            let refnum = reponse.item.value;
            $.post(
                base_url + "production/get_data_sachet_extrusion", { refnum },
                function(data) {
                    $("#chef_equipe").empty();
                    if (data != "") {
                        data.forEach((element) => {
                            $("#chef_equipe").append("<option>" + element.EX_EQUIP + "</option>");
                        });
                        console.log(data);
                    } else {
                        $("#chef_equipe").append("<option value='' hidden>Pas de produiction</option>");
                    }
                }, "json");
        }
    });
    $("#afficher_data_verication").on("click", function(event) {
        event.preventDefault();
        var param = $("#refnum_commande").val().trim();
        var goupe = $("#chef_equipe option:selected").val();
        var datePro = $("#date").val();
        if (param == "") {
            alertMessage("Erreur!", "PO Introvable.", "error", "btn btn-danger");
        } else if (goupe == "equipe" || goupe == "") {
            alertMessage("Erreur!", "Chef d'equipe introvable.", "error", "btn btn-danger");
        } else if (datePro == "") {
            alertMessage("Erreur!", "Date non valide.", "error", "btn btn-danger");
        } else {
            chargement();
            $.post(
                base_url + "Production/get_form_verification", { param: param, goupe: goupe, datePro: datePro },
                function(data) {
                    if (data == " ") {
                        stopload();
                        alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                        $("#data_containt").empty().append();
                    } else {
                        $("refnum_commande").val(param);
                        $("#data_containt").empty().append(data);
                        function_verif_matiere();
                        stopload();
                    }
                }
            ).fail(() => {
                stopload();
                alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
            });
        }
    });

    function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn,
                },
            },
        });
    }

    function function_verif_matiere() {
        $('.VM_ME').on('change', function() {
            let VM_ME = $(this).val();
            let VM_SUITE = $('.VM_SUITE').val();
            let VM_PDSNET = $('.VM_PDSNET').val();
            $('.VM_R1').val(VM_ME - (VM_SUITE + VM_PDSNET));
            $('.VM_R2').val((VM_ME - (VM_SUITE + VM_PDSNET)) * -1);

        });

        $('form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: base_url + "Production/save_verification_matiere",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    swal("", "Participant enregistré avec succès", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });


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
        });
    }

    function stopload() {
        $('.jconfirm').remove();
    }

    function chargement() {
        var htmls =
            '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            title: "",
            content: htmls,
            show: true,
            modal: true,
            close: false,
            closeOnMaskClick: false,
            closeOnEscape: false,
            dynamic: false,
            height: 150,
            fixedDimensions: true,
        });
    }
});