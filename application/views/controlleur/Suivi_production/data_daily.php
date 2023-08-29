<?php
$this->load->model('global');
$this->load->model('sortie_matiere_premiere');
$this->load->model('sachet_extrusion');
$this->load->model('sachet_impression');
$this->load->model('sachet_coupe');
$this->load->model('sortie_produits_finis');
$this->load->model('controle_qualite');
$this->load->model('sortie_surplus_finis');
$this->load->model('commande');
$this->load->model('stock_produit_finis_model');
foreach ($data as $key => $data) : ?>
    <div class="w-100  tabs" title="<?= $data["BC_PE"] ?>">
        <?php $i = 1; ?>
        <div class=" mt-2 w-100">
            <table class=" table-bordered p-0 w-100">
                <thead class="bg-danger text-white">
                    <tr>
                        <td><?= $data["BC_DATE"] ?></td>
                        <td><?= $data["BC_PE"] ?></td>
                        <td><?= $data["BC_DIMENSION"] ?></td>
                        <td class="text-rigth">
                            <a href="#" class="collapsed pull-right" data-toggle="collapse" data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
                        </td>
                    </tr>
                </thead>

            </table>
        </div>

        <div class="mt-2" id="tab_<?= $i ?>" style="padding: 0px;">
            <fieldset class="border p-2 mt-2">
                <table class="w-100">
                    <tr>
                        <?php
                        $date = date('Y-m');
                        $extru = $this->global->select_data_joint_colum(["EX_BC_ID" => $data["BC_PE"]], "BC_DATE,BC_PE,BC_DIMENSION, EX_DATE AS 'DATE'", "commande.BC_PE=sachet_extrusion.EX_BC_ID", "sachet_extrusion", "commande");
                        $imprm = $this->global->select_data_joint_colum(["sachet_impression.BC_ID" => $data["BC_PE"]], "BC_DATE,BC_PE,BC_DIMENSION, EI_DATE AS 'DATE'", "commande.BC_PE=sachet_impression.BC_ID", "sachet_impression", "commande");
                        $coupe = $this->global->select_data_joint_colum(["sachet_coupe.BC_ID" => $data["BC_PE"]], "BC_DATE,BC_PE,BC_DIMENSION, ED_DATE AS 'DATE'", "commande.BC_PE=sachet_coupe.BC_ID", "sachet_coupe", "commande");

                        $reponse = array_merge($extru, $imprm, $coupe);
                        $date_prod = $this->global->array_unique($reponse, "DATE");



                        $matier = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_REFERENCE" => $data["BC_PE"]]);
                        $tabs = array();
                        $x = 0;
                        $detaiMAt = "";
                        foreach ($matier as $key => $matier) {
                            if (array_key_exists($matier->SM_MATIER, $tabs)) {
                                $tabs[$matier->SM_MATIER] +=  $matier->SM_QUANTITE;
                            } else {
                                $tabs[$matier->SM_MATIER] =  $matier->SM_QUANTITE;
                            }
                        }
                        ?>
                        <th>Intere Po N° :&nbsp; <?= $data["BC_PE"] ?></th>
                        <th> Raw MAT USED :</th>
                        <th>T.RAW Mat Used : <?php foreach ($tabs as $key => $tabs) {
                                                    echo '<br/>' . $key . " : " . $tabs;
                                                } ?></th>
                    </tr>
                    <tr>
                        <th>CUST : &nbsp; <?= $data["BC_CODE"] ?></th>
                        <th colspan="2">ORDER Qty : &nbsp; <?= $data["BC_QUNTITE"] ?></th>
                    </tr>

                    <tr>
                        <th>Order date : &nbsp; <?= $data["BC_DATE"] ?></th>
                        <th>DIM : &nbsp; <?= $data["BC_DIMENSION"] ?></th>
                        <th>DATE LIVR : &nbsp; <?= $data["BC_DATELIVRE"] . " " . $data["BC_LIEULIVRE"] ?></th>
                    </tr>
                </table>
            </fieldset>

            <fieldset class="border p-2 mt-2 table-responsive">
                <table class="w-100 table-bordered">
                    <thead class="bg-danger text-white text-center">
                        <tr>
                            <th></th>
                            <th colspan="4">EXTRUSION</th>
                            <th colspan="4">IMPRESSION</th>
                            <th colspan="8">CUTING</th>

                        </tr>
                        <tr>
                            <th></th>
                            <th colspan="2">PRODUCTION</th>
                            <th colspan="2">REJECT </th>
                            <th colspan="2">PRODUCTION</th>
                            <th colspan="2">REJECT </th>
                            <th colspan="2">KGS </th>
                            <th colspan="2">REJECT </th>
                            <th colspan="4">PCS </th>

                        </tr>
                        <tr>
                            <th>DATE</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>TDY</th>
                            <th>ACUM</th>
                            <th>1stChx</th>
                            <th>ACUM</th>
                            <th>2ndCh</th>
                            <th>ACUM</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $totaEXTRU = 0;
                        $totaDECHET = 0;
                        $totalImprim = 0;
                        $totalImpDechet = 0;
                        $totalCoupe = 0;
                        $totalCoupeDechet = 0;
                        $TOTALER_CHOIX = 0;
                        $TOTALdER_CHOIX = 0;
                        foreach ($date_prod as $key => $date_prod) :
                            $extru = $this->global->select_data_joint_colum(["EX_BC_ID" => $data["BC_PE"], "EX_DATE" => $date_prod["DATE"]], "*", "commande.BC_PE=sachet_extrusion.EX_BC_ID", "sachet_extrusion", "commande");
                            $imprm = $this->global->select_data_joint_colum(["sachet_impression.BC_ID" => $data["BC_PE"], "EI_DATE" => $date_prod["DATE"]], "*", "commande.BC_PE=sachet_impression.BC_ID", "sachet_impression", "commande");
                            $coupe = $this->global->select_data_joint_colum(["sachet_coupe.BC_ID" => $data["BC_PE"], "ED_DATE" => $date_prod["DATE"]], "*", "commande.BC_PE=sachet_coupe.BC_ID", "sachet_coupe", "commande");
                        ?>
                            <tr>
                                <td><?= $date_prod["DATE"] ?></td>
                                <td><?php
                                    $TDYEXTRUSION  = 0;
                                    $TDYDECHE = 0;
                                    $TDYIMPRESSIONDECHET = 0;
                                    $TDYIMPRESSION = 0;
                                    $TDYCOUPEDECHET = 0;
                                    $TDYCOUPE = 0;
                                    $ER_CHOIX = 0;
                                    $dER_CHOIX = 0;

                                    foreach ($extru as $extru) {
                                        $TDYEXTRUSION += $extru["EX_PDS_SOMME"];
                                        $TDYDECHE += $extru["EX_DECHETS"];
                                    }
                                    $totaEXTRU += $TDYEXTRUSION;
                                    $totaDECHET += $TDYDECHE;
                                    echo $TDYEXTRUSION; ?></td>
                                <td><?= $totaEXTRU ?></td>
                                <td><?= $TDYDECHE ?></td>
                                <td><?= $totaDECHET ?></td>


                                <?php foreach ($imprm as $imprm) {
                                    $TDYIMPRESSION += $imprm["EI_PDS_SOMME"];
                                    $TDYIMPRESSIONDECHET += $imprm["EI_DECHET"];
                                }
                                $totalImprim += $TDYIMPRESSION;
                                $totalImpDechet += $TDYIMPRESSIONDECHET; ?>
                                <td><?= $TDYIMPRESSION ?></td>
                                <td><?= $totalImprim ?></td>
                                <td><?= $TDYIMPRESSIONDECHET ?></td>
                                <td><?= $totalImpDechet ?></td>



                                <?php foreach ($coupe as $coupe) {
                                    $poid = explode("+", $coupe["ED_PIOD_ENTRE_SOMME"]);
                                    foreach ($poid as $key => $poid) {
                                        $TDYCOUPE += $poid;
                                    }
                                    $ER_CHOIX += $coupe["ED_1ER_CHOIX_SOMME"];
                                    $dER_CHOIX += $coupe["ED_2E_CHOIX_SOMME"];

                                    $TDYCOUPEDECHET += $coupe["ED_DECHE_COUPE"] + $coupe["ED_DECHE_EXTRUSION"] + $coupe["ED_DECHE_INPRESSION"];
                                }
                                $totalCoupe += $TDYCOUPE;
                                $totalCoupeDechet += $TDYIMPRESSIONDECHET;
                                $TOTALER_CHOIX +=  $ER_CHOIX;
                                $TOTALdER_CHOIX +=  $dER_CHOIX; ?>
                                <td><?= $TDYCOUPE ?></td>
                                <td><?= $totalCoupe ?></td>
                                <td><?= $TDYCOUPEDECHET ?></td>
                                <td><?= $totalCoupeDechet ?></td>
                                <td><?= $ER_CHOIX ?></td>
                                <td><?= $TOTALER_CHOIX ?></td>

                                <td><?= $dER_CHOIX ?></td>
                                <td><?= $TOTALdER_CHOIX ?></td>

                            </tr>

                        <?php endforeach ?>

                    </tbody>
                </table>
            </fieldset>


            <?php

            $datas = $this->sortie_produits_finis->get_sortie_produits_finis(["BC_ID" => $data["BC_PE"]]);

            $qc = $this->controle_qualite->get_controle_qualite(["C_PO" => $data["BC_PE"]])

            ?>
            <fieldset class="border p-1 mt-2">
                <legend style="font-size:12px">LIVRAISON</legend>

                <table class="table-strepted tableProduitFini table-bordered w-100">
                    <thead class="bg-primary text-white">
                        <tr>
                            <td>TAILLE</td>
                            <td>N°PO SURPLUS</td>
                            <td>QUANTITE SURPLUS</td>
                            <td>QUANTITE LIVREE</td>
                            <td>DATE DE LIVRAISON</td>
                            <td>N°BL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($datas as $key => $row) :
                            $dataPlus = $this->sortie_surplus_finis->get_sortie_surplus_finis(["SF_DESTINATION" => $row->BC_ID]);
                            $fini = "";
                            $qtt = 0;
                            if ($dataPlus) {
                                foreach ($dataPlus as $key => $dataPlus) {
                                    if ($fini == "") {
                                        $fini .= $dataPlus->BC_ID;
                                    } else {
                                        $fini .= ',' . $dataPlus->BC_ID;
                                    }
                                    $qtt += $dataPlus->EF_QUANTITE;
                                }
                            }
                            $sfn = 0;
                            $bon = $this->commande->select_commande_all(['BC_PE' => $row->BC_ID]);
                            $stokMagasin = $this->stock_produit_finis->get_stock_produit_finis(['STF_TAIL' => $row->SF_TAILL, 'BC_ID' => $row->BC_ID]);
                            $livre = $this->global->get_sum_colum(["SF_BL"=>$row->SF_BL],"SF_QUANTITE", "sortie_produits_finis");
                        ?>
                            <tr>

                                <td><?= $row->SF_TAILL ?></td>
                                <td><?= $fini ?></td>
                                <td><?= $qtt ?></td>
                                <td><?= $livre->SF_QUANTITE ?></td>
                                <td><?= $row->SF_DATE ?></td>
                                <td><?= $row->SF_BL ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>


            </fieldset>

            <fieldset class="border p-1 mt-2">
                <legend style="font-size:12px">QC</legend>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="matier" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table-hover table-strepted w-100 table-bordered tadleData">
                            <thead class="bg-danger text-white text-center">
                                <tr>
                                    <th>DATE</th>
                                    <th>OPERATEUR</th>
                                    <th>PIECE</th>
                                    <th>2EME CHOIX</th>
                                    <th>QTT SORTIE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($qc as $qc) : ?>
                                    <td><?= $qc->C_DATE ?></td>
                                    <td><?= $qc->C_QC ?></td>
                                    <td><?= $qc->C_ENTRE ?></td>
                                    <td><?= $qc->C_TTS ?></td>
                                    <td><?= $qc->C_CHOIX ?></td>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                </div>
            </fieldset>


            <fieldset class="border p-2 mt-2">
                <table class="w-100">
                    <thead class="">
                        <tr>
                            <th>COMPENSATION :</th>
                            <th> LEFT OVER : </th>

                        </tr>
                        <tr>
                            <th>REEX : </th>
                            <th>T.2nd CHX: </th>

                        </tr>
                    </thead>
                </table>
            </fieldset>
        </div>
        <?php $i++; ?>

    </div>
<?php endforeach ?>