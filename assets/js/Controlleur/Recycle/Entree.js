$(() => {

    $('.save').on('click', function(e) {
        e.preventDefault();
        let DATE = $('.date').val();
        let MACHINES = $('.MACHINES').val();
        let MATIERE = $('.MATIEER option:selected').val();
        let DECHETS = $('.DECHETS option:selected').val();
        let POIDS = $('.POIDS').val();
        let OPERATEUR = $('.OPERATEUR').val();
        let TYPE = "ENTRE";
        chargement();
        $.post(base_url + "Recyclage/save_entree", {
            DATE,
            MACHINES,
            MATIERE,
            POIDS,
            DECHETS,
            OPERATEUR,
            TYPE
        }, function() {
            closeDialog();
            $('input').val('');
            alertMessage("Succé", "Enregistrement éffectué avec succé", "success", "btn btn-success")
        }).fail(() => {
            closeDialog();
            alertMessage("Erreur", "Enregistrement non éffectué", "error", "btn btn-danger")
        });

    });

    $('.MACHINES').autocomplete({
        source: base_url + "Production/autocomplete_machine"

    });

    $('.OPERATEUR').autocomplete({
        source: base_url + "Production/autocomplete_operateur"

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