$(document).ready(function() {
    table = $('#dataTable').DataTable({
        ajax: base_url + "Recyclage/get_entree_dechet",
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

        }],
        "columnDefs": [{
            "targets": [4],
            "orderable": false,

        }],
        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {}
    });

    $("#show_selection").on("click", function(event) {
        event.preventDefault();
        let debut = $("#debut").val();
        let fin = $("#fin ").val();
        let link = base_url + "recyclage/get_entree_dechet?debut=" + debut + "&fin=" + fin;
        table.ajax.url(link);
        table.ajax.reload();

    });




});