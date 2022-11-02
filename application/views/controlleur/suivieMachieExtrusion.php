
<?php 
function time_to_sec($time)
	{
		list($h, $m, $s) = explode(":", $time);
		$seconds = 0;
		$seconds += (intval($h) * 3600);
		$seconds += (intval($m) * 60);
		$seconds += (intval($s));
		return $seconds;
	}
function se_to_time($sec)
	{
		return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
	}


?>
<?php  if(!empty($fin) AND !empty($date) ): ?>
	<h3 class="ml-2">SUIVIE MACHINE EXTRUSION DU <?=$fin?> au  <?=$date?>  </h3>
<?php elseif(!empty($fin)):?>
	<h3 class="ml-2">SUIVIE MACHINE EXTRUSION DU <?=$fin?> </h3>
<?php elseif(!empty($date)):?>
	<h3 class="ml-2">SUIVIE MACHINE EXTRUSION DU <?=$date?> </h3>
<?php endif ?>
<style>
	td{
		border: solid gray 1px;
	}
	thead{
		background-color: #000;
		color: white;
	}
</style>	
<table class="table table-hover table-strepted datatable">
	<thead class="bg-dark text-white">
		<tr>
			<td>MACHINE</td>
			<td>POIDS SORTIE</td>
			<td>POIDS DECHET</td>
			<td>TAUX DE REBUT</td>
			<td>TEMPS DE PRODUCTION</td>
		</tr>
	</thead>
	<tbody>
		<?php   $ffect = 0; $i= 0 ;foreach ($machine as $key => $machine):
           $this->load->model('compta_model');
           if($fin!=""){
			  $extru = $this->compta_model->extrusion("(EX_DATE BETWEEN '$fin' AND '$date') AND EX_N_MACH like '$machine->MA_DESIGNATION'");
		   }else{
			  $extru = $this->compta_model->extrusion("EX_DATE like '%$fin%' AND EX_N_MACH like '$machine->MA_DESIGNATION'");
		   }
         
           $poid = 0;
           $deche = 0;
           $dure =0;
          
           foreach ($extru as $key => $extru) {
           	if($extru->EX_PDS_SOMME!=""){
 				$poid += $extru->EX_PDS_SOMME;
           	}
          	
          	if($extru->EX_DECHETS!=""){
 				$deche += $extru->EX_DECHETS;
           	}
          
				$dure +=time_to_sec($extru->EX_DUREE);
          
           }
           if($poid!=0){
           	   $rebut = ($deche*100 )/$poid;
               $ffect +=  $rebut;
           }else{
           	 $rebut = 0;
           }
        
           $i++;
			?>
		<tr>
			<td><?=$machine->MA_DESIGNATION?></td>
			<td><?=$poid?></td>
			<td><?=$deche?></td>
			<td><?=number_format($rebut,'2') ?>%</td>
			<td><?=se_to_time($dure)?></td>

		</tr>
	<?php endforeach;?>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			
			<td></td>
			<td><?=number_format($ffect/$i,'2')?> %</td>
			<td></td>
		</tr>	
	</tfoot>
	</table>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.datatable').dataTable({
			language: {
                 url :base_url+"assets/dataTableFr/french.json"
            },
		});
	});
	
</script>