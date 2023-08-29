<style>
	.dataTables_wrapper {
		padding: 2px !important;
	}

	* {
		scrollbar-width: thin;
		scrollbar-color: #346abf white;
	}

	::-webkit-scrollbar {
		width: 3px;
	}

	::-webkit-scrollbar-thumb {
		background-color: darkgrey;
		outline: 1px solid slategrey;
	}
</style>
<div class="form-control text-left col-md-12 w-100">
	<div class="row">
		<div class="col-md-2">
			<a href="#" class="btn btn-secondary btn-sm w-100" id="btn_coupe_modal"><i class="icon-plus"></i>&nbsp;ENTREE COUPE</a>
		</div>
		<div class="col-md-8 text-rigth">
			<div class="row">
				<div class="col-md-4">
					<select class="form-control form-control-sm QuartExtrusionCoupe">
						<option value="J">Jour</option>
						<option value="N">Nuit</option>
					</select>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control w-100 form-control-sm pocoupe autocomplete_refnum_commande" placeholder="N°PO">
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control w-100 form-control-sm opCoupe autocomplete_operateur" placeholder="CHEF D'EQUIPE">
				</div>
				<div class="col-md-4 mt-2">
					<input type="text" class="form-control w-100 form-control-sm machineCoupe autocomplete_machine" placeholder="MACHINE">
				</div>
				<div class="col-md-4 mt-2">
					<input type="date" class="form-control w-100 form-control-sm coupeInputdebut">
				</div>
				<div class="col-md-4 mt-2">
					<input type="date" class="form-control w-100 form-control-sm coupeInput">
				</div>
				<div class="col-md-4 mt-2">
					<select class="mt-2 form-control form-control-sm" id="type_mat">
						<option></option>
						<option>EPZ</option>
						<option>CMTI I</option>
						<option>CMTI MADA</option>
					</select>
				</div>
			</div>

		</div>
		<div class="col-md-2">
			<a href="#" class="btn btn-info btn-sm w-100" id="btn_affiche_data"><i class="fa fa-tv"></i>&nbsp;
				Afficher</a>
		</div>
	</div>
</div>
<div class="row bg-white mt-2 border pt-2 m-1">
	<table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted" id="table_sachet_coupe">
		<thead class="bg-<?= $nav_color ?> text-white text-center text-xm">
			<tr>
				<th>DATE</th>
				<th>PO</th>
				<th>N°RLX</th>
				<th>DUREE</th>
				<th>METRAGE</th>
				<th>POIDS_ENTREE</th>
				<th>1ER_CHOIX</th>
				<th>POIDS_SORTIE</th>
				<th>2E_CHOIX</th>
				<th>DECHET</th>
				<th>GAINE_TIRE</th>
				<th>EQUIPE</th>
				<th>OPERATEUR_1</th>
				<th>OPERATEUR_2</th>
				<th>OPERATEUR_3</th>
				<th>QC</th>
				<th>TAILLE</th>
				<th>QUART</th>
				<th>MACHINE</th>
				<th>RESTE_GAINE</th>
				<th>OBSERVATION_1</th>
				<th>OBSERVATION_2</th>
				<th> </th>
				<th> </th>

			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modal_form_coupe" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-<?= $nav_color ?>">
				<h5 class="modal-title" id="exampleModalLongTitle"><b>ENREGISTREMENT SACHET COUPE</b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="sachet_coupe" method="post">
				<div class="modal-body" id="body-content">
					<div class="container">
						<div class="row">
							<input type="text" class="form-control form-control-sm collapse" id="ED_ID" name="ED_ID">
							<div class="form-group col-md-3">
								<label>Date</label>
								<input type="date" class="form-control form-control-sm" name="ED_DATE" id="ED_DATE">
							</div>
							<div class="form-group col-md-3">
								<label>PO</label>
								<input type="text" class="form-control form-control-sm autocomplete_refnum_commande_modal" name="BC_ID" id="BC_ID">
							</div>

							<div class="form-group col-md-3">
								<label>N°RLX</label>
								<input type="text" class="form-control form-control-sm" name="ED_RLX" id="ED_RLX">
							</div>
							<div class="form-group col-md-3">
								<label>METTRAGE</label>
								<input type="text" class="form-control form-control-sm" name="ED_METRAGE" id="ED_METRAGE">
							</div>
							<div class="form-group col-md-3">
								<label>POIDS ENTREE</label>
								<input type="text" class="form-control form-control-sm" name="ED_POID_ENTRE" id="ED_POID_ENTRE">
							</div>
							<div class="form-group col-md-3">
								<label>1ER CHOIX</label>
								<input type="text" class="form-control form-control-sm" name="ED_1ER_CHOIX" id="ED_1ER_CHOIX">
							</div>

							<div class="form-group col-md-3">
								<label>POIDS SORTIE</label>
								<input type="text" class="form-control form-control-sm" name="ED_POID_SORTIE" id="ED_POID_SORTIE">
							</div>

							<div class="form-group col-md-3">
								<label>2E CHOIX</label>
								<input type="text" class="form-control form-control-sm" name="ED_2E_CHOIX" id="ED_2E_CHOIX">
							</div>
							<div class="form-group col-md-3">
								<label>POIDS 2E CHOIX</label>
								<input type="text" class="form-control form-control-sm" name="ED_2E_POIDS" id="ED_2E_POIDS">
							</div>

							<div class="form-group col-md-3">
								<label>DECHET EXTRUSION</label>
								<input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_EXTRUSION" id="ED_DECHE_EXTRUSION">
							</div>
							<div class="form-group col-md-3">
								<label>DECHET IMPRESSION</label>
								<input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_INPRESSION" id="ED_DECHE_INPRESSION">
							</div>
							<div class="form-group col-md-3">
								<label>DECHET COUPE</label>
								<input type="text" class="form-control form-control-sm" value="0" name="ED_DECHE_COUPE" id="ED_DECHE_COUPE">
							</div>
							<div class="form-group col-md-3">
								<label>GAINE TIRE</label>
								<input type="text" class="form-control form-control-sm" name="ED_GAINE_TIRE" id="ED_GAINE_TIRE">
							</div>
							<div class="form-group col-md-3">
								<label>EQUIPE</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="EI_EQUIPE" id="EI_EQUIPE">

							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 1</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="ED_OPERATEUR_1" id="ED_OPERATEUR_1">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 2</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="ED_OPERATEUR_2" id="ED_OPERATEUR_2">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 3</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="ED_OPERATEUR_3" id="ED_OPERATEUR_3">
							</div>
							<div class="form-group col-md-3">
								<label>QC</label>
								<input type="text" class="form-control form-control-sm autocomplete_contolle_qualite" name="ED_QC" id="ED_QC">
							</div>
							<div class="form-group col-md-3">
								<label>TAILLE</label>
								<input type="text" class="form-control form-control-sm" name="ED_TAILL" id="ED_TAILL">
							</div>

							<div class="form-group col-md-3">
								<label>QUART</label>
								<select class="form-control form-control-sm" name="ED_QUART" id="ED_QUART">
									<option>J</option>
									<option>N</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>N° MACHINE</label>
								<select class="form-control form-control-sm" name="ED_MACHINE" id="ED_MACHINE">
									<?php foreach ($MACHINE as $key => $MACHINE) : ?>
										<option><?= $MACHINE->MA_DESIGNATION ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>DEBUT</label>
								<input type="time" class="form-control form-control-sm" name="EX_DEBUT" id="EX_DEBUT">
							</div>

							<div class="form-group col-md-3">
								<label>FIN </label>
								<input type="time" class="form-control form-control-sm" name="EX_FIN" id="EX_FIN">
							</div>
							<div class="form-group col-md-3">
								<label>RESTE GAINE</label>
								<input type="text" class="form-control form-control-sm" name="ED_RESRT_GAINE" id="ED_RESRT_GAINE">
							</div>

							<div class="form-group col-md-3">
								<label>OBSERVATION 1</label>
								<select class="form-control form-control-sm" name="ED_OBSERVATION" id="ED_OBSERVATION">
									<option></option>
									<option>Suite</option>
									<option>Suite à suivre</option>
									<option>A suivre</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label>OBSERVATION 2</label>
								<textarea class="form-control form-control-sm" name="ED_OBSERVATION2" id="ED_OBSERVATION2"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Annulée</button>
					<button type="submit" class="btn btn-success">Enregistré</button>
				</div>
			</form>
		</div>
	</div>
</div>