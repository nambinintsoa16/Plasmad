
		<fieldset class="border w-100 p-2">
			<div class="row">
				<div class="form-group col-md-3">
					<input type="date" name="" id="" class="form-control form-control-sm choixdate" placeholder="" aria-describedby="helpId">
				</div>
				<div class="form-group col-md-3">
					<label for="dateLivre"></label>
					<button type="submit" class="btn btn-success btn-sm changeDate">AFFICHER</button>
				</div>

<?php  $i=1; foreach ($data as $key => $data): ?>
	<div class="col-md-12 mt-2">
		<table class="table-strepted tableProduitFini table-bordered p-0 w-100">
						<thead>
							<tr>
								<td style="width: 150px;"><?=$data->BC_DATE?></td>
								<td style="width: 150px;"><?=$data->BC_PE?></td>
								<td style="width: 150px;"><?=$data->BC_CLIENT?></td>
								<td style="width: 150px;"><?=$data->BC_CODE?></td>
								<td style="width: 150px;"><?=$data->BC_DIMENSION?></td>
								<td style="width: 150px;"><?=$data->BC_QUNTITE?></td>
								<td style="width: 150px; text-align: center;">	
									<a href="#" class="collapsed" data-toggle="collapse" data-target="#tab_<?=$i?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
								</td>
							</tr>
						</thead>
						
					</table>
		
	</div>
	<?php 
  $this->load->model('magasiner_model');
  $datas = $this->magasiner_model->dataLivraison(['EF_TYPE'=>'sortie',"entre_produit_fini.BC_ID"=>$data->BC_PE,"EF_ORIGIN"=>'PLASMAD_MAGASIN']);
	
	?>
	<div class="col-md-12">
			<div class="collapse mt-2" id="tab_<?=$i?>" style="padding: 0px;">
				<table class="table-strepted tableProduitFini table-bordered w-100">
						<thead class="bg-primary text-white">
						<tr>
							    <td>STOCK INIT</td>
								<td>QUANTITE ENTREE</td>
								<td>TAILLE</td>
								<td>N°PO SURPLUS</td>
								<td>QUANTITE SURPLUS</td>
								<td>QUANTITE LIVREE</td>
								<td>STOCK FINAL</td>
								<td>DATE DE LIVRAISON</td>
								<td>N°BL</td>
						 </tr>
						</thead> 
						<tbody>
							<?php
							
						
							foreach ($datas as $key => $row): 
								$dataPlus = $this->magasiner_model->dataentre_produit_fini(['EF_TYPE'=>'sortie',"EF_REMARQUE"=>$row->BC_ID]);
								$fini = "";
								$qtt = 0;	
								if($dataPlus){
									foreach ($dataPlus as $key => $dataPlus) {
										if($fini==""){
											$fini .= $dataPlus->BC_ID;
										}else{
											$fini .= ','.$dataPlus->BC_ID;
										}
										$qtt += $dataPlus->EF_QUANTITE;
										
									}
								}
								$sfn =0;
								$bon = $this->magasiner_model->bondecommande(['BC_PE'=>$row->BC_ID]);
								$stokMagasin = $this->magasiner_model->selectstock_produit_fini(['STF_TAIL'=>$row->STF_TAIL,'BC_ID'=>$row->BC_ID]);
								//$reste = $bon->BC_QUNTITE - $row->EF_QUANTITE - $qtt;
								$dataentre = $this->magasiner_model->dataLivraison(['STF_TAIL'=>$row->STF_TAIL,'EF_TYPE'=>'entre',"entre_produit_fini.BC_ID"=>$data->BC_PE,"EF_ORIGIN"=>'PLASMAD_MAGASIN']);
								if($dataentre){
									foreach ($dataentre as $key => $dataentre) {
										$sfn +=$dataentre->EF_QUANTITE;
									}
								}
								$livre = 0;
								$dataSortie = $dataentre = $this->magasiner_model->dataentre_produit_fini(["EF_BL"=>$row->EF_BL,"EF_TYPE"=>"sortie"]);
								if($dataSortie){
									foreach ($dataSortie as $key => $dataSortie) {
										$livre+= $dataSortie->EF_QUANTITE;
									}
								}


								?>
							 <tr>
								<td><?=$row->STF_QUANTITE?></td>
								<td><?=$sfn?></td>
								<td><?=$row->EF_TAILL?></td>
								<td><?=$fini?></td>
								<td><?=$qtt?></td>
								<td><?=$livre?></td>
								<td><?=$row->STF_QUANTITE?></td>
								<td><?=$row->EF_DATE?></td>
								<td><?=$row->EF_BL?></td>
							</tr>	
							<?php endforeach ?>
					</tbody>
					</table>
			  </div>
	     </div>	
<?php $i++; endforeach ?>						
		</fieldset>

<script>
$(document).ready(function(){ 
 /*Tablesx = $(".tableProduitFini").dataTable({
    processing: true,
    ajax:base_url+"Magasiner/dataMagasin",
});
*/
$('.changeDate').on('click',function(){
	var page = "HISTORIQUE DE LIVRAISON";
	var date = $('.choixdate').val();
	chargement();
	$.post(base_url+"Magasiner/page",{page:page,date:date},function(data){
		$('.main').empty().append(data);
		closeDialog();
	});
     
});
 
function chargement(){
	var htmls='<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';  
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
  
  function closeDialog(){
   $('.jconfirm').remove();
  }
/*

 $('.choix').on('change',function(){
     var choix = $(this).val();
     if(choix=="STOCKS PRODUITS FINIS"){
        var  links = base_url +"Magasiner/dataProduitFini";     
     }else{
        var  links = base_url +"stock/dataProduitFini";
     }
     Tablesx.api().ajax.url(links);
     Tablesx.api().ajax.reload();
    });*/
            
});
</script>



								