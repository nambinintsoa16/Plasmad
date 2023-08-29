<form method="post" action="extrusion">
	<div class="container text-left">
		<div class="row">
			<div class="form-group col-md-4">
				<label>Date</label>
				<input type="date" class="form-control form-control-sm EX_DATE" name="EX_DATE">
			</div>

			<div class="form-group col-md-4">
				<label>N° PO</label>
				<input type="text" class="form-control form-control-sm poex EX_BC_ID" name="EX_BC_ID">
			</div>

			<div class="form-group col-md-4">
				<label>METRE</label>
				<input type="text" class="form-control form-control-sm EX_METRE" name="EX_METRE">
			</div>

			<div class="form-group col-md-4">
				<label>PDS (Kg)</label>
				<input type="text" class="form-control form-control-sm EX_PDS_BRUT" name="EX_PDS_BRUT">
			</div>

			<div class="form-group col-md-4">
				<label>DECHETS</label>
				<input type="text" class="form-control form-control-sm EX_DECHETS" name="EX_DECHETS">
			</div>

			<div class="form-group col-md-4">
				<label>DEBUT</label>
				<input type="time" class="form-control form-control-sm EX_DEBUT" name="EX_DEBUT">
			</div>

			<div class="form-group col-md-4">
				<label>FIN </label>
				<input type="time" class="form-control form-control-sm EX_FIN" name="EX_FIN">
			</div>

			<div class="form-group col-md-4">
				<label>QUART</label>
				<select class="form-control form-control-sm EX_QAURT" name="EX_QAURT">
					<option value="J">Jour</option>
					<option value="N">Nuit</option>
				</select>
			</div>

			<div class="form-group col-md-4">
				<label>N° MACHINE</label>
				<select class="form-control form-control-sm EX_N_MACH" name="EX_N_MACH">
					<?php foreach ($MACHINE as $key => $MACHINE) : ?>
						<option><?= $MACHINE->MA_DESIGNATION ?></option>
					<?php endforeach; ?>
				</select>

			</div>
			<div class="form-group col-md-4">
				<label>N° RLX</label>
				<input type="text" class="form-control form-control-sm EX_Nbre_rlx" name="EX_Nbre_rlx">
			</div>
			<div class="form-group col-md-4">
				<label>TAILLE</label>
				<input type="text" class="form-control form-control-sm EX_TAILL" name="EX_TAILL">
			</div>

			<div class="form-group col-md-4">
				<label>EQUIPE</label>
				<input type="text" class="form-control form-control-sm op EX_EQUIP" name="EX_EQUIP">

			</div>
			<div class="form-group col-md-4">
				<label>OPERATEUR 1</label>
				<input type="text" class="form-control form-control-sm op EX_OPERETEUR_1" name="EX_OPERETEUR_1">
			</div>
			<div class="form-group col-md-4">
				<label>OPERATEUR 2</label>
				<input type="text" class="form-control form-control-sm op EX_OPERETEUR_2" name="EX_OPERETEUR_2">
			</div>
			<div class="form-group col-md-12">
				<label>OBSERVATION</label>
				<textarea class="form-control form-control-sm EX_OBS" name="EX_OBS"></textarea>
			</div>
		</div>
	</div>
</form>
