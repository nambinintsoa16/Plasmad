<style>
    .label {
        color: #2a5591;
    }
    
</style>
<div class="container text-left">
<fieldset class="col-md-12 border text-left text-blue">
	<div class="row">
		<div class="form-group col-md-3">
			<label for="BC_PE">PO N° : </label>
			<input type="text" name="BC_PE" value="<?= $job->BC_PE ?>" disabled class="form-control form-control-sm BC_PE" id="refnum" value="">
		</div>

		<div class="form-group col-md-3">
			<label for="JO_ID">JOB N° : </label>
			<input type="text" name="JO_ID" value="<?= $job->JO_ID ?>" disabled class="form-control form-control-sm JO_ID">
		</div>
		<div class="form-group col-md-3">
			<label for="">DEBUT : </label>
			<input type="time" name="" value="<?= $job->JO_DEB ?>" disabled class="form-control form-control-sm hdeb">
		</div>
		<div class="form-group col-md-3">
			<label for="">DUREE : </label>
			<input type="text" name="" value="<?= $job->JO_DURE ?>" disabled class="form-control form-control-sm heure">
		</div>

		<div class="form-group col-md-6">
			<label for="BC_QUANTITEAPRODUIREENMETRE">QUANTITE A PRODUIRE EN METRE : </label>
			<input type="text" id="BC_QUANTITEAPRODUIREENMETRE" value="<?= $commande->BC_QUANTITEAPRODUIREENMETRE ?>" class="form-control form-control-sm update_champ">
		</div>
		<div class="form-group col-md-6">
			<label for="BC_POISENKGSAVECMARGE">POIDS EN KG AVEC MARGE : </label>
			<input type="text" id="BC_POISENKGSAVECMARGE" value="<?= $commande->BC_POISENKGSAVECMARGE ?>" class="form-control form-control-sm update_champ">
		</div>
		<div class="form-group col-md-4">
			<label for="TERMINER">TERMINER : </label>
			<input type="text" name="TERMINER" id="terminer" value="<?= $job->JO_AV ?>" class="form-control form-control-sm terminer">
		</div>
	

		<div class="form-group col-md-12">
			<label for="BC_OBSERVATION">Observation : </label>
			<textarea class="form-control BC_OBSERVATION"></textarea>
		</div>
</div>
</fieldset>
<fieldset class="col-md-12 border text-left text-blue mt-1">
	<div class="row">
		<div class="form-group col-md-6">
			<div class="form-group">
				<label for="stock_sortie">Matière première : </label>
				<input type="text" class="form-control form-control-sm" id="stock_sortie" placeholder="Entrée désignation">
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="form-group">
				<label for="quantite">Quantité : </label>
				<div class="input-group mb-3">
					<input type="text" class="form-control form-control-sm " id="quantite" placeholder="Quantité" aria-label="Quantité" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<a href="#" class="input-group-text btn btn-primary text-white form-control-sm add-table" id="basic-addon2"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
		</fieldset>
		<fieldset class="col-md-12 border text-left text-blue mt-1">		
		<div class="form-group col-md-12">
			<table class="w-100 table-bordered table-hover table-sm" id="table-matiere_utiliser">
				<thead class="bg-info text-white text-center">
					<tr>
						<th>Refnum</th>
						<th>Désignation</th>
						<th>Quantité</th>
						<th>Prix</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="tbody-table-matiere text-center" id="content-table">
					<?php foreach ($matiere as $key => $matiere) : ?>
						<tr>
							<td><?= $matiere->MU_ID ?></td>
							<td><?= $matiere->MU_DESIGNATION ?></td>
							<td><?= $matiere->MU_QUANTITE ?></td>
							<td><?= $matiere->MU_PRIX ?></td>
							<td><a href="#" id="<?= $matiere->MU_ID ?>" class="btn btn-danger btn-sm delete_matiere"><i class="fa fa-trash"></i> Supprimer</a></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		</fieldset>

<script>
	$(document).ready(function() {
		delete_matiere_planning();

		function delete_matiere_planning() {
			$('.delete_matiere').on('click', function(event) {
				event.preventDefault();
				let parent = $(this).parent().parent();
				let refnum = parent.children().eq(0).text();
				$.post(base_url + 'planning/delete_matiere_planning', {
					refnum
				}, function() {
					$.alert({
						title: "Succè!",
						content: "Matière supprimée",
						type: 'green',
						button: {
							function() {

							},
							text: 'confirmer',
							btnClass: 'btn-blue',
						}
					})
					parent.remove();
				});
			});
		}

		function save_new_matiere(designation, quantite, prix, refnum) {
			$.post(base_url + "planning/create_plinning_matiere", {
				designation,
				quantite,
				refnum,
				prix
			}, function(Response) {
				$('#stock_sortie').val("");
				$('#quantite').val("");
				$('#content-table').append('<tr><td>' + Response + '</td><td>' + designation + '</td>' + '<td>' + quantite + '</td><td>' + prix + '</td><td class="text-center"><a href="#" class="btn btn-danger btn-sm delete_matiere"><i class="fa fa-trash"></i> supprimer</a> </td></tr>');
				//delete_matiere_planning();
			});
		}

		$('.add-table').on('click', function(e) {
			e.preventDefault();
			if ($('#stock_sortie').val() != "" && $('#quantite').val() != "") {
				let matiere = $('#stock_sortie').val().split('|');
				let quantite = $('#quantite').val();
				let designation = matiere[0];
				let prix = matiere[1]
				let refnum = $('#refnum').val();
				let table = [];
				$('#content-table > tr').each(function() {
					table.push($(this).children().eq(1).text());
				});
				let methodOk = typeof($('#content-table > tr').html()) == 'undefined';
				if (methodOk) {
					save_new_matiere(designation, quantite, prix, refnum);
				} else {
					methodOk = $.inArray(designation, table) != -1;
					if (methodOk) {
						$.alert({
							title: "Erreur!",
							content: "Ce matière existe déjà dans votre bon de commande. Veuillez modifier la quantité pour ajouter une autre matière.",
							type: 'red'
						});
					} else {
						save_new_matiere(designation, quantite, prix, refnum);

					}

				}
			}
		});

		$('.update_champ').on('change', function(event) {
			event.preventDefault();
			let value = $(this).val();
			let refnum = $('.BC_PE').val();
			let champs = $(this).attr('id');
			$.post(base_url + 'Planning/update_commande_with_param', {
				value,
				refnum,
				champs
			}, function(data) {
				if (data == 1) {
					$.alert({
						title: "Succè!",
						content: "Enregistremnt éffectué.",
						type: 'green'
					});
				} else {
					$.alert({
						title: "Erreur!",
						content: "Une erreur s'est produite. Veuillez rééssayer.",
						type: 'red'
					});
				}
			});

		});

		$('#terminer').on('change', function(event) {
			event.preventDefault();
			let type ="prod_terminer";
			let refnum =$('.JO_ID').val();
		    let value = $(this).val();
			$.post(base_url + "Planning/update_statut_impression_prod", { refnum, value, type },function(data) {
				if (data == 1) {
					$.alert({
						title: "Succè!",
						content: "Enregistremnt éffectué.",
						type: 'green'
					});
				} else {
					$.alert({
						title: "Erreur!",
						content: "Une erreur s'est produite. Veuillez rééssayer.",
						type: 'red'
					});
				}               
            });

		});



	});
</script>