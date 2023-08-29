$(document).ready(function() {

    $('.afficeProd').on('click', function(e) {
        e.preventDefault();
        let refnum = $('#refnum_commande').val();
        $.post(base_url + "Planning/detail_production", {
            refnum
        }, function(data) {
            $('.main-containte').empty().append(data);
        });

    });

    $('#refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
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