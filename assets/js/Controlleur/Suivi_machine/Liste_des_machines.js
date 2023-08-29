$(document).ready(function() {
    var table = $("#dataTable").DataTable({
        processing: true,
        ajax: base_url + 'Controlleur/data_list_machine',
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
        drawCallback: function(row, data) {
            delete_function();
        },
        initComplete: function(setting) {
            // delete_function();
        }
    });

    function delete_function() {
        $(".delete_machine").on('click', function(event) {
            event.preventDefault();
            let refnum = $(this).attr('id');
            $.post(base_url + "controlleur/delete_machine", { refnum }, function() {

            }).done(() => {
                table.ajax.reload();
                alertMessage("Succè!", "Machine supprimé.", "success", "btn btn-success");
            }).fail(() => {
                alertMessage("Erreur!", "Erreur veuillez reéssayer.", "error", "btn btn-danger");
            });


        });
    }

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
});