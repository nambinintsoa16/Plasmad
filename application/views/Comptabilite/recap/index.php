<div class="card">
	<div class="card-header bg-<?=$nav_color?> text-white">
		<b>RECAP COSTING</b>
		<b class="pull-right ml-2"><button type="submit" class="btn btn-sm btn-success modale"><i class="fa fa-plus"></i>
				LIVRE</button></b>
		<b class="pull-right">
			<form action="" method="post">
				<label class="text-white">CLIENT : </label>
				<input type="text" class="mr-3 client" name="date">
				<label class="text-white">DATE : </label>
				<input type="date" class="mr-3 dateCost" name="date">
				<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
					Afficher</button>
			</form>
		</b>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 p-0">
				<form class="form w-100 " method="POST">
					<div class="row">
						<div class="form-group col-md-6 text-right">
							<input type="file" name="file" class="form-control file">
						</div>
						<div class="form-group col-md-2 text-right">
							<button type="submit" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp;IMPORTER</button>
						</div>
					</div>
				</form>
			</div>
			<hr />
			<span id="data_containt">
			
</span>
<div class="modal fade" id="modaleLivre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Valider livraison</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="border p-2">
					<div class="row">
						<div class="form-group  col-md-5">
							<input type="text" class="form-control form-control-sm numpos" name="" placeholder="N°PO">
						</div>
						<div class="form-group  col-md-5">
							<input type="text" class="form-control form-control-sm clientPo" name="" placeholder="CODE CLIENT">
						</div>
						<div class="form-group col-md-2">
							<button type="submit" class="btn btn-sm btn-primary afficheSortie"><i class="fa fa-tv"></i>
								Afficher</button>
						</div>
					</div>
				</fieldset>
				<fieldset class="border p-2 mt-2">
					<table class="table-strepted table-bordered w-100 datatable">
						<thead class="bg-primary text-white">
							<tr>
								<th>Tiers</th>
								<th>Articles</th>
								<th>Famille</th>
								<th>Désignation </th>
								<th>Qtés</th>
								<th>P.U DEVISE </th>
								<th></th>
							</tr>
						</thead>
						<tbody class="dataConfim">

						</tbody>
					</table>
				</fieldset>
			</div>

		</div>
	</div>
</div>