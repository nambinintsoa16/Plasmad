$(document).ready(function() {
    $('.BC_PO').autocomplete({
        source: base_url + "commercial/autocomplet_commande",
        select: function(ui, iteme) {
            var refnum = iteme.item.value.trim();
            $.post(base_url + "planning/get_commande_simple_info", { refnum }, function(data) {
                $("#info_commande").empty().append(data);
            });
        }
    });
    $('.info').on('click', function() {
        event.preventDefault();
        let refnum_pe = $(".BC_PO").val();
        $.post(base_url + "commercial/detail_commande", {
            refnum_pe
        }, function(data) {
            $(".BC_PE").val(data.BC_PE);
            $(".date").val(data.BC_DATE);
            $(".BC_CLIENT").val(data.BC_CLIENT);
            $(".BC_CODE").val(data.BC_CODE);
            $(".BC_DATELIVRE").val(data.BC_DATELIVRE);
            $(".BC_REASSORT").val(data.BC_REASSORT);
            $(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);
            $(".BC_DIMENSION").val(data.BC_DIMENSION);
            $(".BC_RABAT").val(data.BC_RABAT);
            $(".BC_SOUFFLET").val(data.BC_SOUFFLET);
            $(".BC_PERFORATION").val(data.BC_PERFORATION);
            $(".BC_TYPE").val(data.BC_TYPE);
            $(".BC_TYPEPRODUIT").val(data.BC_TYPEPRODUIT);
            $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
            $(".BC_QUNTITE").val(data.BC_QUNTITE);
            $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
            $(".BC_TYPEMATIER").val(data.BC_TYPEMATIER);
            $(".BC_PRIX").val(data.BC_PRIX);
            $(".BC_POISENKGSAVECMARGE").val(data.BC_POISENKGSAVECMARGE);
            $(".BC_QUANTITEAPRODUIREENMETRE").val(data.BC_QUANTITEAPRODUIREENMETRE);
            $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
            $("#infoCOmmande").modal("show");
        }, "json");

    });


    $('.cree').on('click', function(event) {
        event.preventDefault();
        let refnum = $(".BC_PO").val();
        $.post(base_url + "planning/create_reextrusion", {
            refnum
        }, function(data) {

        }).done(function() {
            alertMessage("Succè!", "Réextrusion enregistré.", "success", "btn btn-success");
            $(".BC_PO").val("");
            $("#info_commande").empty();
        }).fail(function() {
            alertMessage("Erreur!", "Réextrusion non enregistré.", "error", "btn btn-danger");
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