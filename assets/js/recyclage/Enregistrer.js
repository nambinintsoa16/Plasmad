$(document).ready(function() {
    $('.save').on('click', function(e) {
        e.preventDefault();
        let date = $('.date').val();
        let po = $('.po').val();
        let MACHINES = $('.MACHINES').val();
        let POIDS = $('.POIDS').val();
        let DECHETS = $('.DECHETS option:selected').val();
        let OPERATEUR = $('.OPERATEUR').val();
        let MATIERE = $('.MATIEER option:selected').val();
        let TYPE = "ENTRE";
        chargement();
        $.post(base_url + "Recyclage/save_new_dechet", {
            date,
            po,
            MACHINES,
            MATIERE,
            POIDS,
            DECHETS,
            OPERATEUR,
            TYPE
        }, function() {
            closeDialog();
            $('input').val('');
            alertMessage("Succé!", "Enregistrement éffectué avec succé", "success", "btn btn-success")
        }).fail(() => {
            closeDialog();
            alertMessage("Erreure!", "Enregistrement non éffectué", "error", "btn btn-danger")
        });

    });



    $('.stock_sortie').autocomplete({
        source: base_url + "Commercial/autocomplet_commande"

    });

    $('.MACHINES').autocomplete({
        source: base_url + "Production/autocomplete_machine",

    });




    $('.OPERATEUR').autocomplete({
        source: base_url + "Production/autocomplete_operateur",

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
        var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner" style="color:#31ce36"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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