$(document).ready(function() {
    $("#autocomplete_refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });
    table = $("#dataTable").DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        rowCallback: function(row, data) {
            function_dataTable();
        },
        drawCallback: function(settings) {
            function_dataTable();
        },
        initComplete: function(setting) {
            function_dataTable();
        },
    });

    function function_dataTable() {
        $(".delete").on("click", function(event) {
            event.preventDefault();
            let refnum = $(this).attr('id');
            let type = $("#type option:selected").val();
            $.post(base_url + "controlleur/delete_mouvement_produit_fini", { refnum, type }, function(data) {
                table.ajax.reload();
            });

        })
    }
    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let refnum = $("#autocomplete_refnum_commande").val();
        let type = $("#type option:selected").val();
        let link = "";
        if (type == "entree") {
            link = base_url + "controlleur/data_liste_entre_produit_fini?refnum=" + refnum;
        }
        if (type == "sortie") {
            link = base_url + "controlleur/data_liste_sortie_produit_fini?refnum=" + refnum;
        }
        table.ajax.url(link);
        table.ajax.reload();
    });
});