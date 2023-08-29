$(document).ready(function() {
    $('.save').on('click', function(e) {
        e.preventDefault();
        let DATE = $('.date').val();
        let MATIERE = $('.MATIEREE option:selected').val();
        let MACHINES = $('.MACHINES').val();
        let POIDS = $('.POIDS').val();
        let DECHETS = $('.DECHETS option:selected').val();
        let OPERATEUR = $('.OPERATEUR').val();
        let POIDSDECHET = $('.POIDSDECHET').val();
        let TYPE = "SORTIE";
        chargement();
        $.post(base_url + "Recyclage/save_sortie", { DATE, POIDSDECHET, MACHINES, POIDS, OPERATEUR, TYPE, MATIERE, DECHETS }, function() {
            closeDialog();
            $('input').val('');
            alertMessage("Sucé", "Enregistrement éffectué avec succé", "success", "btn btn-success")
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