$(document).ready(function() {
    let table = $("#dataTable").DataTable({
        processing: true,
        ajax: base_url + "controlleur/statu_commande_data_list",
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

        },
        drawCallback: function(settings) {

        },
        initComplete: function(setting) {

        },
    });
    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let debut = $("#debut").val();
        let fin = $("#fin").val();
        let link = base_url + "controlleur/statu_commande_data_list?debut=" + debut + "&fin=" + fin;
        table.ajax.url(link);
        table.ajax.reload();
    });



});