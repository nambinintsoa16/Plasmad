$(document).ready(function() {
    table = $('#table_liste_rextrusion').dataTable({
        processing: true,
        ajax: base_url + "Planning/liste_rextrusion",
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

        }],
        rowCallback: function(row, data) {

        },
        drawCallback: function(settings) {

        },
        initComplete: function(setting) {
            data_function();
        }
    });

    $('#affiche_data').on('click', function(e) {
        e.preventDefault();
        var date_debut = $('#date_debut').val();
        var date_fin = $('#date_fin').val();
        var links = base_url + "planning/liste_rextrusion?date_debut=" + date_debut + "&date_fin=" + date_fin;
        table.api().ajax.url(links);
        table.api().ajax.reload();
    });
});