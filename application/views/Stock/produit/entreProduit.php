<div class="card w-100">
	<div class="card-header bg-dark text-white">
		<b>STOCK SURPLUS</b>
		<b class="pull-right">
			<input type="date" class="debut" name="date">
			<input type="date" class="fin" name="date">
			<a href="#" class="btn btn-success btn-sm afficher"><i class="fa fa-tv"></i>&nbsp; AFFICHER</a>
			<a href="<?=base_url("Stock/exportentreProduitFini?debut=&fin=")?>"
				class="btn btn-primary btn-sm exportSortie"><i class="fa fa-download"></i>&nbsp; EXPORTE</a>
			<a href="<?=base_url("Stock/exportentreProduitFini?debut=&fin=")?>" class="btn btn-warning btn-sm printSortie"><i
					class="fa fa-print"></i>&nbsp; IMPRIMER</a>
		</b>
	</div>
	<div class="card-body">
		<fieldset class="col-md-12 border mt-2 w-100 pt-3">
			<table class=" table-sm table-bordered table-hover table-strepted tableProduitEntre w-100">
				<thead class="bg-dark text-white">
					<tr>
						<th>ID</th>
						<th>DATE</th>
						<th>PO</th>
						<th>MAGASINER </th>
						<th>DIMENSION</th>
						<th>QTT</th>
						<th>OBSERVATIION</th>
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
	$(document).ready(function () {
		$('.tableProduitEntre').DataTable({
			processing: true,
			ajax: "Stock/lisete_entre_fini",
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"columnDefs": [{
				"targets": [4],
				"orderable": false,

			}],
			"rowCallback": function (row, data) {

			},
			initComplete: function (setting) {

			},
			"drawCallback": function (settings) {}
		});
	});
</script>
