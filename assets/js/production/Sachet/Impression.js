$(document).ready(function() {
    $(".autocomplete_operateur").autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $(".autocomplete_machine").autocomplete({
        source: base_url + "Production/autocomplete_machine",
    });
    $(".autocomplete_refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
    });

    $(".autocomplete_reference_matiere").autocomplete({
        source: base_url + "Production/autocomplet_reference_matiere",
        appendTo: "#modal_form",
    });

    $(".autocomplete_reference_matiere_update").autocomplete({
        source: base_url + "Production/autocomplet_reference_matiere",
        appendTo: "#modal_form_update_matiere",
    });

    $(".autocomplete_operateur_modal").autocomplete({
        source: base_url + "Production/autocomplete_operateur",
        appendTo: "#modal_form",
    });
    $(".autocomplete_refnum_commande_modal").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#modal_form",
    });
    var table_matiere = $("#table_matiere").DataTable({
        processing: true,
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        rowCallback: function(row, data) {

        },
        drawCallback: function(settings) {
            function_tab_add_mat();
        },
        initComplete: function(setting) {
            function_tab_add_mat();
        }
    });

    function function_tab_add_mat() {
        $(".delete_matiere").on('click', function(event) {
            event.preventDefault();
            let refnum = $(this).attr('id');
            $.post(base_url + "Production/delete_sachet_refnum_print", { refnum }, function(data) {
                table_matiere.ajax.reload();
            });

        });

    }
    var table = $("#table_sachet_impression").DataTable({
        processing: true,
        ajax: base_url + "Production/sachet_impression_data_list",
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        dom: "Bfrtip",
        buttons: [{
                extend: "colvis",
                className: "btn btn-warning text-white",
                collectionLayout: "fixed four-column",
                text: '<i class="icon-eye"></i> Masque colonne',
                columns: ":gt(0)",
            },
            {
                className: "btn btn-primary text-white",
                text: '<i class="icon-printer"></i> Imprimer',
                extend: "print",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
            {
                className: "btn btn-danger text-white",
                text: '<i class="icon-doc"></i> Export PDF',
                extend: "pdf",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
            {
                className: "btn btn-success text-white",
                text: '<i class="icon-folder-alt"></i> Exporter',
                extend: "excel",
                exportOptions: {
                    modifier: {
                        page: "all",
                        search: "none",
                    },
                },
            },
        ],
        rowCallback: function(row, data) {
            sachet_impression();
        },
        drawCallback: function(settings) {
            sachet_impression();
        },
        initComplete: function(setting) {
            sachet_impression();
        },
    });

    function sachet_impression() {
        $(".delete_Imprim_matiere").on("click", function(event) {
            event.preventDefault();
            var id = $(this).attr("id");
            $.post(base_url + "Production/delete_sachet_print", { id }, function(data) {
                table.ajax.reload();
            });
        });

        $('.edit_print_mat').on('click', function(event) {
            event.preventDefault();
            let refnum_commande = $(this).parent().parent().children().eq(1).text();
            let refnum_prod = $(this).attr("refnum_prod");
            $("#refnum_commande").text(refnum_commande);
            $("#refnum_production_modal").text(refnum_prod);
            let link = base_url + "Production/data_list_use_matiere_print?refnum_prod=" + refnum_prod;
            table_matiere.ajax.url(link);
            table_matiere.ajax.reload();
            $('#modal_form_update_matiere').modal('show');
        });
        $(".edit_print_data").on("click", function(event) {
            event.preventDefault();
            $("form").attr("action", "action_edit_print_data");
            let refnum = $(this).attr("id");
            $("#EI_ID").val(refnum);
            $("#matier_content").addClass("collapse");
            $.post(base_url + "production/get_detail_print", { refnum }, function(data) {
                $("#EI_ID").val(data.EI_ID);
                $("#EI_DATE").val(data.EI_DATE);
                $("#BC_ID").val(data.BC_ID);
                $("#EI_TAILLE").val(data.EI_TAILLE);
                $("#EI_RLX").val(data.EI_RLX);
                $("#EI_METRAGE").val(data.EI_METRAGE);
                $("#EI_POIDS").val(data.EI_POIDS);
                $("#EI_DECHET").val(data.EI_DECHETS);
                $("#EX_DEBUT").val(data.EI_DEBUT);
                $("#EX_FIN").val(data.EI_FIN);
                $("#EI_RESTE_GAINE").val(data.EI_RESTE_GAINE);
                $("#EI_MACH").val(data.EI_MACH);
                $("#EI_EQUIPE").val(data.EI_EQUIPE);
                $("#EI_OPERATEUR1").val(data.EI_OPERATEUR1);
                $("#EI_OPERATEUR2").val(data.EI_OPERATEUR2);
                $("#EI_QUART").val(data.EI_QUART);
                $("#EI_OBS").val(data.EI_OBSERVATION);
                $("#modal_form").modal("show");
            }, "json")

        });

    }

    $("#ajouter_matiere").on("click", function(event) {
        event.preventDefault();
        let date = $("#date").val();
        let temp_mat = $("#designation").val().split(" | ");
        let refnum_commande = $("#refnum_commande").text();
        let refnum_production = $("#refnum_production_modal").text();
        let designation = temp_mat[0];
        let prix = temp_mat[1];
        let quantite = $("#quantite").val();
        $.post(base_url + "Production/save_matiere_utiliser", { refnum_production, refnum_commande, date, designation, quantite, prix }, function(data) {
            $("input").val("");
            table_matiere.ajax.reload();
        });
    });

    function save_matiere_utiliser(date, refnum_commande, refnum_production) {
        $(".tbodyMatt tr").each(function() {
            let designation = $(this).children().first().text();
            let quantite = $(this).children().first().next().text();
            let prix = $(this).children().first().next().next().text();
            $.post(
                base_url + "Production/save_matiere_utiliser", {
                    designation,
                    quantite,
                    refnum_commande,
                    refnum_production,
                    prix,
                    date
                },
                function(data) {}
            );
        });
        $(".tbodyMatt").empty();
    }
    $("form").on("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        let refnum_commande = $(".autocomplete_refnum_commande_modal").val()
        let date = $("#EI_DATE").val();
        let action = $(this).attr("action");
        let link = base_url + "Production/" + action.trim();
        $.ajax({
            type: "POST",
            url: link,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (rep) => {
                this.reset();
                if (rep.trim() == "erreur") {
                    swal("Erreur ", "Veuillez réessayer!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    });
                } else {
                    if (action == "save_sachet_impression") {
                        save_matiere_utiliser(date, refnum_commande, rep.trim());
                    }
                    $("form").attr("action", "save_sachet_impression");
                    table.ajax.reload();
                }
            },
            error: function(rep) {
                swal("Erreur ", "Veuillez réessayer!", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: "btn btn-danger",
                        },
                    },
                });
            },
        });
    });

    $(".plusMatt").on("click", function(event) {
        event.preventDefault();
        var reference = $(".autocomplete_reference_matiere ").val().split(" | ");
        var quantite = $(".quantite").val();
        $(".tbodyMatt").append(
            "<tr><td>" +
            reference[0] +
            "</td><td>" +
            quantite +
            "</td><td>" +
            reference[1] +
            '</td><td><a href="#" class="btn btn-danger btn-sm deleteBt"><i class="fa fa-trash"></i></a></td></tr>'
        );
        $(".autocomplete_reference_matiere ").val("");
        $(".quantite").val("");

        deleteBt();
    });

    function deleteBt() {
        $(".deleteBt").on("click", function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
        });
    }

    $("#btn_modal_form_show").on("click", function(event) {
        event.preventDefault();
        $("form").attr("action", "save_sachet_impression");
        $("input").val("");
        $("textarea").val();
        $("#EI_MACH").val("F101");
        $("#EI_QUART").val("J");
        $("#matier_content").removeClass("collapse");
        $("#modal_form").modal("show");
    });

    $(".tbody-TableOperateurEX td").on("click", function(event) {
        event.preventDefault();
        var $parent = $(this).parent().parent().attr("class").split(" ");
        //var type = $parent.text();
        var $type = $parent[1];
        $.post(
            base_url + "Production/formulaire", {
                type: $type,
            },
            function(data, textStatus, xhr) {
                $("#exampleModalCenter .modal-body").empty().append(data);
                $("#exampleModalCenter").modal("show");
            }
        );
    });

    $(".eximpreBtnredate").on("click", function(e) {
        e.preventDefault();
        var date = $(".eximpredate").val();
        var machine_impression = $(".machine_impression").val();
        var operateurs = $(".operateur_impression").val();
        var quart_extrusion_impression = $(
            ".quart_extrusion_impression option:selected"
        ).val();
        var type_mat = $('#type_mat option:selected').val(); 
        var eximpredatedebut = $(".eximpredatedebut").val();
        var refnum_commande = $(".autocomplete_refnum_commande").val();
        var link =
            base_url +
            "Production/sachet_impression_data_list?date=" +
            date +
            "&machine=" +
            machine_impression +
            "&operateurs=" +
            operateurs +
            "&debut=" +
            eximpredatedebut +
            "&quart=" +
            quart_extrusion_impression +
            "&po=" +
            refnum_commande+"&type_mat="+type_mat;
        $(".exportImpression").attr(
            "href",
            base_url +
            "Production/exportImpression?date=" +
            date +
            "&machine=" +
            machine_impression +
            "&operateurs=" +
            operateurs +
            "&debut=" +
            eximpredatedebut +
            "&quart=" +
            quart_extrusion_impression +
            "&po=" +
            refnum_commande+"&type_mat="+type_mat
        );
        table.ajax.url(link);
        table.ajax.reload();
    });

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

    function chargement() {
        var htmls =
            '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
});