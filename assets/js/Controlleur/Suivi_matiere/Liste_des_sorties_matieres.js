$(document).ready(function() {
    
    table = $('#data_sortie').DataTable({
        processing: true,
        ajax: base_url + "stock/list_des_sortie_matiere",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
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
        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {

        },
        "drawCallback": function(settings) {}
    });

    table_print = $("#dataTable_print").DataTable({
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
    });

    $('.printSortie').on('click', function(e) {
        e.preventDefault();
        let date = $("#date").val();
        let link = base_url + "stock/list_des_sortie_matiere?date=" + date;
        table_print.ajax.url(link);
        table_print.ajax.reload();
        $('#modal_print').modal('show');

    });
    $('.print').on('click', function(e) {
        e.preventDefault();
        var dateChoix = $('.dateChoix').val();
        var link = "";
        var i = 0;
        $('.body-table > tr').each(function() {
            var $this = $(this).children();

            if ($this.eq(7).find('input').is(':checked') == true) {
                if (i == 0) {
                    link += $this.eq(0).text();
                } else {
                    link += "+" + $this.eq(0).text();
                }
                i++;
            }
        });
        location.replace(base_url + "stock/export_Sortier_matiere?date=" + dateChoix + "&refnum=" + link);
    });

    $('.showSortie').on('click',function(event){
        event.preventDefault();
        let date_de_bedut = $('.date_de_bedut').val();
        let date_de_fin = $('.date_de_fin').val();
        let link = base_url + "stock/list_des_sortie_matiere?debut="+date_de_bedut+"&fin="+date_de_fin;
        table.ajax.url(link);
        table.ajax.reload();
    });
});