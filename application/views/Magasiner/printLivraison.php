
		<fieldset class="border w-100 p-2">
			<div class="row">
<?php  $i=1; foreach ($data as $key => $data): ?>
	<div class="col-md-12 mt-2">
		<table class="table-strepted tableProduitFini table-bordered p-0 w-100">
						<thead class="text-dark">
							<tr style="border: solid black 1px;">
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
						<tr style="border: black solid 1px">
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
							 <tr style="border: black solid 1px">
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
					
			  </div>
	     </div>	
<?php $i++; endforeach ?>						
		</fieldset>
	</div>
</div>



								