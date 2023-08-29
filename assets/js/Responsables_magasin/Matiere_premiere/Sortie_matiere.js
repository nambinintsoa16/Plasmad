$(document).ready(function() {

    $("#autocomplete_produit_finis").autocomplete({
        source: base_url + "commercial/autocomplet_commande",

    });
    $('#autocomplete_machine').autocomplete({
        source: base_url + "Stock/autocomplete_machine"
    });
    $('#matiere_designation').autocomplete({
        source: base_url + "stock/autocomplete_matiere_sortie_magasin",
        select: function(event, items) {
            event.preventDefault();
            let select_item = items.item.value.split(" | ");
            $('#refmum_matiere').val(select_item[0]);
            $(this).val(select_item[1] + " | " + select_item[2]);
        }
    });

    $('#add-table').on('click', function(e) {
        e.preventDefault();
        let refnum_matiere = $('#autocomplete_produit_finis').val();
        let refnum = $('#refmum_matiere').val();
        let machine = $('#autocomplete_machine').val();
        if (refnum_matiere == "") {
            alertMessage("Erreur!", "Refnum PO introvable.", 'error', 'btn btn-danger');

        } else {
            if ($('#matiere_designation').val() != "" && $('#quantite_matiere').val() != "") {
                let data = $('#matiere_designation').val().split("|");
                let i = 1;
                if (typeof($('#table_content > tr').html()) == 'undefined') {
                    $('#table_content').append('<tr><td>' + refnum + '</td><td>' + machine + '</td><td>' + refnum_matiere + '</td><td>' + data[0].trim() + '</td>' +
                        '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('#quantite_matiere').val() +
                        '"></td><td>' + i +
                        '</td><td class="text-center">' + data[1].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>');
                    $('#matiere_designation').val("");
                    $('#quantite_matiere').val("");
                    deleteTd();

                } else {
                    let table = [];
                    $('#table_content > tr').each(function() {
                        table.push($(this).children().eq(1).text());
                    });

                    if ($.inArray(data, table) != -1) {
                        alertMessage("Ooops!!", "Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.", 'error', 'btn btn-danger');
                    } else {
                        i++;
                        $('#table_content').append('<tr><td>' + refnum + '</td><td>' + machine + '</td><td>' + refnum_matiere + '</td><td>' + data[0].trim() + '</td>' +
                            '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('#quantite_matiere').val() +
                            '"></td><td>' + i +
                            '</td><td class="text-center">' + data[1].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                            '</td></tr>');
                        $('#matiere_designation').val("");
                        $('#quantite_matiere').val("");
                        deleteTd();

                    }

                }
            } else {
                alertMessage("Erreur!", "Champs designation et Champs Quantite obligatoire", 'error', 'btn btn-danger');
            }
        }
    });

    function deleteTd() {
        $('#table_content .delete-td').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
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

    $('#save_demande_validation').on('click', function(e) {
        e.preventDefault();
        var i = 0;
        $('#table_content > tr').each(function() {
            i++;
        });
        let refnum_matiere = $('#autocomplete_produit_finis').val();
        let machine = $('#autocomplete_machine').val();
        $('#table_content > tr').each(function() {
            i--;
            let refnum = $(this).children().eq(0).text();
            var reference = $(this).children().eq(2).text();
            var article = $(this).children().eq(3).text();
            var quantite = $(this).children().eq(4).find('input').val();
            var prix = $(this).children().eq(6).text();

            $.post(base_url + "stock/sauve_sortie_matier_a_valider", { machine, refnum_matiere, refnum, article, quantite, prix, reference }, function() {
                if (i == 0) {
                    alertMessage("Succè!", "Sortie enregistrée avec succè", 'success', 'btn btn-success');
                    $('#table_content').empty();
                    $('input').val('');
                }
            });
        });



    });

    $('#show_info_planning').on('click', function(event) {
        event.preventDefault();
        let refnum = $("#autocomplete_produit_finis").val();
        chargement();
        $.post(base_url + 'stock/get_matiere_use', { refnum }, function(data) {
            $('.contentInfo').empty().append(data);
            closeDialog();
        });
    });

    $('#show_refnum_info').on('click', function(event) {
        event.preventDefault();
        let refnum = $("#autocomplete_produit_finis").val();
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
            $("#modal_refnum_detail").modal("show");
        }, "json");
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
});