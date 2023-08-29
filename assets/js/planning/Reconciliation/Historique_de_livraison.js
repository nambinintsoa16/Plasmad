$(document).ready(function() {
    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let refnum_commande = $("#refnum_commande").val();
        let date = $("#date").val();
        let link = base_url + "Planning/get_data_livraison?date=" + date + "&refnum_commande=" + refnum_commande;
        table.ajax.url(link);
        table.ajax.reload();
    });
    $("#refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });
    table = $("#table_livraison").DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'colvis',
            className: 'btn btn-warning text-white',
            collectionLayout: 'fixed four-column',
            text: '<i class="icon-eye"></i> Masque colonne',
            columns: ':gt(0)'
        }, {
            className: 'btn btn-primary text-white',
            text: '<i class="icon-printer"></i> Imprimer',
            extend: 'print',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }, {
            className: 'btn btn-danger text-white',
            text: '<i class="icon-doc"></i> Export PDF',
            extend: 'pdf',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }, {
            className: 'btn btn-success text-white',
            text: '<i class="icon-folder-alt"></i> Exporter',
            extend: 'excel',
            exportOptions: {
                modifier: {
                    page: 'all',
                    search: 'none'
                }
            },

        }, ]
    });
});