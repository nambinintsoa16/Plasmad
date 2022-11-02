<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Accueil</a></li>
		<li class="breadcrumb-item"><a href="#">Planning</a></li>
		<li class="breadcrumb-item"><a href="#">Liste des commandes</a></li>
	</ol>
</nav>
<div class="card">
	<div class="card-header bg-dark text-white">
		<b>COMMANDES</b>
	</div>
	<div class="card-body">
		<fieldset class="border">
			<div class="row">
				<div class="form-group col-md-12 form-inline">
					<label class="col-md-2 col-form-label">Mois : </label>
					<div class="col-md-4 p-0">
						<select name="anneé" id="moisliste" class="form-control form-control-sm">
							<?php $p = 1;
							foreach (listemois() as $key => $listemois) : ?>
							<option value="<?= $p ?>"><?= $listemois ?></option>
							<?php $p++;
							endforeach; ?>
						</select>
					</div>
					<label class="col-md-2 col-form-label m-0">Année : </label>
					<div class="col-md-4 p-0">
						<select name="anneé" id="anneliste" class="form-control form-control-sm">
							<?php foreach ($annee as $key => $annee) : ?>
							<option><?= $annee ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<hr />
				</div>
		</fieldset>
		<fieldset class="border mt-3 p-3">
			<div class="row">
				<div class="col-md-4">
					<input type="date" placeholder="Date debut" class="form-control debut">
				</div>
				<div class="col-md-4">
					<input type="date" placeholder="Date fin" class="form-control fin">
				</div>
				<div class="col-md-4">
					<a href="#" class="btn btn-sm btn-primary col-md-3 pull-right recherche mr-2">Afficher</a>&nbsp;
					<a href="<?=base_url("Suivi_Commerciale/exportBon")?>" class="btn btn-sm btn-success col-md-3 pull-right print mr-2">Exporter</a>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="selectgroup w-100">
					<label class="selectgroup-item">
						<input type="radio" name="value" value="50" id="TOUT" class="selectgroup-input" checked="">
						<span class="selectgroup-button">TOUT AFFICHE</span>
					</label>
					<label class="selectgroup-item">
						<input type="radio" name="value" value="100" id="SACHETS" class="selectgroup-input">
						<span class="selectgroup-button">SACHETS</span>
					</label>
					<label class="selectgroup-item">
						<input type="radio" name="value" value="100" id="CINTRES" class="selectgroup-input">
						<span class="selectgroup-button">CINTRES</span>
					</label>
				</div>
			</div>
			<fieldset class="border p-2">
				<div class=" col-md-12 table-respensive p-0">
					<table class="w-100 table dataTableLite table-hover table-bordered table-hover table-bordered-bd-dark">
						<thead class="bg-info text-white">
							<tr>
								<th>PO N°</th>
								<th>Date de commande</th>
								<th>Client,Référence</th>
								<th>Code Client</th>
								<th>Dimension</th>
								<th>Observation</th>
								<th>Produit</th>
								<th>Statut</th>
								<th style="width: 150px!important;"></th>
							</tr>

						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title text-center" id="exampleModalLongTitle">
					Annulation PE N° : <span class="npe"></span>
				</p>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

			</div>

			<div class="modal-body">

				<textarea class="form-control" row="4"
					placeholder=" Veillez indiquer l'objet de l' annulation"></textarea>

			</div>

			<div class="modal-footer">

				<button type="button" class="btn btn-success valideAnnull">Valider</button>

				<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>

			</div>

		</div>

	</div>

</div>

<div class="modal fade bd-example-modal-lg" id="infoCOmmande" tabindex="-1" role="dialog"
	aria-labelledby="myLargeModalLabel" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="card">

				<div class="card-header bg-dark text-white">

					<b> BON DE COMMANDE</b>

				</div>

				<div class="card-body">

					<div class="form">

						<form>

							<fieldset class="col-md-12 border">

								<div class="row">

									<div class="form-group col-md-4">

										<label for="date">Date : </label>

										<input type="text" name="date" disabled
											class="form-control form-control-sm date" value=<?= date('d-m-Y') ?>>

									</div>

									<div class="form-group col-md-4">

										<label for="BC_PE">PE N° : </label>

										<input type="text" name="BC_PE" disabled
											class="form-control form-control-sm BC_PE" value="">

									</div>

									<div class="form-group col-md-4">

										<label for="BC_TYPEPRODUIT">TYPE DE PRODUIT : </label>

										<select class="form-control form-control-sm BC_TYPEPRODUIT">

											<option>CINTRES</option>

											<option>SACHETS</option>

											<option>GAINES</option>

											<option>PUCE DE TAILLES</option>

										</select>

									</div>

									<div class="form-group col-md-3">

										<label for="BC_CLIENT">CLIENT, Référence : </label>

										<input type="text" name="BC_CLIENT"
											class="form-control form-control-sm BC_CLIENT ">

									</div>

									<div class="form-group col-md-3">

										<label for="BC_CODE">CODE : </label>

										<input type="text" name="BC_CODE" class="form-control form-control-sm BC_CODE">

									</div>

									<div class="form-group col-md-3">

										<label for="BC_DATELIVRE">Date de livraison : </label>

										<input type="date" name="BC_DATELIVRE"
											class="form-control form-control-sm BC_DATELIVRE">

									</div>

									<div class="form-group col-md-3">

										<label for="BC_LIEULIVRE">Lieu de livraison : </label>

										<input type="text" name="BC_LIEULIVRE"
											class="form-control form-control-sm BC_LIEULIVRE">

									</div>

								</div>

							</fieldset>

							<fieldset class="col-md-12 border mt-2">

								<div class="row">

									<div class="form-group col-md-4">

										<label for="BC_REASSORT">Reassort : </label>

										<input type="text" name="BC_REASSORT"
											class="form-control form-control-sm BC_REASSORT ">

									</div>

									<div class="form-group col-md-4">
										<label for="BC_ECHANTILLON">Echantillon : </label>

										<input type="text" name="BC_ECHANTILLON"
											class="form-control form-control-sm BC_ECHANTILLON">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_DIMENSION">Dimension : </label>
										<input type="text" name="BC_DIMENSION"
											class="form-control form-control-sm BC_DIMENSION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_RABAT">Rabat : </label>
										<input type="text" name="BC_RABAT"
											class="form-control form-control-sm BC_RABAT">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_SOUFFLET">Soufflet : </label>
										<input type="text" name="BC_SOUFFLET"
											class="form-control form-control-sm BC_SOUFFLET">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_PERFORATION">Perforation : </label>
										<input type="text" name="BC_PERFORATION"
											class="form-control form-control-sm BC_PERFORATION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_TYPE">Type : </label>
										<select class="form-control BC_TYPE form-control-sm">
											<?php foreach ($type as $key => $type) : ?>
											<option><?= $type->TF_DESIGNATION ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label for="BC_IMPRESSION">Impression : </label>
										<input type="text" name="BC_IMPRESSION"
											class="form-control form-control-sm BC_IMPRESSION">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_CYLINDRE">Cylindre : </label>
										<input type="text" name="BC_CYLINDRE"
											class="form-control form-control-sm BC_CYLINDRE">
									</div>
								</div>
							</fieldset>
							<fieldset class="col-md-12 border mt-2">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="BC_TYPEMATIER">Matière : </label>
										<select class="form-control BC_TYPEMATIER form-control-sm">
											<?php foreach ($type_de_matier as $key => $type_de_matier) : ?>
											<option><?= $type_de_matier->TM_DESIGNATION ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label for="BC_QUNTITE">Quantité : </label>
										<input type="number" name="BC_QUNTITE"
											class="form-control form-control-sm BC_QUNTITE">
									</div>
									<div class="form-group col-md-4">
										<label for="BC_PRIX">Prix : </label>
										<input type="text" name="BC_PRIX" class="form-control form-control-sm BC_PRIX">
									</div>
								</div>

					</div>
					</fieldset>
					<fieldset class="col-md-12 border mt-2">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="BC_OBSERVATION">Observation : </label>
								<textarea class="form-control BC_OBSERVATION"></textarea>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="card-footer text-right">

					<a href="" class="btn btn-info imprimerprecosting"><i class="fa fa-print"></i>&nbsp;Imprimer
						precosting</a>
					<a href="" class="btn btn-info imprimer"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
					<button type="reset" class="btn btn-danger removeModal">Annuler</button>
				</div>
				</form>
			</div>
		</div>

	</div>

</div>

</div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		
			var link = base_url + 'Planning/MES_COMMANDES';
		

		Table = $(".dataTableLite").DataTable({
			processing: true,
			ajax: link,
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"columnDefs": [{
				"targets": [6],
				"orderable": false,

			}],
			"rowCallback": function (row, data) {
				dataAction();
			},
			initComplete: function (setting) {
				dataAction();
			},
			"drawCallback": function (settings) {
				dataAction();
			}
		});

	function dataAction(){
		$(".edit_post").on("click", function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var pe = parent.children().first().text();
            $.post(base_url + "Suivi_Commerciale/detailPE", {
                pe: pe
            }, function(data) {
                $(".BC_PE").val(data.BC_PE);
                $(".date").val(data.BC_DATE);
                $(".BC_CLIENT").val(data.BC_CLIENT);
                $(".BC_CODE").val(data.BC_CODE);
                $(".BC_DATELIVRE").val(data.BC_DATELIVRE);
                $(".BC_REASSORT").val(data.BC_REASSORT);
                $(".BC_ECHANTILLON").val(data.BC_ECHANTILLON);
                $(".BC_DIMENSION").val(data.BC_DIMENSION);
                $(".BC_RABAT").val(data.BC_RABAT);
                $(".BC_SOUFFLET").val(data.BC_SOUFFLET);
                $(".BC_PERFORATION").val(data.BC_PERFORATION);
                $(".BC_TYPE option:selected").val(data.BC_TYPE);
                $(".BC_IMPRESSION").val(data.BC_IMPRESSION);
                $(".BC_QUNTITE").val(data.BC_QUNTITE);
                $(".BC_BC_CYLINDRE").val(data.BC_CYLINDRE);
                $(".BC_PRIX").val(data.BC_PRIX);
                $(".BC_OBSERVATION").val(data.BC_OBSERVATION);
                $(".BC_LIEULIVRE").val(data.BC_LIEULIVRE);
                $('.imprimerprecosting').attr('href', base_url + 'Commerciale/printcosting?po=' + data.BC_PE);
                $('.imprimer').attr('href', base_url + 'Commerciale/printFacture?po=' + data.BC_PE);
                $("#infoCOmmande").modal("show");
            }, "json");
        });

	}

		$('.recherche').on('click', function (event) {
			event.preventDefault();
			var anneliste = $('#anneliste option:selected').text();
			var moisliste = $('#moisliste option:selected').val();
			var type = $('.checked').attr('id');
			var debut = $('.debut').val();
			var fin = $('.fin').val();
			var links = base_url + "Suivi_Commerciale/commandeSpecifique/" + type + "/" + anneliste + "/" + moisliste + "/?debut=" + debut + "&fin=" + fin;
			$('.print').attr('href', base_url + "Suivi_Commerciale/exportParam?type=" + type + "&anne=" + anneliste + "&mois=" + moisliste + "&debut=" + debut + "&fin=" + fin);
			Table.ajax.url(links);
			Table.ajax.reload();

		});
		$('.selectgroup-input').on('click', function () {
			$('.selectgroup-input').removeClass('checked');
			$(this).addClass('checked');
			if ($(this).attr('id') == "TOUT") {
				var links = base_url + "Planning/MES_COMMANDES/";
				Table.ajax.url(links);
				Table.ajax.reload();
			} else {
				var links = base_url + "Planning/commandeSpecifique/" + $(this).attr('id');
				Table.ajax.url(links);
				Table.ajax.reload();
			}
		});
	});
</script>
