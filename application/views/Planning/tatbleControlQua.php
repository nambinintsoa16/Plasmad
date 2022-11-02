<div class="card">
	<div class="card-header bg-dark text-white">
		<b> Controle qualite</b>
	</div>
	<div class="card-body">
	 <fieldset class="col-md-12 border p-3 ">
       	<table class="table table-bordered border-secondary table-striped table-hover dataTableLite">
       		<thead class="bg-secondary text-white">
       			<tr>
       				<th>Id</th>
       				<th>N°PO</th>
       				<th>OPERATEUR</th>
       				<th>ENTRE</th>
       				<th>TTS</th>
       				<th>2eme Choix</th>
       			</tr>
       		</thead>
       		<tbody>

       		</tbody>
     
       	</table>
       </fieldset>

       <script type="text/javascript">
       	$(document).ready(function() {
			 var link = base_url+"Planning/dataQC";
       		Table = $(".dataTableLite").DataTable({
       			processing: true,
       			ajax: link,
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

