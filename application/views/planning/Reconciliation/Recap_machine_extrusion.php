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
<h4><b>Effective output</b><span class="collapse" id="machine_recap_data"><?= $machine ?></span> <span class="collapse" id="date_recap_data"><?= $date ?></span></h4>
<div class="m-0 p-0">
	<table class="table-hover table-stripted table-bordered w-100 m-0 mt-3" id="table_recap_machine">
		<thead class="bg-info text-white">
			<tr>
				<th>Extrusions</th>
				<th colspan="4" class="text-center">PRODUCTION</th>
				<th></th>
				<th colspan="3" class="text-center">REJECT</th>
			</tr>
			<tr>
				<th>DATE</th>
				<th>TDY</th>
				<th>Hours</th>
				<th>Machine utilization </th>
				<th>Machine efficiency</th>
				<th>Total effective Equipment Losses-OEE % Loss </th>
				<th>TDY</th>
				<th>Scrap%</th>
				<th>Operateur Name</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
	$(document).ready(function() {
		let date = $('#date_recap_data').text();
		let machine = $('#machine_recap_data').text();
		$('#table_recap_machine').DataTable({
			language: {
				url: base_url + "assets/dataTableFr/french.json",
			},
			ajax: base_url + "planning/get_data_recap_machine_extrusion?date=" + date + "&machine=" + machine
		});
	});
</script>