$(document).ready(function() {
    chargement();
    $.post(base_url + "Comptabilite/consting_containt", function(data) {
        $('#result_containt').empty().append(data);
        $('.detailProgre').on('click', function(e) {
            e.preventDefault();
            var po = $(this).attr('id');
            $.post(base_url + 'Comptabilite/detailProduction', {
                po: po
            }, function($data) {
                $('.dataProd').empty().append($data);
                $('#modaleInfo').modal('show');
            });
        });
        closeDialog();
    }).fail(() => {
        closeDialog();
    });
    $('.AfficherCost').on('click', function(e) {
        e.preventDefault();
        var date = $('.dateCost').val();
        var po = $('.numpo').val();
        var type = $('.type option:selected').val();
        var fin = $('.dateCostFin').val();
        var origin = $('.origin').val();
        $('.export').attr('href', base_url + "Comptabilite/export_costing_excel?date=" + date + "&po=" +
            po + "&fin=" + fin + "&type=" + type + "&origin=" + origin);
        chargement();
        $.post(base_url + "Comptabilite/consting_containt", {
            date: date,
            po: po,
            type: type,
            fin: fin,
            origin: origin
        }, function(data) {
            $('#result_containt').empty().append(data);
            $('.detailProgre').on('click', function(e) {
                e.preventDefault();
                var po = $(this).attr('id');
                $.post(base_url + 'Comptabilite/detailProduction', {
                    po: po
                }, function($data) {
                    $('.dataProd').empty().append($data);
                    $('#modaleInfo').modal('show');
                });
            });
            closeDialog();
        }).fail(() => {
            closeDialog();
        });
    });
    $('.detailProgre').on('click', function(e) {
        e.preventDefault();
        var po = $(this).attr('id');
        $.post(base_url + 'Comptabilite/detailProduction', {
            po: po
        }, function($data) {
            $('.dataProd').empty().append($data);
            $('#modaleInfo').modal('show');
        });
    });
    $('.numpo').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });

    function chargement() {
        var htmls =
            '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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