<?php $i = 1;
$this->load->model('sortie_produits_finis');
$this->load->model('sortie_surplus_finis');
$this->load->model('global');
foreach ($data as $key => $data) :?>
    <div class="col-md-12 p-0 m-0 mt-2">
        <table class="table-strepted tableProduitFini table-bordered p-0 w-100">
            <thead class="bg-secondary text-white">
                <tr class="border">
                    <td class="border"><?= $data->BC_DATE ?></td>
                    <td class="pos"><?= $data->BC_PE ?></td>
                    <td><?= $data->BC_CLIENT ?></td>
                    <td><?= $data->BC_CODE ?></td>
                    <td><?= $data->BC_DIMENSION ?></td>
                    <?php if ($data->BC_TYPEPRODUIT == "GAINES") : $unite = " | KG"; ?>
                        <td><?= $data->BC_QUNTITE ?> | KG </td>
                    <?php else : $unite = " | KG"; ?>
                        <td><?= $data->BC_QUNTITE ?> | PCS </td>
                    <?php endif; ?>
                    <td><?php
                        $total_entre = $this->global->get_sum_colum(["BC_ID" => $data->BC_PE], "EF_QUANTITE", "entree_produits_finis");
                        echo $total_entre->EF_QUANTITE;
                        ?></td>
                    <td style="text-align: center;">
                        <a href="#" class="text-white" data-toggle="collapse" data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-12 p-0 m-0 collapse" id="tab_<?=$i?>" >
        <table class="table-bordered table-hover table-strepted w-100">
            <thead class="">
                <tr>
                    <td colspan="5"><b>STOCK SURPLUS</b></td>
                </tr>
                <tr>
                    <!--<td>QUANTITE ENTREE</td>-->
                    <td><b>TAILLE</b></td>
                    <td><b>N°PO SURPLUS</b></td>
                    <td><b>QUANTITE SORTIE SURPLUS</b></td>
                    <td><b>DATE DE SORTIE</b></td>
                    <td><b>N°BL</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $refnum = $data->BC_PE;
                $param = ['SF_DESTINATION' => $refnum];
                $total_suplus = 0;
                $sortie_produit_finis = $this->sortie_surplus_finis->get_sortie_surplus_finis($param);
                foreach ($sortie_produit_finis as $reponse) :
                ?>
                    <tr>
                        <td><?= $reponse->SF_TAILL ?></td>
                        <td><?= $reponse->BC_ID ?></td>
                        <td><?php
                            $total_suplus += $reponse->SF_QUANTITE;
                            echo $reponse->SF_QUANTITE ?></td>
                        <td><?= $reponse->SF_DATE ?></td>
                        <td><?= $reponse->SF_BL ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="">
                <tr>
                    <td>SOMME : </td>
                    <td></td>
                    <td><?= $total_suplus ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-12 p-0 m-0">
        <table class="table-bordered table-hover table-strepted w-100">
            <thead class="">
                <tr>
                    <td colspan="5"><b>STOCK MAGASIN</b></td>
                </tr>
                <tr>
                    <!--<td>QUANTITE ENTREE</td>-->
                    <td><b>TAILLE</b></td>
                    <td><b>QUANTITE LIVREE</b></td>
                    <td><b>RESTE A LIVRE</b></td>
                    <td><b>DATE DE LIVRAISON</b></td>
                    <td><b>N°BL</b></td>
                </tr>
            </thead>
            <tbody>
                <?php

                $methodOk = $refnum != "";
                $rest_total =  $data->BC_QUNTITE;
                $param = ['BC_ID' => $refnum, "SF_ORIGIN" => "Sortie livraison"];
                $sortie_produit_finis = $this->sortie_produits_finis->get_sortie_produits_finis($param);
                foreach ($sortie_produit_finis as $reponse) :
                    $rest_total -= $reponse->SF_QUANTITE;

                ?>
                    <tr>
                        <td><?= $reponse->SF_TAILL ?></td>
                        <td><?= $reponse->SF_QUANTITE ?></td>
                        <td><?= $rest_total ?></td>
                        <td><?= $reponse->SF_DATE ?></td>
                        <td><?= $reponse->SF_BL ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr class="bg-secondary" />
<?php $i++;
endforeach ?>