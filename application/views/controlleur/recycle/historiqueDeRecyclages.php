<div class="card">
	<div class="card-header bg-dark text-white">
		<b>HISTORIQUE ENTRE RECYCLAGES</b>
		<b class="w-100 border-dark text-right col-md-6 pull-right">
			<input type="date" class="m-0 debut">
			<input type="date" class="m-0 ml-2 fin">
			<a href="#" class=" text-white ml-2 btn btn-success btn-sm"><i class="fa fa-tv"></i>&nbsp; AFFICHER</a>
			<a href="<?= base_url("Comptabilite/exportEntre") ?>" class=" text-white ml-2 btn btn-warning btn-sm"><i class="fa fa-download"></i>&nbsp; EXPORTE</a>
			<a href="<?= base_url("Comptabilite/exportEntre") ?>" class="printDechet text-white ml-2 btn btn-info btn-sm"><i
					class="fas fa-file-pdf"></i>&nbsp; IMPRIMER</a>
		
		</b>
	</div>
	<div class="card-body">

		<table class="table table-hover table-strepted tableDecheRecycle">
			<thead class="bg-dark text-white">
				<tr>
					<th>DATE</th>
					<th>MACHINE</th>
					<th>N°PO</th>
					<th>OPERATEUR</th>
					<th>DECHET</th>
					<th>POIDS</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script>
	$('document').ready(function() {
		Table = $(".tableDecheRecycle").DataTable({
			processing: true,
			ajax: base_url + "Recyclage/historiqueDeRecyclages",
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"columnDefs": [{
				"targets": [6],
				"orderable": false,

			}],
			"rowCallback": function(row, data) {

			},
			initComplete: function(setting) {

			},
			"drawCallback": function(settings) {

			}
		});
		$('.afficher').on('click',function(e){
      e.preventDefault()
			let debut = $('.debut').val()
			let fin = $('.fin').val()
			$('.exportDechet').attr('href',base_url+"Recyclage/entreDechet?debut="+debut+"&fin="+fin)
			$('.printDechet').attr('href',base_url+"Recyclage/entreDechet?debut="+debut+"&fin="+fin)

		var  links = base_url +"Recyclage/entreDechet?debut="+debut+"&fin="+fin;
      Table.ajax.url(links);
      Table.ajax.reload();

	})
	});
</script>