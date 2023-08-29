$(document).ready(function() {
    let link = base_url + 'Commercial/liste_suivie_commande';
    Table = $("#table_rapport_de_commande").DataTable({
        processing: true,
        ajax: link,
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
            $('.edit_post').on('click', function(e) {
                e.preventDefault();
                var idModif = $(this).attr('id');
                $('.saveModif').attr('id', idModif);
                $('.npo').text(idModif);
                $('.modalEditSuivie').modal('show');

            });
        }
    });

    $('.itemModif').on('change', function(e) {
        e.preventDefault();
        let valeur = $('.itemModif option:selected').val();
        if (valeur == "Actual Delivered Date") {
            $('.valeurModif').attr('type', 'date');
        } else {
            $('.valeurModif').attr('type', 'text');
        }
    });

    $('.refnum_commande').autocomplete({
        source: base_url + "commercial/autocomplet_commande",
    });
    $('.saveModif').on('click', function(e) {
        e.preventDefault();
        var idModifMod = $(this).attr('id');
        let itemModif = $('.itemModif').val();
        let valeurModif = $('.valeurModif').val();

        $.post(base_url + 'Commercial/update_suivie_commande', { idModifMod: idModifMod, itemModif: itemModif, valeurModif: valeurModif }, function(data) {
            let debut = $('.debut ').val();
            let fin = $('.fin').val();
            let po = $('.po').val();
            let client = $('.client').val();
            $('.valeurModif').val("");
            let links = base_url + 'Commercial/liste_suivie_commande?debut=' + debut + '&fin=' + fin + '&po=' + po + '&client=' + client;
            Table.ajax.url(links);
            Table.ajax.reload();
        });
    });
    $('.client').autocomplete({
        source: base_url + "Commercial/autocomplet_client_commande",
    });
    $('.afficher').on('click', function(e) {
        e.preventDefault();
        let debut = $('.debut ').val();
        let fin = $('.fin').val();
        let refnum_commande = $('.refnum_commande').val();
        let client = $('.client').val();
        let links = base_url + 'Commercial/liste_suivie_commande?debut=' + debut + '&fin=' + fin + '&refnum_commande=' + refnum_commande + '&client=' + client;
        Table.ajax.url(links);
        Table.ajax.reload();
    });
});