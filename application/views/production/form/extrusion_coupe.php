<div class="container text-left">
	<div class="row">

		<div class="form-group col-md-3">
			<label>Date</label>
			<input type="date" class="form-control form-control-sm" id="ED_DATE">
		</div>
		<div class="form-group col-md-3">
			<label>N°PO</label>
			<input type="text" class="form-control form-control-sm autocomplete_refnum_commande_modal" id="BC_ID">
		</div>

		<div class="form-group col-md-3">
			<label>N°RLX</label>
			<input type="text" class="form-control form-control-sm" id="ED_RLX">
		</div>
		<div class="form-group col-md-3">
			<label>METTRAGE</label>
			<input type="text" class="form-control form-control-sm" id="ED_METRAGE">
		</div>
		<div class="form-group col-md-3">
			<label>POIDS ENTREE</label>
			<input type="text" class="form-control form-control-sm" id="ED_POID_ENTRE">
		</div>
		<div class="form-group col-md-3">
			<label>1ER CHOIX</label>
			<input type="text" class="form-control form-control-sm" id="ED_1ER_CHOIX">
		</div>

		<div class="form-group col-md-3">
			<label>POIDS SORTIE</label>
			<input type="text" class="form-control form-control-sm" id="ED_POID_SORTIE">
		</div>

		<div class="form-group col-md-3">
			<label>2E CHOIX</label>
			<input type="text" class="form-control form-control-sm" id="ED_2E_CHOIX">
		</div>
		<div class="form-group col-md-3">
			<label>POIDS 2E CHOIX</label>
			<input type="text" class="form-control form-control-sm" id="ED_2E_POIDS">
		</div>

		<div class="form-group col-md-3">
			<label>DECHET EXTRUSION</label>
			<input type="text" class="form-control form-control-sm" value="0" id="ED_DECHE_EXTRUSION">
		</div>
		<div class="form-group col-md-3">
			<label>DECHET IMPRESSION</label>
			<input type="text" class="form-control form-control-sm" value="0" id="ED_DECHE_INPRESSION">
		</div>
		<div class="form-group col-md-3">
			<label>DECHET COUPE</label>
			<input type="text" class="form-control form-control-sm" value="0" id="ED_DECHE_COUPE">
		</div>
		<div class="form-group col-md-3">
			<label>GAINE TIRE</label>
			<input type="text" class="form-control form-control-sm" id="ED_GAINE_TIRE">
		</div>
		<div class="form-group col-md-3">
			<label>EQUIPE</label>
			<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" id="EI_EQUIPE">

		</div>
		<div class="form-group col-md-3">
			<label>OPERATEUR 1</label>
			<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" id="ED_OPERATEUR_1">
		</div>
		<div class="form-group col-md-3">
			<label>OPERATEUR 2</label>
			<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" id="ED_OPERATEUR_2">
		</div>
		<div class="form-group col-md-3">
			<label>OPERATEUR 3</label>
			<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" id="ED_OPERATEUR_3">
		</div>
		<div class="form-group col-md-3">
			<label>QC</label>
			<input type="text" class="form-control form-control-sm autocomplete_contolle_qualite" id="ED_QC">
		</div>
		<div class="form-group col-md-3">
			<label>TAILLE</label>
			<input type="text" class="form-control form-control-sm" id="ED_TAILL">
		</div>

		<div class="form-group col-md-3">
			<label>QUART</label>
			<select class="form-control form-control-sm" id="ED_QUART">
				<option>J</option>
				<option>N</option>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label>N° MACHINE</label>
			<select class="form-control form-control-sm" id="ED_MACHINE">
				<?php foreach ($MACHINE as $key => $MACHINE) : ?>
					<option><?= $MACHINE->MA_DESIGNATION ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<label>DEBUT</label>
			<input type="time" class="form-control form-control-sm" id="EX_DEBUT">
		</div>

		<div class="form-group col-md-3">
			<label>FIN </label>
			<input type="time" class="form-control form-control-sm" id="EX_FIN">
		</div>
		<div class="form-group col-md-3">
			<label>RESTE GAINE</label>
			<input type="text" class="form-control form-control-sm" id="ED_RESRT_GAINE">
		</div>

		<div class="form-group col-md-3">
			<label>OBSERVATION 1</label>
			<select class="form-control form-control-sm" id="ED_OBSERVATION">
				<option></option>
				<option>Suite</option>
				<option>Suite à suivre</option>
				<option>A suivre</option>
			</select>
		</div>
		<div class="form-group col-md-12">
			<label>OBSERVATION 2</label>
			<textarea class="form-control form-control-sm" id="ED_OBSERVATION2"></textarea>
		</div>
	</div>
</div>