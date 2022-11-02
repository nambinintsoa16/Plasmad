<div class="card">
    <div class="card-header bg-dark text-white">
        <b> CONTROL QUALITE</b>
    </div>
    <div class="card-body">
        <form>
            <fieldset class="col-md-12 border">
                <div class="row">
                    <div class="form-group">
                        <label>PO</label>
                        <input type="text" class="form-control form-control-sm npo" name="PO">
                    </div>

                    <div class="form-group">
                        <label>NOM QC </label>
                        <input type="text" class="form-control form-control-sm QC" name="QC">
                    </div>

                    <div class="form-group">
                        <label>QTT ENTREE</label>
                        <input type="text" class="form-control form-control-sm QTT_ENTRE" name="QTT_ENTRE">
                    </div>

                    <div class="form-group">
                        <label>2eme choix </label>
                        <input type="text" class="form-control form-control-sm QTT_STIE" name="QTT_STIE">
                    </div>
                    <div class="form-group">
                        <label>QTy Stie</label>
                        <input type="text" class="form-control form-control-sm CHOIX_DEUX" name="CHOIX_DEUX">
                    </div>
                    <div class="form-group col-md-12 text-right">
                        <button class="btn btn-success">Valider</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <fieldset class="col-md-12 border mt-2 pt-2">
            <table class=" table-strepted table-hover table-bordered table-sm w-100">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>DATE</th>
                        <th>NOM QC</th>
                        <th>PO</th>
                        <th>QTT ENTREE</th>
                        <th>QTy Stie</th>
                        <th>2eme choix</th>
                    </tr>
                </thead>
                <tbody class="dataPoResult">
                </tbody>
            </table>
        </fieldset>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.QC').autocomplete({
                source: base_url + "Production/autocompleteQC",
            });
            $('.npo').autocomplete({
            source : base_url + "Production/autocompletPo",
            select : function(ui,iteme){
                var param= iteme.item.value.trim();
                $.post(base_url+"Production/control",{PO:param},function(data){
                        $('.dataPoResult').empty().append(data);
						if(data != ""){
							$.post(base_url+"Production/coupeQc",{PO:param},function($datas){
								$('.QTT_ENTRE').val($datas);
							});
						}else{
							$('.QTT_ENTRE').val(0);

						}	   
                },'json');
            }
	});

        })
    </script>
