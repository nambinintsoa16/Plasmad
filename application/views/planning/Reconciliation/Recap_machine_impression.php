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
<span><h4><b>Effective output</b><span class="collapse" id="machine_recap_data"><?= $machine ?></span> <span class="collapse" id="date_recap_data"><?= $date ?></span></h4></span>
<table class="table-hover table-stripted table-bordered w-100" id="table_recap_machine">
	<thead class="bg-info text-white">
		<tr>
			<th colspan="5" class="text-center">PRODUCTION</th>
		</tr>
		<th>DATE</th>
		<th>Poids/kgs</th>
		<th>Metrage</th>
		<th>Hours</th>
		<th>Operateure</th>
		</tr>
	</thead>
	<tbody>

	</tbody>
</table>
<script>
	$(document).ready(function() {
		let date = $('#date_recap_data').text();
		let machine = $('#machine_recap_data').text();
		$('#table_recap_machine').DataTable({
			language: {
				url: base_url + "assets/dataTableFr/french.json",
			},
			ajax: base_url + "Planning/get_data_recap_machine_impression?date=" + date + "&machine=" + machine
		});
	});
</script>