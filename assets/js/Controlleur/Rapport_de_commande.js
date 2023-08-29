$(document).ready(function() {
    //$('#dataTable').dataTable();
    $('#refnum').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });
    $(".show_data").on("click", function(event) {
        event.preventDefault();
        let debut = $('#debut').val();
        let fin = $('#fin').val();
        let refnum = $('#refnum').val();
        let type = $(this).attr('id');
        let link = "";
        chargement();
        $.post(
            base_url + "controlleur/get_data_rapport_production", { refnum, debut, fin, type },
            function(data) {
                link = base_url + "controlleur/get_data_rapport_production?type=" + type + "&refnum=" + refnum + "&debut=" + debut + "&fin=" + fin;
                $('#print_data').attr('href', link);
                $("#data-contente").empty().append(data);
                closeDialog();
            }
        ).fail(() => {
            closeDialog();
            alertMessage("Erreur!", "Erreur veuillez reessayer.", "error", "btn btn-danger")
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

    function closeDialog() {
        $('.jconfirm').remove();
    }
});