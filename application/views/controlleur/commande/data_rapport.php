<?php
$this->load->model("global");
$this->load->model("reextrusion");
function test_valeur($valeur)
{
    return  $valeur == null ? 0 : $valeur;
}

function test_somme_valeur($valeur)
{
    return  $valeur == null ? 0 : $valeur;
}
?>
<?php foreach ($data as $data) : ?>
    <fieldset class="col-md-12 border mt-2 w-100 p-0 pt-3 bg-white">
        <table class="table-bordered table-hover table-strepted w-100 mb-2" id="dataTable">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Date</th>
                    <th><?= $data->BC_DATE ?></th>
                    <th>N°PO</th>
                    <th><?= $data->BC_PE ?></th>
                    <th>Noms Client </th>
                    <th><?= $data->BC_CODE ?></th>
                    <th>Quantite</th>
                    <th><?= $data->BC_QUNTITE ?> &nbsp; 
                    <?=  $data->BC_TYPEPRODUIT =="GAINE"?"Kg":'PCI'; ?>
                </th>
                    <th><?= $data->BC_TYPEPRODUIT ?></th>
                </tr>
                <tr>
                    <th>Entrées extrusion (kg)</th>
                    <th>Sorties Extrusion(kg)</th>
                    <th>Déchets extrusion(kg)</th>
                    <th>Entrées impression(kg)</th>
                    <th>Sorties impression(kg)</th>
                    <th>Déchets impression (kg)</th>
                    <th>Entrées coupe (kg)</th>
                    <th>Sorties coupe(Pièces)</th>
                    <th>Déchets coupe (kg)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <?php
                        $reextrusion  = 0;
                        $date_rextrsuion = $this->reextrusion->get_detail_reextrusion(["BC_ID"=>$data->BC_PE]);
                        $methodOk= $date_rextrsuion != null;
                        if($methodOk){
                            $date = new DateTime($date_rextrsuion->Date_creation);
                            $dt = $date->format('Y-m-d');
                            $reextrusion = $this->global->get_sum_colum("EX_BC_ID= '$data->BC_PE' AND EX_DATE >='$dt'", "EX_PDS_NET", "sachet_extrusion")->EX_PDS_NET;
                        }
                        $rest_gane = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_RESTE_GAINE", "sachet_coupe")->ED_RESTE_GAINE; 
                        $surplus_sortie = $this->global->get_sum_colum(["SF_DESTINATION" => $data->BC_PE], "SF_QUANTITE", "sortie_surplus_finis")->SF_QUANTITE;
                        $choix_2 = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_2E_CHOIX_SOMME", "sachet_coupe")->ED_2E_CHOIX_SOMME;
                        $control_qualite = $this->global->get_sum_colum(["C_PO" => $data->BC_PE], "C_CHOIX", "controle_qualite")->C_CHOIX;
                        $deuxime_choix = test_valeur($control_qualite) + test_valeur($choix_2);
                        $entre_extrusion = $this->global->get_sum_colum(["EX_BC_ID" => $data->BC_PE], "EX_PDS_NET", "sachet_extrusion")->EX_PDS_NET;
                        $entre_impression = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "EI_PDS_SOMME", "sachet_impression")->EI_PDS_SOMME;
                        $control_qualite_poids = $this->global->get_sum_colum(["C_PO" => $data->BC_PE], "C_POID", "controle_qualite")->C_POID;
                        $deuxime_choix_poid = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_2E_POIDS", "sachet_coupe")->ED_2E_POIDS;
                        $poid_second_choix = test_valeur($control_qualite_poids) + test_valeur($deuxime_choix_poid);
                        $choix1_poid = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_POID_SORTIE_SOMME", "sachet_coupe")->ED_POID_SORTIE_SOMME;
                        echo  test_valeur($entre_extrusion);
                        ?></th>
                    <td><?php
                        $sortie_extrusion = $this->global->get_sum_colum(["EX_BC_ID" => $data->BC_PE], "EX_PDS_SOMME", "sachet_extrusion")->EX_PDS_SOMME;
                        echo  number_format(test_valeur($sortie_extrusion)); ?></td>
                    <td><?php
                        $dechte_coupe_extrusion = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_DECHE_EXTRUSION", "sachet_coupe")->ED_DECHE_EXTRUSION;
                        $dechet_extrusion = $this->global->get_sum_colum(["EX_BC_ID" => $data->BC_PE], "EX_DECHETS", "sachet_extrusion")->EX_DECHETS;
                        echo  number_format(test_somme_valeur($dechet_extrusion) + test_somme_valeur($dechte_coupe_extrusion), 0, ' ', ' '); ?></td>

                    <td><?=number_format($entre_impression) ?></td>
                    <td><?php

                        $sortie_impression = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "EI_POIDS_NET", "sachet_impression")->EI_POIDS_NET;
                        echo  number_format(test_valeur($sortie_impression), 0, ' ', ' '); ?></td>
                    <td><?php
                        $dechte_coupe_impression = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_DECHE_INPRESSION", "sachet_coupe")->ED_DECHE_INPRESSION;
                        $dechet_impression = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "EI_DECHET", "sachet_impression")->EI_DECHET;
                        echo  number_format(test_somme_valeur($dechet_impression) + test_somme_valeur($dechte_coupe_impression), 0, ' ', ' '); ?></td>

                    <td><?php

                        $entre_coupe = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_PIOD_ENTRE_SOMME", "sachet_coupe")->ED_PIOD_ENTRE_SOMME;
                        echo  number_format(test_valeur($entre_coupe), 0, ' ', ' '); ?>
                    </td>
                    <td><?php

                        $sortie_coupe = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_1ER_CHOIX_SOMME", "sachet_coupe")->ED_1ER_CHOIX_SOMME;
                        echo  number_format(test_valeur($sortie_coupe) + test_valeur($deuxime_choix), 0, ' ', ' '); ?></td>
                    <td><?php

                        $dechte_coupe = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_DECHE_COUPE", "sachet_coupe")->ED_DECHE_COUPE;
                        echo  number_format(test_valeur($dechte_coupe), 0, ' ', ' '); ?></td>
                </tr>
            </tbody>
            <tfoot >
                  <?php  $choix_1 = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "ED_1ER_CHOIX_SOMME", "sachet_coupe")->ED_1ER_CHOIX_SOMME; ?>
                    
                <tr class="bg-warning text-white">
                <td colspan="2">
                    Sortie matiere : <?php
                     $sortie_matiere = $this->global->get_sum_colum(["SM_DESTINATAIRE" => $data->BC_PE], "SM_QUANTITE", "sortie_matiere_premiere")->SM_QUANTITE;
                     echo  number_format(test_valeur($sortie_matiere), 0, ' ', ' ');
                    ?> Kg
                    </th>
                    <th>Ecart : &nbsp; <?=number_format(test_valeur($sortie_matiere) - test_valeur($entre_extrusion));?> Kg</td>
                    <td colspan="2">Qtt réextrusion : <?=number_format(test_valeur($reextrusion), 0, ' ', ' ')?> kg</td>
                    <td>1ére choix  :  <?=number_format($choix1_poid -  $poid_second_choix)?>&nbsp;kg</td>
                    <td>2émè choix  : <?=number_format($poid_second_choix)?>&nbsp;kg</td>
                    <td colspan="2">Reste gaines Coupe : <?=number_format(test_valeur($rest_gane), 0, ' ', ' ');?> Kg</td>
                      
                </tr>

                <tr class="bg-secondary text-white">
                    
                    <td colspan="2">Quantité prises en surplus:&nbsp;<?=number_format(test_valeur($surplus_sortie), 0, ' ', ' ')?>&nbsp;(piéce)</td>
                   <td></td>
                    <td colspan="2">1ére choix : <?=number_format(test_valeur($choix_1) - test_valeur($control_qualite))?>&nbsp;(piéce)</td>
                    <td colspan="2">2émè choix  : <?php $deuxime_choix = test_valeur($control_qualite) + test_valeur($choix_2);
                    echo number_format($deuxime_choix);
                    ?>&nbsp;(piéce)</td>  
                    <td colspan="2">Quantité prises dans surplus: &nbsp;<?php
                        $surplus = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "EF_QUANTITE", "entree_surplus_finis")->EF_QUANTITE;
                        echo  number_format(test_valeur($surplus), 0, ' ', ' ');
                        ?>&nbsp; (pieces)</th>
                </tr>
            </tfoot>
        </table>
    </fieldset>
<?php endforeach; ?>