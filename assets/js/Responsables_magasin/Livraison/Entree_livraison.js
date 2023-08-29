$(document).ready(function() {
    table = $('#data_sortie').DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
    });
    $('#refnum_commande').autocomplete({
        source: base_url + "stock/autocomplete_produit_plasmad",
        select: function(data, iteme) {
            let refnum_pe = iteme.item.value.trim();
            $.post(base_url + "stock/detail_commande_livraison", { refnum_pe }, function(data) {
                if (data.mesage == "false") {
                    alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                } else {
                    $('.client').val(data.client);
                    $('.dim').val(data.dim);
                    $('.code').val(data.code);
                    $('.tail').empty();
                    $('.quantite').val(data.quantite);
                    $('.reste').val(data.reste);
                    $('.livre').val(data.sortie);
                    data.tail.forEach(element => $('.tail').append("<option>" + element.tail + "</option>"));
                    table.ajax.url(base_url + "stock/data_liste_sortie_surplus_livraison?refnum=" + refnum_pe);
                    table.ajax.reload();
                }
            }, 'json');
        }
    });

    $('.surplus').autocomplete({
        source: base_url + "stock/autocomplete_produit_surplus",
        select: function(data, iteme) {
            let refnum = iteme.item.value.trim();
            $.post(base_url + "stock/taille_produit_surplus", { refnum }, function(data) {
                if (data.mesage == "false") {
                    alertMessage("Erreur!", "Commande introvable.", "error", "btn btn-danger");
                } else {
                    $('#tail_suplus').empty();
                    data.tail.forEach(element => $('#tail_suplus').append("<option>" + element.tail + "</option>"));
                }
            }, 'json');
        }
    });
    $('#save_sortie').on('click', function(event) {
        event.preventDefault();
        var refnum = $('#refnum_commande').val();
        var quantite_sortie = $('.sortie').val();
        var tail = $('.tail option:selected').val();
        var date_entre = $('.date_entre').val();
        var BL = $('.BL').val();
        var obs = $('.obs').val();
        var refnum_surplus = $('.surplus').val();
        var tail_suplus = $('#tail_suplus option:selected').val();
        var quantite_surplus = $('.quantitesuplus').val();
        if (date_entre == "") {
            alertMessage("Erreur!", "Date de sortie obligatoire.", "error", "btn btn-danger");
        } else if (quantite_sortie == "" && quantite_surplus == "") {
            alertMessage("Erreur!", "Quantité à sortir obligatoire.", "error", "btn btn-danger");
        } else if (BL == "") {
            alertMessage("Erreur!", "N° BL obligatoire.", "error", "btn btn-danger");
        } else {

            if (quantite_sortie != "") {
                $.post(base_url + "stock/sortie_produit_fini", { refnum, tail, quantite_sortie, date_entre, BL, obs }, function() {
                    if (quantite_surplus != "") {
                        $.post(base_url + 'stock/sortie_suplus_fini', { tail_suplus, refnum, quantite_surplus, refnum_surplus, date_entre, BL, obs }, function() {
                            alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                            $('input, .obs').val('');
                            table.clear();
                            table.destroy();
                            table = $('#data_sortie').DataTable({
                                processing: true,
                                language: {
                                    url: base_url + "assets/dataTableFr/french.json",
                                },
                            });

                        });
                    } else {
                        alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                        $('input, .obs').val('');
                        table.clear();
                        table.destroy();
                        table = $('#data_sortie').DataTable({
                            processing: true,
                            language: {
                                url: base_url + "assets/dataTableFr/french.json",
                            },
                        });


                    }

                });
            } else {
                if (quantite_surplus != "") {
                    $.post(base_url + 'stock/sortie_suplus_fini', { tail_suplus, refnum, quantite_surplus, refnum_surplus, date_entre, BL, obs }, function() {
                        alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                        $('input, .obs').val('');
                        table.clear();
                        table.destroy();
                        table = $('#data_sortie').DataTable({
                            processing: true,
                            language: {
                                url: base_url + "assets/dataTableFr/french.json",
                            },
                        });


                    });
                } else {
                    alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                    $('input').val('');
                    table.clear();
                    table.destroy();
                    table = $('#data_sortie').DataTable({
                        processing: true,
                        language: {
                            url: base_url + "assets/dataTableFr/french.json",
                        },
                    });

                }

            }
        }


    });


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