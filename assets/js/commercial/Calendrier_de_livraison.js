$('document').ready(function() {
    $.post(base_url + 'Commercial/calendrier_livraison_commande', function(data) {
        $('.conttable').empty().append(data);
    });
    $('.afficher').on('click', function(e) {
        e.preventDefault();
        var date = $('.BC_DATE').val();
        $('.dateConte').text(date);
        $('.export').attr('id', date);
        $.post(base_url + 'Commercial/calendrier_livraison_commande', {
            date: date
        }, function(data) {
            $('.conttable').empty().append(data);
        });

    });


});