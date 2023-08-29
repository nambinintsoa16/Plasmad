$(document).ready(function() {
    $(".dataTable").each(function(index) {
        table = "";
        let current_element = $(this).attr("id");
        table = $("#" + current_element).DataTable({
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
            ajax: base_url +
                "Planning/current_production_extrusion?machine=" +
                current_element,
            rowCallback: function(row, data) {
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);
                });
            },
            drawCallback: function(settings) {
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);
                });
            },
            initComplete: function(ui, setting) {
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);
                });
            },
        });
    });
});