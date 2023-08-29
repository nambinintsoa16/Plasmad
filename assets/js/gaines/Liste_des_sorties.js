$(document).ready(function() {
    table = $("#dataTable").dataTable({
        processing: true,
        ajax: base_url + "Gaines/data_liste_sortie_ganes",
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
            $('.infoProduit').on('click', function(event) {
                event.preventDefault();
                var refnum = $(this).attr('href');
                $.post(base_url + "stock/get_detai_produit_finis", {
                    refnum
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
    });

    


    $('#afficher').on('click', function(e) {
        e.preventDefault();
        var date_debut = $('.debut').val();
        var date_fin = $('.fin').val();
        var links = base_url + "gaines/data_liste_sortie_ganes?date_debut=" + date_debut + "&date_fin=" + date_fin;
        table.ajax.url(links);
        table.ajax.reload();
    });
});