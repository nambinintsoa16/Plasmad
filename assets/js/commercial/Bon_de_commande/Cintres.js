$(document).ready(function() {
    CKEDITOR.replace('BC_OBSERVATION');
    $('.BC_DATE , .BC_DATELIVRE').datepicker();
    $.post(base_url + 'Commercial/refnum_Bon_de_commande_Cintre', { type: "EPZ" }, function(data) {
        $('.BC_PE').val("IN" + data);
    }, 'json');

    $('.BC_TYPEPO').on('change', function() {
        var type = $(this).val();
        $.post(base_url + 'Commercial/refnum_Bon_de_commande_Cintre', { type: type }, function(data) {
            if (type == "CMTI") {
                $('.BC_PE').val("IN" + data + "C");
            } else {
                $('.BC_PE').val("IN" + data);
            }

        }, 'json');
    });

    $('.saveCintre').on('click', function(event) {
        event.preventDefault();
        var BC_DATE = $('.BC_DATE').val();
        var BC_TYPEPO = $('.BC_TYPEPO').val();
        var BC_PE = $('.BC_PE').val();
        var BC_TYPEPRODUIT = $('.BC_TYPEPRODUIT option:selected').val();
        var BC_CLIENT = $('.BC_CLIENT').val();
        var BC_CODE = $('.BC_CODE').val();
        var BC_DATELIVRE = $('.BC_DATELIVRE').val();
        var BC_LIEU = $('.BC_LIEU').val();
        var BC_TYPE_PRODUIT = $('.BC_TYPE_PRODUIT').val();
        var BC_MODEL = $('.BC_MODEL').val();
        var BC_COULEUR = $('.BC_COULEUR').val();
        var BC_QUNTITE = $('.BC_QUNTITE').val();
        var BC_OBSERVATION = CKEDITOR.instances.BC_OBSERVATION.getData();
        var BC_CON_PRIX = $('.BC_CON_PRIX').val();
        chargement();
        $.post(base_url + "Commercial/save_commande_cintre", {
            BC_DATE: BC_DATE,
            BC_TYPEPO: BC_TYPEPO,
            BC_PE: BC_PE,
            BC_TYPEPRODUIT: BC_TYPEPRODUIT,
            BC_CLIENT: BC_CLIENT,
            BC_CODE: BC_CODE,
            BC_DATELIVRE: BC_DATELIVRE,
            BC_LIEU: BC_LIEU,
            BC_TYPE_PRODUIT: BC_TYPE_PRODUIT,
            BC_MODEL: BC_MODEL,
            BC_COULEUR: BC_COULEUR,
            BC_QUNTITE: BC_QUNTITE,
            BC_OBSERVATION: BC_OBSERVATION,
            BC_CON_PRIX: BC_CON_PRIX
        }, function(data) {
            closeDialog();
            $.post(base_url + 'Commercial/refnum_Bon_de_commande_Cintre', { type: BC_TYPEPO }, function(data) {
                if (BC_TYPEPO == "CMTI") {
                    $('.BC_PE').val("IN" + data + "C");
                } else {
                    $('.BC_PE').val("IN" + data);
                }
            }, 'json');
            $('input').val("");
            CKEDITOR.instances.BC_OBSERVATION.setData("");
            swal({
                title: 'Bon de commande enregistré!',
                text: "Voulez-vous imprimer?",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'OUI',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        text: 'NON',
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    location.replace(base_url + 'Commercial/print_bon_commande_cintre?refnum=' + BC_PE);
                } else {
                    alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
                }
            });
        }, 'json');
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