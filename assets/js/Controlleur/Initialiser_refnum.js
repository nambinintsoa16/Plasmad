$(document).ready(function() {
    $("#show_result").on("click", function(event) {
        event.preventDefault();
        let int_table = $("#int_table option:selected").val();
        let type = $("#type option:selected").val();
        let refnum = $("#refnum").val() - 1;
        $.post(
            base_url + "Controlleur/init_refnum", { int_table, type, refnum },
            function(data) {
                $.post(
                    base_url + "Controlleur/return_last_rehum", { int_table, type },
                    function(data) {
                        $("#refnum_now").empty().append(data);
                        $("#refnum").val("");
                        alertMessage("Succés", "Refnum initialiser.", "success", "btn btn-success");
                    }
                );
            }
        );
    });

    $("#int_table, #type").on("change", function(event) {
        event.preventDefault();
        let int_table = $("#int_table option:selected").val();
        let type = $("#type option:selected").val();
        $.post(
            base_url + "Controlleur/return_last_rehum", { int_table, type },
            function(data) {
                $("#refnum_now").empty().append(data);
            }
        );
    });


    $("#show_result_cintre").on("click", function(event) {
        event.preventDefault();
        let type = $("#type_cintre option:selected").val();
        let refnum = $("#refnum_cintre").val() - 1;
        $.post(
            base_url + "Controlleur/init_refnum_cintre", { type, refnum },
            function(data) {
                $.post(
                    base_url + "Controlleur/return_last_refnum_cintre", { type },
                    function(data) {
                        $("#refnum_now_cintre").empty().append(data);
                        $("#refnum_cintre").val("");
                        alertMessage("Succés", "Refnum initialiser.", "success", "btn btn-success");
                    }
                );
            }
        );
    });

    $("#type_cintre").on("change", function(event) {
        event.preventDefault();
        let type = $("#type_cintre option:selected").val();
        $.post(
            base_url + "Controlleur/return_last_refnum_cintre", { type },
            function(data) {
                $("#refnum_now_cintre").empty().append(data);
            }
        );
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
});