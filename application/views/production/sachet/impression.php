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
			<a href="#" class="btn btn-warning btn-sm w-100" id="btn_modal_form_show"><i class="icon-plus"></i>&nbsp;IMPRESSION</a>
		</div>
		<div class="col-md-8 text-rigth">
			<div class="row">

				<div class="col-md-4">
					<select class="form-control form-control-sm quart_extrusion_impression">
						<option></option>
						<option value="J">Jour</option>
						<option value="N">Nuit</option>
					</select>
				</div>

				<div class="col-md-4">
					<input type="text" class="form-control w-100 form-control-sm  autocomplete_refnum_commande" placeholder="N°PO">
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control w-100 form-control-sm operateur_impression autocomplete_operateur" placeholder="CHEF D'EQUIPE">
				</div>
				<div class="col-md-4 mt-2">
					<input type="text" class="form-control w-100 form-control-sm machine_impression autocomplete_machine" placeholder="MACHINE">
				</div>
				<div class="col-md-4  mt-2">
					<input type="date" class="form-control w-100 form-control-sm eximpredatedebut">
				</div>
				<div class="col-md-4  mt-2">
					<input type="date" class="form-control w-100 form-control-sm eximpredate">
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
		<div class="col-md-2 text-rigth">
			<a href="#" class="btn btn-info btn-sm  eximpreBtnredate w-100"><i class="fa fa-tv"></i>&nbsp;
				Afficher</a>
		</div>
	</div>
</div>
<div class="row bg-white mt-2 border pt-2">
	<table class="text-xm table-bordered table-sm  table-responsive table-hover w-100 table-strepted" id="table_sachet_impression">
		<thead class="bg-<?= $nav_color ?> text-white text-center text-xm">
			<tr>
				<th>DATE</th>
				<th>PO</th>
				<th>METRAGE</th>
				<th>POIDS</th>
				<th>DECHET</th>
				<th>POIDS_NET</th>
				<th>DUREE</th>
				<th>EQUIPE</th>
				<th>OPERATEUR_1</th>
				<th>OPERATEUR_2</th>
				<th>QTIME</th>
				<th>N°MACHINE</th>
				<th>TAILLE</th>
				<th>RESTE_GAINE</th>
				<th>N°RLX</th>
				<th>OBSERVATION</th>
				<th></th>
				<th> </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-<?= $nav_color ?>">
				<h5 class="modal-title" id="exampleModalLongTitle">ENREGISTREMENT SACHET IMPRESSION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="save_sachet_impression" method="post">
				<div class="modal-body" id="body-content">
					<div class="container">
						<div class="row">
							<input type="text" class="form-control form-control-sm collapse" id="EI_ID" name="EI_ID">
							<div class="form-group col-md-3">
								<label>Date</label>
								<input type="date" class="form-control form-control-sm" id="EI_DATE" name="EI_DATE">
							</div>
							<div class="form-group col-md-3">
								<label>PO</label>
								<input type="text" class="form-control form-control-sm autocomplete_refnum_commande_modal" name="BC_ID" id="BC_ID">
							</div>
							<div class="form-group col-md-3">
								<label>METRAGE</label>
								<input type="text" class="form-control form-control-sm" name="EI_METRAGE" id="EI_METRAGE">
							</div>
							<div class="form-group col-md-3">
								<label>POIDS(kg)</label>
								<input type="text" class="form-control form-control-sm" name="EI_POIDS" id="EI_POIDS">
							</div>
							<div class="form-group col-md-3">
								<label>DECHET</label>
								<input type="text" class="form-control form-control-sm" name="EI_DECHET" id="EI_DECHET">
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
								<label>Equipe</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="EI_EQUIPE" id="EI_EQUIPE">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 1</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="EI_OPERATEUR1" id="EI_OPERATEUR1">
							</div>
							<div class="form-group col-md-3">
								<label>OPERATEUR 2</label>
								<input type="text" class="form-control form-control-sm autocomplete_operateur_modal" name="EI_OPERATEUR2" id="EI_OPERATEUR2">
							</div>
							<div class="form-group col-md-3">
								<label>QUART</label>
								<select class="form-control form-control-sm" name="EI_QUART" id="EI_QUART">
									<option value="J">J</option>
									<option value="N">N</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>N° MACHINE</label>
								<select class="form-control form-control-sm" name="EI_MACH" id="EI_MACH">
									<?php foreach ($MACHINE as $key => $MACHINE) : ?>
										<option value="<?= $MACHINE->MA_DESIGNATION ?>"><?= $MACHINE->MA_DESIGNATION ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>TAILLE</label>
								<input type="text" class="form-control form-control-sm" name="EI_TAILLE" id="EI_TAILLE">
							</div>
							<div class="form-group col-md-3">
								<label>RESTE GAINE</label>
								<input type="text" class="form-control form-control-sm" name="EI_RESTE_GAINE" id="EI_RESTE_GAINE">
							</div>
							<div class="form-group col-md-3">
								<label>N°RLX</label>
								<input type="text" class="form-control form-control-sm" name="EI_RLX" id="EI_RLX">
							</div>

							<div class="form-group col-md-12" id="matier_content">
								<hr />
								<div class="row ">
									<div class="form-group col-md-6">
										<input type="text" class="form-control form-control-sm autocomplete_reference_matiere" placeholder="Référence">
									</div>
									<div class="form-group col-md-4">
										<input type="text" class="form-control form-control-sm quantite" placeholder="Quantité">
									</div>
									<div class="form-group col-md-2">
										<a href="" class="btn btn-primary btn-sm plusMatt"> <i class="fa fa-plus"></i></a>
									</div>
									<div class="form-group col-md-12">
										<table class="table-bordered table table-sm">
											<thead class="bg-<?= $nav_color ?> text-white">
												<tr>
													<th>REFERENCE</th>
													<th>QUANTITE</th>
													<th>PU</th>
													<th></th>
												</tr>
											</thead>
											<tbody class="tbodyMatt">

											</tbody>
										</table>
									</div>
								</div>
								<hr />
							</div>
							<div class="form-group col-md-12">
								<label>Observetion</label>
								<textarea class="form-control" id="EI_OBS" name="EI_OBS"></textarea>
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



<div class="modal fade" id="modal_form_update_matiere" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-<?= $nav_color ?>">
				<h5 class="modal-title" id="exampleModalLongTitle">MODIFIER MATIERE SACHET IMPRESSION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body" id="body-content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<label class="">N°PO :&nbsp;<span id="refnum_commande"></span></label>
								<label id="refnum_production_modal" class="collapse"></label>
							</div>
							<div class="col-md-3 form-group">
								<input class="form-control form-control-sm " id="date" type="date" placeholder="Date">
							</div>
							<div class="col-md-3 form-group">
								<input class="form-control form-control-sm autocomplete_reference_matiere_update" id="designation" placeholder="Désignation">
							</div>
							<div class="col-md-3 form-group">
								<input class="form-control form-control-sm " id="quantite" placeholder="Quantité">
							</div>
							<div class="col-md-3 form-group">
								<a href="" class="btn-sm btn btn-success " id="ajouter_matiere"><i class="fa fa-plus"></i> Ajouter</a>
							</div>
							<div class="col-md-12">
								<table class="table-hover table-strepted table-bordered w-100" id="table_matiere">
									<thead class="bg-<?=$nav_color?> text-white">
										<tr>
											<th>DATE</th>
											<th>DESIGNATION</th>
											<th>QUANTITE</th>
											<th>PRIX</th>
											<th></th>
										</tr>
									</thead>
									<tbody class="tbody" id="data_mat">
												
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				</div>
		</div>
	</div>
</div>