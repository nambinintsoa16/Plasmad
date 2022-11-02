$(document).ready(function() {
    $.post(base_url + "controlleur/page", { page: "SUIVIE MACHINE" }, function(data) {
        $('.main').empty().append(data);

    });

    $('.btn-click').on('click', function(e) {
        e.preventDefault();
        var page = $(this).children().find('b').text();
        chargement();
        $.post(base_url + "controlleur/page", { page: page }, function(data) {
            $('.main').empty().append(data);
            closeDialog();

        });

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