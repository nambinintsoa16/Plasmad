<style>
	td{
		border: solid gray 1px;
	}
	thead{
		background-color: #000;
		color: white;
	}
</style>

<?php  if(!empty($fin) AND !empty($date) ): ?>
	<h3 class="ml-2">SUIVIE MACHINE IMPRESSION DU <?=$date?> au <?=$fin?>    </h3>
<?php elseif(!empty($fin)):?>
	<h3 class="ml-2">SUIVIE MACHINE IMPRESSION DU <?=$fin?> </h3>
<?php elseif(!empty($date)):?>
	<h3 class="ml-2">SUIVIE MACHINE IMPRESSION DU <?=$date?> </h3>
<?php endif ?>


<table class="table table-hover table-strepted dataTable">
	<thead class="bg-dark text-white">
	  <tr>
		<th>Machine</th>
		<th>Poids/kgs</th>
		<th>Metrage</th>
		<th>Hours</th>
	</tr>
	</thead>
	<tbody>
		<?php 
		
		$dateX = $date;
		$ffect = 0;
		$i = 0;
		foreach ($machine as $key => $machine) :
			if ($fin != "") {
				$dataEx = $this->Controlleur_model->dataImpressionExtrusion("(EI_DATE BETWEEN '$date' AND '$fin') AND EI_MACH like '$machine->MA_DESIGNATION'");
			} else {
				$dataEx = $this->Controlleur_model->dataImpressionExtrusion("EI_DATE like '%$date%' AND EI_MACH like '$machine->MA_DESIGNATION'");
			}
		$sortie = 0;	
        $DECHETS = 0;
		$metrage = 0;
		$heure = 0;

			foreach ($dataEx as $dataEx) {
				$heure += $this->Controlleur_model->time_to_sec($dataEx->EI_DUREE);
				$sortie += $dataEx->EI_PDS_SOMME;
				$metrage += $dataEx->EI_METRE_SOMME;
				if ($DECHETS != "") {
					$DECHETS += $dataEx->EI_DECHET;
				}
			}
		?>
			<tr>
				<td><?= $machine->MA_DESIGNATION ?></td>
				<td><?= $sortie ?></td>
				<td><?= $metrage ?></td>
				<td><?= $this->Controlleur_model->se_to_time($heure) ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>
</div>
<script>
$(document).ready(function(){
$('.dataTable').dataTable();

});
</script>