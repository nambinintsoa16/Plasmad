<?php $i = 1;
$this->load->model('global');
$this->load->model("sortie_matiere_premiere");
$this->load->model("matiere_impression_use");
$this->load->model("sachet_impression");
$this->load->model("sachet_extrusion");
$this->load->model("controle_qualite");
$this->load->model("prix_commande");
$this->load->model("sachet_coupe");
$this->load->model("prix_appiquer");
$this->load->model("global");
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
foreach ($data as $data) :
    $prixbon = $this->prix_commande->get_detail_prix_commande(['PB_PO' => $data->BC_PE]);
?>
    <div class="col-md-12 mt-2">
        <table class="table-strepted tableProduitFini table-bordered p-0 w-100">
            <thead>
                <tr class="bg-info text-white">
                    <td style="width: 65px!important;"><?= $data->BC_DATE ?></td>
                    <td style="width: 65px!important;"><?= $data->BC_PE ?></td>
                    <td style="width: 210px;"><?= $data->BC_TYPEPRODUIT . " " . $data->BC_DIMENSION ?></td>
                    <td style="width: 150px;">QUANTITE : <?= $data->BC_QUNTITE ?><?= $data->BC_TYPEPRODUIT == "GAINES" ? " | KGS" : " | PCS" ?></td>
                    <td style="width: 150px;">P.R.I : <?= $prixbon && $prixbon->PB_SANS_MARGE != "" ? $prixbon->PB_SANS_MARGE : 0; ?></td>
                    <td style="width: 150px;"><?= "PRIX DE VENTE: " . $data->BC_PRIX ?></td>
                    <td style="width: 50px; text-align: center;">
                    <a href="#" class="collapsed text-white" data-toggle="collapse" data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
                </td>
                </tr>
            
                    <tr class="bg-danger text-white">
                        <td><?= $data->BC_STATUT ?></td>
                        <td colspan="2">CLIENT : <?= $data->BC_CODE . "&nbsp&nbsp;" . $origin;  ?></td>
                        <td> PRIX AVEC MARGE : <?= $data->BC_PRIX ?></td>
                        <td colspan="1"> Difference: <?= $prixbon ? (floatval($data->BC_PRIX) - floatval($prixbon->PB_SANS_MARGE)) : $data->BC_PRIX; ?> </td>
                        <td colspan="1"> Marge: <?php
                        if($prixbon){
                            $prixbon->PB_SANS_MARGE != 0 ? number_format((floatval($data->BC_PRIX) - floatval($prixbon->PB_SANS_MARGE)) / floatval($prixbon->PB_SANS_MARGE) * 100, 2) . " %" : 0; 
                        }else{
                            echo 0;
                        }
                       
                         ?> </td>
                        <td class="text-center">
                            <a href="#" id="<?= $data->BC_PE ?>" class="detailProgre text-white">Détail</a>
                        </td>
                    </tr>
              
            </thead>
        </table>

    </div>
    <div class="col-md-12">
        <div class=" mt-2" id="tab_<?= $i ?>" style="padding: 0px;">
            <table class="table-strepted tableProduitFini table-bordered w-100">
                <thead class="bg-primary text-white">
                    <tr class="bg-info text-white">
                        <td colspan="5" class="text-center">EXTRUSION</td>
                        <td colspan="5" class="text-center"> IMPRESSION</td>
                        <td colspan="5" class="text-center"> COUPE </td>
                    </tr>
                    <tr class="bg-info text-white">
                        <td>DESCRIPTION</td>
                        <td>QTE</td>
                        <td>UNIT</td>
                        <td>PU </td>
                        <td>TOTAL</td>

                        <td>DESCRIPTION
                        <td>QTE</td>
                        <td>UNIT</td>
                        <td>PU</td>
                        <td>TOTAL</td>

                        <td>DESCRIPTION
                        <td>QTE </td>
                        <td>UNIT</td>
                        <td>PU Reel</td>
                        <td>TOTAL</td>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <?php

                        /*---------------------------------------------- calicul extrusion ----------------------------------------------*/
                        $dure =  $this->global->get_somme_time("EX_DUREE",['EX_BC_ID' => $data->BC_PE],"sachet_extrusion")->second_format;
                        $poids = $this->global->get_sum_colum(['EX_BC_ID' => $data->BC_PE],"EX_PDS_NET", "sachet_extrusion")->EX_PDS_NET; 
                        $sortir = $this->global->get_sum_colum(['EX_BC_ID' => $data->BC_PE],"EX_PDS_SOMME", "sachet_extrusion")->EX_PDS_SOMME; 
                         
                        /*---------------------------------------------- calicul impression ----------------------------------------------*/
                        $MAT =$this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"EI_POIDS_NET", "sachet_impression")->EI_POIDS_NET; 
                        $EI_DUREE =  $this->global->get_somme_time("EI_DUREE",['BC_ID' => $data->BC_PE],"sachet_impression")->second_format;
                        $entreInpress = $this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"EI_PDS_SOMME", "sachet_impression")->EI_PDS_SOMME;
                        
                        /*---------------------------------------------- calcul coupe ---------------------------------------------------*/

                        $ED_POID_SORTIE_SOMME =$this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"ED_POID_SORTIE_SOMME", "sachet_coupe")->ED_POID_SORTIE_SOMME; 
                        $EI_DUREECOUP =  $this->global->get_somme_time("ED_DURE",['BC_ID' => $data->BC_PE],"sachet_coupe")->second_format;
                        $ED_METRAGE_SOMME = $this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"ED_METRAGE_SOMME", "sachet_coupe")->ED_METRAGE_SOMME;
                        $poidsSomme =  $this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"ED_PIOD_ENTRE_SOMME", "sachet_coupe")->ED_PIOD_ENTRE_SOMME;
                        $piece =  $this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"ED_1ER_CHOIX_SOMME", "sachet_coupe")->ED_1ER_CHOIX_SOMME; 
                        $metrage =  $this->global->get_sum_colum(['BC_ID' => $data->BC_PE],"ED_METRAGE_SOMME", "sachet_coupe")->ED_METRAGE_SOMME; 

                        /*---------------------------------------------- calcul control qualiter -----------------------------------------*/

                        $control =  $this->global->get_sum_colum(['C_PO' => $data->BC_PE],"C_CHOIX", "controle_qualite")->C_CHOIX;
                        $control = $control == null ? 0 : $control;
                        $piece -= $control;
                      
                        
                        $matierinression = $this->matiere_impression_use->get_matiere_impression_use(['MI_PO' => $data->BC_PE]);
                        $matier = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DESTINATAIRE" => $data->BC_PE]);
                        $totalSortie = 0;
                        $prixTotal = 0;
                        $detaiMAt = "";
                        $x = 0;
                        foreach ($matier as $matier) {
                            $totalSortie += $matier->SM_QUANTITE;
                            $matier->SM_VALEUR =="-" || $matier->SM_VALEUR =="null" ? $matier->SM_VALEUR = 0:"";
                            $prixTotal += $matier->SM_VALEUR * $matier->SM_QUANTITE;
                            if ($x != 0) {
                                $detaiMAt .= "/" . $matier->SM_MATIER;
                                $x++;
                            } else {
                                $detaiMAt .= $matier->SM_MATIER;
                                $x++;
                            }
                        }
                        $pu = 0;
                        if ($totalSortie != 0) {
                            //$pu = ($prixTotal * $poids ) / $totalSortie;
                            $pu = $prixTotal /  $totalSortie;
                        }
                        $pux = $pu * $poids;
                        $prix_a_appliquer =$this->global->get_detail_joint_parameter("prix_commande","prixappliquer", 'prixappliquer.PA_ID =prix_commande.PB_ID_HM',["prix_commande.PB_PO"=>$data->BC_PE]);
                        if(!$prix_a_appliquer){
                            $prix_a_appliquer = $this->prix_appiquer->get_prix_appliquer(["PA_STATUT" => "actif"]);
                        }
                        $pxMatIpp = $pux + (($dure * 1.2213) / 3600) + ((($dure * 2) * 1.0166) / 3600);
                     
                        $exdure = ($dure *  $prix_a_appliquer->H_MACHINE_EXTR) / 3600;
                        $hdue = ($dure * $prix_a_appliquer->H_MOD_EXTR) / 3600;
                        $piodsover = $poids * $prix_a_appliquer->OVERHEADS;

                        if ($data->BC_TYPE == "SS") {
                            $coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
                        } else if ($data->BC_TYPE == "BS") {
                            $coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
                        } else {
                            $coupe = (($EI_DUREECOUP) * $prix_a_appliquer->H_MOD_COUPE) / 3600;
                        }

                        $imp = ($EI_DUREE * $prix_a_appliquer->H_MACHINE_IMPR) / 3600;
                        $HModIMP = (($EI_DUREE * 2) *  $prix_a_appliquer->H_MOD_IMPR) / 3600;
                        $hcoupe = ($EI_DUREECOUP * $prix_a_appliquer->H_MACHINE_COUPE) / 3600;
                        $sommeex =  $piodsover + $pux + $exdure +  $hdue;
                        $toto = 0;
                        if ($sortir != 0) {

                            $toto = $sommeex / $sortir;
                        }
                        $sommeMat = 0;
                        $varmatiers = $matierinression;
                        foreach ($varmatiers  as $varmatiers) {
                            $sommeMat += ($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE);
                        }

                        $totaMatIpp = $entreInpress * $toto;
                        $prixImPrixtotal = $HModIMP + $imp + $totaMatIpp + $sommeMat;
                        $toto= number_format($toto, "3");
                        ?>
                        <td><?= $detaiMAt ?></td>
                        <td><?= $poids ?></td>
                        <td>KGS </td>
                        <td><?= number_format($pu, 2, ',', '.') ?></td>
                        <td><?= number_format($pux, 2, ',', '.') ?></td>
                        <td>MAT</td>
                        <td><?= number_format($entreInpress, 2, ',', '.') ?></td>
                        <td>KGS</td>
                        <td><?= number_format($toto, 2, ',', '.'); ?></td>
                        <td><?=  number_format($totaMatIpp, 2, ',', '.'); ?></td>
                        <td>MAT </td>
                        <td><?= number_format($poidsSomme, 2, ',', '.'); ?></td>
                        <td>KGS</td>
                        <td><?php
                            if ($entreInpress != 0) {
                                echo number_format($prixImPrixtotal / $entreInpress, '2');
                                $poidsSomme = $poidsSomme * ($prixImPrixtotal / $entreInpress);
                            } else {

                                if ($sortir == 0) {
                                    echo 0;
                                } else {
                                    echo number_format($sommeex / $sortir, "3");
                                    $poidsSomme = $poidsSomme * ($sommeex / $sortir);
                                }
                            } ?></td>
                        <td><?= number_format($poidsSomme, '3') ?></td>
                    </tr>
                    <tr>
                        <td>GAINE</td>
                        <td>0,00</td>
                        <td>KGS</td>
                        <td>0,00</td>
                        <td>0,0</td>
                        <td>GAINE</td>
                        <td>0,00</td>
                        <td>GAINE</td>
                        <td>0,00</td>
                        <td></td>
                        <td>GAINE</td>
                        <td></td>
                        <td>GAINE</td>
                        <td>0,00</td>
                        <td>0,00</td>
                    </tr>
                    <tr>
                        <td>H MACHINE EXTR</td>
                        <td><?= se_to_time($dure) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MACHINE_EXTR ?></td>
                        <td><?= number_format($exdure, 3); ?></td>

                        <td>H MACHINE IMPR</td>
                        <td><?= se_to_time($EI_DUREE) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MACHINE_IMPR ?></td>
                        <td><?php

                            echo number_format($imp, 3);


                            ?></td>

                        <td>H MACHINE COUPE</td>
                        <td><?= se_to_time($EI_DUREECOUP) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MACHINE_COUPE ?></td>
                        <td><?php

                            echo number_format($hcoupe, 3);

                            ?></td>

                    </tr>
                    <tr>
                        <td>H MOD EXTR</td>
                        <td><?= se_to_time($dure) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MOD_EXTR ?></td>
                        <td><?php

                            echo number_format($hdue, 3);


                            ?></td>
                        <td>H MOD IMPR</td>
                        <td><?= se_to_time($EI_DUREE * 2) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MOD_IMPR ?></td>
                        <td>
                            <?php

                            echo number_format($HModIMP, 3);


                            ?>
                        </td>
                        <td>H MOD COUPE</td>
                        <td><?= se_to_time($EI_DUREECOUP) ?></td>
                        <td>H</td>
                        <td><?= $prix_a_appliquer->H_MOD_COUPE ?></td>
                        <td><?php



                            echo number_format($coupe, 3);

                            ?></td>
                    </tr>
                    <?php $siValeur = 0;
                    $po = 0;
                    $sommeMat = 0;
                    if ($matierinression) :
                        $tab = array();
                        foreach ($matierinression  as $matierinression) {
                            if (array_key_exists($matierinression->MI_DESIGNATION, $tab)) {
                                $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] += $matierinression->MI_QUANTITE;
                            } else {
                                $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] = $matierinression->MI_QUANTITE;
                                $tab[$matierinression->MI_DESIGNATION]["PRIX"] = $matierinression->MI_PRIX;
                            }
                        }
                        foreach ($tab as $key => $tab) :
                    ?>
                            <tr>
                                <td colspan="5"></td>
                                <td><?= $key ?></td>
                                <td><?= $tab["QUANTITE"] ?></td>
                                <td>KGS</td>
                                <td><?= $tab["PRIX"] ?></td>
                                <td><?php
                                    echo number_format($tab["QUANTITE"] * $tab["PRIX"],3);

                                    ?></td>
                                <?php

                                if ($data->BC_TYPE == "SS" and  $po == 0) {
                                    $metre = $metrage / 1000;
                                    $siValeur += number_format(2.820 * $metre, '3');
                                    echo "<td>SEALING TAPE </td><td>" . $metre . "</td><td>M</td><td>2,82</td><td>" . $siValeur . "</td>";
                                    $po++;
                                } ?>

                            </tr>
                    <?php endforeach;
                    endif; ?>

                    <tr>
                        <td>OVERHEADS</td>
                        <td><?= $poids ?></td>
                        <td>KGS</td>
                        <td><?= $prix_a_appliquer->OVERHEADS ?></td>
                        <td colspan="11">
                            <?= $piodsover ?>
                        </td>
                    </tr>
                    <tr>
                        <td>QTE SORTIE</td>
                        <td><?= number_format($sortir,3) ?></td>
                        <td> </td>
                        <td><?php

                            if ($poids == 0) {
                                echo 0;
                            } else {
                                echo number_format($sommeex / $sortir, "3");
                            }


                            ?></td>
                        <td><?= number_format($sommeex, '3') ?></td>

                        <td> QTE SORTIE</td>

                        <td> <?= number_format($entreInpress + $sommeMat, "3") ?></td>
                        <td></td>
                        <td><?php
                     
                            if ($entreInpress != 0) {
                                echo number_format($prixImPrixtotal / ($entreInpress + $sommeMat), '4');
                            } else {
                                echo  0;
                            } ?>

                        </td>
                        <td><?php

                            echo number_format($prixImPrixtotal, '3');
                            ?>
                        </td>
                        <td>QTE SORTIE</td>

                        <td><?= $piece ?></td>
                        <td>PCES</td>
                        <td><?php $totalCops = $siValeur + $coupe + $hcoupe + $poidsSomme;
                            if ($totalCops != 0 && $piece != 0) {
                                $resultcoup = $totalCops / $piece;
                                echo number_format($resultcoup, '3', ',', '.');
                            } else {
                                $resultcoup = 0;
                                echo  number_format($resultcoup,3);
                            }

                            ?></td>
                        <td><?= number_format($resultcoup * $piece, '3', ',', '.') ?></td>

                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

<?php $i++;
endforeach; ?>
</div>