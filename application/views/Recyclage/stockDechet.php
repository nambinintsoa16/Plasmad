<div class="card">
	<div class="card-header bg-dark text-white">
		<b>STOCK DES DECHETS</b>
		<b class="w-100 border-dark text-right col-md-6 pull-right">
			<input type="date" class="m-0 debut">
			<input type="date" class="m-0 ml-2 fin">
			<a href="#" class=" text-white ml-2 btn btn-success btn-sm"><i class="fa fa-tv"></i>&nbsp; AFFICHER</a>
			<a href="<?= base_url("Comptabilite/exportEntre") ?>" class=" text-white ml-2 btn btn-warning btn-sm"><i
					class="fas fa-file-excel"></i>&nbsp; EXPORTE</a>
			<a href="<?= base_url("Comptabilite/exportEntre") ?>" class=" text-white ml-2 btn btn-info btn-sm"><i
					class="fas fa-file-pdf"></i>&nbsp; IMPRIMER</a>
		</b>
	</div>
	<div class="card-body">
		<div class="row m-auto">
			<div class="col-sm-6 col-md-3">
				<div class="card card-stats card-round">
					<div class="card-body ">
						<div class="row align-items-center">
							<div class="col-icon">
								<div class="icon-big text-center icon-success bubble-shadow-small">
									<i class="flaticon-database"></i>
								</div>
							</div>
							<div class="col col-stats ml-3 ml-sm-0">
								<div class="numbers">
									<p class="card-category">Quantite en stock</p>
									<h4 class="card-title"><?=$data->stock?></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-12">
				<table class="table table-hover table-strepted tableDechet">
					<thead class="bg-dark text-white">
						<tr>
							<th>DATE</th>
							<th>N°PO</th>
							<th>OPERATEUR</th>
							<th>MACHINES</th>
							<th>TYPE DE MATIEER</th>
							<th>TYPE DE DECHETS</th>
							<th>POIDS</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	$(() => {

		Table = $('.tableDechet').DataTable({
			processing: true,
			ajax: base_url + "Recyclage/entreDechet",
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
		})


	});

</script>
