$(document).ready(function() {
    table = $("#table_non_planifier").DataTable({
        processing: true,
        ajax: base_url + "Planning/liste_commande_sachet_all_champ",
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
        rowCallback: function(row, data) {

        },
        drawCallback: function(settings) {
            form_mise_en_prod();
        },
        initComplete: function(setting) {
            form_mise_en_prod();
        },
    });
    $("#refnum").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });

    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let date = $("#date_commande").val();
        let refnum = $("#refnum").val();
        let link =
            base_url +
            "Planning/liste_commande_sachet_all_champ?date=" +
            date +
            "&refnum=" +
            refnum;
        table.ajax.url(link);
        table.ajax.reload();
    });

    function form_mise_en_prod() {
        $(".mise_en_prod").on("click", function(event) {
            event.preventDefault();
            let $this = $(this);
            let refnum = $this.parent().parent().children().first().text();
            $("#refnum_commande").val(refnum);
            $("#modal_form_job_card").modal("show");
        });
        $('.btn-observation').on('click', function(event) {
            event.preventDefault();
            let po = $(this).attr('id');
            let methodOk = false;
            $('.obse-content').empty();
            $.post(base_url + "Commercial/get_observation", { po }, function(data) {
                $methodOk = data != "";
                $('.refnum_commande').text(po);
                $methodOk ? data = "<div class='text-center'>Aucune observation</div>" : "";
                $('.obse-content').append(data)
                $('#observation_modal').modal('show');
            });

        });
    }

    $("#add-table").on("click", function(e) {
        e.preventDefault();
        let matiere = $("#matiere").val();
        let quantite = $("#Quantite").val();
        let methodOk = matiere != "" && Quantite != "";

        if (methodOk) {
            matiere = matiere.split("|");
            let i = 1;
            if (typeof $(".tbody_tab_matiere > tr").html() == "undefined") {
                $(".tbody_tab_matiere").append(
                    "<tr><td>" +
                    i +
                    "</td><td>" +
                    matiere[0].trim() +
                    "</td>" +
                    '<td><input type="number" class="quantite_tab w-10 text-center" style="width:80px;" value="' +
                    quantite +
                    '"></td><td class="text-center">' +
                    matiere[1].trim() +
                    '</td><td class="text-center"><a href="#" class="delete_ligne text-danger"><i class="fa fa-trash"></i></a>' +
                    "</td></tr>"
                );
                $("#matiere").val("");
                $("#Quantite").val("");
                delete_ligne_tab();
            } else {
                let table = [];
                $(".tbody_tab_matiere > tr").each(function() {
                    table.push($(this).children().eq(1).text());
                });

                if ($.inArray(matiere, table) != -1) {
                    alertMessage(
                        "Erreure!",
                        "Ce materiel existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre materiel.",
                        "error",
                        "btn btn-danger"
                    );
                } else {
                    i++;
                    $(".tbody_tab_matiere").append(
                        "<tr><td>" +
                        i +
                        "</td><td>" +
                        matiere[0].trim() +
                        "</td>" +
                        '<td><input type="number" class="quantite_tab w-10 text-center" style="width:80px;" value="' +
                        quantite +
                        '"></td><td class="text-center">' +
                        matiere[1].trim() +
                        '</td><td class="text-center"><a href="#" class="delete_ligne text-danger"><i class="fa fa-trash"></i></a>' +
                        "</td></tr>"
                    );
                    $("#matiere").val("");
                    $("#Quantite").val("");
                    delete_ligne_tab();
                }
            }
        } else {
            alertMessage(
                "Erreure!",
                "Champs designation et Champs Quantite obligatoire.",
                "error",
                "btn btn-danger"
            );
        }
    });

    $("#matiere").autocomplete({
        source: base_url + "stock/autocomplete_matiere_sortie_magasin",
        appendTo: "#modal_form_job_card",
        select: function(event, items) {
            event.preventDefault();
            let select_item = items.item.value.split(" | ");
            $(this).val(select_item[1] + " | " + select_item[2]);
        },
    });

    function delete_ligne_tab() {
        $(".tbody_tab_matiere .delete_ligne").on("click", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }

    $("#lance_planning").on("click", function(event) {
        event.preventDefault();
        chargement();
        let date = $("#date").val();
        let refnum = $("#refnum_commande").val().trim();
        let link =
            base_url +
            "Planning/liste_commande_sachet_all_champ?date=" +
            date +
            "&=refnum" +
            refnum;

        $(".tbody_tab_matiere tr").each(function(index) {
            let quantite = $(this).children().eq(2).find("input").val();
            let designation = $(this).children().eq(1).text();
            let prix = $(this).children().eq(3).text();
            $.post(
                base_url + "planning/insert_matiere_utiliser", { quantite, designation, prix, refnum },
                function() {}
            );
        });

        var quantite_en_mettre = $("#quantite_en_mettre").val();
        var poids_en_kg = $("#poids_en_kg").val();
        var dim_prod = $("#dim_prod").val();
        var nb_rouleaux = $("#nb_rouleaux").val();
        var poid_sachet = $("#pois_sachet").val();
        $.post(
            base_url + "planning/update_commande", {
                refnum,
                quantite_en_mettre,
                poids_en_kg,
                dim_prod,
                nb_rouleaux,
                poid_sachet,
            },
            function() {
                $("input").val("");
                $(".tbody_tab_matiere tr").empty();
                $("#modal_form_job_card").modal("hide");
                table.ajax.url(link);
                table.ajax.reload();
                alertMessage(
                    "Succé!",
                    "Job carte enregistre avec succé.",
                    "success",
                    "btn btn-success"
                );
                closeDialog();
            }
        );
    });



    function chargement() {
        var htmls =
            '<style> .spinner div{background-color:#3697e1;}</style><div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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

    function closeDialog() {
        $(".jconfirm").remove();
    }

    function alertMessage(title, message, icons, btn) {
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