$(document).ready(function() {
    $('#operateur').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
    });
    $('#machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
    });
    $('#refnum_commande').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",

    });

    table = $('#Table_extrusion').DataTable({
        processing: true,
        ajax: base_url + 'Production/sachet_extrusion_data_list',
        language: {
            url: base_url + "assets/dataTableFr/french.json"
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
        "rowCallback": function(row, data) {
            function_extrusion();
        },
        "drawCallback": function(settings) {
            function_extrusion();
        },
        "initComplete": function(setting) {
            // function_extrusion();

        },
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api();
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };
            var timestrToSec = function(timestr) {
                var parts = timestr.split(":");
                return (parts[0] * 3600) +
                    (parts[1] * 60) +
                    (+parts[2]);
            }

            function pad(num) {
                if (num < 10) {
                    return "0" + num;
                } else {
                    return "" + num;
                }
            }

            var formatTime = function(seconds) {
                return [pad(Math.floor(seconds / 3600)),
                    pad(Math.floor(seconds / 60) % 60),
                    pad(seconds % 60),
                ].join(":");
            }

            total = api
                .column(3)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b.trim());
                }, 0);

            dechet = api
                .column(4)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            poid = api
                .column(5)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);


            pageTotal = api
                .column(2, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
            time = api
                .column(6, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(timestrToSec(b));

                }, 0);

            $(api.column(2).footer()).html(
                pageTotal
            );
            $(api.column(3).footer()).html(
                total
            );
            $(api.column(4).footer()).html(
                dechet
            );
            $(api.column(5).footer()).html(
                poid
            );
            $(api.column(6).footer()).html(
                formatTime(time)
            );
        }
    });

    function function_extrusion() {
        $('.edit_extrusion').on('click', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            var param = "extrusion";
            $.post(base_url + 'Production/detail_extrusion_production', {
                id
            }, function(datas) {

                if (datas != false) {
                    $('form').attr('action', "update_" + param);
                    $('form').attr('id', param);
                    $('.EX_DATE').val(datas.EX_DATE)
                    $('.EX_BC_ID').val(datas.EX_BC_ID);
                    $('.EX_ID').val(datas.EX_ID)
                    $('.EX_METRE').val(datas.EX_METRE);
                    $('.EX_PDS_BRUT').val(datas.EX_PDS_BRUT);
                    $('.EX_DECHETS').val(datas.EX_DECHETS);
                    $('.EX_DEBUT').val(datas.EX_DEBUT);
                    $('.EX_FIN').val(datas.EX_FIN);
                    $('.EX_QAURT').val(datas.EX_QAURT);
                    $('.EX_N_MACH').val(datas.EX_N_MACH);
                    $('.EX_Nbre_rlx').val(datas.EX_RLL);
                    $('.EX_TAILL').val(datas.EX_TAILL);
                    $('.EX_EQUIP').val(datas.EX_EQUIP);
                    $('.EX_OPERETEUR_1').val(datas.EX_OPERETEUR_1);
                    $('.EX_OPERETEUR_2').val(datas.EX_OPERETEUR_2);
                    $('.EX_OBS').val(datas.EX_OBSERVATION1);
                    $("#modalProccess").modal().show()
                }
            }, 'json');
        });
        $('.delete_extrusion').on('click', function(event) {
            event.preventDefault();
            var id = $(this).attr('id');
            $.post(base_url + "Production/delete_extrusion_production", {
                id
            }, function($data) {
                table.ajax.reload();
            });
        });


    }


    $('#btn_extrusion').on('click', function(event) {
        event.preventDefault();
        $('#ModalTitles').text($(this).text());
        $('.EX_QAURT').val("J");
        $('.EX_N_MACH').val("MACHINE 1");
        $("input,textarea").val("");
        $('form').attr('action', "sachet_extrusion");
        $('#modalProccess').modal('show');

    });

    $('.poex').autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#modalProccess"
    });
    $('.op').autocomplete({
        source: base_url + "Production/autocomplete_operateur",
        appendTo: "#modalProccess"
    });
    $('.exbtndate').on('click', function(e) {
        e.preventDefault();
        let date = $('.exinpdate').val();
        let machine = $('.machineextrusion').val();
        let operateurs = $('.opextrusion').val();
        let quartExtrusion = $('.quartExtrusion option:selected').val();
        let type = $('#type_mat option:selected').val();
        let exinpdatedebut = $('.exinpdatedebut').val();
        var type_mat = $('#type_mat option:selected').val(); 
        let po = $('.po').val();
        let link = base_url + 'Production/sachet_extrusion_data_list?date=' + date + '&machine=' + machine +
            "&operateurs=" + operateurs + "&debut=" + exinpdatedebut + "&quart=" + quartExtrusion + "&po=" + po+"&type_mat="+type_mat;
        $('.exportExtrusion').attr('href', base_url + "Production/exportExtrusion?date=" + date +
            '&machine=' + machine + "&operateurs=" + operateurs + "&debut=" + exinpdatedebut +
            "&quart=" + quartExtrusion + "&po=" + po + "&type=" + type+"&type_mat="+type_mat);
        table.ajax.url(link);
        table.ajax.reload();
    });

    $('form').on('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var $this = $(this);
        var url = $this.attr('action');
        $.ajax({
            type: 'POST',
            url: base_url + "Production/save_" + url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                table.ajax.reload();
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
        var htmls =
            '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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