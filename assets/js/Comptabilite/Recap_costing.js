$(document).ready(function() {
    $('.AfficherCost').on('click', function(e) {
        e.preventDefault();
        var date = $('.dateCost').val();
        var client = $('.client').val();
        chargement();
        $.post(base_url + "Comptabilite/data_recap_costing", { date, client, }, function(data) {
            $('#data_containt').empty().append(data);
            closeDialog();
        }).fail(() => {
            closeDialog();
            swal("Erreur ", "Veuillez réessayer!", {
                icon: "error",
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                },
            });
        });
    });
    $(".modale").on('click', function(e) {
        e.preventDefault();
        $('#modaleLivre').modal("show");

    });
    $('.dataTable').dataTable();
    $('.numpos').autocomplete({
        source: base_url + "commercial/autocomplet_commande",
        appendTo: "#modaleLivre",
        select: function(ui, iteme) {
            var param = iteme.item.value.trim();
            /*$.post(base_url+"Comptabilite/dataCoupe",{param:param},function(data){
            		$('.dataConfim').empty().append(data);	   
            },'json');*/
        }
    });


    $('.client').autocomplete({
        source: base_url + "Comptabilite/autocompletClient",
    });
    $('.clientPo').autocomplete({
        source: base_url + "Comptabilite/autocompletClient",
        appendTo: "#modaleLivre",
    });

    $('.afficheSortie').on('click', function(e) {
        e.preventDefault();
        var numpos = $('.numpos').val();
        var clientPo = $('.clientPo').val();
        chargement();
        $.post(base_url + "Comptabilite/detailLivre", {
            numpos: numpos,
            clientPo: clientPo
        }, function(data) {
            if (data.reponse == "false") {
                closeDialog();
                swal("Erreur! ", "Une c'est produit veuillez recommencer", {
                    icon: "error",
                    buttons: {
                        confirm: {
                            className: 'btn btn-danger'
                        }
                    },
                });
            } else {
                closeDialog();
                $('.dataConfim').empty().append(data.data);
                editLivre();
            }

        }, 'json');

    });

    function editLivre() {
        $('.editlivre').on('click', function(e) {
            e.preventDefault();
            var numpos = $('.numpos').val();
            var clientPo = $('.clientPo').val();
            var po = $(this).attr('id');
            $('#modaleLivre').modal("hide");
            swal({
                title: 'Date de livraison',
                html: '',
                content: {
                    element: "input",
                    attributes: {
                        type: "date",
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
                    var date = $('#input-field').val();
                    swal({
                        title: 'bon',
                        html: '',
                        content: {
                            element: "input",
                            attributes: {
                                type: "text",
                                id: "input-fieldbo",
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
                            var bon = $('#input-fieldbo').val();
                            $.post(base_url + 'Comptabilite/livrePo', {
                                po: po,
                                date,
                                bon: bon
                            }, function(data) {
                                $.post(base_url + "Comptabilite/detailLivre", {
                                    numpos: numpos,
                                    clientPo: clientPo
                                }, function(data) {
                                    $('.dataConfim').empty().append(data.data);
                                    editLivre();
                                }, 'json');
                                $('#modaleLivre').modal("show");
                            }, 'json');

                        }
                    );

                });
        });
    }



    $('form').on('submit', function(event) {
        event.preventDefault();
        var fd = new FormData();
        var files = $('.file')[0].files[0];
        fd.append('file', files);
        chargement();
        $.ajax({

            url: base_url + 'Comptabilite/update_recap',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response) {
                closeDialog();
                if (response != 0) {
                    swal("Erreur!", "Veuillez réessayer.", {
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
                closeDialog();
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