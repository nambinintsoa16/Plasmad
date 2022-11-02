<div class="row">
<?php $i = 1;
foreach ($data as $data) : ?>
<div class="col-md-12 mt-2">
    <table class="table-strepted tableProduitFini table-bordered p-0 w-100">
        <thead>
            <tr class="bg-primary text-white">
                <td style="width: 65px!important;"><?= $data->BC_DATE ?></td>
                <td style="width: 65px!important;"><?= $data->BC_PE ?></td>
                <td style="width: 210px;"><?= $data->BC_TYPEPRODUIT . " " . $data->BC_DIMENSION ?></td>
                <td style="width: 150px;"><?php
                    if($data->BC_TYPEPRODUIT=="GAINES"){
                        echo "QUANTITE : ".$data->BC_QUNTITE." | KGS";
                    }else{
                        echo "QUANTITE : ".$data->BC_QUNTITE." | PCS";
                    }
                             
                    ?></td>

                <td style="width: 150px;"><?php 
                    $this->load->model('compta_model');
                    $prixbon=$this->compta_model->prixbonAppliquer(['prixbon.PB_PO'=>$data->BC_PE]);
                    if($prixbon && $prixbon->PB_SANS_MARGE !=""){
                           echo "P.R.I : ".$prixbon->PB_SANS_MARGE;
                    }else{
                        echo "P.R.I  : 0";
                    }
                        ?></td>
                <td style="width: 150px;">
                <?php if( $origin == "Madakem"){?>
                    <?php 
                   if($prixbon){
                    echo "PRIX DE VENTE: ".$prixbon->PB_PRIX;
                   }else{
                       echo "PRIX DE VENTE: ".$data->BC_PRIX;
                   }
                    ?></td>
                <?php }else{ ?>
                    <?= "PRIX DE VENTE: ".$data->BC_PRIX?></td>
                <?php } ?>
                
                
                <td style="width: 50px; text-align: center;">
                    <a href="#" class="collapsed text-white" data-toggle="collapse"
                        data-target="#tab_<?= $i ?>"> <i class="fa fa-plus" aria-expanded="false"></i></a>
                </td>
            </tr>


            
            <?php
            if( $origin == "Madakem")
            {  ?>
                <tr class="bg-danger text-white">
                <td><?= $data->BC_STATUT ?></td>
                <td colspan="2">CLIENT : <?= $data->BC_CODE ?>    <?php echo $origin;  ?></td>
                <td > PRIX AVEC MARGE : <?= $data->BC_PRIX ?></td>	
                <td colspan="1"> Difference:  <?php 
                if($prixbon){
                    echo ( floatval($prixbon->PB_PRIX) - floatval($prixbon->PB_SANS_MARGE) ) ; 
                    }else{
                        echo $prixbon->PB_PRIX;
                    }
                ?> </td>
                <td colspan="1"> Marge:  <?php 
                if($prixbon){
                      if($prixbon->PB_SANS_MARGE != 0 ){
                          echo number_format( ( floatval($prixbon->PB_PRIX) - floatval($prixbon->PB_SANS_MARGE) ) / floatval($prixbon->PB_SANS_MARGE) * 100 , 2 )." %"  ; 
                      }else{
                          echo 0;
                      }	
                    }
                ?> </td>
                <td class="text-center">
                    <a href="#"  id="<?= $data->BC_PE ?>" class="detailProgre text-white">Détail</a>
                </td>
            </tr>

            <?php }
            else
            { ?>
                <tr class="bg-danger text-white">
                <td><?= $data->BC_STATUT ?></td>
                <td colspan="2">CLIENT : <?= $data->BC_CODE ?>    <?php echo $origin;  ?></td>
                <td > PRIX AVEC MARGE : <?= $data->BC_PRIX ?></td>	
                <td colspan="1"> Difference:  <?php 
                if($prixbon){
                    echo ( floatval($data->BC_PRIX) - floatval($prixbon->PB_SANS_MARGE) ) ; 
                    }else{
                        echo $data->BC_PRIX;
                    }
                
                
                ?> </td>
                <td colspan="1"> Marge:  <?php 
                if($prixbon){
                      if($prixbon->PB_SANS_MARGE != 0 ){
                          echo number_format( ( floatval($data->BC_PRIX) - floatval($prixbon->PB_SANS_MARGE) ) / floatval($prixbon->PB_SANS_MARGE) * 100 , 2 )." %"  ; 
                      }else{
                          echo 0;
                      }
                        
                    }
                
                
                ?> </td>
                
                
                <td class="text-center">
                    <a href="#"  id="<?= $data->BC_PE ?>" class="detailProgre text-white">Détail</a>
                </td>
            </tr>


            <?php }

            ?>
            


            
        </thead>
    </table>

</div>
<div class="col-md-12">
    <div class=" mt-2" id="tab_<?= $i ?>" style="padding: 0px;">
        <table class="table-strepted tableProduitFini table-bordered w-100">
            <thead class="bg-primary text-white">
            <tr class="bg-dark text-white">
                    <td colspan="5" class="text-center">EXTRUSION</td>
                    <td colspan="5" class="text-center"> IMPRESSION</td>
                    <td colspan="5" class="text-center"> COUPE </td>
                </tr>
                <tr class="bg-dark text-white">
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

                             $this->load->model('compta_model');
                            $dextrusion =  $this->compta_model->extrusion(['EX_BC_ID'=>$data->BC_PE]);
                            $extrusion_inpression = $this->compta_model->extrusion_inpression(['extrusion_inpression.BC_ID'=>$data->BC_PE]);
                            $poid = $dextrusion;
                            $poids = 0;
                            $dure = 0;
                            $MAT = 150;
                            $sortir = 0;
                            $EI_DUREE= 0;
                            $MATCOUP=0;
                            $EI_DUREECOUP=0;
                            foreach ($poid as $key => $poid) {
                                if($poid->EX_PDS_SOMME != ""){
                                     $poids += $poid->EX_PDS_NET; 
                                     $dure +=  $this->compta_model->time_to_sec($poid->EX_DUREE);
                                     $sortir +=$poid->EX_PDS_SOMME;

                                }
                              
                            }
                        $entreInpress = 0;	
                    if($extrusion_inpression){
                        foreach ($extrusion_inpression as $key => $extrusion_inpression) {
                                 $MAT +=  $extrusion_inpression->EI_POIDS_NET;
                                 $EI_DUREE += $this->compta_model->time_to_sec( $extrusion_inpression->EI_DUREE);
                                 $entreInpress += $extrusion_inpression->EI_PDS_SOMME;
                         }
                    }	
                    $extrusion_coupe = $this->compta_model->extrusion_coupe(['extrusion_coupe.BC_ID'=>$data->BC_PE]);
                    $EI_DUREECOUP = 0;
                    $ED_METRAGE_SOMME = 0;
                    $ED_POID_SORTIE_SOMME = 0;
                    $piece = 0;
                    $metrage = 0;
                    $poidsSomme = 0;
                    if($extrusion_coupe){
                        foreach ($extrusion_coupe as $key => $extrusion_coupe) {
                             //	$MATCOUP +=  $extrusion_coupe->EI_POIDS_NET;
                                 //$sortirCoup += $extrusion_coupe->ED_POID_SORTIE_SOMME;
                                  $poientre = "";
                                  $poientre =explode("+", $extrusion_coupe->ED_POID_ENTRE);
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
                   $control = $this->compta_model->controlDatas("C_PO ='$data->BC_PE' ORDER BY C_ID DESC");

                   if($control){
                           foreach($control as $control){
                                   $piece -= $control->C_CHOIX;
                           }
                        
                        
                   }
                    $matierinression = $this->compta_model->matierinression(['MI_PO'=>$data->BC_PE]);
                    $matier = $this->compta_model->stock_materiel(["LI_REFERENCE"=>$data->BC_PE,"LI_TYPE"=>"sortie"]);
                    $totalSortie=0;
                    $prixTotal= 0;
                    $detaiMAt = "";
                $x= 0;
                    foreach($matier as $matier){
                        $totalSortie += $matier->LI_QUANTITE;
                        $prixTotal += $matier->LI_VALEUR*$matier->LI_QUANTITE;
                        if($x !=0 ){
                            $detaiMAt .= "/".$matier->LI_MATIER;
                            $x++;
                        }else{
                            $detaiMAt .=$matier->LI_MATIER;
                            $x++;
                        }
                        
                    }
                    $pu = 0;
                    if($totalSortie != 0){
                        //$pu = ($prixTotal * $poids ) / $totalSortie;
                        $pu = $prixTotal /  $totalSortie;
                    }
                    $pux = $pu*$poids;
                    
                        $pxMatIpp =$pux + (($dure * 1.2213 ) / 3600) + ((($dure *2)* 1.0166) / 3600);
                        $exdure = ($dure *  $prixbon->H_MACHINE_EXTR ) / 3600;
                        $hdue= ($dure * $prixbon->H_MOD_EXTR) / 3600;
                        $piodsover = $poids*$prixbon->OVERHEADS;

                        if($data->BC_TYPE == "SS"){
                                $coupe= (($EI_DUREECOUP) * $prixbon->H_MOD_COUPE ) / 3600;
                        }else if($data->BC_TYPE == "BS"){
                                $coupe= (($EI_DUREECOUP) * $prixbon->H_MOD_COUPE ) / 3600;
                        }else{
                                $coupe= (($EI_DUREECOUP) * $prixbon->H_MOD_COUPE ) / 3600;
                        }

                        $imp = ($EI_DUREE * $prixbon->H_MACHINE_IMPR ) / 3600;
                        $HModIMP= (($EI_DUREE*2) *  $prixbon->H_MOD_IMPR) / 3600;


                        $hcoupe= ($EI_DUREECOUP * $prixbon->H_MACHINE_COUPE ) / 3600;

                        


                        $sommeex =  $piodsover+$pux + $exdure +  $hdue;
                          $toto = 0;
                        if($poids!=0){
                                                                
                             $toto = number_format($sommeex/$poids,"3");
                        }
                        $sommeMat=0;
                        $varmatiers = $matierinression;
                        foreach($varmatiers  as $varmatiers){
                             $sommeMat +=($varmatiers->MI_PRIX * $varmatiers->MI_QUANTITE); 

                        }
                
                         $totaMatIpp =$entreInpress*$toto; 
                        $prixImPrixtotal =$HModIMP+$imp+$totaMatIpp+$sommeMat;
                    
                    
                        ?>
                    <td><?=	$detaiMAt?></td>
                    <td><?=$poids?></td>
                    <td>KGS </td>
                    <td><?=number_format($pu,2,',','.')?></td>
                    <td><?=number_format($pux,2,',','.')?></td>
                    <td>MAT</td>
                    <td><?=$entreInpress?></td>
                    <td>KGS</td>
                    <td><?= $toto;?></td>
                    <td><?= $totaMatIpp; ?></td>
                    <td>MAT </td>
                    <td><?=$poidsSomme?></td>
                    <td>KGS</td>
                    <td><?php
                        if($entreInpress!=0){
                        echo number_format($prixImPrixtotal / $entreInpress,'2');
                        $poidsSomme = $poidsSomme*($prixImPrixtotal / $entreInpress);
                        }else{

                            if($poids==0){
                                echo 0;
                            }else{
                                echo number_format($sommeex/$poids,"3");
                                $poidsSomme = $poidsSomme*($sommeex / $poids);
                            }
                        }?></td>
                    <td><?=number_format($poidsSomme,'3')?></td>

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
                    <td><?=   $this->compta_model->se_to_time($dure) ?></td>
                    <td>H</td>
                    <td><?= $prixbon->H_MACHINE_EXTR?></td>
                    <td><?= number_format($exdure,3);?></td>

                    <td>H MACHINE IMPR</td>
                    <td><?= $this->compta_model->se_to_time($EI_DUREE)?></td>
                    <td>H</td>
                    <td><?= $prixbon->H_MACHINE_IMPR?></td>
                    <td><?php
                            
                              echo number_format($imp,3);
                       

                        ?></td>

                    <td>H MACHINE COUPE</td>
                    <td><?= $this->compta_model->se_to_time($EI_DUREECOUP)?></td>
                    <td>H</td>
                    <td><?=$prixbon->H_MACHINE_COUPE?></td>
                    <td><?php
                              
                              echo number_format($hcoupe,3);

                        ?></td>

                </tr>
                <tr>
                    <td>H MOD EXTR</td>
                    <td><?= $this->compta_model->se_to_time($dure) ?></td>
                    <td>H</td>
                    <td><?=$prixbon->H_MOD_EXTR?></td>
                    <td><?php
                            
                             echo number_format($hdue,3);


                        ?></td>
                    <td>H MOD IMPR</td>
                    <td><?= $this->compta_model->se_to_time($EI_DUREE*2)?></td>
                    <td>H</td>
                    <td><?=$prixbon->H_MOD_IMPR?></td>
                    <td>
                        <?php
                            
                             echo number_format($HModIMP,3);


                           ?>
                    </td>
                    <td>H MOD COUPE</td>
                    <td><?=$this->compta_model->se_to_time($EI_DUREECOUP)?></td>
                    <td>H</td>
                    <td><?=$prixbon->H_MOD_COUPE?></td>
                    <td><?php 

                        
                        
                         echo number_format($coupe,3);
                        
                        ?></td>
                </tr>
                <?php $siValeur=0; $po = 0;$sommeMat=0; if($matierinression ) :
                         $tab =array();
                         foreach($matierinression  as $matierinression ){
                             if(array_key_exists($matierinression->MI_DESIGNATION, $tab)){
                                $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] += $matierinression->MI_QUANTITE;
                             }else{
                                $tab[$matierinression->MI_DESIGNATION]["QUANTITE"] = $matierinression->MI_QUANTITE;
                                $tab[$matierinression->MI_DESIGNATION]["PRIX"] = $matierinression->MI_PRIX;
                             }
                            
                         }
                        foreach($tab as $key=>$tab): 
                         ?>
                <tr>
                    <td colspan="5"></td>
                    <td><?=$key?></td>
                    <td><?=$tab["QUANTITE"]?></td>
                    <td>KGS</td>
                    <td><?=$tab["PRIX"]?></td>
                    <td><?php 
                          echo $tab["QUANTITE"] * $tab["PRIX"];
                
                        ?></td>
                    <?php
                             
                          if( $data->BC_TYPE == "SS" AND  $po == 0){
                              $metre=$metrage/1000;
                                 $siValeur +=number_format(2.820*$metre,'3'); 
                                echo "<td>SEALING TAPE </td><td>".$metre."</td><td>M</td><td>2,82</td><td>".$siValeur."</td>";
                                $po++;
                        }?>

                </tr>
                <?php endforeach; endif; ?>

                <tr>
                    <td>OVERHEADS</td>
                    <td><?=$poids?></td>
                    <td>KGS</td>
                    <td><?=$prixbon->OVERHEADS?></td>
                    <td colspan="11">
                        <?= $piodsover ?>
                    </td>
                </tr>
                <tr>
                    <td>QTE SORTIE</td>
                    <td><?=$sortir?></td>
                    <td> </td>
                    <td><?php  
                        
                        if($poids==0){
                            echo 0;
                        }else{
                            echo number_format($sommeex/$poids,"3");
                        }
                        

                        ?></td>
                    <td><?=number_format($sommeex,'3')?></td>

                    <td> QTE SORTIE</td>

                    <td> <?=number_format($entreInpress+$sommeMat,"3")?></td>
                    <td></td>
                    <td><?php 
                        //$prixImPrixtotal ="";
                        //+$HModIMP+$imp+$totaMatIpp; 
                        ///echo number_format($prixImPrixtotal,'3');
                         if( $entreInpress!=0){
                                echo number_format($prixImPrixtotal / ($entreInpress+$sommeMat),'4');
                            }else{
                                echo  0;
                            }?>

                    </td>
                    <td><?php 
                       
                                echo number_format($prixImPrixtotal,'4');
                                ?>
                    </td>
                    <td>QTE SORTIE</td>

                    <td><?=$piece?></td>
                    <td>PCES</td>
                    <td><?php $totalCops = $siValeur+$coupe+$hcoupe+$poidsSomme; 
                            if( $totalCops!=0){
                                $resultcoup = $totalCops/$piece;
                                echo number_format($resultcoup,'4',',','.');
                            }else{
                                $resultcoup = 0;
                                echo  $resultcoup;
                            }
                            
                        ?></td>
                    <td><?=number_format($resultcoup* $piece,'4',',','.')?></td>

                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<?php $i++;
endforeach; ?>
</div>
</div>



