<div class="card w-100">
	<div class="card-header bg-dark text-white">
		<b>PROGRESSION PO </b>
		<b class="pull-right">
			<form action="" method="post">
			    <label>DATE DEBUT : </label>
				<input type="date" class="mr-3 debut" name="findate">
				<label>DATE FIN: </label>
				<input type="date" class="mr-3 fin" name="findate">
				<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
					Afficher</button>
				<a href="<?=base_url("Controlleur/exportStatutPO")?>"
					class="btn btn-sm btn-success export">EXPORT</a>
			</form>

		</b>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="form-group col-md-12 tabs">
				<table class="w-100 table table-light dataTable table-stripted table-hover">
					<thead class="bg-primary text-white">
						<tr>
							<th>N°</th>
							<th>TYPE</th>
							<th>DIMENSION</th>
							<th>COMMANDE</th>
							<th>STATUT</th>
							<th>EXTRUSION</th>
							<th>IMPRESSION</th>
							<th>COUPE</th>
							<th>STOCK MAG</th>
							<th>SURPLUS</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data as $data ):?>
						<tr>
							<td><?=$data->BC_PE?></td>
							<td><?=$data->BC_TYPEPRODUIT?></td>
							<td><?=$data->BC_DIMENSION?></td>
							<td><?=$data->BC_QUNTITE?></td>
							<td><?=$data->BC_STATUT?></td>
							<td class="text-success">

								<?php 
								   $this->load->model('controlleur_model');
								   $extrusion = $this->Controlleur_model->cherchePEEX(['EX_BC_ID'=>$data->BC_PE]);
								   $poidextru =0;
								   $porcentextru=0;
								   $bg="bg-danger"; 
								   if( $extrusion):
								   	foreach ($extrusion as $key => $extrusion) {
								   		$poidextru +=$extrusion->EX_PDS_NET;
								   	}
								?>

								<?php 
									if($data->BC_POISENKGSAVECMARGE !=0){
                                      $porcentextru = ($poidextru*100)/$data->BC_POISENKGSAVECMARGE;
                                    }
									if($porcentextru < 15 AND  0>$porcentextru){
										$bg="bg-warning"; 
									}else if($porcentextru >14){
										$bg="bg-success"; 
									}
								?>
								<?php endif;?>
								<div class="progress">
									<div class="progress-bar  <?=$bg?>" role="progressbar"
										style="width: <?=number_format($porcentextru,2)?>%;" aria-valuenow="25"
										aria-valuemin="0" aria-valuemax="100"><?=number_format($porcentextru,2)?>%</div>
								</div>
							</td>
							<td>
								<?php 
							     $poideInp=0;
								 $porcentImp =0;
								 $impression = $this->Controlleur_model->dataImpressionExtrusion(['BC_ID'=>$data->BC_PE]);
								   if( $impression):
									foreach ($impression as $key => $impression) {
										$poideInp +=$impression->EI_PDS_SOMME;
									}

									if($data->BC_POISENKGSAVECMARGE !=0){
										$porcentImp = ($poideInp*100)/$data->BC_POISENKGSAVECMARGE;
									  }

									  if($porcentImp < 15 AND  0>$porcentImp){
										$bg="bg-warning"; 
									}else if($porcentImp >14){
										$bg="bg-success"; 
									}

								?>
								<?php endif;?>
								<div class="progress">
									<div class="progress-bar <?=$bg?>" role="progressbar"
										style="width:<?=number_format($porcentImp,2)?>%;" aria-valuenow="25"
										aria-valuemin="0" aria-valuemax="100"><?=number_format($porcentImp,2)?>%</div>
								</div>
							</td>

							<?php 
						$poidecoupe =0;
						$porcentCoup =0;
						$coupe = $this->Controlleur_model->dataCoupeExtrusion(['BC_ID'=>$data->BC_PE]);
						
						foreach ($coupe as $key => $coupe) {
							$poidecoupe +=$coupe->ED_1ER_CHOIX_SOMME;
						}
						if($data->BC_QUNTITE){
							$qtt= explode(" ",$data->BC_QUNTITE);
							if(count($qtt)>  1){
								if($qtt[0] !=0){
									$porcentCoup +=  ($poidecoupe*100)/$qtt[0];
								}
							}else{
								$porcentCoup += ($poidecoupe*100)/$data->BC_QUNTITE ;
							}	
							if($porcentCoup < 15 AND  0>$porcentCoup){
										$bg="bg-warning"; 
									}else if($porcentCoup >14){
										$bg="bg-success"; 
									}

						}
						
					 ?>
							<td class="text-success">
								<div class="progress">
									<div class="progress-bar <?=$bg?>" role="progressbar"
										style="width: <?=$porcentCoup?>%;" aria-valuenow="25"
										aria-valuemin="0" aria-valuemax="100"><?=number_format($porcentCoup,2)?>%</div>
								</div>
							</td>
							<td><?php
							$sommeMag = 0;
						    $sommeMags = $this->Controlleur_model->Allstock_produit_fini(["STF_ORIGIN"=>"PLASMAD_MAGASIN","BC_ID"=>$data->BC_PE]);
							foreach( $sommeMags as  $sommeMags ){
								$sommeMag += $sommeMags->STF_QUANTITE;
							}
							echo $sommeMag;

                              
							?>
							</td>	
							<td><?php 
							$sommePlus = 0;
						    $surplus = $this->Controlleur_model->Allstock_produit_fini(["STF_ORIGIN"=>"PLASMAD_STOCK","BC_ID"=>$data->BC_PE]);
							foreach( $surplus as  $surplus ){
								$sommePlus += $surplus->STF_QUANTITE;
							}
							echo $sommePlus;
							?></td>
							<td> <a href="#" id="<?=$data->BC_PE?>" class="btn btn-success btn-sm detailProgre" ><i class="fa fa-info"></i></a> </td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modaleInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h5 class="modal-title" id="exampleModalLongTitle">DETAIL PRODUCTION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body dataProd">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">FERMER</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.dataTable').dataTable({
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
		});
        $('.AfficherCost').on('click',function(e){
        	e.preventDefault();
        	var debut = $('.debut').val();
			var fin = $('.fin').val();
				chargement();
        	$.post(base_url+'Controlleur/page',{page:"STATUT PO",debut:debut,fin:fin},function(data){
        		$('.mainProdact').empty().append(data);
				closeDialog();
        	});

        });
		$('.detailProgre').on('click', function(e) {
			e.preventDefault();
			var po = $(this).attr('id');
			$.post(base_url + 'Comptabilite/detailProduction', {
				po: po
			}, function($data) {
				$('.dataProd').empty().append($data);
				$('#modaleInfo').modal('show');
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
	});
</script>
