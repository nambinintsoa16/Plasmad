
<!DOCTYPE html>
<html>
<head>
	<title> </title>
</head>
<body>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b>COSTING</b>
		<b class="pull-right">
			<form action="" method="post">
		        <label>N°PO : </label>
				<input type="text" class="mr-3 numpo" name="po">
				<label>DATE : </label>
				<input type="date" class="mr-3 dateCost" name="date">
				<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
					Afficher</button>
			</form>
		</b>
	</div>
	<div class="card-body">
		<div class="row">

			<?php $i = 1;
			foreach ($data as $data) : ?>
			<div class="col-md-12 mt-2">
				<table class="table-strepted tableProduitFini table-bordered p-0 w-100">
					<thead>
						<tr class="bg-primary text-white">
							<td style="width: 65px!important;"><?= $data->BC_DATE ?></td>
							<td style="width: 65px!important;"><?= $data->BC_PE ?></td>
							<td style="width: 210px;"><?= $data->BC_TYPEPRODUIT . " " . $data->BC_DIMENSION ?></td>
							<td style="width: 150px;"><?php
								if($data->BC_TYPEPRODUIT=="GAINES"){
									echo "QUANTITE : ".$data->BC_QUNTITE." | KGS";
								}else{
									echo "QUANTITE : ".$data->BC_QUNTITE." | PCS";
								}
                                         
								?></td>

							<td style="width: 150px;"><?php 
								$this->load->model('compta_model');
                                $prixbon=$this->compta_model->prixbon(['PB_PO'=>$data->BC_PE]);
                                if($prixbon){
					           	echo "P.R.I : ".$prixbon->PB_PRIX;
                                }else{
                                		echo "P.R.I  : 0";
                                }
									?></td>
							<td style="width: 150px;"><?= "PRIX  CONSENTIES: ".$data->BC_PRIX?></td>
							<td style="width: 50px; text-align: center;">
								<a href="#" class="collapsed text-white" data-toggle="collapse"
									data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
							</td>
						</tr>

						<tr class="bg-danger text-white">
							<td><?= $data->BC_STATUT ?></td>
							<td colspan="5">CLIENT : <?= $data->BC_CODE ?></td>
							<td class="text-center">
								<a href="#"  id="<?= $data->BC_PE ?>" class="detailProgre text-white">Détail</a>
							</td>
						</tr>
					</thead>
				</table>

			</div>
			<div class="col-md-12">
				<div class=" mt-2" id="tab_<?= $i ?>" style="padding: 0px;">
					<table class="table-strepted tableProduitFini table-bordered w-100">
						<thead class="bg-primary text-white">
						<tr class="bg-dark text-white">
								<td colspan="5" class="text-center">EXTRUSION</td>
								<td colspan="5" class="text-center"> IMPRESSION</td>
								<td colspan="5" class="text-center"> COUPE </td>
							</tr>
							<tr class="bg-dark text-white">
								<td>DESCRIPTION</td>
								<td>QTE</td>
								<td>UNIT</td>
								<td>PU</td>
								<td>TOTAL</td>

								<td>DESCRIPTION
								<td>QTE</td>
								<td>UNIT</td>
								<td>PU</td>
								<td>TOTAL</td>

								<td>DESCRIPTION
								<td>QTE </td>
								<td>UNIT</td>
								<td>PU</td>
								<td>TOTAL</td>
							</tr>
						
						</thead>
						<tbody>
							<tr>
							<?php

        								 $this->load->model('compta_model');
        								$dextrusion =  $this->compta_model->extrusion(['EX_BC_ID'=>$data->BC_PE]);
        								$extrusion_inpression = $this->compta_model->extrusion_inpression(['BC_ID'=>$data->BC_PE]);
        								$poid = $dextrusion;
        								$poids = 0;
        								$dure = 0;
        								$MAT = 150;
        								$sortir = 0;
        								$EI_DUREE= 0;
        								$MATCOUP=0;
        								$EI_DUREECOUP=0;
        								foreach ($poid as $key => $poid) {
        									if($poid->EX_PDS_SOMME != ""){
        										 $poids += $poid->EX_PDS_NET; 
        										 $dure +=  $this->compta_model->time_to_sec($poid->EX_DUREE);
        										 $sortir +=$poid->EX_PDS_SOMME;

        									}
        								  
        								}
        							$entreInpress = 0;	
        						if($extrusion_inpression){
        							foreach ($extrusion_inpression as $key => $extrusion_inpression) {
                                         	$MAT +=  $extrusion_inpression->EI_POIDS_NET;
                                         	$EI_DUREE += $this->compta_model->time_to_sec( $extrusion_inpression->EI_DUREE);
                                         	$entreInpress += $extrusion_inpression->EI_PDS_SOMME;
                                     }
        						}	
        						$extrusion_coupe = $this->compta_model->extrusion_coupe(['BC_ID'=>$data->BC_PE]);
        						$EI_DUREECOUP = 0;
        						$ED_METRAGE_SOMME = 0;
        						$ED_POID_SORTIE_SOMME = 0;
        						$piece = 0;
        						$metrage = 0;
        						$poidsSomme = 0;
        						if($extrusion_coupe){
        							foreach ($extrusion_coupe as $key => $extrusion_coupe) {
                                         //	$MATCOUP +=  $extrusion_coupe->EI_POIDS_NET;
                                         	//$sortirCoup += $extrusion_coupe->ED_POID_SORTIE_SOMME;
        								      $poientre = "";
                                              $poientre =explode("+", $extrusion_coupe->ED_POID_ENTRE);
                                              foreach ($poientre as $key => $poientre) {
                                              	$poidsSomme += (float)$poientre; 
                                              }
        								    $ED_POID_SORTIE_SOMME  +=  $extrusion_coupe->ED_POID_SORTIE_SOMME;
                                         	$EI_DUREECOUP += $this->compta_model->time_to_sec($extrusion_coupe->ED_DURE);
                                         	$ED_METRAGE_SOMME +=  $extrusion_coupe->ED_METRAGE_SOMME;
                                         	$piece += $extrusion_coupe->ED_1ER_CHOIX_SOMME;
                                         	$metrage += $extrusion_coupe->ED_METRAGE_SOMME;
                                     }
        						}	
						
							   $this->load->model('compta_model');		
                               $control = $this->compta_model->controlData("C_PO ='$data->BC_PE' ORDER BY C_ID DESC");
							   if($control){
								 	foreach($control as $control){
								   			$piece -= $control->C_CHOIX;
								   	}
							   }
                                $matierinression = $this->compta_model->matierinression(['MI_PO'=>$data->BC_PE]);
								$matier = $this->compta_model->stock_materiel(["LI_REFERENCE"=>$data->BC_PE,"LI_TYPE"=>"sortie"]);
								$totalSortie=0;
								$prixTotal= 0;
								$detaiMAt = "";
							$x= 0;
								foreach($matier as $matier){
									$totalSortie += $matier->LI_QUANTITE;
									$prixTotal += $matier->LI_VALEUR*$matier->LI_QUANTITE;
									if($x !=0 ){
										$detaiMAt .= "/".$matier->LI_MATIER;
										$x++;
									}else{
										$detaiMAt .=$matier->LI_MATIER;
										$x++;
									}
									
								}
								$pu = 0;
								if($totalSortie != 0){
									//$pu = ($prixTotal * $poids ) / $totalSortie;
									$pu = $prixTotal /  $totalSortie;
								}
								$pux = $pu*$poids;
								
									$pxMatIpp =$pux + (($dure * 1.062 ) / 3600) + ((($dure *2)* 0.412 ) / 3600);
									$exdure = ($dure * 1.062 ) / 3600;
									$hdue= ($dure *  0.412) / 3600;
									$piodsover = $poids*0.403;

									if($data->BC_TYPE == "SS"){
											$coupe= (($EI_DUREECOUP) * 0.050 ) / 3600;
									}else if($data->BC_TYPE == "BS"){
											$coupe= (($EI_DUREECOUP) * 0.050 ) / 3600;
									}else{
											$coupe= (($EI_DUREECOUP) * 0.050 ) / 3600;
									}

									$imp = ($EI_DUREE * 0.912 ) / 3600;
									$HModIMP= (($EI_DUREE*2) *  0.47) / 3600;


									$hcoupe= ($EI_DUREECOUP * 0.136 ) / 3600;

									


									$sommeex =  $piodsover+$pux + $exdure +  $hdue;
									  $toto = 0;
									if($poids!=0){
																			
										 $toto = number_format($sommeex/$poids,"3");
									}
									$sommeMat=0;
									$varmatiers = $matierinression;
									foreach($varmatiers  as $varmatiers){
										 $sommeMat +=($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE); 

									}
							
									 $totaMatIpp =$entreInpress*$toto; 
									$prixImPrixtotal =$HModIMP+$imp+$totaMatIpp+$sommeMat;
								
								
									?>
								<td><?=	$detaiMAt?></td>
								<td><?=$poids?></td>
								<td>KGS </td>
								<td><?=number_format($pu,2,',','.')?></td>
								<td><?=number_format($pux,2,',','.')?></td>
								<td>MAT</td>
								<td><?=$entreInpress?></td>
								<td>KGS</td>
								<td><?= $toto;?></td>
								<td><?= $totaMatIpp; ?></td>
								<td>MAT </td>
								<td><?=$poidsSomme?></td>
								<td>KGS</td>
								<td><?php
                                    if($entreInpress!=0){
									echo number_format($prixImPrixtotal / $entreInpress,'2');
									$poidsSomme = $poidsSomme*($prixImPrixtotal / $entreInpress);
									}else{

										if($poids==0){
											echo 0;
										}else{
											echo number_format($sommeex/$poids,"3");
											$poidsSomme = $poidsSomme*($sommeex / $poids);
										}
									}?></td>
								<td><?=number_format($poidsSomme,'3')?></td>

							</tr>
							<tr>
								<td>GAINE</td>
								<td>0,00</td>
								<td>KGS</td>
								<td>0,00</td>
								<td>0,0</td>
								<td>GAINE</td>
								<td>0,00</td>
								<td>GAINE</td>
								<td>0,00</td>
								<td></td>
								<td>GAINE</td>
								<td></td>
								<td>GAINE</td>
								<td>0,00</td>
								<td>0,00</td>
							</tr>
							<tr>
								<td>H MACHINE EXTR</td>
								<td><?=   $this->compta_model->se_to_time($dure) ?></td>
								<td>H</td>
								<td>3.08</td>
								<td><?= number_format($exdure,3);?></td>

								<td>H MACHINE IMPR</td>
								<td><?= $this->compta_model->se_to_time($EI_DUREE)?></td>
								<td>H</td>
								<td>0.470</td>
								<td><?php
										
										  echo number_format($imp,3);
                                   

									?></td>

								<td>H MACHINE COUPE</td>
								<td><?= $this->compta_model->se_to_time($EI_DUREECOUP)?></td>
								<td>H</td>
								<td>0,136</td>
								<td><?php
										  
										  echo number_format($hcoupe,3);

									?></td>

							</tr>
							<tr>
								<td>H MOD EXTR</td>
								<td><?= $this->compta_model->se_to_time($dure) ?></td>
								<td>H</td>
								<td>0,412</td>
								<td><?php
										
										 echo number_format($hdue,3);


									?></td>
								<td>H MOD IMPR</td>
								<td><?= $this->compta_model->se_to_time($EI_DUREE*2)?></td>
								<td>H</td>
								<td>0,470</td>
								<td>
									<?php
										
										 echo number_format($HModIMP,3);


									   ?>
								</td>
								<td>H MOD COUPE</td>
								<td><?=$this->compta_model->se_to_time($EI_DUREECOUP)?></td>
								<td>H</td>
								<td>0,50</td>
								<td><?php 

									
									
									 echo number_format($coupe,3);
									
									?></td>
							</tr>
							<?php $siValeur=0; $po = 0;$sommeMat=0; if($matierinression ) :
									 $tab =array();
									 foreach($matierinression  as $matierinression ){
										 if(array_key_exists($matierinression->MI_DESIGNATION, $tab)){
											$tab[$matierinression->MI_DESIGNATION]["QUANTITE"] += $matierinression->MI_QUANTITE;
										

										 }else{
											$tab[$matierinression->MI_DESIGNATION]["QUANTITE"] = $matierinression->MI_QUANTITE;
											$tab[$matierinression->MI_DESIGNATION]["PRIX"] = $matierinression->MI_PRIX;
										 }
                                        
									 }
									foreach($tab as $key=>$tab): 
									 ?>
							<tr>
								<td colspan="5"></td>
								<td><?=$key?></td>
								<td><?=$tab["QUANTITE"]?></td>
								<td>KGS</td>
								<td><?=$tab["PRIX"]?></td>
								<td><?php 
									  echo $tab["QUANTITE"] * $tab["PRIX"];
							
									?></td>
								<?php
 										
									  if( $data->BC_TYPE == "SS" AND  $po == 0){
									  	$metre=$metrage/1000;
                                             $siValeur +=number_format(2.82*$metre,'3'); 
											echo "<td>SEALING TAPE </td><td>".$metre."</td><td>M</td><td>2,82</td><td>".$siValeur."</td>";
											$po++;
									}?>

							</tr>
							<?php endforeach; endif; ?>

							<tr>
								<td>OVERHEADS</td>
								<td><?=$poids?></td>
								<td>KGS</td>
								<td>0.403</td>
								<td colspan="11">
									<?= $piodsover ?>
								</td>
							</tr>
							<tr>
								<td>QTE SORTIE</td>
								<td><?=$sortir?></td>
								<td> </td>
								<td><?php  
									
									if($poids==0){
										echo 0;
									}else{
										echo number_format($sommeex/$poids,"3");
									}
									

									?></td>
								<td><?=number_format($sommeex,'3')?></td>

								<td> QTE SORTIE</td>

								<td> <?=$entreInpress+$sommeMat?></td>
								<td></td>
								<td><?php 
									//$prixImPrixtotal ="";
									//+$HModIMP+$imp+$totaMatIpp; 
									///echo number_format($prixImPrixtotal,'3');
									 if( $entreInpress!=0){
                                        	echo number_format($prixImPrixtotal / ($entreInpress+$sommeMat),'4');
                                        }else{
                                        	echo  0;
                                        }?>

								</td>
								<td><?php 
                                   
                                        	echo number_format($prixImPrixtotal,'4');
                                        	?>
								</td>
								<td>QTE SORTIE</td>

								<td><?=$piece?></td>
								<td>PCES</td>
								<td><?php $totalCops = $siValeur+$coupe+$hcoupe+$poidsSomme; 
                                        if( $totalCops!=0){
                                        	echo number_format($totalCops/$piece,'4');
                                        }else{
                                        	echo  0;
                                        }
										
									?></td>
								<td><?=number_format($totalCops ,'4')?></td>

								<td></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>

			<?php $i++;
			endforeach; ?>
		</div>
	</div>
	</body>
</html>