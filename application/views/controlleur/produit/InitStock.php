<form class="w-100">
    <div class="row">
        <div class="form-group col-md-5 text-right">
            <input type="file" name="file" class="form-control file form-control-sm">
        </div>
        <div class="form-group col-md-2 text-right">
            <button type="submit" class="btn btn-success btn-sm inport">IMPORTER</button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            chargement();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: base_url + "Magasiner/initStock",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('input').val('');
                    closeDialog();
                    alertMessage("Succè!", "Enregistré!", "success", "btn btn-success");
                },
                error: function() {
                    closeDialog();
                    alertMessage("Erreur", "Une erreur s'est produit", "error", "btn btn-danger");
                }
            });
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

    function closeDialog() {
        $('.jconfirm').remove();
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
</script>