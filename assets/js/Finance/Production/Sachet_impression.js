$(document).ready(function() {
    Table = $("#dataTable").DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        ajax: base_url + "finance/sachet_impression_data",
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
        "columnDefs": [{
            "targets": [6],
            "orderable": false,

        }],
        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {

        }
    });
});