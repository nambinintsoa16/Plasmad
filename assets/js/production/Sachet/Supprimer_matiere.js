$(document).ready(function() {
    $("#autocomplete_refnum_commande").autocomplete({
        source: base_url + "Commercial/autocomplet_commande",
        select: function(items, label) {
            let link = base_url + "production/data_list_use_update_matiere_print?refnum=" + label.item.value;
            table.ajax.url(link);
            table.ajax.reload();
        }
    });

    table = $("#table_matiere").DataTable({
        language: {
            url: base_url + "assets/dataTableFr/french.json",
        },
        rowCallback: function(row, data) {
            udpdate_function();
        },
        drawCallback: function(settings) {
            udpdate_function();
        },
        initComplete: function(setting) {
            udpdate_function();
        }
    });

    function udpdate_function() {
        $(".delete_Imprim_matiere").on("click", function(event) {
            event.preventDefault();
            var refnum = $(this).attr("id");
            $.post(base_url + "Production/delete_sachet_refnum_print", { refnum }, function(data) {
                table.ajax.reload();
            });
        });
    }

});