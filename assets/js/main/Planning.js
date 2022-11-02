$(document).ready(function() {
    $.post(base_url + "Planning/page", { page: "JOB CARD" }, function(data) {
        $('.main').empty().append(data);
        $.post(base_url + "Planning/page_jobs", { page: "NON PLANNIFIER" }, function(data) {
            $('.containt-result').empty().append(data);
            //dataTableLoadNomPLa();
            Job_card();
        });

    });

    $('.btn-click').on('click', function(e) {
        e.preventDefault();
        var page = $(this).children().find('b').text();
        chargement();
        $.post(base_url + "Planning/page", { page: page }, function(data) {
            $('.main').empty().append(data);
            if (page == "STOCKS DISPONIBLES") {
                produitFini();
                closeDialog();
            } else if (page == "JOB CARD") {
                $.post(base_url + "Planning/page_jobs", { page: "NON PLANNIFIER" }, function(data) {
                    $('.containt-result').empty().append(data);
                    closeDialog();
                    //dataTableLoadNomPLa();
                    Job_card();
                });
            } else if (page == "STOCKS MATIERES PREMIERES") {
                actionMatierPremier();
                closeDialog();
            } else if (page == "RECONCILIATION") {
                reconsiliation();
                closeDialog();
            } else if (page == "ACCUEIL") {
                calandrier();
                closeDialog();
            } else {
                closeDialog();
            }
        });

    });

    function reconsiliation() {
        chargement();
        $.post(base_url + "Planning/page", { page: "RECONCILIATIONS" }, function(data) {
            $('.cont-const').empty().append(data);
            actionRecoss();
            closeDialog();
        });
        $('.btn-click-s').on('click', function(event) {
            event.preventDefault();
            chargement();
            var page = $(this).children().find('b').text();
            $.post(base_url + "Planning/page", { page: page }, function(data) {
                $('.cont-const').empty().append(data);
                if (page == "RECONCILIATIONS") {
                    actionRecoss();
                } else if (page == "PROGRESSION") {
                    progression();
                } else if (page == "VERIFICATION MATIER") {
                    verification();
                } else if (page == "QC") {
                    $('.DataTable').DataTable();
                }
                closeDialog();
            });

        });


    }

    function progression() {
        $('.DataTable').DataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            rowCallback: function(row, data) {
                $('.tbody tr>td').on('click', function(event) {
                    event.preventDefault();
                    var PO = $(this).parent().children().first().text().trim();
                    $.post(base_url + "Planning/detailPoPro", { PO: PO }, function(data) {
                        $('.cont-const').empty().append(data);
                        dataExtrusion(PO);
                    });
                });
            },
            drowCallback: function(row, data) {
                $('.tbody tr>td').on('click', function(event) {
                    event.preventDefault();
                    var PO = $(this).parent().children().first().text().trim();
                    $.post(base_url + "Planning/detailPoPro", { PO: PO }, function(data) {
                        $('.cont-const').empty().append(data);
                        dataExtrusion(PO);
                    });
                });
            },
        });
        $('.tbody tr>td').on('click', function(event) {
            event.preventDefault();
            var PO = $(this).parent().children().first().text().trim();
            $.post(base_url + "Planning/detailPoPro", { PO: PO }, function(data) {
                $('.cont-const').empty().append(data);
                dataExtrusion(PO);
            });
        });

    }

    function dataExtrusion(PO) {
        var TableDecoupeEX = $('.TableDecoupeEX').DataTable({
            processing: true,
            ajax: base_url + 'Planning/exdecoupe?PO=' + PO,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            rowCallback: function(row, data) {

            },
            initComplete: function(setting) {
                $('.tbody-TableOperateurEX td').on('click', function(event) {
                    event.preventDefault();
                    var $parent = $(this).parent().parent().attr('class').split(" ");
                    //var type = $parent.text();
                    var $type = $parent[1];
                    $.post(base_url + 'Production/formulaire', { type: $type }, function(data, textStatus, xhr) {
                        $('#exampleModalCenter .modal-body').empty().append(data);
                        $('#exampleModalCenter').modal('show');
                    });

                });
            }
        });
        var TableOperateurINPRESS = $('.TableOperateurINPRESS').DataTable({
            processing: true,
            ajax: base_url + 'Planning/extrusioninpression?PO=' + PO,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            rowCallback: function(row, data) {

            },
            initComplete: function(setting) {
                $('.tbody-TableOperateurEX td').on('click', function(event) {
                    event.preventDefault();
                    var $parent = $(this).parent().parent().attr('class').split(" ");
                    //var type = $parent.text();
                    var $type = $parent[1];
                    $.post(base_url + 'Production/formulaire', { type: $type }, function(data, textStatus, xhr) {
                        $('#exampleModalCenter .modal-body').empty().append(data);

                        $('#exampleModalCenter').modal('show');
                    });

                });
            }

        });

        tableEX = $('.TableOperateurEX').DataTable({
            processing: true,
            ajax: base_url + 'Planning/tableEX?PO=' + PO,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            rowCallback: function(row, data) {

            },
            initComplete: function(setting) {
                $('.tbody-TableOperateurEX td').on('click', function(event) {
                    event.preventDefault();
                    var $parent = $(this).parent().parent().attr('class').split(" ");
                    //var type = $parent.text();
                    var $type = $parent[1];
                    $.post(base_url + 'Production/formulaire', { type: $type }, function(data, textStatus, xhr) {
                        $('#exampleModalCenter .modal-body').empty().append(data);
                        $('#exampleModalCenter').modal('show');
                    });

                });
            }
        });
    }

    function verification() {

    }

    function actionRecoss() {
        $(".dataTable").dataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "columnDefs": [{
                "targets": [6],
                "orderable": false,

            }],
        });
        $('.tbody tr>td').on('click', function(event) {
            event.preventDefault();
            var PO = $(this).parent().children().first().text().trim();
            $.post(base_url + "Planning/detailPo", { PO: PO }, function(data) {
                $('.cont-const').empty().append(data);
                //$('.main').empty().append(data);
            });
        });
    }

    function produitFini() {

    }

    function fPurge() {

    }

    function dataTableLoadNomPLa() {

        $(".Ttab").DataTable({
            processing: true,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
        });

        $(".stock_sortie").autocomplete({
            source: base_url + "Planning/autocompleteSortie",
            appendTo: "#infoCOmmande"
        });
        $('.add-table').on('click', function(e) {
            e.preventDefault();
            if ($('.stock_sortie').val() != "" && $('.Quantite').val() != "") {
                var data = $('.stock_sortie').val().split("|");
                var i = 1;
                if (typeof($('.tbody-modaltable > tr').html()) == 'undefined') {
                    $('.tbody-modaltable').append('<tr><td>' + i +
                        '</td><td>' + data[0].trim() + '</td>' +
                        '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('.Quantite').val() +
                        '"></td><td class="text-center">' + data[1].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>');
                    $('.stock_sortie').val("");
                    $('.Quantite').val("");
                    deleteTd();
                } else {
                    var table = [];
                    $('.tbody-modaltable > tr').each(function() {
                        table.push($(this).children().eq(1).text());
                    });

                    if ($.inArray(data, table) != -1) {
                        alertMessage("Ooops!!", "Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.", 'error', 'btn btn-danger');
                    } else {
                        i++;
                        $('.tbody-modaltable').append('<tr><td>' + i +
                            '</td><td>' + data[0].trim() + '</td>' +
                            '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('.Quantite').val() +
                            '"></td><td class="text-center">' + data[1].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                            '</td></tr>');
                        $('.stock_sortie').val("");
                        $('.Quantite').val("");
                        deleteTd();

                    }

                }
            } else {
                alertMessage("Ooops!!", "Champs designation et Champs Quantite obligatoire", 'error', 'btn btn-danger');
            }
        });

        $('.date_prod').on('change', function(event) {
            event.preventDefault();
            var date = $(this).val();
            var poids = $('.ENPRODUCTION').val();
            var machine = $('.DJ_MACHINE option:selected').val();
            var processus = $('.BC_STATUT option:selected').val();

            if (poids != "") {
                $.post(base_url + 'Planning/calculePlanning', { poids: poids, date: date, machine: machine, BC_STATUT: processus }, function(data) {
                    if (data.message == "true") {
                        $('.heure').val(data.dure);
                        $('.hdeb').val(data.hdeb);
                        $('.dateFIn').val(data.dateFIn);
                        $('.heurefin').val(data.heurefin);
                        $('#infoCOmmande').modal("show");
                    } else if (data.message == "over") {
                        alertMessage("Erreur!", "Date non disponible! Veuillez choisir un autre!", "error", "btn btn-danger");
                        $('.heure').val('');
                        $('.hdeb').val('');
                        $('.dateFIn').val('');
                        $('.heurefin').val('');
                        $('.date_prod').val('');

                    } else if (data.message == "init") {
                        $('#infoCOmmande').modal("hide");
                        swal({
                            title: 'DUREE',
                            html: '',
                            content: {
                                element: "input",
                                attributes: {
                                    type: "time",
                                    id: "input-field",
                                    className: "form-control"
                                },
                            },
                            buttons: {
                                cancel: {
                                    visible: true,
                                    className: 'btn btn-danger'
                                },
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            },
                        }).then(
                            function() {
                                var hdeb = $('#input-field').val();
                                $.post(base_url + 'Planning/tempsDeProduction', { processus: processus, date: date, poids: poids, machine: machine, heure: hdeb }, function(data) {
                                    $('.heure').val(data.dure);
                                    $('.hdeb').val($('#input-field').val());
                                    $('.dateFIn').val(data.dateFIn);
                                    $('.heurefin').val(data.heurefin);
                                    $('#infoCOmmande').modal("show");
                                }, 'json');

                            }
                        );

                    } else {
                        alertMessage("Ooops!!", data.observation, 'error', 'btn btn-danger');
                        $('.heure').val('');
                        $('.hdeb').val('');
                        $('.dateFIn').val('');
                        $('.heurefin').val('');
                        $('.date_prod').val('');
                    }

                }, 'json');
            } else {
                alertMessage("Ooops!!", "Champs 'POIDS EN KG AVEC MARGE' est obligatoire", 'error', 'btn btn-danger');
            }

        });



        $('.UpdateCommande').on('click', function(e) {
            e.preventDefault();
            var JO_ID = $('.JO_ID').val();
            var BC_PE = $('.BC_PE').val().trim();
            var BC_QUANTITEAPRODUIREENMETRE = $('.BC_QUANTITEAPRODUIREENMETRE').val();
            var BC_POISENKGSAVECMARGE = $('.BC_POISENKGSAVECMARGE').val();
            var BC_DIMENSIONPROD = $('.BC_DIMENSIONPROD').val();
            var BC_ROULEAUX = $('.BC_ROULEAUX').val();
            var BC_STATUT = $('.BC_STATUT option:selected').val();
            var JO_DATE = $('.date_prod').val();
            var JO_MACHINE = $('.DJ_MACHINE').val();
            var heure = $('.heure').val();
            var hdeb = $('.hdeb').val();
            var dateFIn = $('.dateFIn').val();
            var heurefin = $('.heurefin').val();
            var date_prod = $('.date_prod').val();




            chargement();
            $('.tbody-modaltable tr').each(function(index) {
                var MU_DESIGNATION = $(this).children().eq(1).text();
                var MU_QUANTITE = $(this).children().eq(2).find("input").val();
                var MU_PRIX = $(this).children().eq(3).text();
                $.post(base_url + 'Planning/saveMartierPr', { BC_PE: BC_PE, MU_DESIGNATION: MU_DESIGNATION, MU_QUANTITE: MU_QUANTITE, MU_PRIX: MU_PRIX }, function() {

                });

            });

            $.post(base_url + 'Planning/createJobScartEtat1', { JO_DATE: JO_DATE, JO_MACHINE: JO_MACHINE, JO_ID: JO_ID, BC_PE: BC_PE.trim(), BC_QUANTITEAPRODUIREENMETRE: BC_QUANTITEAPRODUIREENMETRE, BC_POISENKGSAVECMARGE: BC_POISENKGSAVECMARGE, BC_STATUT: BC_STATUT, BC_DIMENSIONPROD: BC_DIMENSIONPROD, BC_ROULEAUX: BC_ROULEAUX }, function(data) {
                $.post(base_url + 'Planning/insertJobCart', { date_prod: date_prod, dateFIn: dateFIn, heurefin: heurefin, BC_PE: BC_PE.trim(), JO_DATE: JO_DATE, JO_MACHINE: JO_MACHINE, BC_STATUT: BC_STATUT, JO_ID: JO_ID, heure: heure, hdeb: hdeb }, function(data) {
                    $('.heure').val('');
                    $('.hdeb').val('');
                    $('.dateFIn').val('');
                    $('.heurefin').val('');
                    $('.date_prod').val('');
                    $('.tbody-modaltable tr').empty();
                    $("#infoCOmmande").modal("hide");
                    $('.BC_QUANTITEAPRODUIREENMETRE').val();
                    alertMessage("", "Job carte enregistre avec success", 'success', 'btn btn-success');
                    closeDialog();
                }, 'json');

            });

        });
        tableloade();
    }

    function dataTableLoad(page) {
        if (page == "NON PLANNIFIER") {
            var link = "Job_card";
        } else if (page == "EN PRODUCTION") {
            var link = "Job_card";
        } else if (page == "TERMINER") {
            var link = "Job_terminer";
        } else {
            var link = "Job_terminer";
        }
        var Table = $(".dataTableLite").DataTable({
            processing: true,
            ajax: base_url + 'Planning/' + link,
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            rowCallback: function(row, data) {
                if (link == "Job_card") {
                    tableloade();
                }
            },
            initComplete: function(setting) {
                if (link == "Job_card") {
                    tableloade();
                }
            },
            "drawCallback": function(settings) {
                if (link == "Job_card") {
                    tableloade();
                }

            }
        });


    }

    function tableloade() {
        $(".noplan > tr").on("click", function() {
            var $tr = $(this).children();
            var type = $(this).children().eq(5).text();

            if (type == "SACHETS") {
                $('.BC_STATUT').children().first().empty().append("EXTRUSION");
            } else {
                $('.BC_STATUT').children().first().empty().append("INJECTION");
            }
            $('.BC_PE').val($(this).children().first().text());
            var BC_QUANTITEAPRODUIREENMETRE = $(this).children().eq(13).text();
            var BC_POISENKGSAVECMARGE = $(this).children().eq(15).text();
            var BC_ROULEAUX = $tr.eq(16).text();
            var POIDSSACHET = $tr.eq(14).text();
            var BC_DIMENSIONPROD = $tr.eq(20).text();

            $.post(base_url + "Planning/lastIdJob", {}, function(data) {
                $('.JO_ID').empty().val(data);
                $('.tbody-modaltable').empty();

                $('.BC_QUANTITEAPRODUIREENMETRE').val(BC_QUANTITEAPRODUIREENMETRE);
                $('.BC_POISENKGSAVECMARGE').val(BC_POISENKGSAVECMARGE);
                $('.BC_ROULEAUX').val(BC_ROULEAUX);
                $('.POIDSSACHET').val(POIDSSACHET);
                $('.BC_DIMENSIONPROD').val(BC_DIMENSIONPROD);
                $("#infoCOmmande").modal("show");
                lasteHeure();
            });


        });
        var types = $('.BC_STATUT option:selected').val();
        $.post(base_url + 'Planning/machineModaleTable', { type: types }, function(data) {
            $('.DJ_MACHINE').empty();
            data.forEach(element => $('.DJ_MACHINE').empty().append("<option>" + element + "</option>"));
            $('.tbody-modaltable').empty();
            $('.stock_sortie').val("");
            $('.Quantite').val("");
            $('.BC_QUANTITEAPRODUIREENMETRE').val("");
            $('.BC_POISENKGSAVECMARGE').val("");
            $('.date_prod').val("");
        }, 'json');
        $('.BC_STATUT').on('change', function() {
            var types = $(this).val();
            $.post(base_url + 'Planning/machineModaleTable', { type: types }, function(data) {
                $('.DJ_MACHINE').empty();
                data.forEach(element => $('.DJ_MACHINE').append("<option>" + element + "</option>"));
            }, 'json');
        });
    }

    function lasteHeure() {
        $('.DJ_MACHINE').on('change', function() {
            var machine = $('.DJ_MACHINE option:selected').val();
            $.post(base_url + 'Planning/testHeure', { machine: machine }, function(data) {
                $('.hdeb').val(data);
            });
        });

    }

    function modaleTableDefault() {
        $(".stock_sortie").autocomplete({
            source: base_url + "Planning/autocompleteSortie",
            appendTo: "#infoCOmmande"
        });
        $('.add-table').on('click', function(e) {
            e.preventDefault();
            if ($('.stock_sortie').val() != "" && $('.Quantite').val() != "") {
                var data = $('.stock_sortie').val().split("|");
                var i = 1;
                if (typeof($('.tbody-modaltable > tr').html()) == 'undefined') {
                    $('.tbody-modaltable').append('<tr><td>' + i +
                        '</td><td>' + data[0].trim() + '</td>' +
                        '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('.Quantite').val() +
                        '"></td><td class="text-center">' + data[0].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                        '</td></tr>');
                    $('.stock_sortie').val("");
                    $('.Quantite').val("");
                    deleteTd();
                } else {
                    var table = [];
                    $('.tbody-modaltable > tr').each(function() {
                        table.push($(this).children().eq(1).text());
                    });

                    if ($.inArray(data, table) != -1) {
                        //   alertMessage("Ooops!!","Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.",'error','btn btn-danger');
                    } else {
                        i++;
                        $('.tbody-modaltable').append('<tr><td>' + i +
                            '</td><td>' + data[0] + '</td>' +
                            '<td><input type="number" class="qttable w-10 text-center" style="width:80px;" value="' + $('.Quantite').val() +
                            '"></td><td class="text-center">' + data[1].trim() + '</td><td class="text-center"><a href="#" class="delete-td text-danger"><i class="fa fa-trash"></i></a>' +
                            '</td></tr>');
                        $('.stock_sortie').val("");
                        $('.Quantite').val("");
                        deleteTd();

                    }

                }

            } else {
                alertMessage("Ooops!!", "Champs designation et Champs Quantite obligatoire", 'error', 'btn btn-danger');
            }
        });



        $('.UpdateCommande').on('click', function(e) {
            e.preventDefault();
            var JO_ID = $('.JO_ID').val();
            var BC_PE = $('.BC_PE').val();
            var BC_QUANTITEAPRODUIREENMETRE = $('.BC_QUANTITEAPRODUIREENMETRE').val();
            var BC_POISENKGSAVECMARGE = $('.BC_POISENKGSAVECMARGE').val();
            var BC_STATUT = $('.BC_STATUT option:selected').val();
            var JO_DATE = $('.date_prod').val();
            var JO_MACHINE = $('.DJ_MACHINE option:selected').val();
            var hdeb = $('.hdeb').val();
            var heure = $('.heure').val();
            var dateFIn = $('.dateFIn').val();
            var heurefin = $('.heurefin').val();
            var date_prod = $('.date_prod').val();


            chargement();
            $('.tbody-modaltable tr').each(function(index) {
                var MU_DESIGNATION = $(this).children().eq(1).text();
                var MU_QUANTITE = $(this).children().eq(3).find("input").val();
                var MU_PRIX = $(this).children().eq(2).text();
                $.post(base_url + 'Planning/saveMartierPr', { BC_PE: BC_PE, MU_DESIGNATION: MU_DESIGNATION, MU_QUANTITE: MU_QUANTITE, MU_PRIX: MU_PRIX }, function() {

                });

            });
            $.post(base_url + 'Planning/createJobScartEtat1', { JO_DATE: JO_DATE, JO_MACHINE: JO_MACHINE, JO_ID: JO_ID, BC_PE: BC_PE, BC_QUANTITEAPRODUIREENMETRE: BC_QUANTITEAPRODUIREENMETRE, BC_POISENKGSAVECMARGE: BC_POISENKGSAVECMARGE, BC_STATUT: BC_STATUT }, function(data) {
                $.post(base_url + 'Planning/insertJobCart', { date_prod: date_prod, dateFIn: dateFIn, heurefin: heurefin, BC_PE: BC_PE, JO_DATE: JO_DATE, JO_MACHINE: JO_MACHINE, BC_STATUT: BC_STATUT }, function(data) {
                    alertMessage("", "Job carte enregistre avec success", 'success', 'btn btn-success');
                    $("#infoCOmmande").modal("hide");
                    closeDialog();
                }, 'json');

            });

        });



    }

    function deleteTd() {
        $('tbody .delete-td').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }

    function proxcessuxExtrusionAction() {
        $('.UpdateExtrusion').on('click', function(event) {
            event.preventDefault();
            var BC_PE = $('.BC_PE').val();
            var BC_STATUT = $('.BC_STATUT option:selected').val();
            var BC_MACHINE = $('.DJ_MACHINE option:selected').val();
            var date = $('.date_prod').val();
            var DURE = $('.DURE').val();
            var DEBUT = $('.DEBUT').val();

            $.post(base_url + 'Planning/updateBondecommande', { DURE: DURE, DEBUT: DEBUT, date: date, BC_PE: BC_PE, BC_STATUT: BC_STATUT, BC_MACHINE: BC_MACHINE }, function(data) {
                $(".editData").modal("hide");
            });



        });

        $('.terminerPro').on('click', function(event) {
            event.preventDefault();
            var parent = $(this).parent().parent().children().eq(2).text().trim();
            swal({
                title: 'Message de confirmation',
                text: "Vous êtes sûr de vouloir terminé le processus",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Oui',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text: 'Non',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.post(base_url + 'Planning/updateJobsTerminer', { parent: parent }, function(data) {
                        swal({
                            title: 'Succè!',
                            text: 'Processus terminé.',
                            type: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    });
                } else {
                    swal.close();
                }
            });

        });
    }

    function processusExtrusion() {
        $.post(base_url + 'Planning/dataExtrusion', { param: "EXTRUSION" }, function(data) {
            $('.processus-cont').empty().append(data);
            proxcessuxExtrusionAction();
            closeDialog();
        });


        $('.linsKPro').on('click', function(event) {
            event.preventDefault();
            chargement();
            var param = $(this).text().trim();
            $.post(base_url + 'Planning/dataExtrusion', { param: param }, function(data) {
                $('.processus-cont').empty().append(data);
                proxcessuxExtrusionAction();
                closeDialog();
            });

        });

    }

    function processusInjection() {
        $.post(base_url + 'Planning/dataInjection', { param: "INJECTION" }, function(data) {
            $('.processus-cont').empty().append(data);
            closeDialog();
        });

        $('.linsKPro').on('click', function(event) {
            event.preventDefault();
            chargement();
            var param = $(this).text().trim();
            $.post(base_url + 'Planning/dataInjection', { param: param }, function(data) {
                $('.processus-cont').empty().append(data);
                proxcessuxExtrusionAction();
                closeDialog();
            });

        });

    }

    function enprod() {
        $.post(base_url + 'Planning/tableProcessus', { page: "EXTRUSION" }, function(data) {
            $('.cont-data').empty().append(data);
            processusExtrusion();
        });
        $(".linksTabs").on('click', function(event) {
            event.preventDefault();
            var page = $(this).text().trim();
            $.post(base_url + 'Planning/tableProcessus', { page: page }, function(data) {
                $('.cont-data').empty().append(data);
                if (page == "EXTRUSION") {
                    processusExtrusion();
                } else if (page == "INJECTION") {
                    processusInjection();

                }
            });

        });
    }

    function Job_card() {
        $('.btn-click-planning').on('click', function(e) {
            e.preventDefault();
            var page = $(this).children().find('b').text();
            $.post(base_url + "Planning/page_jobs", { page: page }, function(data) {
                $('.containt-result').empty().append(data);
                if (page == "EN PRODUCTION") {
                    // enprod();
                } else {
                    //dataTableLoadNomPLa();
                }

            });
        });

        $('.form-serch-machine').on('click', function(e) {
            e.preventDefault();
            var cherche = $('.form-serch-input').val();
            $.post(base_url + "Planning/TableCherche", { cherche: cherche }, function(data) {
                $('.containt-result').empty().append(data);
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
                /*$(".BC_PE").val(data.BC_PE);
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
              
  $("#infoCOmmande").modal("show");	*/
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