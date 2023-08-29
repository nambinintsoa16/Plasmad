$(document).ready(function() {
    let table = $("#DataTable").DataTable({
        ajax: base_url + "controlleur/data_list_matier_en_attent_de_validation",
        processing: true,
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

        },
        drawCallback: function(settings) {
            action_dataTable();

        },
        initComplete: function(setting) {

        },
    });
    table_modif = $('#dataTable_modif').DataTable({
        processing: true,

        language: {
            url: base_url + "assets/dataTableFr/french.json"
        },
        drawCallback: function(settings) {
            validerModif();
        }

    })

    function action_dataTable() {
        $('.valider').on('click', function(e) {
            e.preventDefault();
            let refnum = $(this).attr('id');
            $.post(base_url + "controlleur/valide_sortie_matiere", { refnum }, function() {

            }).done(() => {
                table.ajax.reload();
            }).fail(() => {

            });

        });

        $('.delete').on('click', function(e) {
            e.preventDefault();
            let refnum = $(this).attr('id');
            $.post(base_url + "controlleur/delete_matiere_attent_validation", { refnum }, function() {
                table.ajax.reload();
            });

        });


    }
    $("#refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        appendTo: "#ajouterProduit"
    });

    $('.machine').autocomplete({
        source: base_url + "Production/autocomplete_machine",
        appendTo: "#ajouterProduit"
    });
    $(".addMat").on('click', function(e) {
        e.preventDefault();
        let matiere = $('.matier').val();
        let quantite = $('.quanatite').val();
        let refnum = $('.po').val();
        let machine = $('.machine').val();
        let prix = $('.prix').val();
        $.post(base_url + "controlleur/insert_validation_matiere", { refnum, quantite, prix, matiere, machine }, function() {
            table.ajax.url(base_url + "controlleur/data_list_matier_en_attent_de_validation");
            table.ajax.reload();
            $('input').val("");
        });

    });
    $(".matier").autocomplete({
        appendTo: "#ajouterProduit",
        source: base_url + "stock/autocomplete_matiere_sortie_magasin",
        select: function(item, label) {
            item.preventDefault();
            let rep = label.item.label.split("|");
            $('.matier').val(rep[1].trim());
            $('.prix').val(rep[2].trim());
        }

    });

    $('.add').on('click', function(e) {
        e.preventDefault();
        $('#modal_form_edit').modal("hide");
        $('.quanatite').val("");
        $('.machine').val("");
        $('.prix').val("");
        $('#ajouterProduit').modal("show");
    });
    $("#hide_modal").on("click", function() {
        table_modif.ajax.reload();
        $('#modal_form_edit').modal("show");
    });

    function validerModif() {

        $('.supprimer').on('click', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.post(base_url + "controlleur/deleteSortieTransac", { id }, function() {
                table_modif.ajax.reload();
                Table.ajax.reload();
            });

        });


    }
});