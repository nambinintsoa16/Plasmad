       <div class="row">
			<?php $i = 1;
			 function time_to_sec($time)
				{
					list($h, $m, $s) = explode(":", $time);
					$seconds = 0;
					$seconds += (intval($h) * 3600);
					$seconds += (intval($m) * 60);
					$seconds += (intval($s));
					return $seconds;
				}
				 function se_to_time($sec)
				{
					return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
				}
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
								$this->load->model('global');
								$requette = "BC_CODE = '$data->BC_CODE' AND  LV_DATE like '$date%'";
								$dataPo = $this->global->get_data_joint_parameter_group_by("livraison_compta","commande","commande.BC_PE=livraison_compta.LV_PO",$requette,"commande.BC_CODE");
								foreach ($dataPo as $key => $dataPo) :
									$poids = 0;
									$dure = 0;
									$MAT = 150;
									$sortir = 0;
									$EI_DUREE = 0;
									$MATCOUP = 0;
									$EI_DUREECOUP = 0;
								
									$poids =   $this->global->get_sum_colum(['EX_BC_ID' => $dataPo->BC_PE],"EX_PDS_NET", "sachet_extrusion")->EX_PDS_NET;
									$dure =   $this->global->get_somme_time("EX_DUREE",['EX_BC_ID' => $dataPo->BC_PE],"sachet_extrusion")->format_heure;
								    $sortir = $this->global->get_sum_colum(['EX_BC_ID' => $dataPo->BC_PE],"EX_PDS_SOMME", "sachet_extrusion")->EX_PDS_SOMME;
										
					
									$entreInpress = 0;

									$MAT =   $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"EI_POIDS_NET", "sachet_impression")->EI_POIDS_NET;
									$EI_DUREE =   $this->global->get_somme_time("EI_DUREE",['BC_ID' => $dataPo->BC_PE],"sachet_impression")->format_heure;
								    $entreInpress = $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"EI_PDS_SOMME", "sachet_impression")->EI_PDS_SOMME;
										
									$EI_DUREECOUP = 0;
									$ED_METRAGE_SOMME = 0;
									$ED_POID_SORTIE_SOMME = 0;
									$piece = 0;
									$metrage = 0;
									$poidsSomme = 0;
								
											$poidsSomme = $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"ED_PIOD_ENTRE_SOMME", "sachet_coupe")->ED_PIOD_ENTRE_SOMME;
											$ED_POID_SORTIE_SOMME = $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"ED_PIOD_ENTRE_SOMME", "sachet_coupe")->ED_PIOD_ENTRE_SOMME;
											$EI_DUREECOUP =$this->global->get_somme_time("ED_DURE",['BC_ID' => $dataPo->BC_PE],"sachet_coupe")->format_heure;
											$ED_METRAGE_SOMME += $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"ED_METRAGE_SOMME", "sachet_coupe")->ED_METRAGE_SOMME;
											$piece = $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"ED_1ER_CHOIX_SOMME", "sachet_coupe")->ED_1ER_CHOIX_SOMME;
											$metrage = $this->global->get_sum_colum(['BC_ID' => $dataPo->BC_PE],"ED_METRAGE_SOMME", "sachet_coupe")->ED_METRAGE_SOMME; 
									
				
									$control = $this->controle_qualite->get_detail_controle_qualite("C_PO ='$dataPo->BC_PE' ORDER BY C_ID DESC");
									if ($control) {
										$piece = 0;
										$piece = $control->C_CHOIX;
									}
									$matierinression = $this->matiere_impression_use->get_matiere_impression_use(['MI_PO' => $dataPo->BC_PE]);
									$matier = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DESTINATAIRE" => $dataPo->BC_PE]);
									$totalSortie = 0;
									$prixTotal = 0;
									foreach ($matier as $matier) {
										$totalSortie += $matier->SM_QUANTITE;
										$prixTotal += (float)$matier->SM_VALEUR * $matier->SM_QUANTITE;
									}
									$pu = 0;
									if ($totalSortie != 0) {
										//$pu = ($prixTotal * $poids ) / $totalSortie;
										$pu = $prixTotal /  $totalSortie;
									}
									$pux = $pu * $poids;
                                
									$pxMatIpp = $pux + ((time_to_sec($dure) * 3.08) / 3600) + (((time_to_sec($dure) * 2) * 0.49) / 3600);

									$exdure = (time_to_sec($dure) * 3.08) / 3600;
									$hdue = (time_to_sec($dure) *  0.49) / 3600;
									$piodsover = $poids * 0.403;
							
									if ($dataPo->BC_TYPE == "SS") {
										$coupe = ((time_to_sec($EI_DUREECOUP)) * 0.510) / 3600;
									} else if ($dataPo->BC_TYPE == "BS") {
										$coupe = ((time_to_sec($EI_DUREECOUP)) * 0.510) / 3600;
									} else {
										$coupe = ((time_to_sec($EI_DUREECOUP)) * 0.510) / 3600;
									}

									$imp = ($EI_DUREE * 2.84) / 3600;
									$HModIMP = (($EI_DUREE * 2) *  0.440) / 3600;

									$hcoupe = (time_to_sec($EI_DUREECOUP) * 0.260) / 3600;
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
<script>
	$(document).ready(function () {
		$('.dataTable').dataTable();
		$('.numpos').autocomplete({
			source: base_url + "commercial/autocomplet_commande",
			appendTo: "#modaleLivre",
			select: function(ui, iteme) {
				var param = iteme.item.value.trim();
				/*$.post(base_url+"Comptabilite/dataCoupe",{param:param},function(data){
						$('.dataConfim').empty().append(data);	   
				},'json');*/
			}
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
		

	});
</script>