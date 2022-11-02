<p>
	<div class="row">
		<div class="form-control text-left col-md-12 w-100">
			<div class="row">
				<div class="col-md-2">
					<a href="#" class="btn btn-warning btn-sm liknk" id="extrusion"><i
							class="fa fa-plus"></i>&nbsp;EXTRUSION</a>
				</div>
				<div class="col-md-10 text-rigth">
					<div class="row">
						<div class="col-md-3">
							<select class="form-control form-control-sm quartExtrusion">
								<option value="J">Jour</option>
								<option value="N">Nuit</option>
							</select>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control w-100 form-control-sm po poexc"
								placeholder="N°PO">
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control w-100 form-control-sm opextrusion operateurs"
								placeholder="CHEF D'EQUIPE">
						</div>
						
						<div class="col-md-3">
							<input type="text" class="form-control w-100 form-control-sm machineextrusion match"
								placeholder="MACHINE">
						</div>

						<div class="col-md-4 mt-2">
							<input type="date" class="form-control w-100 form-control-sm exinpdatedebut">
						</div>
						<div class="col-md-4 mt-2">
							<input type="date" class="form-control w-100 form-control-sm exinpdate">
						</div>
						<div class="col-md-4 mt-2">
							<a href="#" class="btn btn-info btn-sm  exbtndate"><i class="fa fa-tv"></i>&nbsp;
								Afficher</a>
							<a href="" class="btn btn-primary btn-sm exportExtrusion "> <i class="fa fa-download">
								</i>&nbsp;Exporter</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</p>
<table class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableOperateurEX"
	style="font-size: 13px!important;" id="EXTRUSION">
	<thead class="bg-dark text-white text-center text-xm">
		<tr>
			<th>DATE</th>
			<th>PO</th>
			<th>METRE</th>
			<th>POIDS (Kg)</th>
			<th>DECHETS</th>
			<th>POIDS NET</th>
			<th>DUREE</th>
			<th>QUART</th>
			<th>N°MACHINE</th>
			<th>N°RLX</th>
			<th>NB ROULAUX</th>
			<th>TAILLE</th>
			<th>CHEF D'EQUIPE</th>
			<th>OPERATEUR 1</th>
			<th>OPERATEUR 2</th>
			<th>OBSERVATION 1</th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<p>
	<div class="form-control text-left col-md-12 w-100">
		<div class="row">
			<div class="col-md-2">
				<a href="#" class="btn btn-warning btn-sm liknk" id="exinpression"><i
						class="fa fa-plus"></i>&nbsp;IMPRESSION</a>
			</div>

			<div class="col-md-10 text-rigth">
				<div class="row">

					<div class="col-md-3">
						<select class="form-control form-control-sm quartExtrusionImpressio">
							<option></option>
							<option value="J">Jour</option>
							<option value="N">Nuit</option>
						</select>
					</div>
					
					<div class="col-md-3">
							<input type="text" class="form-control w-100 form-control-sm poimpr poexc"
								placeholder="N°PO">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control w-100 form-control-sm opImpression operateurs"
							placeholder="CHEF D'EQUIPE">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control w-100 form-control-sm machineImpression match"
							placeholder="MACHINE">
					</div>
					<div class="col-md-4  mt-2">
						<input type="date" class="form-control w-100 form-control-sm eximpredatedebut">
					</div>
					<div class="col-md-4  mt-2">
						<input type="date" class="form-control w-100 form-control-sm eximpredate">
					</div>
					<div class="col-md-4 mt-2 text-rigth">
						<a href="#" class="btn btn-info btn-sm  eximpreBtnredate"><i class="fa fa-tv"></i>&nbsp;
							Afficher</a>
						<a href="" class="btn btn-primary btn-sm  exportImpression "> <i class="fa fa-download">
							</i>&nbsp;Exporter</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</p>
<table
	class="text-xm table-bordered table-sm  table-responsive table-hover w-100 table-strepted TableOperateurINPRESS table-modif">
	<thead class="bg-dark text-white text-center text-xm">
		<tr>
			<th>DATE</th>
			<th>PO</th>
			<th>METRAGE</th>
			<th>POIDS</th>
			<th>DECHET</th>
			<th>POIDS NET</th>
			<th>DUREE</th>
			<th>EQUIPE</th>
			<th>OPERATEUR 1</th>
			<th>OPERATEUR 2</th>
			<th>QTIME</th>
			<th>N°MACHINE</th>
			<th>TAILLE</th>
			<th>RESTE GAINE</th>
			<th>N°RLX</th>
			<th>OBSERVATION</th>
			<th></th>
			<th> </th>
			<th> </th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<p>
	<div class="form-control text-left col-md-12 w-100">
		<div class="row">
			<div class="col-md-2">
				<a href="#" class="btn btn-warning btn-sm liknk" id="excoupe"><i class="fa fa-plus"></i>&nbsp;COUPE</a>
			</div>
			<div class="col-md-10 text-rigth">
				<div class="row">
					<div class="col-md-3">
						<select class="form-control form-control-sm QuartExtrusionCoupe">
							<option value="J">Jour</option>
							<option value="N">Nuit</option>
						</select>
					</div>
					<div class="col-md-3">
							<input type="text" class="form-control w-100 form-control-sm pocoupe poexc"
								placeholder="N°PO">
						</div>
					<div class="col-md-3">
						<input type="text" class="form-control w-100 form-control-sm opCoupe operateurs"
							placeholder="CHEF D'EQUIPE">
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control w-100 form-control-sm machineCoupe match"
							placeholder="MACHINE">
					</div>
					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm coupeInputdebut">
					</div>
					<div class="col-md-4 mt-2">
						<input type="date" class="form-control w-100 form-control-sm coupeInput">
					</div>
					<div class="col-md-4 mt-2">
						<a href="#" class="btn btn-info btn-sm  coupebtndata"><i class="fa fa-tv"></i>&nbsp;
							Afficher</a>
						<a href="" class="btn btn-primary btn-sm exportCoupe"> <i class="fa fa-download">
							</i>&nbsp;Exporter</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</p>

<table
	class="text-xm table-bordered table-sm table-responsive table-hover w-100 table-strepted TableDecoupeEX table-modif">
	<thead class="bg-dark text-white text-center text-xm">
		<tr>
			<th>DATE</th>
			<th>PO</th>
			<th>N°RLX</th>
			<th>DURE</th>
			<th>METRAGE</th>
			<th>POIDS ENTREE</th>
			<th>1ER CHOIX</th>
			<th>POIDS SORTIE</th>
			<th>2E CHOIX</th>
			<th>DECHET</th>
			<th>GAINE TIRE</th>
			<th>EQUIPE</th>
			<th>OPERATEUR 1</th>
			<th>OPERATEUR 2</th>
			<th>OPERATEUR 3</th>
			<th>QC</th>
			<th>TAILLE</th>
			<th>QUART</th>
			<th>MACHINE</th>
			<th>RESTE GAINE</th>
			<th>OBSERVATION 1</th>
			<th>OBSERVATION 2</th>
			<th></th>
			<th> </th>

		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<script>
	$(document).ready(function() {
		$('.operateurs').autocomplete({
			source: base_url + "Production/autocompleteOperateurs",
		});
		$('.save').on('click', function() {
			var url = $('form').attr('id');
			if (url == "exinpression") {
				$('.tbodyMatt tr').each(function() {
					var reference = $(this).children().first().text();
					var quantite = $(this).children().first().next().text();
					var prix = $(this).children().first().next().next().text();
					var po = $('.poex').val();
					$.post(base_url + 'Production/saveEncre', {
						reference: reference,
						quantite: quantite,
						po: po,
						prix: prix
					}, function(data) {});
				});
				$('.tbodyMatt').empty();
			}
		});
		$('.liknk').on('click', function(event) {
			event.preventDefault();
			$('#ModalTitles').text($(this).text());
			var param = $(this).attr('id');
			$.post(base_url + 'Production/formulaires', {
				param: param
			}, function(data, textStatus, xhr) {
				if (data != false) {
					$('.form').attr('action', param);
					$('.form').attr('id', param);
					$('.body-content').empty().append(data);
					$('.poex').autocomplete({
						source: base_url + "Production/autocompletPo",
						appendTo: "#modalProccess"
					});
					$('.op').autocomplete({
						source: base_url + "Production/autocompleteOperateurs",
						appendTo: "#modalProccess"
					});
					$('#modalProccess').modal('show');
				} else {
					alertMessage('', 'Page introuvable, veuillez réessayer!', 'error',
						'btn btn-danger');
				}
			});
		});
		var TableDecoupeEX = $('.TableDecoupeEX').DataTable({
			processing: true,
			ajax: base_url + 'Production/exdecoupe',
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			rowCallback: function(row, data) {
				coupefunction();
			},
			"drawCallback": function(settings) {
				coupefunction();
			},
			initComplete: function(setting) {
				coupefunction();
				/*$('.tbody-TableOperateurEX td').on('click', function(event) {
					event.preventDefault();
					var $parent = $(this).parent().parent().attr('class').split(" ");
					//var type = $parent.text();
					var $type = $parent[1];
					$.post(base_url + 'Production/formulaire', {
						type: $type
					}, function(data, textStatus, xhr) {
						$('#exampleModalCenter .modal-body').empty().append(data);
						$('#exampleModalCenter').modal('show');
					});

				});*/
			}
		});
		var TableOperateurINPRESS = $('.TableOperateurINPRESS').DataTable({
			processing: true,
			ajax: base_url + 'Production/extrusioninpression',
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"rowCallback": function(row, data) {
				imprefunction();
			},
			"drawCallback": function(settings) {
				imprefunction();
			},
			"initComplete": function(setting) {
				imprefunction();
				$('.tbody-TableOperateurEX td').on('click', function(event) {
					event.preventDefault();
					var $parent = $(this).parent().parent().attr('class').split(" ");
					//var type = $parent.text();
					var $type = $parent[1];
					$.post(base_url + 'Production/formulaire', {
						type: $type
					}, function(data, textStatus, xhr) {
						$('#exampleModalCenter .modal-body').empty().append(data);
						$('#exampleModalCenter').modal('show');
					});
				});
			}
		});
		tableEX = $('.TableOperateurEX').DataTable({
			processing: true,
			ajax: base_url + 'Production/tableEX',
			language: {
				url: base_url + "assets/dataTableFr/french.json"
			},
			"rowCallback": function(row, data) {
				exfunction();
			},
			"drawCallback": function(settings) {
				exfunction();
			},
			"initComplete": function(setting) {
				exfunction();
				/* $('.tbody-TableOperateurEX td').on('click',function(event) {
					event.preventDefault();	
					var $parent=$(this).parent().parent().attr('class').split(" ");
					//var type = $parent.text();
					var $type =  $parent[1];
					$.post(base_url+'Production/formulaire', {type: $type}, function(data, textStatus, xhr) {
						 $('#exampleModalCenter .modal-body').empty().append(data);
						 $('#exampleModalCenter').modal('show');
					});
					 
				   });*/
			}
		});

		$('.poexc').autocomplete({
			   source : base_url + "Production/autocompletPo",
			  
		   });
		$('.exbtndate').on('click', function(e) {
			e.preventDefault();
			var date = $('.exinpdate').val();
			var machine = $('.machineextrusion').val();
			var operateurs = $('.opextrusion').val();
			var quartExtrusion = $('.quartExtrusion option:selected').val();
			var exinpdatedebut = $('.exinpdatedebut').val();
			var po = $('.po').val();
			var link = base_url + 'Production/tableEX?date=' + date + '&machine=' + machine +
				"&operateurs=" + operateurs + "&debut=" + exinpdatedebut + "&quart=" + quartExtrusion+"&po="+po;
			$('.exportExtrusion').attr('href', base_url + "Production/exportExtrusion?date=" + date +
				'&machine=' + machine + "&operateurs=" + operateurs + "&debut=" + exinpdatedebut +
				"&quart=" + quartExtrusion+"&po="+po);
			tableEX.ajax.url(link);
			tableEX.ajax.reload();
		});
		$('.eximpreBtnredate').on('click', function(e) {
			e.preventDefault();
			var date = $('.eximpredate').val();
			var machine = $('.machineImpression').val();
			var operateurs = $('.opImpression').val();
			var quartExtrusionImpressio = $('.quartExtrusionImpressio option:selected').val();
			var eximpredatedebut = $('.eximpredatedebut').val();
			var po = $('.poimpr').val();
			var link = base_url + 'Production/extrusioninpression?date=' + date + "&machine=" + machine +
				"&operateurs=" + operateurs + "&debut=" + eximpredatedebut + "&quart=" +
				quartExtrusionImpressio+"&po="+po;
			$('.exportImpression').attr('href', base_url + "Production/exportImpression?date=" + date +
				'&machine=' + machine + "&operateurs=" + operateurs + "&debut=" + eximpredatedebut +
				"&quart=" + quartExtrusionImpressio+"&po="+po);
			TableOperateurINPRESS.ajax.url(link);
			TableOperateurINPRESS.ajax.reload();
		});
		$('.coupebtndata').on('click', function(e) {
			e.preventDefault();
			var date = $('.coupeInput').val();
			var machine = $('.machineCoupe').val();
			var operateurs = $('.opCoupe').val();
			var QuartExtrusionCoupe = $('.QuartExtrusionCoupe option:selected').val();
			var coupeInputdebut = $('.coupeInputdebut').val();
			var po = $('.pocoupe').val();
			var link = base_url + 'Production/exdecoupe?date=' + date + '&machine=' + machine +
				"&operateurs=" + operateurs + "&debut=" + coupeInputdebut + "&quart=" +
				QuartExtrusionCoupe+"&po="+po;;
			$('.exportCoupe').attr('href', base_url + "Production/exportCoupe?date=" + date + '&machine=' +
				machine + "&operateurs=" + operateurs + "&debut=" + coupeInputdebut + "&quart=" +
				QuartExtrusionCoupe+"&po="+po);
			TableDecoupeEX.ajax.url(link);
			TableDecoupeEX.ajax.reload();
		});

		function exfunction() {
			$('.deleteExtrusion').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				$.post(base_url + "Production/deleteExtrusion", {
					id: id
				}, function($data) {});
			});
			$('.editExtrusion').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				var param = "extrusion";
				$.post(base_url + 'Production/tableEXRow', {
					id: id
				}, function(datas) {
					$.post(base_url + 'Production/formulaires', {
						param: param
					}, function(data, textStatus, xhr) {
						if (data != false) {
							$('.form').attr('action', "update" + param);
							$('.form').attr('id', param);
							$('.body-content').empty().append(data);
							$('.poex').autocomplete({
								source: base_url + "Production/autocompletPo",
								appendTo: "#modalProccess"
							});
							$('.op').autocomplete({
								source: base_url +
									"Production/autocompleteOperateurs",
								appendTo: "#modalProccess"
							});
							$('#modalProccess').modal('show');
							$('.EX_DATE').val(datas.EX_DATE)
							$('.EX_BC_ID').val(datas.EX_ID);
							$('.EX_METRE').val(datas.EX_METRE);
							$('.EX_PDS_BRUT').val(datas.EX_PDS_BRUT);
							$('.EX_DECHETS').val(datas.EX_DECHETS);
							var heure = datas.EX_HEURE.split("-");
							$('.EX_DEBUT').val(heure[0]);
							$('.EX_FIN').val(heure[1]);
							$('.EX_QAURT').val(datas.EX_QAURT);
							$('.EX_N_MACH').val(datas.EX_N_MACH);
							$('.EX_Nbre_rlx').val(datas.EX_Nbre_rlx);
							$('.EX_TAILL').val(datas.EX_TAILL);
							$('.EX_EQUIP').val(datas.EX_EQUIP);
							$('.EX_OPERETEUR_1').val(datas.EX_OPERETEUR_1);
							$('.EX_OPERETEUR_2').val(datas.EX_OPERETEUR_2);
							$('.EX_OBS').val(datas.EX_OBSERVATION1);
						} else {
							alertMessage('', 'Page introuvable, veuillez réessayer!',
								'error', 'btn btn-danger');
						}
					});
				}, 'json');
			});
		}
		$('.match').autocomplete({
			source: base_url + "Production/autocompletMaChine",
		});

		function coupefunction() {
			$('.deletecoupe').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				$.post(base_url + "Production/deleteEcooupe", {
					id: id
				}, function($data) {});
			});
			$('.editcoupe').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				var param = "excoupe";
				$.post(base_url + 'Production/editCoupeEx', {
					id: id
				}, function(data) {
					if (data != false) {
						$('.form').attr('action', "update" + param);
						$('.form').attr('id', param);
						$('.body-content').empty().append(data);
						$('.poex').autocomplete({
							source: base_url + "Production/autocompletPo",
							appendTo: "#modalProccess"
						});
						$('.op').autocomplete({
							source: base_url + "Production/autocompleteOperateurs",
							appendTo: "#modalProccess"
						});
						$('#modalProccess').modal('show');
					} else {
						alertMessage('', 'Page introuvable, veuillez réessayer!', 'error',
							'btn btn-danger');
					}
				}, 'json');
			});
		}

		function imprefunction() {
			$('.deleteImprim').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				$.post(base_url + "Production/deleteImprime", {
					id: id
				}, function($data) {});
			});
			$('.editMatier').on('click', function() {
				event.preventDefault();
				event.preventDefault();
				var id = $(this).attr('id');
				var param = "exinpressionMatier";
				$.post(base_url + 'Production/editImprimermatier', {
					id: id
				}, function(data) {
					if (data != false) {
						$('.form').attr('action', "update" + param);
						$('.form').attr('id', param);
						$('.body-content').empty().append(data);
						$('.poex').autocomplete({
							source: base_url + "Production/autocompletPo",
							appendTo: "#modalProccess"
						});
						$('.op').autocomplete({
							source: base_url + "Production/autocompleteOperateurs",
							appendTo: "#modalProccess"
						});
						$('#modalProccess').modal('show');
					} else {
						alertMessage('', 'Page introuvable, veuillez réessayer!', 'error',
							'btn btn-danger');
					}
				}, 'json');
			});
			$('.editExImprim').on('click', function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				var param = "exinpression";
				$.post(base_url + 'Production/editImprimer', {
					id: id
				}, function(data) {
					if (data != false) {
						$('.form').attr('action', "update" + param);
						$('.form').attr('id', param);
						$('.body-content').empty().append(data);
						$('.poex').autocomplete({
							source: base_url + "Production/autocompletPo",
							appendTo: "#modalProccess"
						});
						$('.op').autocomplete({
							source: base_url + "Production/autocompleteOperateurs",
							appendTo: "#modalProccess"
						});
						$('#modalProccess').modal('show');
					} else {
						alertMessage('', 'Page introuvable, veuillez réessayer!', 'error',
							'btn btn-danger');
					}
				}, 'json');
			});
		}

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
			var htmls =
				'<div class="text-center" style="font-size:14px;"><span class="text-center">Traitement en cours ...</span></div><div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
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
