$(document).ready(function() {

    $('#refnum').autocomplete({
        source: base_url + "commercial/autocomplet_commande",
        select: function(data, iteme) {
            let refnum_pe = iteme.item.value.trim();
            $.post(base_url + "stock/detail_commande_livraison", { refnum_pe }, function(data) {
                if (data.mesage == "false") {
                    alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                } else {
                    $('.client').val(data.client);
                    $('.dim').val(data.dim);
                    $('.Codeclient').val(data.code);
                }
            }, 'json');
        }
    });
    $('form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: base_url + "controlleur/save_entre_produit_fini",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if (data.trim() == 1) {
                    console.log(data);
                    $('input').val('');
                    $('textarea').val('');
                    alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                } else {
                    alertMessage("Erreur!", "Erreur veuillez réessayer.", "error", "btn btn-danger");
                }

            },
            error: function() {
                alertMessage("Erreur!", "Erreur veuillez réessayer.", "error", "btn btn-danger");
            }
        });

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

});