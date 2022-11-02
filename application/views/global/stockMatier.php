<div class="card w-100">
	<div class="card-header bg-dark text-white">
		<b>
			LISTE DES MATIERES PREMIERES
		</b>

	</div>
	<div class="card-body">
		<fieldset class="col-md-12 border mt-2 w-100 p-3">
			<form action="" method="post">
				<label>Origin : </label>
				<select class="mr-5 origin" name="origin">
					<option>Plasmad</option>
					<option>Madakem</option>
				</select>
				<input type="text" class="ref" placeholder="Référence">
				<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
					Afficher</button>
				<a href="<?= base_url("Comptabilite/exportCostingExecel") ?>" class="btn btn-sm btn-success export">EXPORT</a>
			</form>
		</fieldset>
		<fieldset class="col-md-12 border mt-2 w-100 pt-3">
			<table class=" table-sm table-bordered table-hover table-strepted dataTable w-100">
				<thead class="bg-dark text-white">
					<tr>
						<th>Référence</th>
						<th>Désignation</th>
						<th>Prix Unitaire</th>
						<th>En stock</th>
					</tr>
				</thead>
				<tbody>

				</tbody>

			</table>
		</fieldset>
	</div>
</div>
</div>
<script>
	$(document).ready(function() {
		var table = $('.dataTable').dataTable({
			processing: true,
			ajax: "magasiner/liseteMPremierData",
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},

			"rowCallback": function(row, data) {

			},
			initComplete: function(setting) {

			},
			"drawCallback": function(settings) {

			}
		});
	});
</script>