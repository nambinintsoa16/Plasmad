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
			     	<th>Extrusions</th>
					<th colspan="4" class="text-center">PRODUCTION</th>
					<th></th>
					<th  colspan="3"  class="text-center">REJECT</th>
					</tr>		
				<tr>
					<th>DATE</th>
					<th>TDY</th>
					<th>Hours</th>
					<th>Machine utilization </th>
					<th>Machine efficiency</th>
					<th>Total effective Equipment  Losses-OEE % Loss </th>
					<th>TDY</th>
					<th>Scrap%</th>
					<th>Operateur Name</th>
				</tr>		
				</thead>
				<tbody>
			    
					<?php for($i=1;$i<$reponse+1;$i++):
						$dateX= $dt->format('Y-m')."-".$i;
						$dataEx = $this->Controlleur_model->cherchePEEX(["EX_DATE"=>$dateX,"EX_N_MACH"=>$machine]);
						$sortie = 0;
						$heure = 0;
						$equipe = "";
						$DECHETS=0;
						$p=0;
						$perateur =array();
						foreach($dataEx as $dataEx){
                            $heure += $this->Controlleur_model->time_to_sec($dataEx->EX_DUREE);
							$sortie += $dataEx->EX_PDS_NET;
							if(	$DECHETS!=""){
							$DECHETS +=$dataEx->EX_DECHETS;
						}
							if(!in_array($dataEx->EX_OPERETEUR_1,$perateur)){
								if($dataEx->EX_OPERETEUR_1!=""){
									if($p!=0){
										$equipe .=" / ".$dataEx->EX_OPERETEUR_1;	
									}else{
										$equipe .=$dataEx->EX_OPERETEUR_1;
										$p++;
									}
								
									$perateur[] = $dataEx->EX_OPERETEUR_1;
								}
								
							}
							if(!in_array($dataEx->EX_OPERETEUR_2,$perateur)){
								if($dataEx->EX_OPERETEUR_2!=""){
									if($p!=0){
									$equipe .= " / ".$dataEx->EX_OPERETEUR_2;
								
									}else{
										$equipe .=$dataEx->EX_OPERETEUR_2;
										$p++;
									}
									$perateur[] = $dataEx->EX_OPERETEUR_2;
							   }
							}
							
						}
						$detailmachine=   $this->Controlleur_model->machineRow(['MA_DESIGNATION'=>$machine]);
						?>
						<tr>
                             <td><?=$i."-".$dt->format('m-Y')?></td>
							 <td><?=$sortie?></td>
							 <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
							 <td><?php
							 $effic = (($heure/3600)/24)*100;
							 echo number_format($effic,'2')?> %</td>
							 <td><?php 
							 $div = $heure/3600*$detailmachine->MA_VITESSE;
							 if( $div!=0){
 								 $dataPour = ($sortie / $div ) * 100;
							 }else{
								$dataPour = 0;
							 }
							
							 echo number_format($dataPour,'2')?> %
							 </td>
							 <td><?= number_format((100-$dataPour)/100,'2')?>%</td>
							
							 <td><?=$DECHETS?></td>
							 <td><?php
							 if($sortie!=0){
 								echo number_format(($DECHETS/$sortie)*100,'2');
							 }else{
                               echo number_format(0,'2');
							 }
							?>%</td>
							 <td><?=$equipe?></td>
						</tr>
					<?php endfor;?>
				</tbody>
			</table>

		</div>
</div>
</div>
