<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control form-control-sm auto" placeholder="N°PO">
    </div>
    <div class="col-md-6">
        <a href="#" class="btn btn-info btn-sm afficeProd"> <i class="fa fa-tv"></i> AFFICHER</a>
    </div>
</div>
<div class="main-containte mt-3"></div>

<fieldset class="border w-100 p-2">
            <div class="row">
                <div class="form-group col-md-3">
                    <input type="text" name="" id="" class="form-control form-control-sm po pochereche" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group col-md-3">
                    <input type="date" name="" id="" class="form-control form-control-sm choixdate" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group col-md-3">
                    <label for="dateLivre"></label>
                    <button type="submit" class="btn btn-success btn-sm changeDate">AFFICHER</button>
                </div>

    <div class="col-md-12">
            <div class="mt-2" id="tab_" style="padding: 0px;">
                <table class="table-strepted tableProduitFini table-bordered w-100">
                        <thead class="bg-primary text-white">
                        <tr>
                                <td>N°PO</td>
                                <td>QUANTITE </td>
                                <td>QC</td>
                                <td>QUANTITE LIVREE</td>
                                <td>RESTRE A LIVREE</td>
                                <td></td>
                                
                         </tr>
                        </thead> 
                        <tbody>
                        
                    </table>
              </div>
         </div>                     
        </fieldset>
<script>
    $(document).ready(function() {
       $('.afficeProd').on('click', function(e) {
            e.preventDefault();
         /*    var PO = $('.auto').val();
            $.post(base_url + "Planning/detailLivraison", {
                PO: PO
            }, function(data) {
                $('.main-containte').empty().append(data);
            });*/
    let po = $('.auto').val();
    let date = $('.choixdate').val();
    var links = base_url+"Planning/livraison?date="+date+"&po="+po;
    Table.ajax.url(links);
    Table.ajax.reload();

        });


        Table = $(".tableProduitFini").DataTable({
            processing: true,
            ajax: base_url+"Planning/livraison",
            language: {
                url: base_url + "assets/dataTableFr/french.json"
            },
            "rowCallback": function(row, data) {
                
            },
            initComplete: function(setting) {
                
            },
            "drawCallback": function(settings) {
                Action();
            }
        });
function Action(){

}
$('.changeDate').on('click',function(){
    let po = $('.pochereche').val();
    let date = $('.choixdate').val();
    var links = base_url+"Planning/livraison?date="+date+"&po="+po;
    Table.ajax.url(links);
    Table.ajax.reload();
     
});
$('.pochereche').autocomplete({
            source : base_url + "Production/autocompletPo"
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