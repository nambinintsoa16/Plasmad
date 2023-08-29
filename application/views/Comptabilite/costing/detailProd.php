<fieldset class="border p-2 text-right">
	<span><?="Commande n° : <b>".$PO."</b>"?></span>
</fieldset>
<fieldset class="border p-2">
	<legend class="w-auto" style="font-size:12px"><b>PRODUCTION</b></legend>
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">EXTRUSION</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">IMPRESSION</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">COUPE</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active table-responsive  mt-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<table class="table-hover table-strepted w-100 table-bordered tadleData">
				<thead class="bg-info text-white text-center">
					<tr>
						<th style="width: 80px!important;">DATE</th>
						<th>DURE</th>
						<th>POID</th>
						<th>DECHETS</th>
						<th>MACHINE</th>
						<th>QUART</th>
						<th>EQUIPE</th>
						<th style="width: 120px!important;">OPERATEUR 1</th>
						<th style="width: 120px!important;">OPERATEUR 2</th>
						<th>OBSERVATION</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($extrusion as $extrusion) : ?>
						<tr>
							<td><?= $extrusion->EX_DATE ?></td>
							<td><?= $extrusion->EX_DUREE ?></td>
							<td><?= $extrusion->EX_PDS_SOMME ?></td>
							<td><?= $extrusion->EX_DECHETS ?></td>
							<td><?= $extrusion->EX_N_MACH ?></td>
							<td><?= $extrusion->EX_QAURT ?></td>
							<td><?= $extrusion->EX_EQUIP ?></td>
							<td><?= $extrusion->EX_OPERETEUR_1 ?></td>
							<td><?= $extrusion->EX_OPERETEUR_2 ?></td>
							<td><?= $extrusion->EX_OBSERVATION1 ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>
		<div class="tab-pane fade table-responsive mt-2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

			<table class="table-hover table-strepted w-100 table-bordered tadleData">
				<thead class="bg-info text-white text-center">
					<tr>
						<th style="width: 80px!important;">DATE</th>
						<th>DURE</th>
						<th>POID</th>
						<th>DECHET</th>
						<th>EQUIPE</th>
						<th>OPERATEUR 1</th>
						<th>OPERATEUR 2</th>
						<th>OBSERVATION</th>
					</tr>

				</thead>
				<tbody>
					<?php foreach ($impression as $impression) : ?>
						<tr>
							<td><?= $impression->EI_DATE ?></td>
							<td><?= $impression->EI_DUREE ?></td>
							<td><?= $impression->EI_PDS_SOMME ?></td>
							<td><?= $impression->EI_DECHETS ?></td>
							<td><?= $impression->EI_EQUIPE ?></td>
							<td><?= $impression->EI_OPERATEUR1 ?></td>
							<td><?= $impression->EI_OPERATEUR2 ?></td>
							<td><?= $impression->EI_OBSERVATION ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<span>ENCRE</span>
			<table class="table-hover table-strepted w-100 table-bordered tadleData mt-2">
				<thead class="bg-info text-white text-center">
					<tr>
						<th>DATE</th>
						<th>REFERNCE</th>
						<th>QUANTITE</th>
						<th>PRIX</th>

					</tr>


				</thead>
				<tbody>
					<?php foreach ($matierinression as $matierinression) : ?>
						<tr>
							<td><?= $matierinression->MI_DATE ?></td>
							<td><?= $matierinression->MI_DESIGNATION ?></td>
							<td><?= $matierinression->MI_QUANTITE ?></td>
							<td><?= $matierinression->MI_PRIX ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>
		<div class="tab-pane fade table-responsive mt-2" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
			<table class="table-hover table-strepted w-100 table-bordered tadleData">
				<thead class="bg-info text-white text-center">
					<tr>
						<th style="width: 80px!important;">DATE</th>
						<th>DURE</th>
						<th>POID</th>
						<th>1érè choix</th>
						<th>2émè choix</th>
						<th>EQUIPE</th>
						<th>OPERATEUR 1</th>
						<th>OPERATEUR 2</th>
						<th>OPERATEUR 3</th>
						<th>OBSERVATION</th>
					</tr>
				<tbody>
					<?php foreach ($coupe as $coupe) : ?>
						<tr>
							<td><?= $coupe->ED_DATE ?></td>
							<td><?= $coupe->ED_DURE ?></td>
							<td><?php
								$poids = 0;
								$poid = explode("+", $coupe->ED_POID_ENTRE);
								foreach ($poid as $poid) {
									$poids += $poid;
								}

								echo $poids ?></td>
							<td><?= $coupe->ED_1ER_CHOIX_SOMME ?></td>
							<td><?= $coupe->ED_2E_CHOIX_SOMME ?></td>
							<td><?= $coupe->ED_EQUIPE ?></td>
							<td><?= $coupe->ED_OPERATEUR_1 ?></td>
							<td><?= $coupe->ED_OPERATEUR_2 ?></td>
							<td><?= $coupe->ED_OPERATEUR_3 ?></td>
							<td><?= $coupe->ED_OBSERVATION2 ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>

				</thead>
			</table>
		</div>
	</div>
</fieldset>
<fieldset class="border p-2 mt-2">
	<legend class="w-auto" style="font-size:12px"><b>MATIERE</b></legend>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="matier" role="tabpanel" aria-labelledby="nav-home-tab">
			<table class="table-hover table-strepted w-100 table-bordered tadleData">
				<thead class="bg-info text-white text-center">
					<tr>

						<th>REFRENCE</th>
						<th>POIDS</th>
						<th>PRIX</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($matier as $matier) : ?>
						<tr>
							<td><?= $matier->SM_MATIER ?></td>
							<td><?= $matier->SM_QUANTITE ?></td>
							<td><?= $matier->SM_VALEUR ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
</fieldset>
<fieldset class="border p-1 mt-2">
	<legend class="w-auto" style="font-size:12px"><b>Control qualité</b></legend>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="matier" role="tabpanel" aria-labelledby="nav-home-tab">
			<table class="table-hover table-strepted w-100 table-bordered tadleData">
				<thead class="bg-info text-white text-center">
					<tr>
						<th>DATE</th>
						<th>OPERATEUR</th>
						<th>PIECE</th>
						<th>2EME CHOIX</th>
						<th>QTT SORTIE</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($qc as $qc) : ?>
						<tr>
							<td><?= $qc->C_DATE ?></td>
							<td><?= $qc->C_QC ?></td>
							<td><?= $qc->C_ENTRE ?></td>
							<td><?= $qc->C_CHOIX ?></td>
							<td><?= $qc->C_TTS ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

		</div>

	</div>
</fieldset>
</div>

<script>
	$(document).ready(function() {
		$('.tadleData').DataTable();

	});
</script>