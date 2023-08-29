$(document).ready(function() {
    $(".dataTable").each(function(index) {
        table = "";
        let current_element = $(this).attr("id");
        table = $("#" + current_element).DataTable({
            processing: true,
            createdRow: function(row, data, dataIndex) {
                $(row).attr("id", data[1]);
                $(row).attr("machine_id", current_element)
            },
            language: {
                url: base_url + "assets/dataTableFr/french.json",
            },
            ajax: base_url +
                "Planning/current_production_sachet_coupe?machine=" +
                current_element,
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
                /*let previ = 0;
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);

                    let previ_row = $(this).children().eq(14).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += previ_row;
                        // console.log(previ_row);
                    }
                });
                console.log(previ);
                $("#previ_" + current_element).empty().append(previ);*/

            },
            drawCallback: function(settings) {
                let previ = 0;
                let terminer = 0;
                let rest = 0;
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);

                    let previ_row = $(this).children().eq(14).text().trim();
                    let terminer_row = $(this).children().eq(15).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += parseFloat(previ_row);
                        terminer += parseFloat(terminer_row);
                        rest = previ - terminer;
                        $("#previ_" + current_element).empty().append(previ);
                        $("#terminer_" + current_element).empty().append(terminer);
                        $("#rest_" + current_element).empty().append(rest);
                    }

                });

            },
            initComplete: function(ui, setting) {
                let previ = 0;
                let terminer = 0;
                let rest = 0;
                $("#" + current_element + "tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();

                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);
                    let previ_row = $(this).children().eq(14).text().trim();
                    let terminer_row = $(this).children().eq(15).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += parseFloat(previ_row);
                        terminer += parseFloat(terminer_row);
                        rest = previ - terminer;
                        $("#previ_" + current_element).empty().append(previ);
                        $("#terminer_" + current_element).empty().append(terminer);
                        $("#rest_" + current_element).empty().append(rest);

                    }
                });


            },
        });

    });
});