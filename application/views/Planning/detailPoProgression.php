<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control form-control-sm auto" placeholder="N°PO">
    </div>
    <div class="col-md-6">
        <a href="#" class="btn btn-info btn-sm afficeProd"> <i class="fa fa-tv"></i> AFFICHER</a>
    </div>
</div>
<div class="main-containte mt-3"></div>
<script>
    $(document).ready(function() {
        $('.afficeProd').on('click', function(e) {
            e.preventDefault();
            var PO = $('.auto').val();
            $.post(base_url + "Planning/detailPoPro", {
                PO: PO
            }, function(data) {
                $('.main-containte').empty().append(data);
            });

        });

        $('.auto').autocomplete({
            source: base_url + "Magasiner/autocompletPo",
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
    });
</script>