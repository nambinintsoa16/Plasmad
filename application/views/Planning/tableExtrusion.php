<div class="col-md-12 text-right p-2">
	<fieldset class="border p-2 bg-white mb-2 text-right">
		<a href="<?= base_url("Planning\printExtrusion") ?>" class="btn btn-primary"><i class="fa fa-print"></i> Imprimer</a>
		<a href="#" class="btn btn-primary printJobs"><i class="fa fa-print"></i> Imprimer JobCart</a>
	</fieldset>
</div>
<?php foreach ($machine as $key => $machine) : ?>
	<?php

					$this->load->model('Production_model');
					$data = "";
					$param = "";
					 $sommeFini = 0;
					 $previ = 0;
					$param = [
						"JO_MACHINE" => $machine->MA_DESIGNATION,
						"JO_TYPE" => "EXTRUSION",
						"JO_STATUT" => "PLANIFIER"
					];
					$donnee= $this->planning_model->selectJobCardComm($param);
					$data = ["data" => $donnee, "Vitesse" => $machine->MA_VITESSE];
					foreach($donnee as $key=>$donnee){
                            $sommeFini += $donnee->JO_AV;
                             $previ+=$donnee->JO_SORTIE;
					}
					?> 
	<div class="col-md-12 p-2 bg-dark text-white">
		<span class="col-md-3"><?= $machine->MA_DESIGNATION ?> </span>
		<span><a href="<?= base_url('Planning/printMachineData?machine=' . $machine->MA_DESIGNATION) ?>" class="text-success"><i class="fa fa-print"></i></a></span>&nbsp;
		<span><a href="<?= base_url('Planning/exportMachineData?machine=' . $machine->MA_DESIGNATION) ?>" class="text-success"><i class="fa fa-download"></i></a></span>
		<span>&nbsp;&nbsp;<a href="#" class="text-white">Capacité de la machine : <?= $machine->CAPACITE?></a></span>
		<span>&nbsp;&nbsp;<a href="#" class="text-white">Production prévisionnelle : <?= $previ?></a></span>
		|<span>&nbsp;&nbsp;<a href="#" class="text-white">Términer : <?= $sommeFini?></a></span>
		|<span>&nbsp;&nbsp;<a href="#" class="text-white">Reste à produire : <?=  $previ-$sommeFini?></a></span>
		
		<span class="pull-right" style="font-size:11px">
			<p class="text-right collapsed" data-toggle="collapse" data-target="#tab_<?= $machine->MA_ID ?>"> <i class="fa fa-plus " aria-expanded="false"></i></p>
		</span>
	</div>
	<div clas="row pt-2" style="padding:10px 2px;">
		<div class="col-md-12">
			<div class="d-flex justify-content-between">
				<p>


				</p>
			</div>
			<fieldset class="border p-2 bg-white mb-2 text-right">

				<button class="btn btn-success addProd"><i class="fa fa-plus"></i>&nbsp;Ajouter Production</button>
			</fieldset>
			<fieldset class="border p-2 bg-white">
				<div class="" id="tab_<?= $machine->MA_ID ?>" style="padding: 0px;">



					<?php $this->load->view('Planning\tableleEXtrusion', $data); ?>

				</div>
			</fieldset>
		</div>
	</div>
<?php endforeach; ?>


<div class="modal fade modalmachine" id="exampleModalCentere" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">AFFECTER A UNE AUTRE MACHINE</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="BC_PE">PO N° : </label>
							<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PEE" value="">
						</div>
						
						<div class="form-group col-md-6">
							<label for="">DEBUT : </label>
							<input type="time" name="" class="form-control form-control-sm hdebe">
						</div>
						<div class="form-group col-md-6">
							<label for="">DUREE : </label>
							<input type="text" name="" class="form-control form-control-sm heuree">
						</div>
						<div class="form-group col-md-6">
							<label for="">DATE FIN : </label>
							<input type="date" name="" class="form-control form-control-sm dateFIne">
						</div>
						<div class="form-group col-md-6">
							<label for="">HEURE FIN : </label>
							<input type="time" name="" class="form-control form-control-sm heurefine">
						</div>
						<div class="form-group col-md-4">
							<label for="DJ_MACHINE">MACHINE</label>
							<select class="form-control form-control-sm DJ_MACHINEE machineCreate" name="DJ_MACHINE">
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="BC_POISENKGSAVECMARGE">POIDS : </label>
							<input type="text" name="BC_POISENKGSAVECMARGE" class="form-control form-control-sm BC_POISENKGSAVECMARGEE">
						</div>
						<div class="form-group col-md-4">
							<label for="date_prod">DATE DEBUT</label>
							<input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm date_prodE">
						</div>
						<div class="form-group col-md-4 collapse">
							<input type="text" name="reste" class="form-control form-control-sm reste">
						</div>
					</div>
				</fieldset>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">FERMEE</button>
				<button type="button" class="btn btn-success createCard">MODIFIEE</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade editData" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">NOUVEL PROCESSUS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="BC_PE">PO N° : </label>
							<input type="text" name="BC_PE" disabled class="form-control form-control-sm BC_PE" value="">
						</div>
						<div class="form-group col-md-6">
							<label for="JO_ID">JOB CARD N° : </label>
							<input type="text" name="JO_ID" disabled class="form-control form-control-sm JO_ID">
						</div>

						<div class="form-group col-md-6">
							<label for="">DEBUT : </label>
							<input type="time" name="" class="form-control form-control-sm DEBU">
						</div>
						<div class="form-group col-md-6">
							<label for="">DUREE : </label>
							<input type="text" name="" class="form-control form-control-sm DURE">
						</div>
						<div class="form-group col-md-6">
							<label for="">DATE FIN : </label>
							<input type="date" name="" class="form-control form-control-sm DATEFIN">
						</div>
						<div class="form-group col-md-6">
							<label for="">HEURE FIN : </label>
							<input type="time" name="" class="form-control form-control-sm HEUREFIN">
						</div>
						<div class="form-group col-md-4">
							<label for="date_prod">DATE DE PRODUCTION</label>
							<input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm date_prod">
						</div>
						<div class="form-group col-md-4">
							<label for="DJ_MACHINE">PROCESSUS</label>
							<select class="form-control BC_STATUT form-control-sm" name="BC_STATUT">
								<option value="IMPRESSION_EXTRUSION">IMPRESSION</option>
								<option value="COUPE_EXTRUSION">COUPE</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="DJ_MACHINE">MACHINE</label>
							<select class="form-control form-control-sm DJ_MACHINE" name="DJ_MACHINE">

							</select>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success UpdateExtrusion">ENREGISTRE</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade changehourModal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Déplacer une tâche</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="">Déplacer après</label>
							<input type="text" class="form-control  press collapse">
							<input type="text" class="form-control po rang">
						</div>
					</div>
				</fieldset>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success UpdatePlace">ENREGISTRE</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
			</div>
		</div>
	</div>
</div>









<div class="modal fade" id="modaUpdatetime" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Modifier date</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="BC_PE">JOB ID : </label>
							<input type="text" name="BC_PE" class="form-control form-control-sm jobIDUPDATE" value="">
						</div>

						<div class="form-group col-md-6">
							<label for="">DEBUT : </label>
							<input type="time" name="" class="form-control form-control-sm DEBUUPDATE">
						</div>
						<div class="form-group col-md-6">
							<label for="date_prod">DATE DE PRODUCTION</label>
							<input type="date" id="date_prod" name="date_prod" class="form-control form-control-sm date_prodUPDATE">
						</div>



					</div>
				</fieldset>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success UpdateDatePlane">ENREGISTRE</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="printJobs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">IMPRIMER JOB CART</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="col-md-12 border">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="BC_PE">JOB ID : </label>
							<input type="text" name="" class="form-control form-control-sm jobsPrints" value="">
						</div>
						<div class="form-group col-md-12">
							<select class="form-control form-control-sm logoS">
								<option>PLASMAD</option>
								<option>MADAKEM</option>
							</select>
						</div>

					</div>
				</fieldset>
			</div>
			<div class="card-footer text-right">
				<button type="submit" class="btn btn-success savePrint">IMPRIMER</button>
				<button type="reset" class="btn btn-danger" data-dismiss="modal">ANNULE</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

		$('.updateDate').on('click', function(e) {
			e.preventDefault();
			$('.jobIDUPDATE').val($(this).parent().parent().children().eq(2).text());
			$('#modaUpdatetime').modal('show');


		});

		$('.printJobs').on('click', function(e) {
			e.preventDefault();
			$('#printJobs').modal('show');


		});
		$('.savePrint').on('click', function(e) {
			e.preventDefault();
			var jobs = $('.jobsPrints').val();
			var logo = $('.logoS option:selected').val();
			location.replace(base_url + 'planning/printJobs?place=' + logo + '&job=' + jobs);
		});



		$('.updatePO').autocomplete({

			source: base_url + 'Planning/autocompleteBon',
			appendTo: "#modaUpdatetime"

		});
		$('.UpdateDatePlane').on('click', function(e) {
			e.preventDefault();
			var updatePO = $('.jobIDUPDATE').val();
			var DEBUUPDATE = $('.DEBUUPDATE').val();
			var date_prodUPDATE = $('.date_prodUPDATE').val();
			$.post(base_url + "Planning/updateTime", {
				updatePO: updatePO,
				DEBUUPDATE: DEBUUPDATE,
				date_prodUPDATE: date_prodUPDATE,
			}, function(data) {
				$('.jobIDUPDATE').val("");
				$('.DEBUUPDATE').val("");
				$('.date_prodUPDATE').val("");
				$('#modaUpdatetime').modal('hide');
				swal("Succée!", "Date et heure modifier avec succée!", {
					icon: "success",
					buttons: {
						confirm: {
							className: "btn btn-success"
						}
					},
				});
				//alertMessage("Succée!", "Date et heure modifier avec succée!", "success", "btn btn-success");
			});



		});


		$.post(base_url + 'Planning/machineModaleTable', {
			type: "IMPRESSION_EXTRUSION"
		}, function(data) {
			$('.DJ_MACHINE').empty();
			data.forEach(element => $('.DJ_MACHINE').append("<option>" + element + "</option>"));
		}, 'json');
		var Table = $(".dataTable").dataTable({
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
		});

		$('.editProcessus').on('click', function(event) {
			event.preventDefault();
			var BC_PE = $(this).parent().parent().children().eq(1).text().trim();
			var JO_ID = $(this).parent().parent().children().eq(2).text().trim();
			var poids = $(this).parent().parent().children().eq(11).text().trim();

			$('.BC_PE').val(BC_PE);
			$('.JO_ID').val(JO_ID);
			$('.date_prod').attr('id', poids);
			$(".editData").modal("show");
		});

		$('.editP').on('click', function(event) {
			event.preventDefault();
			var BC_PE = $(this).parent().parent().children().eq(1).text().trim();
			var jobs = $(this).parent().parent().children().eq(2).text().trim();

			var type = "EXTRUSION";
			$.post(base_url + "Planning/editPoExtrusion", {
				BC_PE: BC_PE,
				jobs: jobs,
				type: type
			}, function(data) {
				$('.containt-result').empty().append(data);
			});

		});

		$('.date_prod').on('change', function(event) {
			event.preventDefault();
			var date = $(this).val();
			var processus = $('.BC_STATUT option:selected').val();
			var machine = $('.DJ_MACHINE option:selected').val();
			var poids = $(this).attr('id');
			$.post(base_url + 'Planning/calculePlanning', {
				date: date,
				poids: poids,
				machine: machine,
				BC_STATUT: processus
			}, function(data) {
				if (data.message == "true") {

					$('.DURE').val(data.dure);
					$('.DEBU').val(data.hdeb);
					$('.DATEFIN').val(data.dateFIn);
					$('.HEUREFIN').val(data.heurefin);
					$(".editData").modal("show");
				} else if (data.message == "over") {
					alertMessage("Erreur!", "Date non disponible! Veuillez choisir une autre!", "error", "btn btn-danger");
					$('.DURE').val('');
					$('.DEBU').val('');
					$('.DATEFIN').val('');
					$('.HEUREFIN').val('');
					$('.date_prode').val('');

				} else if (data.message == "init") {
					$(".editData").modal("hide");
					swal({
						title: 'DUREE',
						html: '',
						content: {
							element: "input",
							attributes: {
								type: "time",
								id: "input-field",
								className: "form-control"
							},
						},
						buttons: {
							cancel: {
								visible: true,
								className: 'btn btn-danger'
							},
							confirm: {
								className: 'btn btn-success'
							}
						},
					}).then(
						function() {
							var hdeb = $('#input-field').val();
							$.post(base_url + 'Planning/tempsDeProduction', {
								processus: processus,
								date: date,
								machine: machine,
								heure: hdeb
							}, function(data) {
								$('.DURE').val(data.dure);
								$('.DEBU').val($('#input-field').val());
								$('.DATEFIN').val(data.dateFIn);
								$('.HEUREFIN').val(data.heurefin);
								$(".editData").modal("show");
							}, 'json');

						}
					);

				} else {
					alertMessage("Ooops!!", data.observation, 'error', 'btn btn-danger');
					$('.DURE').val('');
					$('.DEBU').val('');
					$('.DATEFIN').val('');
					$('.HEUREFIN').val('');
					$('.date_prode').val('');
				}

			}, 'json');

		});

		$('.date_prodE').on('change', function(event) {
			event.preventDefault();
			var date = $(this).val();
			var poids = $('.BC_POISENKGSAVECMARGEE').val();
			var machine = $('.DJ_MACHINEE option:selected').val();
			var processus = "EXTRUSION";
			if (poids != "") {
				$.post(base_url + 'Planning/calculePlanning', {
					poids: poids,
					date: date,
					machine: machine,
					BC_STATUT: processus
				}, function(data) {
					if (data.message == "true") {
						$('.heuree').val(data.dure);
						$('.hdebe').val(data.hdeb);
						$('.dateFIne').val(data.dateFIn);
						$('.heurefine').val(data.heurefin);
						$('#exampleModalCentere').modal("show");
					} else if (data.message == "over") {
						alertMessage("Erreur!", "Date non disponible! Veuillez choisir une autre!", "error", "btn btn-danger");
						$('.heuree').val('');
						$('.hdebe').val('');
						$('.dateFIne').val('');
						$('.heurefine').val('');
						$('.date_prode').val('');

					} else if (data.message == "init") {
						$('#exampleModalCentere').modal("hide");
						swal({
							title: 'DUREE',
							html: '',
							content: {
								element: "input",
								attributes: {
									type: "time",
									id: "input-field",
									className: "form-control"
								},
							},
							buttons: {
								cancel: {
									visible: true,
									className: 'btn btn-danger'
								},
								confirm: {
									className: 'btn btn-success'
								}
							},
						}).then(
							function() {
								var hdeb = $('#input-field').val();
								$.post(base_url + 'Planning/tempsDeProduction', {
									processus: processus,
									date: date,
									poids: poids,
									machine: machine,
									heure: hdeb
								}, function(data) {
									$('.heuree').val(data.dure);
									$('.hdebe').val($('#input-field').val());
									$('.dateFIne').val(data.dateFIn);
									$('.heurefine').val(data.heurefin);
									$('#exampleModalCentere').modal("show");
								}, 'json');

							}
						);

					} else {
						alertMessage("Ooops!!", data.observation, 'error', 'btn btn-danger');
						$('.heuree').val('');
						$('.hdebe').val('');
						$('.dateFIne').val('');
						$('.heurefine').val('');
						$('.date_prode').val('');
					}

				}, 'json');
			} else {
				alertMessage("Ooops!!", "Champs 'POIDS EN KG AVEC MARGE' est obligatoire", 'error', 'btn btn-danger');
			}

		});
        

		$('.dateDeple').datepicker();



		$('.changehour').on('click', function(event) {
			event.preventDefault();
			var jobs = $(this).parent().parent().children().eq(2).text().trim();
			swal({
				text: "Choisir une action",
				type: 'warning',
				buttons: {
					confirm: {
						text: 'Déplacer une tâche',
						className: 'btn btn-success'
					},
					cancel: {
						visible: true,
						text: 'Mise en production',
						className: 'btn btn-primary'
					}
				}
			}).then((Delete) => {
				if (Delete) {
					$('.press').val(jobs);
					$(".changehourModal").modal("show");
				} else {
					$.post(base_url + 'Planning/miseEnProduction', {
						jobs: jobs
					}, function() {
						alertMessage("Succè", "Tâche mise en production", "success", "btn btn-success");

					});

				}
			});


		});

		$('.BC_STATUT').on('change', function() {
			var types = $(this).val();
			$.post(base_url + 'Planning/machineModaleTable', {
				type: types
			}, function(data) {
				$('.DJ_MACHINE').empty();
				data.forEach(element => $('.DJ_MACHINE').append("<option>" + element + "</option>"));
			}, 'json');
		});

		$.post(base_url + 'Planning/machineModaleTable', {
			type: "EXTRUSION"
		}, function(data) {
			$('.DJ_MACHINEE').empty();
			data.forEach(element => $('.DJ_MACHINEE').append("<option>" + element + "</option>"));
		}, 'json');
		$('.UpdatePlace').on('click', function(event) {
			event.preventDefault();
			var rang = $('.rang').val();
			var place = $('.press').val();
		
			$.post(base_url + 'Planning/deplaceExtrusion', {
				rang: rang,
				place: place

			}, function(data) {
				$(".changehourModal").modal("hide");
				swal("Succè", "Tâche mise à jour", {
					icon: "success",
					buttons: {
						confirm: {
							className: "btn btn-success"
						}
					},
				});
			
			});

		});

		$('.createCard').on('click', function() {
			event.preventDefault(event);
			var DEBUT = $('.DEBUTE').val();
			var DURE = $('.DUREE').val();
			var BC_PE = $('.BC_PEE').val();
			var JOB_CARD = $('.JO_IDE').val();
			var RESTE = $('.reste').val();
			var JO_DATE = $('.date_prodE').val();
			var status = "EXTRUSION";
			var JO_ID = 0;
			var hdebe = $('.hdebe').val();
			var heuree = $('.heuree').val();
			var dateFIne = $('.dateFIne').val();
			var heurefine = $('.heurefine').val();
			var heure = $('.heure').val();
			var JO_SORTIE = $('.ENPRODUCTIONE').val();
			var JO_MACHINE = $('.machineCreate option:selected').val();
			$.post(base_url + 'planning/insertJobCart', {
				JO_ID: JO_ID,
				heure: heure,
				JO_MACHINE: JO_MACHINE,
				date_prod: JO_DATE,
				JO_DATE: JO_DATE,
				hdeb: DEBUT,
				heure: DURE,
				BC_PE: BC_PE,
				hdeb: hdebe,
				heure: heuree,
				dateFIn: dateFIne,
				heurefin: heurefine,
				JOB_CARD: JOB_CARD,
				RESTE: RESTE,
				JO_SORTIE: JO_SORTIE,
				BC_STATUT: status
			}, function(data) {
				$('.DEBUTE').val("");
				$('.DUREE').val("");
				$('.BC_PEE').val("");
				$('.JO_IDE').val("");
				$('.reste').val("");
				$('.heure').val("");
				$('.date_prodE').val("");
				$('.JO_SORTIE').val("");

				$('.exampleModalCentere').modal('hide');
			}).done(function() {
				$('#exampleModalCentere').modal("hide");
				alertMessage("Succè!", "Jobs cart créé", "success", "btn btn-success");
			}).fail(function() {
				alertMessage("Erreur", "Jobs cart non créé", "error", "btn btn-danger");
			});
		});

		$('.delete').on('click', function(event) {
			event.preventDefault();
			var JO_ID = $(this).parent().parent().children().eq(2).text().trim();
			$.post(base_url + 'planning/deleteJobsEx', {
				JO_ID: JO_ID
			}, function() {

			}).done(function() {
						swal("Succè!",  "Jobs supprimer", {
							icon: "success",
							buttons: {
								confirm: {
									className: "btn btn-success"
								}
							},
					});
						
			}).fail(function() {

				wal("Erreur!",  "Jobs non supprimer", {
							icon: "error",
							buttons: {
								confirm: {
									className: "btn btn-danger"
								}
							},
					});
				
			});

		});



		$('.addProd').on('click', function(e) {
			e.preventDefault();
			$('#jobMachine').modal("show");
		});

		function lasteHeure() {
			$('.DJ_MACHINE').on('change', function() {
				var machine = $('.DJ_MACHINE option:selected').val();
				$.post(base_url + 'Planning/testHeure', {
					machine: machine
				}, function(data) {
					$('.hdeb').val(data);
				});
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

		$('.UpdateCommandeE').on('click', function(event) {
			var heure = $('.heureE').val();
			var hdeb = $('.hdebE').val();
			var dateFIn = $('.dateFInE').val();
			var heurefin = $('.heurefinE').val();
			var date_prod = $('.date_prodEE').val();
			var BC_PE = $('.BC_PEE ').val();
			var BC_STATUT = $('.BC_STATUTE option:selected').val();
			var JO_MACHINE = $('.DJ_MACHINEE option:selected').val();
			var JO_DATE = $('.date_prodEE').val();
			var JO_ID = $('.JO_IDE').val();
			var JO_SORTIE = $('.ENPRODUCTIONE').val();

			$.post(base_url + 'Planning/insertJobCart', {
				JO_SORTIE: JO_SORTIE,
				date_prod: date_prod,
				dateFIn: dateFIn,
				heurefin: heurefin,
				BC_PE: BC_PE.trim(),
				JO_DATE: JO_DATE,
				JO_MACHINE: JO_MACHINE,
				BC_STATUT: BC_STATUT,
				JO_ID: JO_ID,
				heure: heure,
				hdeb: hdeb
			}, function(data) {
				$('.heureE').val('');
				$('.hdebE').val('');
				$('.dateFInE').val('');
				$('.heurefinE').val('');
				$('.date_prodEE').val('');
				$('.BC_PEE ').val('');
				$("#jobMachine").modal("hide");
				$('.BC_QUANTITEAPRODUIREENMETRE').val();
				swal("Succè", "Job carte enregistre avec success!", {
					icon: "success",
					buttons: {
						confirm: {
							className: "btn btn-success"
						}
					},
				});
				closeDialog();
			}, 'json');
		});







		$('.BC_PEE').autocomplete({
			source: base_url + 'Planning/autocompleteBon',
			appendTo: "#jobMachine"

		});

		$.post(base_url + "Planning/lastIdJob", {}, function(data) {
			$('.JO_IDE').empty().val(data);
		});
	});
	var typese = $('.BC_STATUTE option:selected').val();
	$.post(base_url + 'Planning/machineModaleTable', {
		type: typese
	}, function(data) {
		$('.DJ_MACHINEE').empty();
		data.forEach(element => $('.DJ_MACHINE').empty().append("<option>" + element + "</option>"));
		$('.tbody-modaltable').empty();
		$('.stock_sortie').val("");
		$('.Quantite').val("");
		$('.BC_QUANTITEAPRODUIREENMETRE').val("");
		$('.BC_POISENKGSAVECMARGE').val("");
		$('.date_prod').val("");
	}, 'json');
	$('.BC_STATUTE').on('change', function() {
		var types = $(this).val();
		$.post(base_url + 'Planning/machineModaleTable', {
			type: types
		}, function(data) {
			$('.DJ_MACHINEE').empty();
			data.forEach(element => $('.DJ_MACHINEE').append("<option>" + element + "</option>"));
		}, 'json');


		$('.date_prodEE').on('change', function(event) {
			event.preventDefault();
			var date = $(this).val();
			var poids = $('.ENPRODUCTIONE').val();
			var machine = $('.DJ_MACHINEE option:selected').val();
			var processus = $('.BC_STATUTE option:selected').val();

			if (poids != "") {
				$.post(base_url + 'Planning/calculePlanning', {
					poids: poids,
					date: date,
					machine: machine,
					BC_STATUT: processus
				}, function(data) {
					if (data.message == "true") {
						$('.heureE').val(data.dure);
						$('.hdebE').val(data.hdeb);
						$('.dateFInE').val(data.dateFIn);
						$('.heurefinE').val(data.heurefin);
						$('#jobMachine').modal("show");
					} else if (data.message == "over") {
						alertMessage("Erreur!", "Date non disponible! Veuillez choisir un autre!", "error", "btn btn-danger");
						$('.heureE').val('');
						$('.hdebE').val('');
						$('.dateFIn').val('');
						$('.dateFInE').val('');
						$('.date_prodEE').val('');

					} else if (data.message == "init") {
						$('#jobMachine').modal("hide");
						swal({
							title: 'DUREE',
							html: '',
							content: {
								element: "input",
								attributes: {
									type: "time",
									id: "input-field",
									className: "form-control"
								},
							},
							buttons: {
								cancel: {
									visible: true,
									className: 'btn btn-danger'
								},
								confirm: {
									className: 'btn btn-success'
								}
							},
						}).then(
							function() {
								var hdeb = $('#input-field').val();
								$.post(base_url + 'Planning/tempsDeProduction', {
									processus: processus,
									date: date,
									poids: poids,
									machine: machine,
									heure: hdeb
								}, function(data) {
									$('.heureE').val(data.dure);
									$('.hdebE').val($('#input-field').val());
									$('.dateFInE').val(data.dateFIn);
									$('.heurefinE').val(data.heurefin);
									$('#jobMachine').modal("show");
								}, 'json');

							}
						);

					} else {
						alertMessage("Ooops!!", data.observation, 'error', 'btn btn-danger');
						$('.heureE').val('');
						$('.hdebE').val('');
						$('.dateFInE').val('');
						$('.heurefinE').val('');
						$('.date_prodEE').val('');
					}

				}, 'json');
			} else {
				alertMessage("Ooops!!", "Champs 'POIDS EN KG AVEC MARGE' est obligatoire", 'error', 'btn btn-danger');
			}

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

	});
</script>