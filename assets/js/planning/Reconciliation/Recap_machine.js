$(document).ready(function() {
    $("#affincher").on("click", function(e) {
        e.preventDefault();
        let machine = $("#machine option:selected").text();
        let date = $("#date").val();
        let specification = $("#machine option:selected").val();
        let link = "";
        switch (specification) {
            case "IMPRESSION_EXTRUSION":
                link = base_url + "Planning/get_recap_machine_impression";
                break;
            case "EXTRUSION":
                link = base_url + "Planning/get_recap_machine_extrusion";
                break;
            default:
                break;
        }
        $.post(link, { machine, date }, function(data) {
            $("#result_containt").empty().append(data);
        });
    });
});