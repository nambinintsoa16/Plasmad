$(document).ready(function() {
    var tables = $('.tableQC').dataTable({
        processing: true,
        ajax: base_url + "Control_qualite/data_stock_deuxieme_choix",
        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        "columnDefs": [
            { "width": "10%", "targets": 3 }
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
        "rowCallback": function(row, data) {
            deleteQc();
        },
        initComplete: function(setting) {
            deleteQc();
        },
        "drawCallback": function(settings) {
            deleteQc();
        }
    });
    $('.updateQC').on('click', function(e) {
        e.preventDefault();
        var date = $('.date').val();
        var po = $('.po').val();
        var qc = $('.qc').val();
        var links = base_url + "Controle_Qualite/liseteControl?C_DATE=" + date + "&C_PO=" + po + "&QC=" + qc;
        tables.ajax.url(links);
        tables.ajax.reload();

    });

    function deleteQc() {
        $(".delete").on('click', function(e) {
            e.preventDefault();
            var $this = $(this).parent().parent();
            chargement();
            var parametre = $(this).attr('href');
            $.post(base_url + "Production/deleteQC", {
                parametre: parametre
            }, function(data) {
                alertMessage("Suppression QC", "QC supprimer avec succè", "success", "btn btn-success");
                $this.remove();
                closeDialog();
            });

        });


        $('.view').on('click', function(e) {
            e.preventDefault();
            let refnum_pe = $(this).attr('href').trim();
            $.post(base_url + "Commercial/detail_commande", {
                refnum_pe
            }, function(data) {
                $(".BC_PE").val(data.BC_PE);
                $(".date").val(data.BC_DATE);
                $(".BC_CLIENT").val(data.BC_CLIENT);
                $(".BC_CODE").val(data.BC_CODE);
                $(".BC_DATELIVRE").val(data.BC_DATELIVRE);
                $(".BC_REASSORT").val(data.BC_REASSORT);
                $(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);
                $(".BC_DIMENSION").val(data.BC_DIMENSION);
                $(".BC_RABAT").val(data.BC_RABAT);
                $(".BC_SOUFFLET").val(data.BC_SOUFFLET);
                $(".BC_PERFORATION").val(data.BC_PERFORATION);
                $(".BC_TYPE").val(data.BC_TYPE);
                $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
                $(".BC_QUNTITE").val(data.BC_QUNTITE);
                $(".BC_TYPEMATIER").val(data.BC_TYPEMATIER);
                $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
                $(".BC_PRIX").val(data.BC_PRIX);
                $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
                $(".BC_LIEULIVRE").val(data.BC_LIEULIVRE);
                $("#infoCOmmande").modal("show");
            }, "json");

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