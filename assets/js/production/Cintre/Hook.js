$(document).ready(function() {
    $("#show_modal").on("click", function(event) {
        event.preventDefault();
        $("form").attr("action", "save_cintre_hook_data");
        $("input").val("");
        $("textarea").val("");
        $("#IN_MACHINE").val("Hook Machine");
        $("#QUART_TIME").val("J");
        $("#modal_form_cintre_hook").modal("show");


    });
    $('.operateur').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
        appendTo: "#modal_form_cintre_hook"
    });
    $('#Operateur_show').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $('#machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
        appendTo: "#modal_form_cintre_hook"
    });
    $('.refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#modal_form_cintre_hook"

    });
    table = $("#dataTable").DataTable({
        processing: true,
        ajax: base_url + "Production/get_data_list_cintre_hook",
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
            cintre_injection_fonction();
        },
        drawCallback: function(settings) {
            cintre_injection_fonction();
        },
        initComplete: function(setting) {
            cintre_injection_fonction();
        },
    });

    $('form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var $this = $(this);
        var url = $this.attr('action');
        $.ajax({
            type: 'POST',
            url: base_url + "Production/" + url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                $("form").attr("action", "save_hook_data");
                table.ajax.reload();
            },
            error: function(data) {
                $("#modal_form_hook_impression").modal("hide");
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
    $("#show_data").on("click", function(event) {
        event.preventDefault();
        let Quart_show = $("#Quart_show").val();
        let Operateur_show = $("#Operateur_show").val();
        let machine_show = $("#machine_show").val();
        let date_debut_show = $("#date_debut_show").val();
        let date_fin_show = $("#date_fin_show").val();
        let link = base_url + "production/get_data_list_cintre_hook?Quart_show=" + Quart_show + "&Operateur_show=" + Operateur_show + "&machine_show=" + machine_show + "&date_debut_show=" + date_debut_show + "&date_fin_show=" + date_fin_show;
        table.ajax.url(link);
        table.ajax.reload();

    });

    function cintre_injection_fonction() {
        $(".edit_cintre_injection").on("click", function(event) {
            event.preventDefault();
            $("#BC_ID").val($(this).attr("id"));
            let refnum = $(this).attr("id");
            $.post(base_url + "production/get_data_cintre_hook", { refnum }, function(data) {
                $("form").attr("action", "update_cintre_hook");
                $("#BC_PO").val(data.BC_PO);
                $("#IN_DATE").val(data.IN_DATE);
                $("#IN_REFERENCE").val(data.IN_REFERENCE);
                $("#IN_QTY").val(data.IN_QTY);
                $("#IN_DECHETS").val(data.IN_DECHETS);
                $("#IN_MACHINE").val(data.IN_MACHINE);
                $("#IN_DURE").val(data.IN_DEBUT)
                $("#IN_FIN").val(data.IN_FIN)
                $("#QUART_TIME").val(data.QUART_TIME);
                $("#IN_OPERATEUR1").val(data.IN_OPERATEUR1);
                $("#IN_OPERATEUR2").val(data.IN_OPERATEUR2);
                $("#IN_MATIERES").val(data.IN_MATIERES);
                $("#IN_MASTERBATCHE").val(data.IN_MASTERBATCHE);
                $("#IN_OBSERVATION1").val(data.IN_OBSERVATION1);
                $("#IN_OBSERVATION2").val(data.IN_OBSERVATION2);

                $("#modal_form_cintre_hook").modal("show");
            }, "json");
        });
        $(".delete_cintre_hook").on("click", function(event) {
            event.preventDefault();
            let refnum = $(this).attr("id");
            $.post(base_url + "production/delete_date_cintre_hook", { refnum }, function(data) {

            }).done(() => {
                table.ajax.reload();
                swal("Succè! ", "Hook supprimer.", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                });
            });
        });
    }
});