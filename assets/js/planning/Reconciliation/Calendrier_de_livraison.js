$(document).ready(function() {
    table = $('#table_show_data').DataTable({
        processing: true,
        ajax: base_url + "Planning/get_liste_livraison",
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

        }, ]

    });
    $('#refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });


    $('#afficher_result').on('click', function(e) {
        e.preventDefault();
        let date = $('#date_de_sortie').val();
        let refnum = $('#refnum_commande').val();
        let links = base_url + "Planning/get_liste_livraison?date=" + date + "&refnum=" + refnum;
        $('.export').attr('href', base_url + "Planning/printLivraison?date=" + date);
        table.ajax.url(links);
        table.ajax.reload();
    });



    $('#save_data').on('click', function(e) {
        e.preventDefault();
        let date = $('#date_de_sortie').val();
        let refnum = $('#refnum_commande').val();
        let quantite = $('#quantite').val();
        let methodOk = false;
        methodOk = date != "" && refnum != "" && quantite != "";
        if (methodOk == false) {
            swal("Erreure!", "Date ,qauntitè ou Po non valide.", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });

        }
        if (methodOk) {
            $.post(base_url + 'Planning/add_new_livraison', { date, refnum, quantite }, function() {
                $('input').val('');
                table.ajax.reload();
                swal("Succè !", "Date de livraison enregistré.", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                });
            });
        }
    });
});