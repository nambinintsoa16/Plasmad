<div class="card">
	<div class="card-header bg-dark text-white">
		<b>RECAP COSTING</b>
		<b class="pull-right ml-2"><button type="submit" class="btn btn-sm btn-success modale"><i class="fa fa-plus"></i>
				LIVRE</button></b>
		<b class="pull-right">
			<form action="" method="post">
				<label>CLIENT : </label>
				<input type="text" class="mr-3 client" name="date">
				<label>DATE : </label>
				<input type="date" class="mr-3 dateCost" name="date">
				<button type="submit" class="btn btn-sm btn-primary AfficherCost"><i class="fa fa-tv"></i>
					Afficher</button>
			</form>
		</b>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 p-0">
				<form class="form w-100 " method="POST">
					<div class="row">
						<div class="form-group col-md-6 text-right">
							<input type="file" name="file" class="form-control file">
						</div>
						<div class="form-group col-md-2 text-right">
							<button type="submit" class="btn btn-success">IMPORTER</button>
						</div>
					</div>
				</form>
			</div>
			<hr />
			<?php $i = 1;

			foreach ($data as $data) : ?>
				<div class="col-md-12">
					<table class="table-strepted tableProduitFini table-bordered p-0 w-100">
						<thead>
							<tr class="bg-primary text-white">
								<td colspan="17"><?= $data->BC_CODE ?></td>
								<td style="width: 50px; text-align: center;">
									<a href="#" class="collapsed text-white" data-toggle="collapse" data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
								</td>
							</tr>
						</thead>
					</table>
				</div>
				<div class="col-md-12">
					<div class=" mt-2" id="tab_<?= $i ?>" style="padding: 0px;">
						<table class=" table-strepted tableProduitFini table-bordered p-0 w-100">
							<thead class="text-center">
								<tr>
									<th colspan="7"></th>
									<th colspan="3" class="text-danger">FACTURES DEF</th>
									<th colspan="2" class="text-info">COSTING REEL</th>
									<th colspan="2" class="text-success">MARGES</th>


								</tr>
								<tr>
									<th style="width: 80px!important;">Date</th>
									<th style="width: 80px!important;">N° pièce</th>
									<th style="width: 100px!important;">Tiers</th>
									<th style="width: 100px!important;">Articles</th>
									<th style="width: 100px!important;">Famille</th>
									<th style="width: 250px!important;">Désignation </th>
									<th style="width: 70px!important;">Qtés</th>
									<th class="text-danger">P.U DEVISE </th>
									<th class="text-danger">Devise </th>
									<th class="text-danger">MONTANT HT </th>
									<th class="text-info">P.U DEVISE</th>
									<th class="text-info">MONTANT HT </th>
									<th class="text-success">EN VALEUR </th>
									<th class="text-success">EN %GE </th>

								</tr>
							</thead>
							<tbody>
								<?php
								$this->load->model('compta_model');
								$dataPo = $this->compta_model->listeLivraison("BC_CODE = '$data->BC_CODE' AND  LV_DATE like '$date%'");
								foreach ($dataPo as $key => $dataPo) :

									$dextrusion =  $this->compta_model->extrusion(['EX_BC_ID' => $dataPo->BC_PE]);
									$extrusion_inpression = $this->compta_model->extrusion_inpression(['extrusion_inpression.BC_ID' => $dataPo->BC_PE]);
									$poid = $dextrusion;
									$poids = 0;
									$dure = 0;
									$MAT = 150;
									$sortir = 0;
									$EI_DUREE = 0;
									$MATCOUP = 0;
									$EI_DUREECOUP = 0;
									foreach ($poid as $key => $poid) {
										if ($poid->EX_PDS_SOMME != "") {
											$poids += $poid->EX_PDS_NET;
											$dure +=  $this->compta_model->time_to_sec($poid->EX_DUREE);
											$sortir += $poid->EX_PDS_SOMME;
										}
									}
									$entreInpress = 0;
									if ($extrusion_inpression) {
										foreach ($extrusion_inpression as $key => $extrusion_inpression) {
											$MAT +=  $extrusion_inpression->EI_POIDS_NET;
											$EI_DUREE += $this->compta_model->time_to_sec($extrusion_inpression->EI_DUREE);
											$entreInpress += $extrusion_inpression->EI_PDS_SOMME;
										}
									}
									$extrusion_coupe = $this->compta_model->extrusion_coupe(['extrusion_coupe.BC_ID' => $dataPo->BC_PE]);
									$EI_DUREECOUP = 0;
									$ED_METRAGE_SOMME = 0;
									$ED_POID_SORTIE_SOMME = 0;
									$piece = 0;
									$metrage = 0;
									$poidsSomme = 0;
									if ($extrusion_coupe) {
										foreach ($extrusion_coupe as $key => $extrusion_coupe) {
											//	$MATCOUP +=  $extrusion_coupe->EI_POIDS_NET;
											//$sortirCoup += $extrusion_coupe->ED_POID_SORTIE_SOMME;
											$poientre = "";
											$poientre = explode("+", $extrusion_coupe->ED_POID_ENTRE);
											foreach ($poientre as $key => $poientre) {
												$poidsSomme += (float)$poientre;
											}
											$ED_POID_SORTIE_SOMME  +=  $extrusion_coupe->ED_POID_SORTIE_SOMME;
											$EI_DUREECOUP += $this->compta_model->time_to_sec($extrusion_coupe->ED_DURE);
											$ED_METRAGE_SOMME +=  $extrusion_coupe->ED_METRAGE_SOMME;
											$piece += $extrusion_coupe->ED_1ER_CHOIX_SOMME;
											$metrage += $extrusion_coupe->ED_METRAGE_SOMME;
										}
									}

									$this->load->model('compta_model');
									$control = $this->compta_model->controlData("C_PO ='$dataPo->BC_PE' ORDER BY C_ID DESC");
									if ($control) {
										$piece = 0;
										$piece = $control->C_CHOIX;
									}
									$matierinression = $this->compta_model->matierinression(['MI_PO' => $dataPo->BC_PE]);
									$matier = $this->compta_model->stock_materiel(["LI_REFERENCE" => $dataPo->BC_PE, "LI_TYPE" => "sortie"]);
									$totalSortie = 0;
									$prixTotal = 0;
									foreach ($matier as $matier) {
										$totalSortie += $matier->LI_QUANTITE;
										$prixTotal += $matier->LI_VALEUR * $matier->LI_QUANTITE;
									}
									$pu = 0;
									if ($totalSortie != 0) {
										//$pu = ($prixTotal * $poids ) / $totalSortie;
										$pu = $prixTotal /  $totalSortie;
									}
									$pux = $pu * $poids;

									$pxMatIpp = $pux + (($dure * 3.08) / 3600) + ((($dure * 2) * 0.49) / 3600);
									$exdure = ($dure * 3.08) / 3600;
									$hdue = ($dure *  0.49) / 3600;
									$piodsover = $poids * 0.403;

									if ($dataPo->BC_TYPE == "SS") {
										$coupe = (($EI_DUREECOUP) * 0.510) / 3600;
									} else if ($dataPo->BC_TYPE == "BS") {
										$coupe = (($EI_DUREECOUP) * 0.510) / 3600;
									} else {
										$coupe = (($EI_DUREECOUP) * 0.510) / 3600;
									}

									$imp = ($EI_DUREE * 2.84) / 3600;
									$HModIMP = (($EI_DUREE * 2) *  0.440) / 3600;

									$hcoupe = ($EI_DUREECOUP * 0.260) / 3600;
									$sommeex =  $piodsover + $pux + $exdure +  $hdue;
									$toto = 0;
									if ($poids != 0) {

										$toto = number_format($sommeex / $poids, "3");
									}
									$sommeMat = 0;
									$varmatiers = $matierinression;
									foreach ($varmatiers  as $varmatiers) {
										$sommeMat += ($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE);
									}

									$totaMatIpp = $entreInpress * $toto;
									$prixImPrixtotal = $HModIMP + $imp + $totaMatIpp + $sommeMat;

									$siValeur = 0;
									$po = 0;
									$sommeMat = 0;
									if ($matierinression) {
										$tab = array();
										foreach ($matierinression  as $matierinression) {
											if (array_key_exists($matierinression->MI_DESIGNATION, $tab)) {
												$tab[$matierinression->MI_DESIGNATION]["QUANTITE"] += $matierinression->MI_QUANTITE;
											} else {
												$tab[$matierinression->MI_DESIGNATION]["QUANTITE"] = $matierinression->MI_QUANTITE;
												$tab[$matierinression->MI_DESIGNATION]["PRIX"] = $matierinression->MI_PRIX;
											}
										}
									}


									if ($poids == 0) {
										$prixstempsex = 0;
									} else {
										$prixstempsex = $sommeex / $poids;
									}




									if ($entreInpress != 0) {
										$prixstempsImp  = $prixImPrixtotal / $entreInpress;
										$poidsSomme = $poidsSomme * ($prixImPrixtotal / $entreInpress);
									} else {

										if ($poids == 0) {
											$prixstempsImp  =  0;
										} else {
											$prixstempsImp = $sommeex / $poids;
											$poidsSomme = $poidsSomme * ($sommeex / $poids);
										}
									}


									$totalCops = $siValeur + $coupe + $hcoupe + $poidsSomme;
									if ($totalCops != 0) {
										$prixstempsCoupe = $totalCops / $piece;
									} else {
										$prixstempsCoupe = 0;
									}
									if ($prixstempsCoupe != 0) {
										$prixs = $prixstempsCoupe;
									} else if ($prixstempsImp != 0) {
										$prixs = $prixstempsImp;
									} else {
										$prixs = $prixstempsex;
									}
								?>
									<tr>
										<td><?= $dataPo->BC_DATELIVRE ?></td>
										<td></td>
										<td><?= $dataPo->BC_CODE ?></td>
										<td><?= $dataPo->BC_PE ?></td>
										<td><?= $dataPo->BC_TYPEPRODUIT . $dataPo->BC_TYPEMATIER ?></td>
										<td><?= $dataPo->BC_TYPEPRODUIT . " " . $dataPo->BC_DIMENSION ?></td>
										<td><?php
											$qtt = explode(" ", $dataPo->BC_QUNTITE);
											echo  $qtt[0] ?></td>
										<td><?php
											$prix = explode(" ", $dataPo->BC_PRIX);
											echo  $prix[0];
											?></td>
										<td>USD</td>
										<td><?php
											echo $mg = $prix[0] * $qtt[0];

											?></td>
										<td><?= number_format($prixs, 4) ?></td>
										<td><?php
											$monta = $prixs * $qtt[0];
											echo number_format($prixs * $qtt[0], 4);
											?></td>
										<td><?php
											$montax = $mg - $monta;
											echo number_format($montax, 4);

											?></td>
										<td><?php
											if ($mg != 0) {
												echo number_format(($montax * 100 / $mg), 2);
											} else {
												echo 0;
											}

											?> %</td>

									</tr>

								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
		</div>

	</div>



<?php $i++;
			endforeach; ?>

</div>
</div>
</div>






<div class="modal fade" id="modaleLivre" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<fieldset class="border p-2">
					<div class="row">
						<div class="form-group  col-md-5">
							<input type="text" class="form-control form-control-sm numpos" name="" placeholder="N°PO">
						</div>
						<div class="form-group  col-md-5">
							<input type="text" class="form-control form-control-sm clientPo" name="" placeholder="CODE CLIENT">
						</div>
						<div class="form-group col-md-2">
							<button type="submit" class="btn btn-sm btn-primary afficheSortie"><i class="fa fa-tv"></i>
								Afficher</button>
						</div>
					</div>
				</fieldset>
				<fieldset class="border p-2 mt-2">
					<table class="table-strepted table-bordered w-100 datatable">
						<thead class="bg-dark text-white">
							<tr>
								<th>Tiers</th>
								<th>Articles</th>
								<th>Famille</th>
								<th>Désignation </th>
								<th>Qtés</th>
								<th>P.U DEVISE </th>
								<th></th>
							</tr>
						</thead>
						<tbody class="dataConfim">

						</tbody>
					</table>
				</fieldset>
			</div>

		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.AfficherCost').on('click', function(e) {
			e.preventDefault();
			var date = $('.dateCost').val();
			var client = $('.client').val();
			chargement();
			$.post(base_url + "Comptabilite/page", {
				date: date,
				client: client,
				page: "RECAP COSTING"
			}, function(data) {
				$('.main').empty().append(data);
				closeDialog();
			});
		});
		$(".modale").on('click', function(e) {
			e.preventDefault();
			$('#modaleLivre').modal("show");

		});
		$('.dataTable').dataTable();
		$('.numpos').autocomplete({
			source: base_url + "Production/autocompletPo",
			appendTo: "#modaleLivre",
			select: function(ui, iteme) {
				var param = iteme.item.value.trim();
				/*$.post(base_url+"Comptabilite/dataCoupe",{param:param},function(data){
						$('.dataConfim').empty().append(data);	   
				},'json');*/
			}
		});


		$('.client').autocomplete({
			source: base_url + "Comptabilite/autocompletClient",
		});
		$('.clientPo').autocomplete({
			source: base_url + "Comptabilite/autocompletClient",
			appendTo: "#modaleLivre",
		});

		$('.afficheSortie').on('click', function(e) {
			e.preventDefault();
			var numpos = $('.numpos').val();
			var clientPo = $('.clientPo').val();
			chargement();
			$.post(base_url + "Comptabilite/detailLivre", {
				numpos: numpos,
				clientPo: clientPo
			}, function(data) {
				if (data.reponse == "false") {
					closeDialog();
					swal("Erreur! ", "Une c'est produit veuillez recommencer", {
						icon: "error",
						buttons: {
							confirm: {
								className: 'btn btn-danger'
							}
						},
					});
				} else {
					closeDialog();
					$('.dataConfim').empty().append(data.data);
					editLivre();
				}

			}, 'json');

		});

		function editLivre() {
			$('.editlivre').on('click', function(e) {
				e.preventDefault();
				var numpos = $('.numpos').val();
				var clientPo = $('.clientPo').val();
				var po = $(this).attr('id');
				$('#modaleLivre').modal("hide");
				swal({
					title: 'Date de livraison',
					html: '',
					content: {
						element: "input",
						attributes: {
							type: "date",
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
						var date = $('#input-field').val();
						swal({
							title: 'bon',
							html: '',
							content: {
								element: "input",
								attributes: {
									type: "text",
									id: "input-fieldbo",
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
								var bon = $('#input-fieldbo').val();
								$.post(base_url + 'Comptabilite/livrePo', {
									po: po,
									date,
									bon: bon
								}, function(data) {
									$.post(base_url + "Comptabilite/detailLivre", {
										numpos: numpos,
										clientPo: clientPo
									}, function(data) {
										$('.dataConfim').empty().append(data.data);
										editLivre();
									}, 'json');
									$('#modaleLivre').modal("show");
								}, 'json');

							}
						);

					});

















			});
		}



		$('form').on('submit', function(event) {
            event.preventDefault();
            var fd = new FormData();
            var files = $('.file')[0].files[0];
            fd.append('file', files);
            chargement();
            $.ajax({

                url: base_url + 'Comptabilite/update_recap',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
					closeDialog();
                    if (response != 0) {
                        swal("Erreur ", "Veuillez réessayer!", {
                            icon: "error",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            },
                        });
                    } else {
                        //table.ajax.reload();
                        closeDialog();

                    }
                },
                error: function(data) {
                    swal("Erreur ", "Veuillez réessayer!", {
                        icon: "error",
                        buttons: {
                            confirm: {
                                className: 'btn btn-danger'
                            }
                        },
                    });
                }

            });
        });










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