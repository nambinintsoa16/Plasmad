$(document).ready(function() {
    table = $('#table_control_qualite').DataTable({
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        ajax: base_url + "surplus/data_liste_controle_qualite",
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

        },
    });
    $('.dateAffiche').on('click', function(e) {
        e.preventDefault();
        let debut = $('#debut').val();
        let fin = $('#fin').val();
        table.ajax.url(base_url + "surplus/data_liste_controle_qualite?debut=" + debut + "&fin=" + fin);
        table.ajax.reload();
    });
});