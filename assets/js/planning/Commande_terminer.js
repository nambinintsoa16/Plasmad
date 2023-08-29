$(document).ready(function() {
    table = $('.DataTable').dataTable({
        processing: true,
        ajax: base_url + "Planning/liste_commande_sachet",
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
        rowCallback: function(row, data) {

        },
        drawCallback: function(settings) {

        },
        initComplete: function(setting) {
            data_function();
        }
    });
    $('.auto').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",

    });
    $('.terminer').on('click', function(e) {
        e.preventDefault();
        var refnum = $(".auto").val();
        $.post(base_url + "Planning/terminer_commande", {
            refnum
        }, function(data) {
            table.api().ajax.reload();
            alertMessage("Message ", "Modification effectuée", "success", "btn btn-success");
            $('input').val("");
        });

    });
    $('.infoProduit').on('click', function(event) {
        event.preventDefault();
        var refnum = $(".auto").val();
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
            $("#infoCOmmande").modal("show");
        }, "json");
    });

    function data_function() {
        $('.lire-obse').on('click', function(e) {
            e.preventDefault();
            let po = $(this).attr('id');
            $('.obse-content').empty();
            $.post(base_url + "Commercial/get_observation", { po }, function(data) {
                $('.npeObs').text(po);
                $('.obse-content').append(data);
                $('#observation_modal').modal('show');
            });



        });
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
});