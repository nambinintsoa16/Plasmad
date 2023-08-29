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
				<a href="#" class="btn btn-secondary btn-sm w-100" id="btn_extrusion"><i class="icon-plus"></i>&nbsp;EXTRUSION</a>

			</div>
			<div class="col-md-8 text-rigth">
				<div class="row">
					<div class="col-md-4">
						<select class="form-control form-control-sm quartExtrusion">
							<option value="J">Jour</option>
							<option value="N">Nuit</option>
						</select>
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control w-100 form-control-sm po poexc" placeholder="N°PO" id="refnum_commande">
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control w-100 form-control-sm opextrusion" id="operateur" placeholder="CHEF D'EQUIPE">
					</div>

					<div class="col-md-4 mt-2">
						<input type="text" class="form-control w-100 form-control-sm machineextrusion match" placeholder="MACHINE" id="machine">
					</div>

					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm exinpdatedebut">
					</div>
					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm exinpdate">
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
			<div class="col-md-2 ">
				<a href="#" class="btn btn-info btn-sm  exbtndate w-100"><i class="fa fa-tv"></i>&nbsp;
					Afficher</a>
			</div>
		</div>
	</div>
</div>
<div class="row bg-white mt-2 border pt-2 m-1">
	<table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted" style="font-size: 13px!important;" id="Table_extrusion">
		<thead class="bg-<?= $nav_color ?> text-white text-center text-xm">
			<tr>
				<th>DATE</th>
				<th>PO</th>
				<th>METRE</th>
				<th>POIDS(Kg)</th>
				<th>DECHETS</th>
				<th>POIDS_NET</th>
				<th>DUREE</th>
				<th>QUART</th>
				<th>N°MACHINE</th>
				<th>N°RLX</th>
				<th>NB_ROULAUX</th>
				<th>TAILLE</th>
				<th>CHEF_D_EQUIPE</th>
				<th>OPERATEUR_1</th>
				<th>OPERATEUR_2</th>
				<th>OBSERVATION_1</th>
				<th> </th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot class="bg-<?= $nav_color ?> text-white">
			<tr>

				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>






<div class="modal fade" id="modalProccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-<?= $nav_color ?>">
				<h5 class="modal-title" id="exampleModalLongTitle">Enregistrement extrusion</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="sachet_extrusion">
				<div class="modal-body border-dark" id="body-content">
					<form method="post" action="extrusion">
						<div class="container text-left">
							<div class="row">
								<input type="text" class="form-control form-control-sm EX_ID collapse" name="EX_ID">
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
										<?php foreach ($machine as $key => $machine) : ?>
											<option value="<?= $machine->MA_DESIGNATION ?>"><?= $machine->MA_DESIGNATION ?></option>
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Annulée</button>
					<button type="submit" class="btn btn-success">Enregistré</button>
				</div>
			</form>
		</div>
	</div>
</div>