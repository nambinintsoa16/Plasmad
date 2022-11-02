effective output			
			KGS	
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
			<table class="table-hover table-stripted table-bordered w-100 datatable">
				<thead class="bg-dark text-white">
				<tr>
		
					<th  colspan="9"  class="text-center"><?=strtoupper($machine)?></th>
				</tr>
				<tr>
					<th>DATE</th>
					<th>PRODUCTION PCS</th>
					<th>PRODUCTION Kgs</th>
					<th>REJECT KGS</th>
					<th>2nd  choice KGS</th>
					<th>2nd  choice Pcs	hours</th>
					<th>Hour</th>
					<th>Machine efficiency</th>
					<th>Operateure Name</th>
				</tr>		
				</thead>
				<tbody>
				<?php for($i=1;$i<$reponse+1;$i++):
						$dateX= $dt->format('Y-m')."-".$i;
						$dataEx = $this->Controlleur_model->dataCoupeExtrusion(["ED_DATE"=>$dateX,"ED_MACHINE"=>$machine]);
						$sortie = 0;
						$heure = 0;
						$equipe = "";
						$DECHETS=0;
						$choix1 = 0;
						$p=0;
						$perateur =array();
						foreach($dataEx as $dataEx){
                            $heure += $this->Controlleur_model->time_to_sec($dataEx->ED_DURE);
							$sortie += $dataEx->ED_POID_SORTIE_SOMME;
							if(	$DECHETS!=""){
							$DECHETS +=$dataEx->ED_2E_CHOIX_SOMME;
						}
							if(!in_array($dataEx->ED_OPERATEUR_1,$perateur)){
								if($dataEx->ED_OPERATEUR_1!=""){
									if($p!=0){
										$equipe .=" / ".$dataEx->ED_OPERATEUR_1;	
									}else{
										$equipe .=$dataEx->ED_OPERATEUR_1;
										$p++;
									}
								
									$perateur[] = $dataEx->ED_OPERATEUR_2;
								}
								
							}
							if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
								if($dataEx->ED_OPERATEUR_2!=""){
									if($p!=0){
									$equipe .= " / ".$dataEx->ED_OPERATEUR_2;
								
									}else{
										$equipe .=$dataEx->ED_OPERATEUR_2;
										$p++;
									}
									$perateur[] = $dataEx->ED_OPERATEUR_2;
							   }
							}

							if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
								if($dataEx->ED_OPERATEUR_3!=""){
									if($p!=0){
									$equipe .= " / ".$dataEx->ED_OPERATEUR_3;
								
									}else{
										$equipe .=$dataEx->ED_OPERATEUR_3;
										$p++;
									}
									$perateur[] = $dataEx->ED_OPERATEUR_3;
							   }
							}
							
						}
						$detailmachine=   $this->Controlleur_model->machineRow(['MA_DESIGNATION'=>$machine]);
						?>
				
						<td><?=$i."-".$dt->format('m-Y')?></td>
						<td><?=$sortie?></td>
						<td><?=	$choix1?></td>
						<td><?= $this->Controlleur_model->se_to_time($heure)?></td>
						<td></td>
						<td></td>
						<td><?= $this->Controlleur_model->se_to_time($heure)?></td>
						<td></td>
						<td><?=	$equipe?></td>
						</tr>	
					<?php endfor;?>
					</tbody>
				</table>
			</div>
	</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.datatable').dataTable();
	});
	
</script>