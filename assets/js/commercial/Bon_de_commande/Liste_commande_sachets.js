$(document).ready(function() {

    let link = base_url + 'Commercial/liste_commande_sachet';
    Table = $("#table_liste_commande").DataTable({
        processing: true,
        ajax: link,
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
        "columnDefs": [{
            "targets": [6],
            "orderable": false,

        }],
        "rowCallback": function(row, data) {

        },
        initComplete: function(setting) {
            // data_function();
        },
        "drawCallback": function(settings) {
            data_function();
        }
    });

    function data_function() {

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
            var refnum_pe = $(".npe").text();
            if (text == "") {
                $("textarea").addClass("border border-danger");
            } else {
                $.post(base_url + "Commercial/annule_commande", { refnum_pe, text }, function() {
                    $("#exampleModalCenter").modal("hide");
                    $("textarea").val("");
                    Table.ajax.reload();
                });
            }
        });

        $('.lire-obse').on('click', function(e) {
            e.preventDefault();
            let po = $(this).attr('id');
            $('.obse-content').empty();
            $.post(base_url + "Commercial/get_observation", { po }, function(data) {
                $('.npeObs').text(po);
                $('.obse-content').append(data);
                $('#observationModal').modal('show');
            });



        });

        $(".edit_post").on("click", function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var refnum_pe = parent.children().first().text();
            $.post(base_url + "Commercial/detail_commande", { refnum_pe }, function(data) {
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
                $('.imprimerprecosting').attr('href', base_url + 'Commercial/print_costing?refnum=' + data.BC_PE);
                $('.imprimer').attr('href', base_url + 'Commercial/printFacture?po=' + data.BC_PE);
                $("#infoCOmmande").modal("show");
            }, "json");
        });

        $(".removeModal").on("click", function() {
            $("#infoCOmmande").modal("hide");
        });
        $('.recherche').on('click', function(event) {
            event.preventDefault();
            var anneliste = $('#anneliste option:selected').text();
            var moisliste = $('#moisliste option:selected').val();
            var debut = $('.debut').val();
            var fin = $('.fin').val();
            var links = base_url + "Commercial/recherche_commande_specifique/" + anneliste + "/" + moisliste + "/" + debut + "/" + fin;
            Table.ajax.url(links);
            Table.ajax.reload();

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

            $.post(base_url + "Commercial/upadate_commande", { content }, function() {
                $("#infoCOmmande").modal("hide");
                Table.ajax.reload();
            });


        });

        $('.selectgroup-input').on('click', function() {
            $('.selectgroup-input').removeClass('checked');
            $(this).addClass('checked');
            var links = base_url + "Commercial/recherche_commande_specifique/";
            Table.ajax.url(links);
            Table.ajax.reload();

        });

    }

});