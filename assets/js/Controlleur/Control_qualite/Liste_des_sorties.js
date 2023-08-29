$(document).ready(function() {
    table = $('.tableQC').dataTable({
        processing: true,
        ajax: base_url + "Control_qualite/data_list_sortie_control_qualite",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "columnDefs": [
            { "width": "10%", "targets": 5 }
        ],
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
        "rowCallback": function(row, data) { deleteQc(); },
        "initComplete": function(setting) { deleteQc(); },
        "drawCallback": function(settings) { deleteQc(); }
    });


    function deleteQc() {
        $(".delete").on('click', function(e) {
            e.preventDefault();
            chargement();
            var refnum = $(this).attr('href');
            $.post(base_url + "Control_qualite/delete_sortie_control_qualite", {
                refnum
            }, function(data) {
                closeDialog();
                table.api().ajax.reload();
                alertMessage("Succè!", "QC supprimer avec succè!", "success", "btn btn-success");


            });

        });
    }

    function chargement() {
        var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            "title": "",
            "content": htmls,
            "show": true,
            "modal": true,
            "close": false,
            "closeOnMaskClick": false,
            "closeOnEscape": false,
            "dynamic": false,
            "height": 150,
            "fixedDimensions": true
        });


    }

    function closeDialog() {
        $('.jconfirm').remove();
    }

    function alertMessage(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn
                }
            },
        });

    }

});