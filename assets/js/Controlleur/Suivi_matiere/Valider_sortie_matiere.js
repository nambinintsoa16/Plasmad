$(document).ready(function() {

    table_modif = $('#dataTable_modif').DataTable({
        processing: true,

        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        drawCallback: function(settings) {
            validerModif();
        }

    })


    $("#input_cherche").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

        $('.valider').on('click', function(e) {
            e.preventDefault();
            let refnum = $(this).attr('id');
            let parent  = $(this).parent().parent();
          
            $.post(base_url + "controlleur/valide_sortie_matiere", { refnum }, function() {

            }).done(() => {
                  parent.remove();
            }).fail(() => {

            });

        });

        $('.delete').on('click', function(e) {
            e.preventDefault();
            let refnum = $(this).attr('id');
            let parent  = $(this).parent().parent();
            $.post(base_url + "controlleur/delete_matiere_attent_validation", { refnum }, function() {
                 parent.remove();
            });
        });


    
    $("#refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#ajouterProduit"
    });

    $('.machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
        appendTo: "#ajouterProduit"
    });
    $(".addMat").on('click', function(e) {
        e.preventDefault();
        let matiere = $('.matier').val();
        let quantite = $('.quanatite').val();
        let refnum = $('.po').val();
        let machine = $('.machine').val();
        let prix = $('.prix').val();
        $.post(base_url + "controlleur/insert_validation_matiere", { refnum, quantite, prix, matiere, machine }, function() {
            //table.ajax.url(base_url + "controlleur/data_list_matier_en_attent_de_validation");
            //table.ajax.reload();
            window.location.reload();
            $('input').val("");
        });

    });
    $(".matier").autocomplete({
        appendTo: "#ajouterProduit",
        source: base_url + "stock/autocomplete_matiere_sortie_magasin",
        select: function(item, label) {
            item.preventDefault();
            let rep = label.item.label.split("|");
            $('.matier').val(rep[1].trim());
            $('.prix').val(rep[2].trim());
        }

    });

    $('.add').on('click', function(e) {
        e.preventDefault();
        $('#modal_form_edit').modal("hide");
        $('.quanatite').val("");
        $('.machine').val("");
        $('.prix').val("");
        $('#ajouterProduit').modal("show");
    });
    $("#hide_modal").on("click", function() {
        table_modif.ajax.reload();
        $('#modal_form_edit').modal("show");
    });

    function validerModif() {

        $('.supprimer').on('click', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.post(base_url + "controlleur/deleteSortieTransac", { id }, function() {
                table_modif.ajax.reload();
                window.location.reload();
                //Table.ajax.reload();
            });

        });


    }
});