$(document).ready(function() {
    tables = $("#table_produit_surplus").DataTable({
        processing: true,
        ajax: base_url + "Surplus/data_liste_produit_surplus",
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
        "drawCallback": function(settings) {
            data_liste();
        }
    });

    function data_liste() {
        $('.info_produit').on('click', function(event) {
            event.preventDefault();
            var refnum_pe = $(this).attr('href');
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
                $(".BC_TYPEPRODUIT").val(data.BC_TYPEPRODUIT);
                $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
                $(".BC_QUNTITE").val(data.BC_QUNTITE);
                $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
                $(".BC_TYPEMATIER").val(data.BC_TYPEMATIER);
                $(".BC_PRIX").val(data.BC_PRIX);
                $(".BC_POISENKGSAVECMARGE").val(data.BC_POISENKGSAVECMARGE);
                $(".BC_QUANTITEAPRODUIREENMETRE").val(data.BC_QUANTITEAPRODUIREENMETRE);
                $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
                $("#modal_detail_commande").modal("show");
            }, "json");
        });

    }
    $('.afficher').on('click', function(e) {
        e.preventDefault()
        let debut = $('.debut').val()
        let fin = $('.fin').val()
        $('.exportSortie').attr('href', base_url + "Stock/exportFini?debut=" + debut + "&fin=" + fin)
        $('.printSortie').attr('href', base_url + "Stock/printFini?debut=" + debut + "&fin=" + fin)

        var links = base_url + "Surplus/data_liste_produit_surplus?debut=" + debut + "&fin=" + fin;
        tables.ajax.url(links);
        tables.ajax.reload();

    })

    $('form').on('submit', function(event) {
        event.preventDefault();
        var fd = new FormData();
        var files = $('.file')[0].files[0];
        fd.append('file', files);
        chargement();
        $.ajax({

            url: base_url + 'Controlleur/update_stock_surplus',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response == 1) {
                    closeDialog();
                    swal("Erreur ", "Vous n'étè pas autorise à éffectue cette opération", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                } else if (response == 0) {
                    closeDialog();
                    swal("Succés ", "Stock rénitialise!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });

                    closeDialog();

                } else {
                    closeDialog();
                    swal("Erreur ", "Veuillez réessayer!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                }
            },
            error: function(data) {
                swal("Erreur ", "Veuillez réessayer!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
            }

        });
    });

});

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