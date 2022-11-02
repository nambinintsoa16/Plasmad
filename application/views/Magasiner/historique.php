<div class="card bg-default">
	<div class="card-header bg-dark text-white">
		<b>HISTORIQUE</b>
		<b class="pull-right">
		   <input type="text" class="mr-3 po" name="po" placeholder="Entre N°PO">
		   <input type="date" class="mr-3 choixdate" name="date">
           <button type="submit" class="btn btn-success btn-sm changeDate">AFFICHER</button> 
		   <a href="<?=base_url("Magasiner/exportentrelivrasoin")?>" class="btn btn-sm btn-primary"><i class="fa fa-download"></i></a>


		     <a href="<?=base_url("Magasiner/printLivraison?date=$date&po=$po")?>" class="btn btn-sm btn-primary print"><i class="fa fa-print"></i>Imprimer</a>
	
		</b>
	</div>
	<div class="card-body">
		<fieldset class="border w-100 p-2">
			<div class="row">
<?php  $i=1; foreach ($data as $key => $data): ?>
	<div class="col-md-12 mt-2">
		<table class="table-strepted tableProduitFini table-bordered p-0 w-100">
						<thead class="text-dark">
							<tr>
								<td style="width: 150px;" class="choixdates"><?=$data->BC_DATE?></td>
								<td style="width: 150px;" class="pos"><?=$data->BC_PE?></td>
								<td style="width: 150px;"><?=$data->BC_CLIENT?></td>
								<td style="width: 150px;"><?=$data->BC_CODE?></td>
								<td style="width: 150px;"><?=$data->BC_DIMENSION?></td>
								<?php if($data->BC_TYPEPRODUIT =="GAINES"): $unite =" | KG"; ?>
									<td style="width: 150px;"><?=$data->BC_QUNTITE?> | KG </td>
								<?php else : $unite =" | KG"; ?>
									<td style="width: 150px;"><?=$data->BC_QUNTITE?> | PCS </td>
								<?php endif;?>
								<td style="width: 150px;" class="quantiteEntre"></td>
								<td style="width: 150px; text-align: center;">	
									<a href="#" class="collapsed" data-toggle="collapse" data-target="#tab_<?=$i?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
								</td>
							</tr>
						</thead>
						
					</table>
		
	</div>
	<?php 
  $this->load->model('magasiner_model');
  $datas = $this->magasiner_model->dataLivraison("EF_TYPE like 'sortie' AND entre_produit_fini.BC_ID like '".$data->BC_PE."' AND EF_ORIGIN like 'PLASMAD_MAGASIN' AND STF_ORIGIN like 'PLASMAD_MAGASIN' GROUP BY entre_produit_fini.EF_ID");

	?>
	<div class="col-md-12">
			<div class=" mt-2" id="tab_<?=$i?>" style="padding: 0px;">
				<table class="table-strepted tableProduitFini table-bordered w-100">
						<thead class="bg-primary text-white">
						<tr>
								<!--<td>QUANTITE ENTREE</td>-->
								<td>TAILLE</td>
								<td>N°PO SURPLUS</td>
								<td>QUANTITE SORTIE SURPLUS</td>
								<td>QUANTITE SORTIE MAGASIN</td>
								<td>QUANTITE LIVREE</td>
								<td>REST A LIVRE</td>
								<td>DATE DE LIVRAISON</td>
								<td>N°BL</td>
								<td></td>
						 </tr>
						</thead> 
						<tbody>
							<?php
							$p=0;
							$stfinal = 0;
							$sortieTotal = 0;
							$sortieSurplusTotal = 0;
							$qttlivre = 0;
						    $entreTot = 0;
							foreach ($datas as $key => $row): 
								$dataPlus = $this->magasiner_model->dataentre_produit_fini(['EF_TYPE'=>'sortie',"EF_REMARQUE"=>$row->BC_ID,"EF_BL"=>$row->EF_BL]);
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
								$dataSortie = $dataentre = $this->magasiner_model->dataentre_produit_fini(["EF_BL"=>$row->EF_BL,"EF_TYPE"=>"sortie","BC_ID"=>$row->BC_ID,"EF_ORIGIN"=>'PLASMAD_MAGASIN',"EF_TAILL"=>$row->EF_TAILL]);
								if($dataSortie){
									foreach ($dataSortie as $key => $dataSortie) {
										$livre+= $dataSortie->EF_QUANTITE;
									}
								}
 
	                             $sortieStock = 0;
								$dataSortieStock = $this->magasiner_model->dataentre_produit_fini(["EF_BL"=>$row->EF_BL,"EF_TYPE"=>"sortie","EF_REMARQUE"=>"vide","BC_ID"=>$row->BC_ID,"EF_TAILL"=>$row->EF_TAILL]);
								if($dataSortieStock){
									foreach ($dataSortieStock as $key => $dataSortieStock) {
										$sortieStock+= $dataSortieStock->EF_QUANTITE;
									}
								}
                                $quantiteArre = explode(' ',$data->BC_QUNTITE);
								if($p==0){
									$entreTot = $sfn;
									if( is_array($quantiteArre)){
										$stfinal = $quantiteArre[0] - $sortieStock;  
									}else{
										$stfinal = $data->BC_QUNTITE - $sortieStock;
									}
									
									$p++;
								}else{
									$stfinal = $stfinal - $sortieStock;
								}
									$sortieTotal += $sortieStock;
									$sortieSurplusTotal += $qtt;
									$qttlivre += $livre;
								?>
							 <tr>
							<!--	<td><?=$row->STF_QUANTITE?></td>-->
							<!--	<td><?=$sfn?></td> -->
								<td><?=$row->EF_TAILL?></td>
								<td><?=$fini?></td>
								<td><?=$qtt?></td>
								<td><?=$sortieStock?></td>
								<td><?=$livre?></td>
								<td><?=$stfinal ?></td>
								<td><?=$row->EF_DATE?></td>
								<td><?=$row->EF_BL?></td>
								<td class="text-center"> <a href="<?=base_url('magasiner/deleteMovemenetStock/'.$row->EF_ID."/".$row->STF_ID)?>" class="text-danger delete"><i class="fa fa-trash"></i></a></td>
							</tr>	
							<?php endforeach ?>
					</tbody>
					<tfoot class="bg-warning text-white">
						<tr>
							<td>SOMME</td>
							<td></td>
							<td><?=$sortieSurplusTotal?></td>
							<td><?=$sortieTotal?></td>
							<td><?=$qttlivre ?></td>
							<td>
                        <?=$stfinal?> 
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
					</table>
					<label class="commande collapse"><?=$entreTot?></label>
			  </div>
	     </div>	
<?php $i++; endforeach ?>						
		</fieldset>
	</div>
</div>
<script>
$(document).ready(function(){ 
 /*Tablesx = $(".tableProduitFini").dataTable({
    processing: true,
    ajax:base_url+"Magasiner/dataMagasin",
});
*/
//$('.quantiteEntre').text($('.commande').text());
$('.changeDate').on('click',function(){
	var page = "HISTORIQUE DE LIVRAISON";
	var date = $('.choixdate').val();
	var po = $('.po').val();
	chargement();
	$.post(base_url+"Magasiner/page",{page:page,date:date,po:po},function(data){
		$('.print').attr('href',base_url+"Magasiner/printLivraison?date="+date+"&po="+po);
		$('.main').empty().append(data);
        deleteTras();
		closeDialog();
	});
     
});
function deleteTras(){
	$('.delete').on('click',function(event){
	event.preventDefault();
	var page = "HISTORIQUE DE LIVRAISON";
	var date = $('.choixdates').text();
	var po = $('.pos').text();
	chargement();
	$.get($(this).attr('href'),function(){
		$.post(base_url+"Magasiner/page",{page:page,date:date,po:po},function(data){
			$('.main').empty().append(data);
			deleteTras();
			closeDialog();
	    }); 
	});
});
}

   $('.po').autocomplete({
	source : base_url + "Production/autocompletPo",	 
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
  
});
</script>



								