$('document').ready(function() {
      function closeDialog() {
        $('.jconfirm').remove();
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
                $.post(base_url + "Suivi_Commerciale/annuleBonDeCommande", {
                    pe: pe,
                    text: text
                }, function() {
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
            $.post(base_url + "Suivi_Commerciale/detailPE", {
                pe: pe
            }, function(data) {
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
            $.post(base_url + 'Suivi_Commerciale/migreBon', {
                id: id
            }, function(data) {
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

            $.post(base_url + "Suivi_Commerciale/upadatePeCom", {
                content: content
            }, function() {
                $("#infoCOmmande").modal("hide");
                Table.ajax.reload();
            });


        });
    }

    $.post(base_url + "Suivi_Commerciale/page", {
        page: "COMMANDES"
    }, function(data) {
        $('.main').empty().append(data);
        if (dataTableLoad("COMMANDES")) {
            
        }
        closeDialog();
    });

    function dataTableLoad(page, type = null) {

        if (page == "COMMANDES") {
            var link = base_url + 'Suivi_Commerciale/MES_COMMANDES';
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
            var links = base_url + "Suivi_Commerciale/commandeSpecifique/" + type + "/" + anneliste + "/" + moisliste + "/?debut=" + debut + "&fin=" + fin;
            $('.print').attr('href', base_url + "Suivi_Commerciale/exportParam?type=" + type + "&anne=" + anneliste + "&mois=" + moisliste + "&debut=" + debut + "&fin=" + fin);
            Table.ajax.url(links);
            Table.ajax.reload();

        });
        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).attr('id') == "TOUT") {
                var links = base_url + "Suivi_Commerciale/MES_COMMANDES/";
                Table.ajax.url(links);
                Table.ajax.reload();
            } else {
                var links = base_url + "Suivi_Commerciale/commandeSpecifique/" + $(this).attr('id');
                Table.ajax.url(links);
                Table.ajax.reload();
            }
        });
    }
});


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
$('.btn-click').on('click', function(e) {
    e.preventDefault();
    var page = $(this).children().find('b').text();
    chargement();
    $.post(base_url + "Suivi_Commerciale/page", {
        page: page
    }, function(data) {
    $('.main').empty().append(data);
       $('.jconfirm').remove();
        if (page == "COMMANDES") {
           dataTableLoad(page)
             
                dataAction();
            

        }


    });


    function dataTableLoad(page, type = null) {

        if (page == "COMMANDES") {
            var link = base_url + 'Suivi_Commerciale/MES_COMMANDES';
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
            var links = base_url + "Suivi_Commerciale/commandeSpecifique/" + type + "/" + anneliste + "/" + moisliste + "/?debut=" + debut + "&fin=" + fin;
            $('.print').attr('href', base_url + "Suivi_Commerciale/exportParam?type=" + type + "&anne=" + anneliste + "&mois=" + moisliste + "&debut=" + debut + "&fin=" + fin);
            Table.ajax.url(links);
            Table.ajax.reload();

        });
        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            if ($(this).attr('id') == "TOUT") {
                var links = base_url + "Suivi_Commerciale/MES_COMMANDES/";
                Table.ajax.url(links);
                Table.ajax.reload();
            } else {
                var links = base_url + "Suivi_Commerciale/commandeSpecifique/" + $(this).attr('id');
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
                $.post(base_url + "Suivi_Commerciale/annuleBonDeCommande", {
                    pe: pe,
                    text: text
                }, function() {
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
            $.post(base_url + "Suivi_Commerciale/detailPE", {
                pe: pe
            }, function(data) {
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
            $.post(base_url + 'Suivi_Commerciale/migreBon', {
                id: id
            }, function(data) {
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

            $.post(base_url + "Suivi_Commerciale/upadatePeCom", {
                content: content
            }, function() {
                $("#infoCOmmande").modal("hide");
                Table.ajax.reload();
            });


        });
    }
});