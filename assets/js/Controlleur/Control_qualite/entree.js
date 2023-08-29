$(document).ready(function() {
    table = $('#table_control_qualite').DataTable({
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        rowCallback: function(row, data) {
            delete_data_select()
        },
        drawCallback: function(settings) {
            delete_data_select()
        },
        initComplete: function(setting) {
            delete_data_select()
        },
    });
    $('#operateur').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $('#refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        select: function(ui, iteme) {
            var refnum_pe = iteme.item.value.trim();
            table.ajax.url(base_url + "surplus/data_liste_controle_qualite?refnum=" + refnum_pe);
            table.ajax.reload();
        }

    });

    $('.dateAffiche').on('click', function(e) {
        e.preventDefault();
        var debut = $('.rechDate').val();
        table.ajax.url(base_url + "surplus/data_liste_controle_qualite?debut=" + debut);
        table.ajax.reload();
    });

    function delete_data_select() {
        $(".delete_select").on('click', function(e) {
            e.preventDefault();
            var $this = $(this).parent().parent();
            chargement();
            var refnum = $(this).attr('id');
            $.post(base_url + "surplus/delete_select_controle_qualite", {
                refnum
            }, function(data) {
                table.ajax.url(base_url + "surplus/data_liste_controle_qualite?refnum=" + data);
                table.ajax.reload();
                alertMessage("Succè", "Element supprimer.", "success", "btn btn-success");

                closeDialog();
            });

        });
    }



    $('#deuxieme_choix, #qtt_entre').on('keyup', function() {
        var entre = $('#qtt_entre').val();
        var qtts = $('#deuxieme_choix').val();
        $('#qtt_stie').val(entre - qtts);
    });


    $('#save_entree_control_quality').on('click', function(event) {
        event.preventDefault();
        chargement();
        let refnum_pe = $('#refnum_commande').val();
        var qtt_entre = $('#qtt_entre').val();
        var deuxieme_choix = $('#deuxieme_choix').val();
        var qtt_stie = $('#qtt_stie').val();
        var operateur = $('#operateur').val();
        let poid_entree = $('#poid_entree').val();
        $.post(base_url + 'surplus/save_controle_qualite', { poid_entree, refnum_pe, qtt_entre, deuxieme_choix, qtt_stie, operateur }, function(data) {
            table.ajax.url(base_url + "surplus/data_liste_controle_qualite?refnum=" + refnum_pe);
            table.ajax.reload();
            $('input').val('');
            closeDialog();
            alertMessage("Succè!", "Enregistrement reussie.", "success", "btn btn-success");
        });


    })

    function chargement() {
        var htmls = '<style> .spinner div{background-color:#6861ce;}</style><div class="text-center" style="font-size:14px;color:#6861ce;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner color-secondary"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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