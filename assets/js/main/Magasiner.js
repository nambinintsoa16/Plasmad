$(document).ready(function() {
    chargement();
    $.post(base_url + "Magasiner/page", { page: "MATIERE PREMIERE" }, function(data) {
        $('.main').empty().append(data);
        matierPremier();
        closeDialog();
    });

    $('.btn-click').on('click', function(e) {
        e.preventDefault();
        chargement();
        var page = $(this).children().find('b').text();
        $.post(base_url + "Magasiner/page", { page: page }, function(data) {
            $('.main').empty().append(data);
            $('.link').text(page);
            if (page == "PRODUIT FINI") {
                produit();

            } else if (page == "MATIERE PREMIERE") {
                matierPremier();
            } else if (page == "LIVRAISON") {


            }
            closeDialog();
        });

    });

    function sortie() {
        $('.saveTransaction').on('click', function(e) {
            e.preventDefault();
            var data = [];
            var datesortie = $('.date-sortie').val();
            var reception = $('.reception').val();
            var PE = $('.PE').val();
            $('.table-sortie .tbody tr').each(function() {
                var content = {
                    'reference': $(this).find('.ref').text(),
                    'quantite': $(this).find('.qua').text()
                };
                data.push(content);
            });
            var donne = JSON.stringify(data);
            JSON.s
            $.post(base_url + 'Magasiner/saurSortie', { data: donne, date: datesortie, reception: reception, PE: PE }, function(data) {
                if (data.message == 'true') {
                    alertMessage("", "Transaction enregistre", "success", "btn btn-success");
                }
            });

        });

        $('.addItem').on('click', function(e) {
            var datesortie = $('.date-sortie').val();
            var quantite = $('.quantite').val();
            var reception = $('.reception').val();
            var PE = $('.PE').val();
            var reference = $('.reference').val();
            if (reference == "") {
                alertMessage("Oops!", "Réfernce obligatoire", "error", "btn btn-danger");
            } else if (PE == "") {
                alertMessage("Oops!", "Réfernce obligatoire", "error", "btn btn-danger");
            } else if (reception == "") {
                alertMessage("Oops!", "Réceptionnaire obligatoire", "error", "btn btn-danger");
            } else if (datesortie == "") {
                alertMessage("Oops!", "Date de sortie obligatoire", "error", "btn btn-danger");
            } else if (quantite == "") {
                alertMessage("Oops!", "Quantité obligatoire", "error", "btn btn-danger");
            } else {
                var html = "<tr><td class='ref'>" + reference + "</td><td class='qua'>" + quantite + "</td><td><a href='#' class='btn btn-danger btn-sm btn-removeItem'><i class='fa fa-trash'></i></a></td> </tr>";
                $('.table-sortie tbody').append(html);
                removeItem();

                $('.quantite').val("");
                $('.reference').val("");


            }

        });

        $('.InitItem').on('click', function(e) {
            $('.date-sortie').val("");
            $('.quantite').val("");
            $('.reception').val("");
            $('.PE').val("");
            $('.reference').val("");
        });

    }

    function removeItem() {
        $('.btn-removeItem').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

    }

    function dataTableLoad(page) {
        $('.table').dataTable({
            processing: true,
            language: {
                url: base_url + 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
            },
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

    function actionMatierPremier() {
        var table = $('.dataTable').dataTable({
            processing: true,
            ajax: "magasiner/liseteMPremierData",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "rowCallback": function(row, data) {

            },
            initComplete: function(setting) {

            },
            "drawCallback": function(settings) {

            }
        });
        $('form').on('submit', function(event) {
            event.preventDefault();
            var fd = new FormData();
            var files = $('.file')[0].files[0];
            fd.append('file', files);
            chargement();
            $.ajax({

                url: base_url + 'magasiner/update_matierPremier',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        closeDialog();
                        swal("Erreur ", "Veuillez réessayer!", {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            },
                        });
                    } else {
                        //table.ajax.reload();
                        closeDialog();

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



    }

    function sortieMPremier() {
        $.post(base_url + "Magasiner/page", { page: "SORTIE_SORTIE" }, function(data) {
            $('.contTypeAction').empty().append(data);
            cherchePo();
            $('.dataTable').dataTable();

        });
        $('.typeSortie').on('change', function(event) {
            event.preventDefault();
            var page = $(this).val().toUpperCase();
            $.post(base_url + "Magasiner/page", { page: "SORTIE_" + page }, function(data) {
                $('.contTypeAction').empty().append(data);
                $('.link').text("MATIERE PREMIERE / SORTIE MATIERE PREMIERE /" + page);
                if (page == "SORTIE MATIERE PREMIERE") {
                    sortieMPremier();
                } else if (page == "BON DE COMMANDE") {
                    cherchePo();
                    $('.dataTable').dataTable();
                } else if (page == "ECHANGE") {
                    echange();
                }
            });
        });
    }

    function echange() {
        $('.auto').autocomplete({
            source: base_url + "Magasiner/autocompleteSortie",
        });

        $('.saveEchange').on('click', function(event) {
            event.preventDefault();
            var receptQuantite = $('.receptQuantite').val();
            var receptProduit = $('.receptProduit').val();
            var recept = $('.recept option:selected').val();
            var quantiteForn = $('.quantiteForn').val();
            var produitForn = $('.produitForn').val();
            var fornisseur = $('.fornisseur option:selected').val();
            $.post(base_url + "Magasiner/echange", { fornisseur: fornisseur, produitForn: produitForn, quantiteForn: quantiteForn, receptQuantite: receptQuantite, receptProduit: receptProduit, recept: recept }, function(data) {
                if (data.type == "error") {
                    alertMessage("Erreur!", "Echange non effectué", "error", "btn btn-danger");
                } else if (data.type == "succes") {
                    $('.receptQuantite').val("");
                    $('.receptProduit').val("");
                    $('.quantiteForn').val("");
                    $('.produitForn').val("");
                    swal("Succè! ", "Echange éffectué!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });

                }
            }, 'json');
        });
    }

    function valideSortie() {
        $('.sortierMatier').on('click', function(event) {
            event.preventDefault();
            var link = base_url + $(this).attr('href');
            var po = $('.recherchePos ').val();
            var parent = $(this).parent().parent().children().first().next().text();
            var quantite = $(this).parent().parent().children().first().next().next().text();
            var prix = $(this).parent().parent().children().eq(4).text();
            swal({
                title: 'Vous-êtes sûr ?',
                text: "OUI, pour éffectuer l'opération!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'OUI',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text: 'NON',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    chargement();
                    $.post(link, { po: po, matier: parent, quantite: quantite, prix: prix }, function(data) {
                        $.post(base_url + 'magasiner/chercheMateir', { po: po }, function(datas) {
                            $('.tbody-matirUtiliser').empty().append(datas);
                            closeDialog();
                            valideSortie();
                        });
                    });
                } else {
                    swal.close();
                }
            });

        });
    }

    function matierPremier() {
        $.post(base_url + "Magasiner/page", { page: "STOCK MATIERE PREMIERE" }, function(data) {
            $('.main-matier').empty().append(data);
            actionMatierPremier();
        });


        $('.btn-click-link').on('click', function(e) {
            e.preventDefault();
            var page = $(this).children().find('b').text();
            chargement();
            $.post(base_url + "Magasiner/page", { page: page }, function(data) {
                $('.main-matier').empty().append(data);
                $('.link').text("MATIERE PREMIERE / " + page);
                if (page == "SORTIE MATIERE PREMIERE") {
                    sortieMPremier();
                } else if (page == "STOCK MATIERE PREMIERE") {
                    actionMatierPremier();
                } else if (page == "ENTREE MATIERE PREMIERE") {
                    actinApprove();
                }
                closeDialog();
            });

        });

    }

    function produit() {
        $.post(base_url + "Magasiner/page", { page: "STOCK PRODUIT FINI" }, function(data) {
            $('.main-matier').empty().append(data);
            produitFini();
        });


        $('.btn-click-link').on('click', function(e) {
            e.preventDefault();
            chargement();
            var page = $(this).children().find('b').text();
            $.post(base_url + "Magasiner/page", { page: page }, function(data) {
                $('.main-matier').empty().append(data);
                $('.link').text("MATIER PREMIER / " + page);
                if (page == "ENTREE") {
                    ENTRESTK();
                } else if (page == "STOCK MATIER PREMIER") {
                    actionMatierPremier();
                } else if (page == "SORTIE") {
                    SORTIESTK();
                } else if (page == "STOCK PRODUIT FINI") {
                    produitFini();
                }
                closeDialog();
            });

        });
    }

    function history() {

    }

    function produitFini() {

    }

    function SORTIESTK() {
        $('.auto').autocomplete({
            source: base_url + "Magasiner/autocompletSortie",
            select: function(data, iteme) {
                var param = iteme.item.value.trim();
                $.post(base_url + "Magasiner/recherchePESort", { param: param }, function(data) {
                    if (data.mesage == "false") {
                        alertMessage("Erreur", "PO Introvable", "error", "btn btn-danger");
                    } else {
                        $('.client').val(data.client);
                        $('.dim').val(data.dim);
                        $('.tail').empty();
                        data.tail.forEach(element => $('.tail').append("<option>" + element + "</option>"));
                    }
                }, 'json');
            }
        });

        $('form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: base_url + "Magasiner/savesortie",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('input').val('');
                    $('textarea').val('');
                    if (data === '1') {
                        alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                    }
                    if (data === '0') {
                        alertMessage("Erreur", "Une erreur s'est produit", "error", "btn btn-danger");
                    }

                },
                error: function() {
                    alertMessage("Erreur", "Une erreur s'est produit", "error", "btn btn-danger");
                }
            });
            /* $.post(,function(){
            	alert();
             })*/
        });
    }

    function ENTRESTK() {

    }

    function actinApprove() {
        $('.matier').autocomplete({
            source: base_url + "Magasiner/autocompleteSortie",
        });
        $('form').on('submit', function(event) {
            event.preventDefault();
            var designation = $('.designation').val();
            var quantite = $('.quantite').val();
            var date = $('.date').val();
            var forniseur = $('.forniseur').val();
            var reference = $('.reference').val();
            var type = $('.type option:selected').val();
            $.post(base_url + "Magasiner/saveApprove", { reference: reference, designation: designation, type: type, quantite: quantite, date: date, forniseur: forniseur }, function(data) {
                if (data.type == "error") {
                    alertMessage("Erreur!", "Approvisionement non effectué", "error", "btn btn-danger")
                } else if (data.type == "succes") {
                    alertMessage("Succè!", "Approvisionement effectué", "success", "btn btn-success");
                    $('.designation').val("");
                    $('.quantite').val("");
                    $('.date').val("");

                    $('.forniseur').val("");
                    $('.reference').val("");
                }
            }, 'json');
        });

    }

    function cherchePo() {
        $('.recherchePos').autocomplete({
            source: base_url + "Magasiner/autocompletPo",
        });

        $('.recherchePosBtn').on('click', function(event) {
            event.preventDefault();
            var po = $('.recherchePos').val();
            chargement();
            $.post(base_url + 'magasiner/chercheMateir', { po: po }, function(data) {
                $('.contentInfo').empty().append(data);
                closeDialog();
            });
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