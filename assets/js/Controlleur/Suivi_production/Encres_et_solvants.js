$(document).ready(function() {

    $("#refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande"
    });
    $("#designation").autocomplete({
        source: base_url + "Production/autocomplet_reference_matiere",
        appendTo: "#modal_form",
    });

    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let refnum_commande = $("#refnum_commande").val();
        let link = base_url + "Controlleur/data_list_use_matiere_print?refnum=" + refnum_commande;
        table_matiere.ajax.url(link);
        table_matiere.ajax.reload();

    });

    table_matiere = $("#dataTable").DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        dom: "Bfrtip",
        buttons: [{
                extend: "colvis",
                className: "btn btn-warning text-white",
                collectionLayout: "fixed four-column",
                text: '<i class="icon-eye"></i> Masque colonne',
                columns: ":gt(0)",
            },
            {
                className: "btn btn-primary text-white",
                text: '<i class="icon-printer"></i> Imprimer',
                extend: "print",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
            {
                className: "btn btn-danger text-white",
                text: '<i class="icon-doc"></i> Export PDF',
                extend: "pdf",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
            {
                className: "btn btn-success text-white",
                text: '<i class="icon-folder-alt"></i> Exporter',
                extend: "excel",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
        ],
        rowCallback: function(row, data) {
            matiere_sachet_impression();
        },
        drawCallback: function(settings) {
            matiere_sachet_impression();
        },
        initComplete: function(setting) {
            matiere_sachet_impression();
        },
    });

    function matiere_sachet_impression() {
        $(".delete_Imprim_matiere").on("click", function(event) {
            event.preventDefault();
            var refnum = $(this).attr("id");
            $.post(base_url + "Production/delete_sachet_refnum_print", { refnum }, function(data) {
                table_matiere.ajax.reload();
            });
        });

    }
    $("#save_matiere").on("click", function(event) {
        event.preventDefault();
        let date = $("#date").val();
        let temp_mat = $("#designation").val().split(" | ");
        let refnum_commande = $("#refnum_commande").val();
        let designation = temp_mat[0];
        let prix = temp_mat[1];
        let quantite = $("#quantite").val();
        $.post(base_url + "Production/save_matiere_utiliser", { refnum_commande, date, designation, quantite, prix }, function(data) {
            $("input").val("");
            table_matiere.ajax.reload();
        });
    });

});