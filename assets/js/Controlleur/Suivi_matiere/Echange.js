$(document).ready(function() {
    var link_auto_complete_sortie = 'stock/autocomplete_matiere_plasmad';
    var link_auto_complete_entree = 'stock/autocomplete_matiere_mdakem';
    var cvar =
        $("#mouvement").on("change", function(event) {
            event.preventDefault();
            $('input').val("");
            let mouvement = $(this).val().split("->");
            let sortie = mouvement[0].trim();
            let entree = mouvement[1].trim();
            $("#sortie_title").text(sortie);
            $("#entre_title").text(entree);
            if (sortie == "Plasmad") {
                link_auto_complete_sortie = base_url + 'stock/autocomplete_matiere_plasmad';
                link_auto_complete_entree = base_url + 'stock/autocomplete_matiere_mdakem';
                $('.produit_sortie').autocomplete("option", { source: link_auto_complete_sortie });
                $('.produit_entree').autocomplete("option", { source: link_auto_complete_entree });

            }
            if (sortie == "Madakem") {
                link_auto_complete_entree = base_url + 'stock/autocomplete_matiere_plasmad';
                link_auto_complete_sortie = base_url + 'stock/autocomplete_matiere_mdakem';
                $('.produit_sortie').autocomplete("option", { source: link_auto_complete_sortie });
                $('.produit_entree').autocomplete("option", { source: link_auto_complete_entree });
            }
        });
    $('.produit_sortie').autocomplete({
        source: base_url + link_auto_complete_sortie,
        select: function(event, items) {
            event.preventDefault();
            let select_item = items.item.value.split(" | ");
            $('#refnum_sortie').val(select_item[0]);
            $(this).val(select_item[1]);
        }
    });
    $('.produit_entree').autocomplete({
        source: base_url + link_auto_complete_entree,
        select: function(event, items) {
            event.preventDefault();
            let select_item = items.item.value.split(" | ");
            $('#refnum_entree').val(select_item[0]);
            $(this).val(select_item[1]);

        }
    });
    $('#save_echange').on('click', function(event) {
        event.preventDefault();
        let sortie = $("#sortie_title").text();
        let entree = $("#entre_title").text();
        let produit_sortie = $('#produit_sortie').val();
        let quantite_sortie = $('#quantite_sortie').val();
        let produit_entree = $('#produit_entree').val();
        let quantite_entree = $('#quantite_entree').val();
        let refnum_sortie = $('#refnum_sortie').val();
        let refnum_entree = $('#refnum_entree').val();
        $.post(base_url + "stock/entree_echange_create_" + entree, { produit_entree, refnum_entree, quantite_entree }, function(rep_entree) {
            $.post(base_url + "stock/sortie_echange_create_" + sortie, { produit_sortie, refnum_sortie, quantite_sortie }, function(rep_sortie) {
                $('input').val("");
                alertMessage("Succè!", "Mouvement enregistrè.", "success", "btn btn-success")
            });
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