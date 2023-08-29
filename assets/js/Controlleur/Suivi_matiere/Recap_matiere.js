$(document).ready(function() {
    var Table = $('.tableRecapMatier').DataTable({
        processing: true,
        ajax: base_url + "Controlleur/data_list_sortie_materiel",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "columnDefs": [
            { "width": "30%", "targets": 0 },
            { "width": "50%", "targets": 3 }
        ],
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

        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {}
    });

    $('.AfficherMatier').on('click', function(e) {
        e.preventDefault();

        let dateCost = $('.dateCost').val();
        let dateCostFin = $('.dateCostFin').val();
        let reference = $('.reference').val();
        let links = base_url + "Controlleur/data_list_sortie_materiel?dateCost=" + dateCost + "&dateCostFin=" + dateCostFin + "&reference=" + reference;
        Table.ajax.url(links);
        Table.ajax.reload();
    });

    $(".reference").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",

    });
});