$(document).ready(function() {
    table = $("#dataTable").DataTable({
        processing: true,
        ajax: base_url + "Controlleur/data_suivi_machine_coupe_list",
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
        footerCallback: function(row, data, start, end, display) {
            var api = this.api();
            var intVal = function(i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;

            };
            console.log(intVal);

            // Total over all pages
            /* total = api
                .column(3)
                .data()
                .reduce(function (a, b) {
                    console.log(a);
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page*/
            pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            $(api.column(3).footer()).html('<b>Total : </b>' + pageTotal + " %");
        },


    });

    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let debut = $("#debut").val();
        let fin = $("#fin").val();
        let text = "";
        if (debut != "" && fin != "") {
            text = "DU : " + debut + " au " + fin;
        } else if (debut != "") {
            text = "DU : " + debut;
        } else {
            date = new Date();
            date.getFullYear(),
                date.getMonth(),
                text = "DU : " + date.getMonth() + "-" + date.getFullYear();
        }
        $("#date_show").text(text);
        let link = base_url + "Controlleur/data_suivi_machine_coupe_list?debut=" + debut + "&fin=" + fin;
        table.ajax.url(link);
        table.ajax.reload();
    });

});