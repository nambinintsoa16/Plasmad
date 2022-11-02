$('document').ready(function() {
    $.post(base_url + "Commerciale/page", { page: "BON DE COMMANDE" }, function(data) {
        $('.main').empty().append(data);
        saveCommande();

    });

    $('.btn-click').on('click', function(e) {
        e.preventDefault();
        var page = $(this).children().find('b').text();
        chargement();
        $.post(base_url + "Commerciale/page", { page: page }, function(data) {
            $('.main').empty().append(data);
            if (page == "MES COMMANDES") {
                if (dataTableLoad(page)) {
                    recherche();
                }
                closeDialog();
            } else if (page == "MES PRE COSTING") {
                dataTableLoadPre();
                closeDialog();
            } else if (page == "ACCUEIL") {
                chart();
                closeDialog();
            } else if (page == "PRE COSTING") {
                savePrecosting();
                closeDialog();
            } else if (page == "STOCK DISPONIBLE") {

                closeDialog();
            } else if (page == "STOCK MATIERE") {
                actionMatierPremier();
                closeDialog();
            } else if (page == "CALENDRIER DE LIVRAISON") {
                closeDialog();
            } else if (page == "SUIVIE COMMANDE") {
                closeDialog();

            } else {
                saveCommande();
                closeDialog();
            }
        });

    });



    function alertClick() {
        $('.delete_post').on('click', function(e) {
            e.preventDefault();
        });
    }

    function stock_Final() {
        Table = $(".dataTable").DataTable({
            processing: true,
            ajax: base_url + "Commerciale/stockfinal",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "columnDefs": [{
                "targets": [6],
                "orderable": false,

            }],
            "rowCallback": function(row, data) {
                dataAction();
            },
            initComplete: function(setting) {
                dataAction();
            },
            "drawCallback": function(settings) {
                dataAction();
            }
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




    }


    function dataTableLoad(page, type = null) {
        if (page == "MES COMMANDES") {
            var link = base_url + 'Commerciale/MES_COMMANDES';
        } else if (page == "MES PRE COSTING") {
            var link = base_url + 'Commerciale/precosting';
        } else {
            var link = base_url + 'Commerciale';
        }



        if (type != null) {
            link = link + "/" + type;
        }

        Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax: link,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "columnDefs": [{
                "targets": [6],
                "orderable": false,

            }],
            "rowCallback": function(row, data) {
                dataAction();
            },
            initComplete: function(setting) {
                dataAction();
            },
            "drawCallback": function(settings) {
                dataAction();
            }
        });

        $('.recherche').on('click', function(event) {
            event.preventDefault();
            var anneliste = $('#anneliste option:selected').text();
            var moisliste = $('#moisliste option:selected').val();
            var type = $('.checked').attr('id');
            var debut = $('.debut').val();
            var fin = $('.fin').val();
            var links = base_url + "Commerciale/commandeSpecifique/" + type + "/" + anneliste + "/" + moisliste + "/" + debut + "/" + fin;
            Table.ajax.url(links);
            Table.ajax.reload();

        });
        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).attr('id') == "TOUT") {
                var links = base_url + "Commerciale/MES_COMMANDES/";
                Table.ajax.url(links);
                Table.ajax.reload();
            } else {
                var links = base_url + "Commerciale/commandeSpecifique/" + $(this).attr('id');
                Table.ajax.url(links);
                Table.ajax.reload();
            }
        });


    }


    function dataTableLoadPre() {

        var link = base_url + 'Commerciale/precosting';
        Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax: link,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "columnDefs": [{
                "targets": [6],
                "orderable": false,

            }],
            "rowCallback": function(row, data) {
                dataAction();
            },
            initComplete: function(setting) {
                dataAction();
            },
            "drawCallback": function(settings) {
                dataAction();
            }
        });

        $('.recherche').on('click', function(event) {
            event.preventDefault();
            var anneliste = $('#anneliste option:selected').text();
            var moisliste = $('#moisliste option:selected').val();
            var type = $('.checked').attr('id');
            var links = base_url + "Commerciale/PrecommandeSpecifique/" + type + "/" + anneliste + "/" + moisliste;
            Table.ajax.url(links);
            Table.ajax.reload();
        });



        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).attr('id') == "TOUT") {
                var links = base_url + "Commerciale/precosting/";
                Table.ajax.url(links);
                Table.ajax.reload();
            } else {
                var links = base_url + "Commerciale/PrecommandeSpecifique/" + $(this).attr('id');
                Table.ajax.url(links);
                Table.ajax.reload();
            }
        });


    }

    function dataAction() {

        $(".delete_post").on("click", function(e) {
            e.preventDefault();
            $(".npe").empty().append($(this).attr("id"));
            $("#exampleModalCenter").modal("show");
        });
        $(".valideAnnull").on("focus", function(e) {
            $("textarea").removeClass("border border-danger");
        });
        $(".valideAnnull").on("click", function(e) {
            e.preventDefault();
            var text = $("textarea").val();
            var pe = $(".npe").text();
            if (text == "") {
                $("textarea").addClass("border border-danger");
            } else {
                $.post(base_url + "Commerciale/annuleBonDeCommande", { pe: pe, text: text }, function() {
                    $("#exampleModalCenter").modal("hide");
                    $("textarea").val("");
                    Table.ajax.reload();
                });
            }
        });
        $(".edit_post").on("click", function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var pe = parent.children().first().text();
            $.post(base_url + "Commerciale/detailPE", { pe: pe }, function(data) {
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
                $(".BC_TYPE option:selected").val(data.BC_TYPE);
                $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
                $(".BC_QUNTITE").val(data.BC_QUNTITE);
                $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
                $(".BC_PRIX").val(data.BC_PRIX);
                $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
                $(".BC_LIEULIVRE").val(data.BC_LIEULIVRE);
                $('.imprimerprecosting').attr('href', base_url + 'Commerciale/printcosting?po=' + data.BC_PE);
                $('.imprimer').attr('href', base_url + 'Commerciale/printFacture?po=' + data.BC_PE);
                $("#infoCOmmande").modal("show");
            }, "json");
        });

        $(".removeModal").on("click", function() {
            $("#infoCOmmande").modal("hide");
        });
        $('.migre_post').on('click', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            chargement();
            $.post(base_url + 'Commerciale/migreBon', { id: id }, function(data) {
                closeDialog()
                Table.ajax.reload();
                alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");

            }, 'json');
        });

        $(".UpdateCommande").on("click", function(e) {
            e.preventDefault();
            var BC_PE = $(".BC_PE").val();
            var BC_CLIENT = $(".BC_CLIENT").val();
            var BC_CODE = $(".BC_CODE").val();
            var BC_DATELIVRE = $(".BC_DATELIVRE").val();
            var BC_REASSORT = $(".BC_REASSORT").val();
            var BC_ECHANTILLON = $(".BC_ECHANTILLON").val();
            var BC_DIMENSION = $(".BC_DIMENSION").val();
            var BC_RABAT = $(".BC_RABAT").val();
            var BC_SOUFFLET = $(".BC_SOUFFLET").val();
            var BC_PERFORATION = $(".BC_PERFORATION").val();
            var BC_TYPE = $(".BC_TYPE option:selected").val();
            var BC_IMPRESSION = $(".BC_IMPRESSION").val();
            var BC_CYLINDRE = $(".BC_CYLINDRE").val();
            var BC_QUNTITE = $(".BC_QUNTITE").val();
            var BC_TYPEPRODUIT = $(".BC_TYPEPRODUIT option:selected").val();
            var BC_TYPEMATIER = $(".BC_TYPEMATIER option:selected").val();
            var BC_PRIX = $(".BC_PRIX").val();
            var BC_OBSERVATION = $(".BC_OBSERVATION").val();
            var data = new Array();
            data[1] = BC_CYLINDRE;
            data[2] = BC_QUNTITE;
            data[3] = BC_PRIX;
            data[4] = BC_OBSERVATION;
            data[5] = BC_SOUFFLET;
            data[6] = BC_PERFORATION;
            data[7] = BC_TYPE;
            data[8] = BC_IMPRESSION;
            data[9] = BC_REASSORT;
            data[10] = BC_ECHANTILLON;
            data[11] = BC_DIMENSION;
            data[12] = BC_RABAT;
            data[13] = BC_PE;
            data[14] = BC_CLIENT;
            data[15] = BC_CODE;
            data[16] = BC_DATELIVRE;
            data[17] = BC_TYPEPRODUIT;
            data[18] = BC_TYPEMATIER;
            var content = JSON.stringify(data);

            $.post(base_url + "Commerciale/upadatePeCom", { content: content }, function() {
                $("#infoCOmmande").modal("hide");
                Table.ajax.reload();
            });


        });
    }

    function chart() {
        $.post(base_url + "Commerciale/countCommandeLIvre", function(data) {
            Circles.create({
                id: 'circles-2',
                radius: 45,
                value: 100,
                maxValue: 100,
                width: 7,
                text: data,
                colors: ['#f1f1f1', '#2BB930'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            });

        });

        $.post(base_url + "Commerciale/countCommande", function(data) {

            Circles.create({
                id: 'circles-4',
                radius: 45,
                value: 100,
                maxValue: 100,
                width: 7,
                text: data,
                colors: ['#f1f1f1', '#2BB930'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            });

        });



        $.post(base_url + "Commerciale/countCommandePlan", function(data) {
            Circles.create({
                id: 'circles-1',
                radius: 45,
                value: data.value,
                maxValue: 100,
                width: 7,
                text: data.text,
                colors: ['#f1f1f1', '#FF9E27'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })


        }, 'json');


        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 0,
            maxValue: 100,
            width: 7,
            text: 0,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        });
    }

    function savePrecosting() {
        $('.saveCommande').on('click', function(e) {
            e.preventDefault();

            var BC_CLIENT = $('.BC_CLIENT').val();
            var BC_CODE = $('.BC_CODE').val();
            var BC_DATELIVRE = $('.BC_DATELIVRE').val();
            var BC_REASSORT = $('.BC_REASSORT').val();
            var BC_ECHANTILLON = $('.BC_ECHANTILLON').val();
            var BC_DIMENSION = $('.BC_DIMENSION').val();
            var BC_RABAT = $('.BC_RABAT').val();
            var BC_SOUFFLET = $('.BC_SOUFFLET').val();
            var BC_PERFORATION = $('.BC_PERFORATION').val();
            var BC_TYPE = $('.BC_TYPE option:selected').val();
            var BC_IMPRESSION = $('.BC_IMPRESSION').val();
            var BC_CYLINDRE = $('.BC_CYLINDRE').val();
            var BC_TYPE_PRODUIT = $('.BC_TYPE_PRODUIT').val();
            var BC_LIEULIVRE = $('.BC_LIEULIVRE').val();
            var BC_QUNTITE = $('.BC_QUNTITE').val();
            var BC_PRIX = $('.BC_PRIX').val();
            var BC_TYPEPRODUIT = $('.BC_TYPEPRODUIT option:selected').val();
            var BC_TYPEMATIER = $('.BC_TYPEMATIER option:selected').val();

            var BC_OBSERVATION = $('.BC_OBSERVATION').val();
            var data = new Array();
            data[1] = BC_CYLINDRE;
            data[2] = BC_QUNTITE;
            data[3] = BC_PRIX;
            data[4] = BC_OBSERVATION;
            data[5] = BC_SOUFFLET;
            data[6] = BC_PERFORATION;
            data[7] = BC_TYPE;
            data[8] = BC_IMPRESSION;
            data[9] = BC_REASSORT;
            data[10] = BC_ECHANTILLON;
            data[11] = BC_DIMENSION;
            data[12] = BC_RABAT;
            data[14] = BC_CLIENT;
            data[15] = BC_CODE;
            data[16] = BC_DATELIVRE;
            data[17] = BC_TYPEPRODUIT;
            data[18] = BC_TYPEMATIER;
            data[19] = BC_TYPE_PRODUIT;
            data[20] = BC_LIEULIVRE;
            var content = JSON.stringify(data);
            if (BC_CLIENT == "" || BC_CODE == "" || BC_DATELIVRE == "" || BC_REASSORT == "" || BC_ECHANTILLON == "" || BC_DIMENSION == "" || BC_RABAT == "" || BC_SOUFFLET == "" || BC_PERFORATION == "" || BC_TYPE == "" || BC_IMPRESSION == "" || BC_CYLINDRE == "" || BC_QUNTITE == "" || BC_TYPEPRODUIT == "" || BC_TYPEMATIER == "" || BC_PRIX == "" || BC_OBSERVATION == "") {
                alertMessage("Erreur!", "Tous les champs sont obligatoire.", "error", "btn btn-danger");
            } else {
                chargement();
                $.post(base_url + "Commerciale/savePrecosting", { content: content }, function(datas) {
                    $('.jconfirm').remove();
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        buttons: {
                            confirm: {
                                text: 'Oui',
                                className: 'btn btn-success'
                            },
                            cancel: {
                                visible: true,
                                className: 'btn btn-danger'
                            }
                        }
                    }).then((Delete) => {
                        if (Delete) {
                            $.post(base_url +'Commerciale/printFacture', function() {
                                alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
                            });
                        } else {
                            alertMessage("Succè!", "Bon de commande enregistré.", "success", "btn btn-success");
                        }
                    });

                    $('.BC_CLIENT').val("");
                    $('.BC_CODE').val("");
                    $('.BC_DATELIVRE').val("");
                    $('.BC_REASSORT').val("");
                    $('.BC_ECHANTILLON').val("");
                    $('.BC_DIMENSION').val("");
                    $('.BC_RABAT').val("");
                    $('.BC_SOUFFLET').val("");
                    $('.BC_PERFORATION').val("");
                    $('.BC_IMPRESSION').val("");
                    $('.BC_CYLINDRE').val("");
                    $('.BC_QUNTITE').val("");
                    $('.BC_PRIX').val("");
                    $('.BC_OBSERVATION').val("");


                    $('.QttMetre').val("");
                    $('.poidSachet').val("");
                    $('.poidMarge').val("");
                    $('.rollDim').val("");
                    $('.NROULEAUX').val("");



                }, 'json');
            }
        });

        $('.BC_TYPEMATIER').on('change', function(e) {
            e.preventDefault();
            var type = $('.BC_TYPEMATIER option:selected').val();
            $.post(base_url + 'Commerciale/numBon', { type: type }, function(data) {
                $('.titlePO').text($type + " N°");
                if (type == 'HDPE') {
                    $('.BC_PE').val('PE' + data);
                } else {
                    $('.BC_PE').val($type + data);
                }

            }, 'json');

        });
        $('.BC_PRIX').on('click', function(e) {
            e.preventDefault();
            $(this).val("");
            $('.width').val("");
            $('.length').val("");
            $('.thickness').val("");
            $('.Flap').val("");
            $('.Gusset').val("");
            $('.Order').val("");
            $('.total').val("");
            $('.marge').val("");
            $(".marges").val("");
            $('.prix').val("");
            $('.prixdefault').val("");
            $('.PrixCalc').modal('show');

        });



    }

    function produitFini() {
        $(".tableProduitFini").dataTable({
            processing: true,
            ajax: base_url + "Magasiner/dataProduitFini",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "columnDefs": [{
                "targets": [6],
                "orderable": false,

            }],
            "rowCallback": function(row, data) {

            },
            initComplete: function(setting) {

            },
            "drawCallback": function(settings) {

            }
        });
    }

    function saveCommande() {

        CKEDITOR.replace('BC_OBSERVATION');

    }





    /* $('.roll_Dimenison').val(roll_Dimenison);
    $('.Raw').val(raw);
    $('.weightPc').val(weightPc);
    $('.Yeild').val(Yeild);
    $('.Scrap').val(Scrap);
    $('.Total_Mat').val(Total_Mat);
    $('.Total_yeild').val(Total_yeild);
    $('.manfact').empty().append(Order);
    $('.Des').val("MATIERES LDPE");
    $('.QTE').val(Total_Mat);
    $('.UNITE').val("KG");
    $('.CU').val("");

    removeTable();*/


    $('.Des').autocomplete({
        source: base_url + "Commerciale/autocompleteMatier",
        appendTo: "#infoCOmmandes",
        select: function(request, response) {
            $.post(base_url + 'Commerciale/retourProduit', { param: response.item['label'] }, function(data) {
                if (data.message === "true") {
                    $('.CU').val(data.prix);
                    $('.Des').dal(data.designation)
                } else {
                    alertMessage("Erreur", "Une ", "error", "btn btn-danger");
                }

            }, 'json');
        }
    });

    $('.addTab').on('click', function(event) {
        event.preventDefault();
        var Des = $('.Des').val();
        var QTE = $('.QTE').val();
        var UNITE = $('.UNITE').val();
        var CU = $('.CU').val();
        var html = "<tr><td>" + Des + "</td><td>" + QTE + "</td><td>" + UNITE + "</td><td>" + CU + "</td><td>" + QTE * CU + "</td><td><a href='#' class='btn btn-danger btn-sm deleteTd'><i class='fa fa-trash'></i></a></td></tr>";
        $('.Des').val("");
        $('.QTE').val("");
        $('.UNITE').val("");
        $('.CU').val("");
        $('.tbody-prix').append(html);
        removeTable();

    });

    function removeTable() {
        $('.deleteTd').on('click', function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
        });
    }

    $('.calcule').on('click', function(event) {
        event.preventDefault();
        var total = 0;
        $('.tbody-prix > tr').each(function() {
            var cont = $(this).children().eq(4).text();
            total += cont;
        });
        var manfact = $('.manfact').text();
        var totaltab = total / manfact;
        var pource = $('.datamage').text();
        var marge = (totaltab * parseInt(pource)) / 100;
        $('.tabTotal').empty().append(total);
        $('.totaltab').empty().append(totaltab);
        $('.marge').empty().append(marge);

    });



    function listeCommande() {
        Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax: base_url + 'Utilisateur/dataListe',
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/French.json'
            },
            "columnDefs": [{
                "targets": [0, 3, 4],
                "orderable": false,
            }, ],
            rowCallback: function(row, data) {
                /*  $('.delete_post').on('click',function(e){
                    e.preventDefault();
        
                });*/
            }

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