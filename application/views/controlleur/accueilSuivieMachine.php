<div id="tabs">
        <ul>
            <li> <a href="#tab_1">EXTRUSION</a> </li>
            <li> <a href="#tab_2">IMPRESSION</a> </li>
            <li> <a href="#tab_3">COUPE</a> </li>

        </ul>

        <div id="tab_1">
           





        effective output            
            KGS 
            <?php
$machine = "MACHINE 1";
$dt = new DateTime("");
$reponse  = $dt->format('t');
$rowspan = $reponse+1;
$this->load->model('Controlleur_model');

?>

            <table class="table-hover table-stripted table-bordered w-100">
                <thead class="bg-dark text-white">
                <tr>
        
                    <th  colspan="9"  class="text-center"></th>
                </tr>
                <tr>
                    <th>DATE</th>
                    <th>PRODUCTION PCS</th>
                    <th>PRODUCTION Kgs</th>
                    <th>REJECT KGS</th>
                    <th>2nd  choice KGS</th>
                    <th>2nd  choice Pcs hours</th>
                    <th>Hour</th>
                    <th>Machine efficiency</th>
                    <th>Operateure Name</th>
                </tr>       
                </thead>
                <tbody>
                <?php for($i=1;$i<$reponse+1;$i++):
                        $dateX= $dt->format('Y-m')."-".$i;
                        $dataEx = $this->Controlleur_model->dataCoupeExtrusion(["ED_DATE"=>$dateX,"ED_MACHINE"=>$machine]);
                        $sortie = 0;
                        $heure = 0;
                        $equipe = "";
                        $DECHETS=0;
                        $choix1 = 0;
                        $p=0;
                        $perateur =array();
                        foreach($dataEx as $dataEx){
                            $heure += $this->Controlleur_model->time_to_sec($dataEx->ED_DURE);
                            $sortie += $dataEx->ED_POID_SORTIE_SOMME;
                            if( $DECHETS!=""){
                            $DECHETS +=$dataEx->ED_2E_CHOIX_SOMME;
                        }
                            if(!in_array($dataEx->ED_OPERATEUR_1,$perateur)){
                                if($dataEx->ED_OPERATEUR_1!=""){
                                    if($p!=0){
                                        $equipe .=" / ".$dataEx->ED_OPERATEUR_1;    
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_1;
                                        $p++;
                                    }
                                
                                    $perateur[] = $dataEx->ED_OPERATEUR_2;
                                }
                                
                            }
                            if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
                                if($dataEx->ED_OPERATEUR_2!=""){
                                    if($p!=0){
                                    $equipe .= " / ".$dataEx->ED_OPERATEUR_2;
                                
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_2;
                                        $p++;
                                    }
                                    $perateur[] = $dataEx->ED_OPERATEUR_2;
                               }
                            }

                            if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
                                if($dataEx->ED_OPERATEUR_3!=""){
                                    if($p!=0){
                                    $equipe .= " / ".$dataEx->ED_OPERATEUR_3;
                                
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_3;
                                        $p++;
                                    }
                                    $perateur[] = $dataEx->ED_OPERATEUR_3;
                               }
                            }
                            
                        }
                        $detailmachine=   $this->Controlleur_model->machineRow(['MA_DESIGNATION'=>$machine]);
                        ?>
                
                        <td><?=$i."-".$dt->format('m-Y')?></td>
                        <td><?=$sortie?></td>
                        <td><?= $choix1?></td>
                        <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
                        <td></td>
                        <td></td>
                        <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
                        <td></td>
                        <td><?= $equipe?></td>
                        </tr>   
                    <?php endfor;?>
                    </tbody>
                </table>
    




















        </div>
        <div id="tab_2">






        <?php

$dt = new DateTime();
$reponse  = $dt->format('t');
$rowspan = $reponse+1;
$this->load->model('Controlleur_model');

?>

            <table class="table-hover table-stripted table-bordered w-100">
                <thead class="bg-dark text-white">
                    <tr>
                        <th colspan="5" class="text-center">PRODUCTION</th>
                    </tr>       
                    <th>DATE</th>
                    <th>Poids/kgs</th>
                    <th>Metrage</th>
                    <th>Hours</th>
                    <th>Operateure</th>
                </tr>       
                </thead>
                <tbody>
                    <?php 
                    for($i=1;$i<$reponse+1;$i++):
                    ?>
                    <tr>
                    <?php
                    $dateX= $dt->format('Y-m')."-".$i;
                    $dataEx = $this->Controlleur_model->dataImpressionExtrusion(["EI_DATE"=>$dateX,"EI_MACH"=>$machine]);
                    $sortie = 0;
                    $heure = 0;
                    $equipe = "";
                    $DECHETS=0;
                    $metrage =0;
                    $p=0;
                    $perateur =array();
                    foreach($dataEx as $dataEx){
                        $heure += $this->Controlleur_model->time_to_sec($dataEx->EI_DUREE);
                        $sortie += $dataEx->EI_PDS_SOMME;
                        $metrage += $dataEx->EI_METRE_SOMME;
                        if( $DECHETS!=""){
                        $DECHETS +=$dataEx->EI_DECHET;
                        }

                        if(!in_array($dataEx->EI_OPERATEUR1,$perateur)){
                            if($dataEx->EI_OPERATEUR1!=""){
                                if($p!=0){
                                    $equipe .=" / ".$dataEx->EI_OPERATEUR1; 
                                }else{
                                    $equipe .=$dataEx->EI_OPERATEUR1;
                                    $p++;
                                }
                            
                                $perateur[] = $dataEx->EI_OPERATEUR1;
                            }
                            
                        }
                        if(!in_array($dataEx->EI_OPERATEUR2,$perateur)){
                            if($dataEx->EI_OPERATEUR2!=""){
                                if($p!=0){
                                $equipe .= " / ".$dataEx->EI_OPERATEUR2;
                            
                                }else{
                                    $equipe .=$dataEx->EI_OPERATEUR2;
                                    $p++;
                                }
                                $perateur[] = $dataEx->EI_OPERATEUR2;
                           }
                        }
                    }?>

                
                
                
                    <td><?=$i."-".$dt->format('m-Y')?></td>
                    <td><?=$sortie?></td>
                    <td><?= $metrage?></td>
                    <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
                    <td><?= $equipe?></td>
                    </tr>   
                <?php endfor;?>
                </tbody>
            </table>

</div>





         
        <div id="tab_3">
        effective output            
            KGS 
            <?php

$dt = new DateTime();
$reponse  = $dt->format('t');
$rowspan = $reponse+1;
$this->load->model('Controlleur_model');

?>

            <table class="table-hover table-stripted table-bordered w-100">
                <thead class="bg-dark text-white">
                <tr>
        
                    <th  colspan="9"  class="text-center"><?=strtoupper($machine)?></th>
                </tr>
                <tr>
                    <th>DATE</th>
                    <th>PRODUCTION PCS</th>
                    <th>PRODUCTION Kgs</th>
                    <th>REJECT KGS</th>
                    <th>2nd  choice KGS</th>
                    <th>2nd  choice Pcs hours</th>
                    <th>Hour</th>
                    <th>Machine efficiency</th>
                    <th>Operateure Name</th>
                </tr>       
                </thead>
                <tbody>
                <?php for($i=1;$i<$reponse+1;$i++):
                        $dateX= $dt->format('Y-m')."-".$i;
                        $dataEx = $this->Controlleur_model->dataCoupeExtrusion(["ED_DATE"=>$dateX,"ED_MACHINE"=>$machine]);
                        $sortie = 0;
                        $heure = 0;
                        $equipe = "";
                        $DECHETS=0;
                        $choix1 = 0;
                        $p=0;
                        $perateur =array();
                        foreach($dataEx as $dataEx){
                            $heure += $this->Controlleur_model->time_to_sec($dataEx->ED_DURE);
                            $sortie += $dataEx->ED_POID_SORTIE_SOMME;
                            if( $DECHETS!=""){
                            $DECHETS +=$dataEx->ED_2E_CHOIX_SOMME;
                        }
                            if(!in_array($dataEx->ED_OPERATEUR_1,$perateur)){
                                if($dataEx->ED_OPERATEUR_1!=""){
                                    if($p!=0){
                                        $equipe .=" / ".$dataEx->ED_OPERATEUR_1;    
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_1;
                                        $p++;
                                    }
                                
                                    $perateur[] = $dataEx->ED_OPERATEUR_2;
                                }
                                
                            }
                            if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
                                if($dataEx->ED_OPERATEUR_2!=""){
                                    if($p!=0){
                                    $equipe .= " / ".$dataEx->ED_OPERATEUR_2;
                                
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_2;
                                        $p++;
                                    }
                                    $perateur[] = $dataEx->ED_OPERATEUR_2;
                               }
                            }

                            if(!in_array($dataEx->ED_OPERATEUR_2,$perateur)){
                                if($dataEx->ED_OPERATEUR_3!=""){
                                    if($p!=0){
                                    $equipe .= " / ".$dataEx->ED_OPERATEUR_3;
                                
                                    }else{
                                        $equipe .=$dataEx->ED_OPERATEUR_3;
                                        $p++;
                                    }
                                    $perateur[] = $dataEx->ED_OPERATEUR_3;
                               }
                            }
                            
                        }
                        $detailmachine=   $this->Controlleur_model->machineRow(['MA_DESIGNATION'=>$machine]);
                        ?>
                
                        <td><?=$i."-".$dt->format('m-Y')?></td>
                        <td><?=$sortie?></td>
                        <td><?= $choix1?></td>
                        <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
                        <td></td>
                        <td></td>
                        <td><?= $this->Controlleur_model->se_to_time($heure)?></td>
                        <td></td>
                        <td><?= $equipe?></td>
                        </tr>   
                    <?php endfor;?>
                    </tbody>
                </table>
    
    </div>
     <script>
        $(document).ready(function () {
            $('#tabs').tabs();
           /* $.post(base_url+'Controlleur/page',{page:"dataRepotFollow"},function(data){
                $('#tab_1').empty().append(data);

            });*/
        });
    </script>
