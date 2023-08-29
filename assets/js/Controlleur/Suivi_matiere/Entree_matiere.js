$(document).ready(function() {
    $('.autocomplete_matiere').autocomplete({
        source: base_url + "stock/autocomplete_matiere",
        select: function(event, items) {
            event.preventDefault();
            let select_item = items.item.value.split(" | ");
            $('#refnum').val(select_item[0]);
            $(this).val(select_item[1]);

        }
    });

    $('#save_entree_matiere').on('click', function(event) {
        event.preventDefault();
        chargement();
        let designation = $("#designation").val();
        let quantite = $("#quantite").val();
        let date = $("#date").val();
        let forniseur = $("#forniseur").val();
        let reference = $("#reference").val();
        let refnum = $("#refnum").val();
        let methodOk = false;
        $.post(base_url + "Stock/save_entree_matiere", { refnum, reference, designation, quantite, date, forniseur }, function(data) {
            closeDialog()
            methodOk = data == 1;
            if (!methodOk) {
                alertMessage("Erreur!", "Approvisionement non effectué", "error", "btn btn-danger")
            }
            if (methodOk) {
                alertMessage("Succè!", "Approvisionement effectué", "success", "btn btn-success");
                $('#designation').val("");
                $('#refnum').val("");
                $('#quantite').val("");
                $('#date').val("");
                $('#forniseur').val("");
                $('#reference').val("");
            }
        });

    })

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