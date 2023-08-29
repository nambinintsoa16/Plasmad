$(document).ready(function() {
    table = $(".dataTable").DataTable({
        processing: true,
        ajax: base_url + "Comptabilite/matiere_liste_Data",
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        dom: 'Bfrtip',
        columnDefs: [

            {
                'searchable': false,
                'targets': [5]
            },
        ],
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
            data_list_fonction();
        },
        drawCallback: function(settings) {
            data_list_fonction();
        },
        initComplete: function(setting) {
            data_list_fonction();
        },
    });
    $("#save_matiere").on("click", function(e) {
        e.preventDefault();
        chargement();
        let methodOk = false;
        let designation = $("#designation_new").val();
        let prix_usd = $("#prix_usd_new").val();
        let prix_ariary = $("#prix_ariary").val();
        let type_matiere_new = $("#type_matiere_new option:selected").val();
        $.post(
            base_url + "Comptabilite/save_matiere", { designation, type_matiere_new, prix_usd, prix_ariary },
            function(data) {
                methodOk = data == 1;
                closeDialog();
                if (methodOk) {
                    $("input").val();
                    table.ajax.reload();
                    $("#form_matier_modal").modal("hide");
                    swal("Succè ", "Matiere Enregistré!", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
                if (!methodOk) {
                    swal("Erreur", "Matiere non Enregistré!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: "btn btn-danger",
                            },
                        },
                    });
                }
            }
        );
    });

    function data_list_fonction() {
        $(".edit_matiere").on("click", function(event) {
            event.preventDefault();
            $this = $(this).parent().parent().children();
            let refnum_produit = $(this).attr('id');
            $('#refnum_update').val(refnum_produit);
            $('#designation_update').val($this.eq(0).text());
            $('#prix_usd_update').val($this.eq(2).text());
            $('#prix_ariary_update').val($this.eq(3).text());
            $('#form_modal_update').modal('show');
        });
    }
    $("#update_matiere").on('click', function(event) {
        event.preventDefault();
        var designation = $('#designation_update').val();
        var prix_usd = $('#prix_usd_update').val();
        var prix_ariary = $('#prix_ariary_update').val();
        var refnum = $('#refnum_update').val();

        $.post(base_url + 'Comptabilite/update_matiere', {
            designation,
            prix_usd,
            prix_ariary,
            refnum
        }, function(data) {
            methodOk = data == 1;
            if (methodOk) {
                $('#designation_update').val("");
                $('#prix_usd_update').val("");
                $('#prix_ariary_update').val("");
                $('#refnum_update').val("");
                $('#form_modal_update').modal('hide');
                table.ajax.reload();
                swal("Succè!", "Modification effectuée avec succè.", {
                    icon: "success",
                    buttons: {
                        confirm: {
                            className: 'btn btn-success'
                        }
                    },
                });
            }
            if (!methodOk) {
                swal("Erreur!", "Veuillez réessayer.", {
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

    $('form').on('submit', function(event) {
        event.preventDefault();
        var fd = new FormData();
        var files = $('.file')[0].files[0];
        fd.append('file', files);
        chargement();
        $.ajax({

            url: base_url + 'Comptabilite/import_files_matiere_premiere',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                closeDialog();
                if (response == 0) {
                    closeDialog();
                    swal("Erreur!", "Veuillez réessayer.", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                } else {
                    table.ajax.reload();
                    swal("Succè!", "Donnée importé.", {
                        icon: "success",
                        buttons: {
                            confirm: {
                                className: 'btn btn-success'
                            }
                        },
                    });

                }
            },
            error: function(data) {
                closeDialog();
                swal("Erreur!", "Veuillez réessayer.", {
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