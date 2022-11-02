<?php

$dt = new DateTime($date);
$reponse  = $dt->format('t');
$rowspan = $reponse+1;
$this->load->model('Controlleur_model');

?>
<fieldset class="border p-2 bg-white mb-2">
<div class="col-md-12 p-2">
	<span><b>Effective output</b></span>
		<div class="row">
			<table class="table-hover table-stripted table-bordered w-100">
				<thead class="bg-dark text-white">
					<tr>
						<th colspan="5" class="text-center">PRODUCTION</th>
					</tr>		
					<th>DATE</th>
					<th>Poids/kgs</th>
					<th>Metrage</th>
					<th>Hours</th>
					<th>Operateure</th>
				</tr>		
				</thead>
				<tbody>
					<?php 
					for($i=1;$i<$reponse+1;$i++):
					?>
					<tr>
					<?php
					$dateX= $dt->format('Y-m')."-".$i;
					$dataEx = $this->Controlleur_model->dataImpressionExtrusion(["EI_DATE"=>$dateX,"EI_MACH"=>$machine]);
					$sortie = 0;
					$heure = 0;
					$equipe = "";
					$DECHETS=0;
					$metrage =0;
					$p=0;
					$perateur =array();
					foreach($dataEx as $dataEx){
						$heure += $this->Controlleur_model->time_to_sec($dataEx->EI_DUREE);
						$sortie += $dataEx->EI_PDS_SOMME;
						$metrage += $dataEx->EI_METRE_SOMME;
						if(	$DECHETS!=""){
						$DECHETS +=$dataEx->EI_DECHET;
						}

						if(!in_array($dataEx->EI_OPERATEUR1,$perateur)){
							if($dataEx->EI_OPERATEUR1!=""){
								if($p!=0){
									$equipe .=" / ".$dataEx->EI_OPERATEUR1;	
								}else{
									$equipe .=$dataEx->EI_OPERATEUR1;
									$p++;
								}
							
								$perateur[] = $dataEx->EI_OPERATEUR1;
							}
							
						}
						if(!in_array($dataEx->EI_OPERATEUR2,$perateur)){
							if($dataEx->EI_OPERATEUR2!=""){
								if($p!=0){
								$equipe .= " / ".$dataEx->EI_OPERATEUR2;
							
								}else{
									$equipe .=$dataEx->EI_OPERATEUR2;
									$p++;
								}
								$perateur[] = $dataEx->EI_OPERATEUR2;
						   }
						}
					}?>

				
				
				
					<td><?=$i."-".$dt->format('m-Y')?></td>
					<td><?=$sortie?></td>
					<td><?=	$metrage?></td>
					<td><?= $this->Controlleur_model->se_to_time($heure)?></td>
					<td><?=	$equipe?></td>
					</tr>	
				<?php endfor;?>
				</tbody>
			</table>
		</div>
</div>
</div>




