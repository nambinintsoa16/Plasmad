<?php  if(!empty($fin) AND !empty($date) ): ?>
	<h3 class="ml-2">SUIVIE MACHINE COUPE DU <?=$date?>  au  <?=$fin?> </h3>
<?php elseif(!empty($fin)):?>
	<h3 class="ml-2">SUIVIE MACHINE COUPE DU <?=$fin?> </h3>
<?php elseif(!empty($date)):?>
	<h3 class="ml-2">SUIVIE MACHINE COUPE DU <?=$date?> </h3>
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
		<th>Machine</th>
		<th>Poids/kgs</th>
		<th>Metrage</th>
		<th>PCS</th>
		<th>DECHET</th>
		<th>Hours</th>

		</tr>
	</thead>
	<tbody>
		<?php 
		
		$i = 0;
		foreach ($machine as $key => $machine) :
		$piece = 0;
	 	$metrage = 0;		
		$DECHETS = 0;
		$metrage = 0;
		$heure = 0;
		$ffect = 0;
		$sortie = 0;

			if ($fin != "") {
				$coupe = $this->compta_model->extrusion_coupe("(ED_DATE BETWEEN  '$date' AND '$fin') AND  ED_MACHINE like '$machine->MA_DESIGNATION'");
			} else {
				$coupe = $this->compta_model->extrusion_coupe("ED_DATE like '%$date%' AND  ED_MACHINE like '$machine->MA_DESIGNATION'");
			}



			foreach ($coupe as $key => $coupe) {
				if ($coupe->ED_POID_ENTRE != "") {
					$poidEntre = explode("+", $coupe->ED_POID_ENTRE);
					foreach ($poidEntre as $key => $poidEntre) {
						$sortie += $poidEntre;
					}
				}
                $metrage += $coupe->ED_METRAGE_SOMME;
				$piece += $coupe->ED_1ER_CHOIX_SOMME;
				$heure += $this->Controlleur_model->time_to_sec($coupe->ED_DURE);
				$DECHETS += $coupe->ED_DECHE_COUPE;
			}
		?>

			<tr>
				<td><?= $machine->MA_DESIGNATION ?></td>
				<td><?= $sortie ?></td>
				<td><?= $metrage ?></td>
				<td><?= $piece ?></td>
				<td><?= $DECHETS ?></td>
				<td><?= $this->Controlleur_model->se_to_time($heure) ?></td>

			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.datatable').dataTable();
	});
</script>