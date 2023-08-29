$(document).ready(function() {
    $(".dataTable").each(function(index) {
        table = "";
        let current_element = $(this).attr("id");
        table = $("#" + current_element).DataTable({
            processing: true,
            createdRow: function(row, data, dataIndex) {
                $(row).attr("id", data[1]);
                $(row).attr("machine_id", current_element)
            },
            paging: false,
            scrollY: 500,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: true,
            rowReorder: {
                selector: "tr",
            },
            language: {
                url: base_url + "assets/dataTableFr/french.json",
            },
            ajax: base_url +
                "Planning/current_production_sachet_impression?machine=" +
                current_element,
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
                /*let previ = 0;
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);

                    let previ_row = $(this).children().eq(14).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += previ_row;
                        // console.log(previ_row);
                    }
                });
                console.log(previ);
                $("#previ_" + current_element).empty().append(previ);*/

            },
            drawCallback: function(settings) {
                let previ = 0;
                let terminer = 0;
                let rest = 0;
                $("#" + current_element + " tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();
                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);

                    let previ_row = $(this).children().eq(14).text().trim();
                    let terminer_row = $(this).children().eq(15).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += parseFloat(previ_row);
                        terminer += parseFloat(terminer_row);
                        rest = previ - terminer;
                        $("#previ_" + current_element).empty().append(previ);
                        $("#terminer_" + current_element).empty().append(terminer);
                        $("#rest_" + current_element).empty().append(rest);
                    }

                });


            },
            initComplete: function(ui, setting) {
                let previ = 0;
                let terminer = 0;
                let rest = 0;
                $("#" + current_element + "tr").each(function(index_element) {
                    let stat_color = $(this).children().eq(28).text();

                    let color = "";
                    stat_color == "OUI" ? (stat_color = "yellow") : "";
                    $(this).css("background", stat_color);
                    let previ_row = $(this).children().eq(14).text().trim();
                    let terminer_row = $(this).children().eq(15).text().trim();
                    if (previ_row != "POIDS_EN_PROD" && previ_row != "") {
                        previ += parseFloat(previ_row);
                        terminer += parseFloat(terminer_row);
                        rest = previ - terminer;
                        $("#previ_" + current_element).empty().append(previ);
                        $("#terminer_" + current_element).empty().append(terminer);
                        $("#rest_" + current_element).empty().append(rest);

                    }
                });


            },
        });
        table.on("row-reorder", function(e, diff, edit) {
            let data = new Array();
            let machine = "";
            for (var i = 0, ien = diff.length; i < ien; i++) {
                let refnum = diff[i].node.id;
                if (i == 0) {
                    machine = diff[i].node.attributes.machine_id.nodeValue;
                }
                let position = diff[i].newPosition + 1;
                let oldPosition = diff[i].oldPosition + 1;
                data[i] = new Array();
                data[i][0] = oldPosition;
                data[i][1] = position;
                data[i][2] = refnum;
            }
            $.post(base_url + "planning/mouve_job_card_impression_prod", { data, machine }, function(reponse) {
                table = $("#" + machine).DataTable();
                let link = base_url + "Planning/current_production_sachet_impression?machine=" + machine;
                table.ajax.url(link);
                table.ajax.reload();
            });

        });
    });
    $(".btn-update-statu").on("click", function(event) {
        event.preventDefault();
        let machine = $(this).attr("machine");
        let type = $(this).attr("type");
        table = $("#" + machine).DataTable();
        let link =
            base_url + "Planning/current_production_sachet_impression?machine=" + machine;
        $.confirm({
            title: "",
            content: '<fieldset class="border p-2 text-left"><span style="color: #2a5591;">Entrée refnum job card :</span> <input type="number" id="refnum" class="form-control form-control-sm"></p></fieldset>',
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        loding();
                        let refnum = this.$content.find("#refnum").val();
                        if (!refnum) {
                            //alert_message('Erreur!', 'Veuillez entrée numéro valide.', 'error', 'btn-danger');
                            $.alert("Veuillez entrer numéro valide.");
                            return false;
                        }
                        $.post(
                            base_url + "Planning/update_statut_impression_prod", { refnum, machine, type },
                            function() {
                                table.ajax.url(link);
                                table.ajax.reload();
                                stop_load();
                                alert_message(
                                    "Succè!",
                                    "Requêtte traitée.",
                                    "success",
                                    "btn-success"
                                );
                            }
                        );
                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    });


    $(".new_pross").on("click", function(event) {
        event.preventDefault();
        let machine = $(this).attr("machine");
        $.confirm({
            title: "",
            content: "url:" + base_url + "planning/show_form_nouveau_impression_processus?machine=" + machine,
            columnClass: "col-md-8",
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let refnum = this.$content.find("#refnum_commande").val();
                        if (!refnum) {
                            $.alert("Veuillez entrer numéro valide.");
                            return false;
                        }
                        let machine = this.$content.find('#machine_pross').val();
                        let id_jobs = this.$content.find('#refnum_job_card').val();
                        let quantite = this.$content.find('#commande_produit').val();
                        let date_prod = this.$content.find('#date_prod').val();
                        let heure_debut = this.$content.find('#heure_debut').val();
                        let duree_prod = this.$content.find('#duree_prod').val();
                        let date_fin = this.$content.find('#date_fin').val();
                        let heure_fin = this.$content.find('#heure_fin').val();
                        let processus = this.$content.find('#machine_processus').val();
                        loding();

                        $.post(base_url + "Planning/add_new_job_card_prod", { processus, machine, id_jobs, refnum, quantite, date_prod, heure_debut, duree_prod, date_fin, heure_fin }, function(data) {
                            stop_load();
                            alert_message(
                                "Succè!",
                                "Requêtte traitée.",
                                "success",
                                "btn-success"
                            );
                        });

                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    });


    $(".edit_production").on("click", function(event) {
        event.preventDefault();
        let machine = $(this).attr("machine");
        $.confirm({
            title: "",
            content: '<fieldset class="border p-2 text-left"><span style="color: #2a5591;">Entrée refnum job card :</span> <input type="number" id="refnum" class="form-control form-control-sm"></p></fieldset>',
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let refnum = this.$content.find("#refnum").val();
                        if (!refnum) {
                            $.alert("Veuillez entrer numéro valide.");
                            return false;
                        }
                        show_form_update_data_prod(machine, refnum);
                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    });

    function show_form_update_data_prod(machine, refnum) {
        $.confirm({
            title: "",
            type: "blue",
            content: "url:" +
                base_url +
                "planning/show_form_update_data_impression_prod?machine=" +
                machine +
                "&refnum=" +
                refnum,
            columnClass: "col-md-8",
            onContentReady: function() {
                $("#stock_sortie").autocomplete({
                    source: base_url + "stock/autocomplete_matiere_sortie_magasin",
                    appendTo: ".jconfirm-open",
                    select: function(event, items) {
                        event.preventDefault();
                        let select_item = items.item.value.split(" | ");
                        $(this).val(select_item[1] + " | " + select_item[2]);
                    },
                });
            },
            buttons: {
                button: {
                    action: function() {
                        table = $("#" + machine).DataTable();
                        let link =
                            base_url +
                            "Planning/current_production_sachet_impression?machine=" +
                            machine;
                        table.ajax.url(link);
                        table.ajax.reload();
                    },
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    }
    $(".add_purge").on('click', function(event) {
        event.preventDefault();
        let machine_id = $(this).attr("machine");
        $.confirm({
            title: "",
            type: "blue",
            content: "url:" +
                base_url +
                "planning/show_form_add_data_impression_purge?machine=" +
                machine_id,
            columnClass: "col-md-6",
            onContentReady: function() {
                $("#refnum").autocomplete({
                    source: base_url + "commercial/autocomplet_commande",
                    appendTo: ".jconfirm-open",
                });
            },
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let machine = this.$content.find('#machine').val();
                        let id_jobs = this.$content.find('#id_jobs').val();
                        let refnum = this.$content.find('#refnum').val();
                        let quantite = this.$content.find('#quantite').val();
                        let date_prod = this.$content.find('#date_prod').val();
                        let heure_debut = this.$content.find('#heure_debut').val();
                        let duree_prod = this.$content.find('#duree_prod').val();
                        let date_fin = this.$content.find('#date_fin').val();
                        let heure_fin = this.$content.find('#heure_fin').val();
                        let obs = this.$content.find("#type").val();
                        $.post(base_url + "Planning/add_job_card_impression_prod", { obs, machine, id_jobs, refnum, quantite, date_prod, heure_debut, duree_prod, date_fin, heure_fin }, function(data) {
                            if (data == 1) {
                                table = $("#" + machine_id).DataTable();
                                let link = base_url + "Planning/current_production_sachet_impression?machine=" + machine_id;
                                table.ajax.url(link);
                                table.ajax.reload();
                            }
                        });

                    },
                },
                button: {
                    action: function() {

                    },
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });

    });
    $(".add_prod").on("click", function(event) {
        event.preventDefault();
        let machine_id = $(this).attr("machine");
        $.confirm({
            title: "",
            type: "blue",
            content: "url:" +
                base_url +
                "planning/show_form_add_data_impression_prod?machine=" +
                machine_id,
            columnClass: "col-md-6",
            onContentReady: function() {
                $("#refnum").autocomplete({
                    source: base_url + "commercial/autocomplet_commande",
                    appendTo: ".jconfirm-open",
                });
            },
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let machine = this.$content.find('#machine').val();
                        let id_jobs = this.$content.find('#id_jobs').val();
                        let refnum = this.$content.find('#refnum').val();
                        let quantite = this.$content.find('#quantite').val();
                        let date_prod = this.$content.find('#date_prod').val();
                        let heure_debut = this.$content.find('#heure_debut').val();
                        let duree_prod = this.$content.find('#duree_prod').val();
                        let date_fin = this.$content.find('#date_fin').val();
                        let heure_fin = this.$content.find('#heure_fin').val();
                        $.post(base_url + "Planning/add_job_card_impression_prod", { machine, id_jobs, refnum, quantite, date_prod, heure_debut, duree_prod, date_fin, heure_fin }, function(data) {
                            if (data == 1) {
                                table = $("#" + machine_id).DataTable();
                                let link = base_url + "Planning/current_production_sachet_impression?machine=" + machine_id;
                                table.ajax.url(link);
                                table.ajax.reload();
                            }
                        });

                    },
                },
                button: {
                    action: function() {

                    },
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    });
    $(".update_date").on("click", function(event) {
        event.preventDefault();
        let machine = $(this).attr("machine");
        table = $("#" + machine).DataTable();
        let link =
            base_url + "Planning/current_production_sachet_impression?machine=" + machine;
        let html_content =
            '<span style="color: #2a5591;">Entrée refnum job card :</span> <input type="number" id="refnum" class="form-control form-control-sm">';
        html_content +=
            '<span style="color: #2a5591;">Heure de début :</span> <input type="time" id="heure" class="form-control form-control-sm">';
        html_content +=
            '<span style="color: #2a5591;">Date de production :</span> <input type="date" id="date" class="form-control form-control-sm">';

        $.confirm({
            title: "",
            content: '<fieldset class="border p-2 text-left w-100">' +
                html_content +
                "</fieldset>",
            columnClass: "col-md-6",
            type: "blue",
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let refnum = this.$content.find("#refnum").val();
                        let heure = this.$content.find("#heure").val();
                        let date = this.$content.find("#date").val();
                        if (!refnum || !heure || !date) {
                            /*$.alert({
                                title: "Erreur!",
                                content: "Une erreur s'est produite. Veuillez rééssayer.",
                                type: 'red'
                            });
                            return false;*/
                        }
                        loding();
                        $.post(
                            base_url + "Planning/update_date_time_impression_prod", { refnum, heure, date },
                            function(data) {
                                stop_load();
                                table.ajax.url(link);
                                table.ajax.reload();
                                alert_message(
                                    "Succè!",
                                    "Requêtte traitée.",
                                    "success",
                                    "btn-success"
                                );
                            }
                        ).fail(() => {
                            stop_load();
                            alert_message("Erreur!", "Requêtte non traitée", "error", "btn btn-danger");
                        });
                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });
    });
    $("#print_job_cart").on("click", function(event) {
        event.preventDefault();
        let html_content = '<span style="color: #2a5591;">Entrée refnum job card :</span> <input type="number" id="refnum" class="form-control form-control-sm">';
        $.confirm({
            title: "",
            content: '<fieldset class="border p-2 text-left w-100">' + html_content + "</fieldset>",
            columnClass: "col-md-6",
            type: "blue",
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {
                        let refnum = this.$content.find("#refnum").val();
                        if (!refnum) {
                            $.alert({
                                title: "Erreur!",
                                content: "Une erreur s'est produite. Veuillez rééssayer.",
                                type: 'red'
                            });
                            return false;
                        }
                        $.post(base_url + "planning/print_jobs_cart", { refnum }, function(reponse) {
                            if (reponse == "Erreur!") {
                                alert_message("Erreur!", "Une erreur s'est produite. Veuillez rééssayer.", "error", "btn btn-danger");
                            }

                        })

                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });

    });

    function loding() {
        let htmls =
            '<style>.jconfirm-content{opacity:1;}.jconfirm .jconfirm-box{height: 125px !important; text-align:center;}.jconfirm .jconfirm-box div.jconfirm-closeIcon {display:none !important;}.spinner {margin: 10px auto;width: 50px;height: 40px;text-align: center;font-size: 10px;}.spinner > div {background-color: #0000ff;height: 100%;width: 6px;display: inline-block;-webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;animation: sk-stretchdelay 1.2s infinite ease-in-out;}.spinner .rect2 {-webkit-animation-delay: -1.1s;animation-delay: -1.1s;}.spinner .rect3 {-webkit-animation-delay: -1.0s;animation-delay: -1.0s;}.spinner .rect4 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}.spinner .rect5 {-webkit-animation-delay: -0.8s;animation-delay: -0.8s;}@-webkit-keyframes sk-stretchdelay {0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  20% { -webkit-transform: scaleY(1.0) }}@keyframes sk-stretchdelay {0%, 40%, 100% { transform: scaleY(0.4);-webkit-transform: scaleY(0.4);}  20% { transform: scaleY(1.0);-webkit-transform: scaleY(1.0);}}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
        $.dialog({
            title: "",
            content: htmls,
            show: true,
            modal: true,
            close: false,
            closeOnMaskClick: false,
            closeOnEscape: false,
            dynamic: false,
            height: 150,
            fixedDimensions: true,
        });
    }

    function stop_load() {
        $(".jconfirm ").remove();
    }

    function alert_message(title, message, icons, btn) {
        swal(title, message, {
            icon: icons,
            buttons: {
                confirm: {
                    className: btn,
                },
            },
        });
    }
});