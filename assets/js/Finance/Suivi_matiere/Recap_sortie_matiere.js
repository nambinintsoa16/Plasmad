$(document).ready(function() {
    $("#show_data").on('click', function(event) {
        event.preventDefault();
        let date_debut = $("#debut").val();
        $.post(base_url + "controlleur/Recap_data_sortie_matiere", { date_debut },
            function(data, textStatus, jqXHR) {
                $("#data_containte").empty().append(data);
            });
    });
});