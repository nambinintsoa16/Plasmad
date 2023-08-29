$(document).ready(function() {

    $('.autocomplete_operateur').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $('.autocomplete_machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
    });
    $('.autocomplete_refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",

    });

    $('.autocomplete_reference_matiere').autocomplete({
        source: base_url + "Production/autocomplet_reference_matiere",
        appendTo: "#modal_form"
    });

    $('.autocomplete_operateur_modal').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
        appendTo: "#modal_form_coupe",
    });
    $('.autocomplete_refnum_commande_modal').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#modal_form_coupe",

    });
    $(".autocomplete_contolle_qualite").autocomplete({
        source: base_url + "Production/autocomplete_contolle_qualite",
        appendTo: "#modal_form_coupe",
    });

    var table = $("#table_sachet_coupe").DataTable({
        processing: true,
        ajax: base_url + "Production/sachet_coupe_data_list",
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
            sachet_coupe_fonction();
        },
        drawCallback: function(settings) {
            sachet_coupe_fonction();
        },
        initComplete: function(setting) {
            sachet_coupe_fonction();
        },
    });

    $('#btn_coupe_modal').on('click', function(event) {
        event.preventDefault();
        $("input").val("");
        $("textarea").val("");
        $("form").attr("action", "save_sachet_coupe");
        $('#modal_form_coupe').modal('show');

    });
    $('form').on('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        let method = $(this).attr("action");
        let link = base_url + "Production/" + method;
        $.ajax({
            type: 'POST',
            url: link,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (rep) => {
                this.reset();
                if (rep == "erreur") {
                    swal("Erreur ", "Veuillez réessayer!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                } else {
                    $("form").attr("action", "save_sachet_coupe");
                    table.ajax.reload();
                }

            },
            error: function(rep) {
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
    $('#btn_affiche_data').on('click', function(e) {
        e.preventDefault();
        var date = $('.coupeInput').val();
        var machine = $('.machineCoupe').val();
        var operateurs = $('.opCoupe').val();
        var QuartExtrusionCoupe = $('.QuartExtrusionCoupe option:selected').val();
        var coupeInputdebut = $('.coupeInputdebut').val(); 
        var type_mat = $('#type_mat option:selected').val(); 
        var po = $('.pocoupe').val();
        var link = base_url + 'Production/sachet_coupe_data_list?date=' + date + '&machine=' + machine +
            "&operateurs=" + operateurs + "&debut=" + coupeInputdebut + "&quart=" +
            QuartExtrusionCoupe + "&po=" + po+"&type_mat="+type_mat;
        $('.exportCoupe').attr('href', base_url + "Production/exportCoupe?date=" + date + '&machine=' +
            machine + "&operateurs=" + operateurs + "&debut=" + coupeInputdebut + "&quart=" +
            QuartExtrusionCoupe + "&po=" + po+"&type_mat="+type_mat);
        table.ajax.url(link);
        table.ajax.reload();
    });

    function sachet_coupe_fonction() {
        $(".delete_coupe").on('click', function(event) {
            event.preventDefault();
            let refnum = $(this).attr("id");
            $.post(base_url + 'production/delete_coupe', { refnum }, function(data) {
                table.ajax.reload();
            });

        });
        $(".edit_coupe").on('click', function(event) {
            event.preventDefault();
            let refnum = $(this).attr("id");
            $("form").attr("action", "update_sachet_coupe");
            $.post(base_url + "Production/get_detail_sachet_coup", { refnum }, function(data) {
                $("#ED_ID").val(refnum);
                $("#ED_DATE").val(data.ED_DATE);
                $("#BC_ID").val(data.BC_ID);
                $("#ED_RLX").val(data.ED_RLX);
                $("#ED_METRAGE").val(data.ED_METRAGE);
                $("#ED_POID_ENTRE").val(data.ED_POID_ENTRE);
                $("#ED_1ER_CHOIX").val(data.ED_1ER_CHOIX);
                $("#ED_POID_SORTIE").val(data.ED_POID_SORTIE);
                $("#ED_2E_CHOIX").val(data.ED_2E_CHOIX);
                $("#ED_2E_POIDS").val(data.ED_2E_POIDS);
                $("#ED_DECHE_EXTRUSION").val(data.ED_DECHE_EXTRUSION);
                $("#ED_DECHE_INPRESSION").val(data.ED_DECHE_INPRESSION);
                $("#ED_DECHE_COUPE").val(data.ED_DECHE_COUPE);
                $("#ED_GAINE_TIRE").val(data.ED_GAINE_TIRE);
                $("#EI_EQUIPE").val(data.ED_EQUIPE);
                $("#ED_OPERATEUR_1").val(data.ED_OPERATEUR_1);
                $("#ED_OPERATEUR_2").val(data.ED_OPERATEUR_2);
                $("#ED_OPERATEUR_3").val(data.ED_OPERATEUR_3);
                $("#ED_QC").val(data.ED_QC);
                $("#EX_DEBUT").val(data.ED_DEBUT);
                $("#EX_FIN").val(data.ED_FIN);
                $("#ED_TAILL").val(data.ED_TAILL);
                $("#ED_QUART").val(data.ED_QUART);
                $("#ED_MACHINE").val(data.ED_MACHINE);
                $("#ED_RESRT_GAINE").val(data.ED_RESTE_GAINE);
                $("#ED_OBSERVATION").val(data.ED_OBSERVATION2);
                $("#ED_OBSERVATION2").val(data.ED_OBSERVATION);
                $('#modal_form_coupe').modal('show');
            }, "json");
        });
    }
});