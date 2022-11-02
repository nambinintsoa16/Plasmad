<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Suivi commerciale</a></li>
		<li class="breadcrumb-item"><a href="#">Suivie commande</a></li>
	</ol>
</nav>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b>SUIVIE COMMANDE</b>
		<p class="float-right m-0 p-0">Début : <input type="date" class="debut"> Fin : <input type="date" class="fin">N°PO : <input type="text" class="po"> Code client : <input type="text" class="client"> <button type="submit" class="btn btn-sm btn-info afficher">Affiche</button> <a href="#" class="btn btn-success btn-sm btn-export">Exporter</a> </p>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table class="table-strepted table-repensive table-bordered p-0 w-100 tableSuivie">
					<thead class="bg-dark text-white">
						<tr>
							<th style="width:250x!important">REFERENCE CLIENT</th>
							<th style="width:250x!important">PO Date </th>
							<th style="width:250x!important">Plasmad PO No.</th>
                            <th style="width:250x!important">STATUS</th>
							<th style="width:250x!important">Customer</th>
							<th style="width:250x!important">Dimensions</th>
							<th style="width:250x!important">Order Quantity</th>
							<th style="width:250x!important">Required Delivery Date</th>
							<th style="width:250x!important">Confirmed Delivery Date</th>
							<th style="width:250x!important">Description XIT</th>
							<th style="width:250x!important">Actual Delivered Date</th>
							<th style="width:250x!important">Delivery Month</th>
							<th style="width:250x!important">Cfmd Delivery Week</th>
							<th style="width:250x!important">Unit Price USD</th>
							<th style="width:250x!important">Amount USD</th>
							<th style="width:250x!important">Delivered qty</th>
							<th style="width:250x!important">Unit Price Euro</th>
							<th style="width:250x!important">Amount Euro</th>
							<th style="width:250x!important">Production Lead-time (day)</th>
							<th style="width:250x!important">Variance Delivery (day)</th>
							<th style="width:250x!important">Varaince Actual Dlvry (day)</th>
							<th style="width:250x!important">Amount-Dlvd USD</th>
							<th style="width:250x!important">Amount-Dlvd EURO</th>
							<th style="width:250x!important">Balance to be Dlvd (Qty)</th>
							<th style="width:250x!important">Bal Amount USD</th>
							<th style="width:250x!important">Bal Amount Euro</th>
							
							<th style="width:250x!important"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>






<div class="modal fade modalEditSuivie" id="modale-info" tabindex="-1" role="dialog" aria-labelledby="Title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">PO N° : <span class="npo"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="container p-2">
						<div class="row">
						    <div class="form-group m-auto col-md-12">
								<label for="">Modifier</label>
								<select class="form-control form-control-sm itemModif">
									<option>Delivered qty</option>
									<option>Unit Price Euro</option>
									<option>Amount Euro</option>
									<option>Production Lead-time (day)</option>
									<option>Variance Delivery (day)</option>
									<option>Varaince Actual Dlvry (day)</option>
									<option>Amount-Dlvd USD</option>									
									<option>Actual Delivered Date</option>
									<option>Amount-Dlvd EURO</option>
									<option>Bal Amount USD</option>
									<option>Bal Amount Euro</option>
								</select>
							</div>
							<div class="form-group m-auto col-md-12">
								<label for="">Nouvel valeur</label>
								<input type="text " class="form-control form-control-sm valeurModif">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success saveModif">Enregistrer</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
<script>
	$(document).ready(function() {

		let link = base_url + 'Suivi_Commerciale/suivie';
		$('.btn-export').attr('href',base_url + 'Suivi_Commerciale/exportsuivie');

		$('.itemModif').on('change',function(e){
			e.preventDefault();
			let valeur = $('.itemModif option:selected').val();
			if(valeur=="Actual Delivered Date"){
				$('.valeurModif').attr('type','date');
			}else{
				$('.valeurModif').attr('type','text');
			}

		});
		Table = $(".tableSuivie").DataTable({
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
                $('.edit_post').on('click',function(e){
					e.preventDefault();
					var idModif = $(this).attr('id');
					$('.saveModif').attr('id',idModif);
					$('.npo').text(idModif);
					$('.modalEditSuivie').modal('show');

				});
			}
		});
		$('.po').autocomplete({
            source: base_url + "Comptabilite/autocompletPo",
        });
         $('.saveModif').on('click',function(e){
			 e.preventDefault();
			var idModifMod = $(this).attr('id');
			let itemModif = $('.itemModif').val();
			let valeurModif = $('.valeurModif').val();

			$.post(base_url+'Suivi_Commerciale/saveSuivie',{idModifMod:idModifMod,itemModif:itemModif,valeurModif:valeurModif},function(data){
				let debut = $('.debut ').val();
				let fin = $('.fin').val();
				let po = $('.po').val();
				let client = $('.client').val();
				$('.valeurModif').val("");
				let links = base_url + 'Suivi_Commerciale/suivie?debut=' + debut + '&fin=' + fin + '&po=' + po+'&client='+client;
				Table.ajax.url(links);
				Table.ajax.reload();
				$('.btn-export').attr('href',base_url + 'Suivi_Commerciale/exportsuivie?debut=' + debut + '&fin=' + fin + '&po=' + po+'&client='+client);
			});
		 });
		 $('.client').autocomplete({
			source: base_url + "Comptabilite/autocompletClient",
		});
		$('.afficher').on('click', function(e) {
			e.preventDefault();
			let debut = $('.debut ').val();
			let fin = $('.fin').val();
			let po = $('.po').val();
			let client = $('.client').val();
			let links = base_url + 'Suivi_Commerciale/suivie?debut=' + debut + '&fin=' + fin + '&po=' + po+'&client='+client;
			Table.ajax.url(links);
			Table.ajax.reload();
			$('.btn-export').attr('href',base_url + 'Suivi_Commerciale/exportsuivie?debut=' + debut + '&fin=' + fin + '&po=' + po+'&client='+client);
		});
	});
</script>
