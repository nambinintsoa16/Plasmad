$(() => {
    $("form").on("submit", function(event) {
        event.preventDefault();
        var matricule = $(".matricule").val();
        var password = $(".password").val();
        $.post(base_url + "authentification/check_utilisateur", { matricule: matricule, password: password },function() {   
             location.reload();
            }
        );
    });

    $(".control-input-pass").on("click", function(e) {
        e.preventDefault();

        let $this = $(this);
        let $input = $this.parent().parent().parent().children().eq(1);
        let $icon = $this.children().eq(0);
        if ($input.attr("type") === "text") {
            $input.attr("type", "password");
            if ($icon.hasClass("fa-eye")) {
                $icon.removeClass("fa-eye");
                $icon.addClass("fa-eye-slash");
            }
        } else if ($input.attr("type") === "password") {
            $input.attr("type", "text");
            if ($icon.hasClass("fa-eye-slash")) {
                $icon.removeClass("fa-eye-slash");
                $icon.addClass("fa-eye");
            }
        }
    });
});