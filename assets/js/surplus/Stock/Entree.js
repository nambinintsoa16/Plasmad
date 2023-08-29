$(document).ready(function() {
    $('#refnum').autocomplete({
        source: base_url + "stock/autocomplete_produit_plasmad",
        select: function(data, iteme) {
            let refnum_pe = iteme.item.value.trim();
            $.post(base_url + "Stock/detail_commande_livraison", { refnum_pe }, function(data) {
                if (data.mesage == "false") {
                    alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                } else {
                    $('#client').val(data.client);
                    $('#dim').val(data.dim);
                    $('#code_client').val(data.code);
                    $('#tail').empty();
                    data.tail.forEach(element => $('#tail').append("<option>" + element.tail + "</option>"));
                }
            }, 'json');
        }
    });
    $('#save_entree').on('click', function(event) {
        event.preventDefault();
        chargement();
        let date = $('#date').val();
        let refnum = $('#refnum').val();
        let client = $('#client').val();
        let code_client = $('#code_client').val();
        let dim = $('#dim').val();
        let tail = $('#tail option:selected').val();
        let quantite = $('#quantite').val();
        let localisation = $('#localisation').val();
        let obs = $('#obs').val();
        $.post(base_url + 'surplus/save_entree_surplus', { date, refnum, client, code_client, dim, tail, quantite, localisation, obs }, function(data) {
            closeDialog();
            if (data) {
                $("input").val("");
                $("textarea").val("");
                $('#tail').empty();
                alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                //alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
            }
        })
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
        var htmls = '<style> .spinner div{background-color:#6861ce;}</style><div class="text-center" style="font-size:14px;color:#6861ce;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner color-secondary"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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