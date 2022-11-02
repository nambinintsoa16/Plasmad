<div class="col-md-12 p-2">
    <fieldset class="border p-2 bg-white mb-2">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">N° PO</label>
                <input type="text" class="form-control form-control-sm ponum" placeholder="N° PO">
            </div>
            <div class="form-group col-md-4 mt-1">
                <a href="#" class="btn btn-success btn-sm mt-4 affincher"><i class="fa fa-tv"></i> AFFICHER</a>
            </div>
        </div>
    </fieldset>
</div>
<div class="col-md-12 p-2">
    <fieldset class="border p-2 bg-white mb-2 dataMatier">


 </fieldset>

</div>
<script type="text/javascript">
    $(document).ready(function(){
         $('.ponum').autocomplete({
            source: base_url + "Production/autocompletPo",
         });
        $('.affincher').on('click',function(event){
            event.preventDefault();
            chargement();
            var id = $('.ponum').val();
                var param = "exinpression";
                $.post(base_url + 'Production/editImprimermatier', {
                    id: id
                }, function(data) {
                    closeDialog();
                    if (data != false) {
                        $('.dataMatier').empty().append(data);
                    } else {
                        alertMessage('', 'Page introuvable, veuillez réessayer!', 'error',
                            'btn btn-danger');
                    }
                }, 'json');

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