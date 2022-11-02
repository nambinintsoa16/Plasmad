<div class="card">
	<div class="card-header bg-dark text-white">
		<b>ENTREE DECHETS MACHINES RECYCLAGES</b>
	</div>
	<div class="card-body">
		<div class="card">
			<fieldset class="border w-100 p-2 rounded shadow-sm" style="background-color:#e2e5de;">
			
				<div class="row">
					<div class="form-group col-md-4">
						<label for="client">DATE</label>
						<input type="date" class="form-control form-control-sm date" name="date" id="date">
					</div>
					<div class="form-group col-md-4">
						<label for="client">MACHINES</label>
						<input type="text" class="form-control form-control-sm MACHINES" name="MACHINES" id="MACHINES">
					</div>
					<div class="form-group col-md-4">
						<label for="date_expir">TYPE DE MATIEER</label>
						<select class="form-control  MATIEER" name="MATIEER" id="MATIEER">
							<option>PE</option>
							<option>PP</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="date_expir">TYPE DE DECHETS</label>
						<select class="form-control   DECHETS" name="DECHETS"  id="DECHETS">
							<option>GAINE</option>
							<option>SACHET</option>
							<option>GAINE IMPRIMER</option>
							<option>SACHET IMPRIMER</option>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="date_expir">POIDS</label>
						<input type="text" class="form-control form-control-sm POIDS form-control-sm" name="POIDS"
							id="POIDS">
					</div>
					<div class="form-group col-md-4">
						<label for="date_expir">OPERATEUR</label>
						<input type="text" class="form-control form-control-sm OPERATEUR form-control-sm"
							name="OPERATEUR" id="OPERATEUR">
					</div>
					<div class="form-group col-md-12">
						<button type="submt" data-toggle="button" class="btn btn-success pull-right save"> <i
								class="fa fa-save"></i>&nbsp; ENREGISTRER</button>
						<button type="reset" class="btn btn-danger pull-right mr-2"> <i class="fa fa-times"></i>&nbsp;
							ANNULER</button>

					</div>
				</div>

			</fieldset>



		</div>
	</div>
</div>
<script>
$(()=>{

	$('.save').on('click', function(e) {
			e.preventDefault();
			let DATE = $('.date').val();
			let MACHINES = $('.MACHINES').val();
			let MATIERE = $('.MATIEER option:selected').val();    
			let DECHETS = $('.DECHETS option:selected').val();
			let POIDS = $('.POIDS').val();
			let OPERATEUR = $('.OPERATEUR').val();
			let TYPE = "ENTRE";
			chargement();
			$.post(base_url + "Recyclage/saveRecycleentre", {
				DATE,
				MACHINES,
				MATIERE,
				POIDS,
				DECHETS,
				OPERATEUR,
				TYPE
			}, function() {
				closeDialog();
				$('input').val('');
				alertMessage("Sucé", "Enregistrement éffectué avec succé", "success", "btn btn-success")
			});

		});




	$('.MACHINES').autocomplete({
			source: base_url + "Production/autocompletMa",

		});




		$('.OPERATEUR').autocomplete({
			source: base_url + "Production/autocompleteQC",

		});

		function alertMessage(title, message, icons, btn) {
			swal(title, message, {
				icon: icons,
				buttons: {
					confirm: {
						className: btn
					}
				},
			});

		}

		function chargement() {
			var htmls = '<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
			$.dialog({
				"title": "",
				"content": htmls,
				"show": true,
				"modal": true,
				"close": false,
				"closeOnMaskClick": false,
				"closeOnEscape": false,
				"dynamic": false,
				"height": 150,
				"fixedDimensions": true
			});


		}

		function closeDialog() {
			$('.jconfirm').remove();
		}
});

</script>