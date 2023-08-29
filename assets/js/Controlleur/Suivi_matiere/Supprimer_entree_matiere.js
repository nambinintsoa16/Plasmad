$(document).ready(function() {

    table = $('#dataTable_entree_matiere').DataTable({
        processing: true,
        ajax: base_url + "Controlleur/entree_matiere_liste_data",
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
        "drawCallback": function(settings) {
            delete_function();
        }
       
           
    });
    function delete_function() {
        $(".delete_matiere").on('click', function(event) {
            event.preventDefault();
            let refnum = $(this).attr('id');
            $.post(base_url + "controlleur/delete_entree_matieree", { refnum }, function() {

            }).done(() => {
                table.ajax.reload();
                alertMessage("Succès!", "Entrée supprimer.", "success", "btn btn-success");
            }).fail(() => {
                alertMessage("Erreur!", "Erreur veuillez reéssayer.", "error", "btn btn-danger");
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
    $('#check_cherche').on('click', function(event) {
        event.preventDefault();
        let date_de_debut = $('#date_de_bedut').val();
        let date_fin = $('#date_fin').val();
        let link = base_url + "Comptabilite/entree_matiere_liste_data";
        let methodOk = date_de_debut != "" && date_fin != "";

        if (methodOk) {
            $('#btn-export').attr('href', base_url + 'Comptabilite/export_entree_stock_matiere?date_de_debut=' + date_de_debut + '&date_fin=' + date_fin)
            link = base_url + "Comptabilite/entree_matiere_liste_data?date_de_debut=" + date_de_debut + "&date_fin=" + date_fin;
        }

        if (!methodOk) {
            methodOk = date_de_debut != "";
            if (methodOk) {
                $('#btn-export').attr('href', base_url + 'Comptabilite/export_entree_stock_matiere?date_de_debut=' + date_de_debut)
                link = base_url + "Comptabilite/entree_matiere_liste_data?date_de_debut=" + date_de_debut;
            }
        }

        table.ajax.url(link);
        table.ajax.reload();
    })
})