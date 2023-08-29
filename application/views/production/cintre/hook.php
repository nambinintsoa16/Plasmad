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
<div class="row">
	<div class="form-control text-left col-md-12 w-100">
		<div class="row">
			<div class="col-md-2">
				<a href="#" class="btn btn-primary btn-sm ml-2" id="show_modal"><i class="icon-plus"></i>&nbsp;HOOK</a>
			</div>
			<div class="col-md-10 text-rigth">
				<div class="row">
					<div class="col-md-4">
						<select class="form-control" id="Quart_show">
							<option value=""></option>
							<option value="J">Jour</option>
							<option value="N">Nuit</option>
						</select>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control w-100 form-control-sm" id="Operateur_show" placeholder="CHEF D'EQUIPE">
					</div>
					<div class="col-md-4">
						<select class="form-control" name="" id="machine_show">
							<option value="" hidden>Machine</option>
							<option value=""></option>
							<?php foreach ($machine as $machine) : ?>
								<option value="<?= $machine->MA_DESIGNATION ?>"><?= $machine->MA_DESIGNATION ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm" id="date_debut_show">
					</div>
					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm" id="date_fin_show">
					</div>
					<div class="col-md-4 mt-2">
						<a href="#" class="btn btn-info btn-sm" id="show_data"><i class="fa fa-tv"></i>&nbsp;Afficher</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 mt-2 bg-white border pt-2 pb-2">
		<table class="text-sm table-bordered table-sm table-hover w-100 table-strepted table-responsive" id="dataTable">
			<thead class="bg-<?= $nav_color ?> text-white text-center">
				<tr>
					<th>DATE</th>
					<th>PO</th>
					<th>REFERENCE</th>
					<th>N°MACHINE</th>
					<th>QTT</th>
					<th>DECHET</th>
					<th>DUREE</th>
					<th>QUART</th>
					<th>EQUIPE</th>
					<th>OPERATEUR</th>
					<th>OBSERVATION I</th>
					<th>OBSERVATION II</th>
				</tr>
			</thead>
			<tbody class="coupInjection">

			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modal_form_cintre_hook" tabindex="-1" role="dialog" aria-labelledby="modal_form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-<?= $nav_color ?>">
				<h5 class="modal-title text-center" id="modal_form">ENREGISTREMENT INJECTION</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="save_injection_data" method="post">
				<div class="modal-body">
					<div class="container text-left">
						<div class="row">
							<div class="form-group col-md-4 collapse">
								<label for="">ID</label>
								<input type="text" name="BC_ID" id="BC_ID" class="form-control form-control-sm ">
							</div>
							<div class="form-group col-md-4">
								<label for="">PO</label>
								<input type="text" name="BC_PO" id="BC_PO" class="form-control form-control-sm refnum_commande">
							</div>
							<div class="form-group col-md-4">
								<label for="">DATE</label>
								<input type="date" name="IN_DATE" id="IN_DATE" class="form-control form-control-sm">
							</div>

							<div class="form-group col-md-4">
								<label for="">REFERENCE</label>
								<input type="text" name="IN_REFERENCE" id="IN_REFERENCE" class="form-control form-control-sm">
							</div>

							<div class="form-group col-md-4">
								<label for="">QTY</label>
								<input type="text" name="IN_QTY" id="IN_QTY" class="form-control form-control-sm">
							</div>

							<div class="form-group col-md-4">
								<label for="">DECHETS</label>
								<input type="text" name="IN_DECHETS" id="IN_DECHETS" class="form-control form-control-sm">
							</div>

							<div class="form-group col-md-4">
								<label for="">N°MACHINE</label>
								<select class="form-control" name="IN_MACHINE" id="IN_MACHINE">
									<?php foreach ($machine_modal as $machine_modal) : ?>
										<option value="<?= $machine_modal->MA_DESIGNATION ?>"><?= $machine_modal->MA_DESIGNATION ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group col-md-4">
								<label for="">DEBUT</label>
								<input type="TIME" name="IN_DURE" id="IN_DURE" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-4">
								<label for="">FIN</label>
								<input type="TIME" name="IN_FIN" id="IN_FIN" class="form-control form-control-sm">
							</div>

							<div class="form-group col-md-4">
								<label for="">QUART TIME</label>
								<select class="form-control form-control-sm" name="QUART_TIME" id="QUART_TIME">
									<option value="J">J</option>
									<option value="N">N</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<label for="">OPERATEUR 1</label>
								<input type="text" name="IN_OPERATEUR1" id="IN_OPERATEUR1" class="form-control form-control-sm operateur">
							</div>
							<div class="form-group col-md-4">
								<label for="">OPERATEUR 2</label>
								<input type="text" name="IN_OPERATEUR2" id="IN_OPERATEUR2" class="form-control form-control-sm operateur">
							</div>
							<div class="form-group col-md-4">
								<label for="">MATIERES EN(kg)</label>
								<input type="text" name="IN_MATIERES" id="IN_MATIERES" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-4">
								<label for="">MASTER BATCHE</label>
								<input type="text" name="IN_MASTERBATCHE" id="IN_MASTERBATCHE" class="form-control form-control-sm">
							</div>
							<div class="form-group col-md-12">
								<label for="">OBSERVATION 1</label>
								<textarea name="IN_OBSERVATION1" id="IN_OBSERVATION1" class=" form-control"></textarea>
							</div>
							<div class="form-group col-md-12">
								<label for="">OBSERVATION 2</label>
								<textarea name="IN_OBSERVATION2" id="IN_OBSERVATION2" class=" form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Annulée</button>
					<button type="submit" class="btn btn-success">Enregistré</button>
				</div>

		</div>
	</div>
</div>