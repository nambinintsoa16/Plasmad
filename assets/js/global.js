$(document).ready(function() {
    $('#edit_image_user').on('click', function(e) {
        e.preventDefault();
        $('#modal_modif_Image').modal().show();
    });

    $('#image').on('change', (e) => {
        let that = e.currentTarget
        if (that.files && that.files[0]) {
            $(that).next('.custom-file-label').html(that.files[0].name)
            let reader = new FileReader()
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(that.files[0])
        }
    });
    $('#change_pass').on('click', function(event) {
        event.preventDefault();
        $.confirm({
            title: "<h2><i class='icon icon-lock'></i>&nbsp;Changer mot de passe</h2>",
            content: "url:" + base_url + "Globals/change_passe",
            columnClass: "col-md-4",
            onContentReady: function() {

            },
            buttons: {
                formSubmit: {
                    text: "confirmer",
                    btnClass: "btn-success",
                    action: function() {;
                        let old_pass = this.$content.find("#old_pass").val();
                        let new_pass = this.$content.find("#new_pass").val();
                        let conf_pass = this.$content.find("#conf_pass").val();
                        if (old_pass == "" || new_pass == "" || conf_pass == "") {
                            $.alert("Tous les champs sont obligatoire.");
                            return false;
                        }
                        if (new_pass.length < 4) {
                            $.alert("Mot de passe trop court.");
                            return false;
                        }
                        if (new_pass != conf_pass) {
                            $.alert("Mot de pass non confirmé.");
                            return false;
                        }


                        $.post(base_url + "globals/change_pass_user", { old_pass, new_pass }, function(data) {
                            // stop_load();
                            if (data.message == "true") {
                                alertCustum(
                                    "Succè!",
                                    "Requêtte traitée.",
                                    "success",
                                    "btn-success"
                                );
                            } else {
                                alertCustum(
                                    "Erreur!",
                                    data.message,
                                    "error",
                                    "btn-danger"
                                );
                            }

                        }, 'json');

                    },
                },
                button: {
                    action: function() {},
                    text: "Fermer",
                    btnClass: "btn-red",
                },
            },
        });

    });
    $('#save_image_users').on('click', function(event) {
        event.preventDefault();
        var fd = new FormData();
        var files = $('.upload')[0].files[0];
        fd.append('file', files);
        $.ajax({
            type: 'POST',
            url: "Globals/change_image_users",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                window.location.reload('/');
            },
            error: function(data) {

            }
        });
    });

    function alertCustum(title, containt, icon, color) {
        swal(title, containt, {
            icon: icon,
            buttons: {
                confirm: {
                    className: color
                }
            },
        });
    }

});