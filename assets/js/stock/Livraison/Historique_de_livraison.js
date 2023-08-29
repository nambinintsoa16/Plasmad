$(document).ready(function() {
    $('#refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",

    });
    /* $.post(base_url + 'stock/data_historique_livraison', function(data) {
         $('#data_containt').empty().append();
     });*/

    $('#changeDate').on('click', function() {
        var date = $('.choixdate').val();
        var refnum = $('#refnum_commande').val();
        chargement();
        $.post(base_url + "stock/data_historique_livraison", { date, refnum }, function(data) {
            $('#data_containt').empty().append(data);
            closeDialog();
        });

    });
    $('#print_data').on('click', function() {
        var date = $('.choixdate').val();
        var refnum = $('#refnum_commande').val();
        window.location.replace(base_url + "stock/data_historique_livraison?type=print&refnum=" + refnum + "&date=" + date);
    });




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