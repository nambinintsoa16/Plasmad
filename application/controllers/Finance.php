
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Finance extends My_Controller
{
    public function index()
    {
    }
    public function sachet_extrussion_data()
    {
        $this->load->model("commande");
        $this->load->model("sachet_coupe");
        $this->load->model("sachet_extrusion");
        $this->load->model("sachet_impression");
        $this->load->model("global");
        $tableArray = array();
        $in = "";
        $date =date("Y-m");//$this->input->get('date');
        $po = $this->input->get('po');
        $type = $this->input->get('type');
    
        if ($type == "") {
            $type = "PE";
        }
        $findate = $this->input->get('fin');
        $i = 0;
      
        if ($date == "") {
          
            if ($po != "") {
                $requette = "BC_PE LIKE '%$po%'";
            } else {
                $date = date('Y-m');
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
                foreach ($extru as $key => $extru) {
                    if (!in_array($extru->EX_BC_ID, $tableArray)) {
                        array_push($tableArray, $extru->EX_BC_ID);
                        if ($i != 0) {
                            $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                        } else {
                            $in .= "BC_PE like '$extru->EX_BC_ID'";
                            $i++;
                        }
                    }
                }
                $date = date('Y-m');
                if ($in != "") {
                    $requette = "$in";
                } else {
                    $requette = "0";
                }
            }
        } else {

            if ($findate != "") {
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
            } else {
                $dateTEmp = explode("-", $date);
                $date = $dateTEmp[0] . "-" . $dateTEmp[1];
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
            }

            foreach ($extru as $key => $extru) {
                if (!in_array($extru->EX_BC_ID, $tableArray)) {
                    array_push($tableArray, $extru->EX_BC_ID);
                    if ($i != 0) {
                        $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                    } else {
                        $in .= "BC_PE like '$extru->EX_BC_ID'";
                        $i++;
                    }
                }
            }
            if ($in != "") {
                $requette = "$in";
            } else {
                $requette = "0";
            }
        }
        $datas = $this->commande->select_commande_all("(" . $requette . ") ORDER BY BC_DATE ASC");
        
        $data = array();
        foreach ($datas as $row) {
          $sub_array = array();
          $prixTotal = 0;
          $quantite =0;
          $valeur =0;
          $sub_array[] = $row->BC_PE;
          $sub_array[] = $row->BC_DIMENSION;
          $matier = $this->global->get_sum_colum(["SM_DESTINATAIRE" => $row->BC_PE],"SM_QUANTITE", "sortie_matiere_premiere")->SM_QUANTITE; 
          $matier == Null ?  $matier = 0:"";
          $sub_array[] = $matier;
          $gaine_produit = $this->global->get_sum_colum(["EX_BC_ID" => $row->BC_PE],"EX_PDS_SOMME", "sachet_extrusion")->EX_PDS_SOMME;
          $sub_array[] = number_format($gaine_produit, 2, ',', ' ');
          $dechet = $this->global->get_sum_colum(["EX_BC_ID" => $row->BC_PE],"EX_DECHETS", "sachet_extrusion")->EX_DECHETS;
         $dechet == Null ?  $dechet = 0:"";

          $sub_array[] =  number_format($dechet, 2, ',', ' ');
          $sub_array[] =  number_format($matier-$dechet-$gaine_produit, 2, ',', ' ');
          
         
          $matier_sortie = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DESTINATAIRE" => $row->BC_PE]);
            foreach ($matier_sortie as $matier_sortie) {
    
              $prixTotal +=  (float)$matier_sortie->SM_VALEUR *  $matier_sortie->SM_QUANTITE;            
          }
         if($matier !=0){
          $valeur =  $prixTotal /  $matier;
         }
          $sub_array[] =  number_format($valeur, 2, ',', ' ');
          $sortie_livraison = $this->global->get_sum_colum(["SF_ORIGIN"=>"Sortie livraison","BC_ID" => $row->BC_PE],"SF_QUANTITE", "sortie_produits_finis")->SF_QUANTITE; 
          $sortie_livraison == Null ?  $sortie_livraison = 0:"";
          
          $sub_array[] = number_format($gaine_produit - $sortie_livraison, 2, ',', ' '); 
		  $sub_array[] = number_format($gaine_produit - $sortie_livraison, 2, ',', ' '); 


          /*$terminer = $this->test_valeur($this->global->get_sum_colum(["BC_PE"=>$row->BC_PE],"JO_AV", "jobcart_sachet_extrusion")->JO_AV);
          $sortie =  $this->global->get_sum_colum(['EX_BC_ID' => $row->BC_PE],"EX_PDS_SOMME", "sachet_extrusion")->EX_PDS_SOMME; 
          $sortie = $sortie == null ? 0 :$sortie;
          $sub_array[] =  $terminer;
          
          foreach ($matier as $matier) {
            $matier->SM_VALEUR =="-" || $matier->SM_VALEUR =="null" ? $matier->SM_VALEUR = 0:"";
            $prixTotal += $matier->SM_VALEUR * $matier->SM_QUANTITE;
          }
          $sub_array[] =  number_format($prixTotal);
          $sub_array[] =  number_format($sortie - $terminer);
          $livre = $this->test_valeur($this->global->get_sum_colum(["BC_ID"=>$row->BC_PE,"SF_ORIGIN"=>"Sortie livraison"],"SF_QUANTITE", "sortie_produits_finis")->SF_QUANTITE);
          $sub_array[] =  $livre ;
          $sub_array[] = $qtt[0] -  $livre;*/
          $data[] = $sub_array;
          
        }
        $output = array(
          "data" => $data
        );
        echo json_encode($output);
    }


    public function sachet_impression_data()
    {
        $this->load->model("commande");
        $this->load->model("sachet_coupe");
        $this->load->model("sachet_extrusion");
        $this->load->model("sachet_impression");
        $this->load->model("global");
        $tableArray = array();
        $in = "";
        $date ="2023-06-08"; //$this->input->get('date');
        $po = $this->input->get('po');
        $type = $this->input->get('type');
    
        if ($type == "") {
            $type = "PE";
        }
        $findate = $this->input->get('fin');
        $i = 0;
      
        if ($date == "") {
          
            if ($po != "") {
                $requette = "BC_PE LIKE '%$po%'";
            } else {
                $date = date('Y-m');
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
                foreach ($extru as $key => $extru) {
                    if (!in_array($extru->EX_BC_ID, $tableArray)) {
                        array_push($tableArray, $extru->EX_BC_ID);
                        if ($i != 0) {
                            $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                        } else {
                            $in .= "BC_PE like '$extru->EX_BC_ID'";
                            $i++;
                        }
                    }
                }
                $date = date('Y-m');
                if ($in != "") {
                    $requette = "$in";
                } else {
                    $requette = "0";
                }
            }
        } else {

            if ($findate != "") {
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
            } else {
                $dateTEmp = explode("-", $date);
                $date = $dateTEmp[0] . "-" . $dateTEmp[1];
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
            }

            foreach ($extru as $key => $extru) {
                if (!in_array($extru->EX_BC_ID, $tableArray)) {
                    array_push($tableArray, $extru->EX_BC_ID);
                    if ($i != 0) {
                        $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                    } else {
                        $in .= "BC_PE like '$extru->EX_BC_ID'";
                        $i++;
                    }
                }
            }
            if ($in != "") {
                $requette = "$in";
            } else {
                $requette = "0";
            }
        }
        $datas = $this->commande->select_commande_all("(" . $requette . ") ORDER BY BC_DATE ASC");
        
        $data = array();
        foreach ($datas as $row) {
          $sub_array = array();
          $sub_array[] = $row->BC_PE;
          $sub_array[] = $row->BC_DIMENSION;
          $qtt = explode(" ",$row->BC_QUNTITE);
          $sub_array[] = $row->BC_QUNTITE;
          $terminer = $this->test_valeur($this->global->get_sum_colum(["BC_PE"=>$row->BC_PE],"JO_AV", "jobcart_sachet_extrusion")->JO_AV);
          $sortie = $this->test_valeur( $this->global->get_sum_colum(["BC_PE"=>$row->BC_PE],"JO_SORTIE", "jobcart_sachet_extrusion")->JO_SORTIE);
          $sub_array[] =  $terminer;
          $sub_array[] = $sortie - $terminer;
          $livre = $this->test_valeur($this->global->get_sum_colum(["BC_ID"=>$row->BC_PE,"SF_ORIGIN"=>"Sortie livraison"],"SF_QUANTITE", "sortie_produits_finis")->SF_QUANTITE);
          $livre = $livre == null ? $livre = 0 : $livre = $livre;
          $sub_array[] =  $livre ;
          $sub_array[] = $qtt[0] -  float($livre);
          $data[] = $sub_array;
          
        }
        $output = array(
          "data" => $data
        );
        echo json_encode($output);
    }

    public function sachet_coupe_data()
    {
        $this->load->model("commande");
        $this->load->model("sachet_coupe");
        $this->load->model("sachet_extrusion");
        $this->load->model("sachet_impression");
        $this->load->model("global");
        $tableArray = array();
        $in = "";
        $date ="2023-06-08"; //$this->input->get('date');
        $po = $this->input->get('po');
        $type = $this->input->get('type');
    
        if ($type == "") {
            $type = "PE";
        }
        $findate = $this->input->get('fin');
        $i = 0;
      
        if ($date == "") {
          
            if ($po != "") {
                $requette = "BC_PE LIKE '%$po%'";
            } else {
                $date = date('Y-m');
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND  EX_DATE like '$date%'");
                foreach ($extru as $key => $extru) {
                    if (!in_array($extru->EX_BC_ID, $tableArray)) {
                        array_push($tableArray, $extru->EX_BC_ID);
                        if ($i != 0) {
                            $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                        } else {
                            $in .= "BC_PE like '$extru->EX_BC_ID'";
                            $i++;
                        }
                    }
                }
                $date = date('Y-m');
                if ($in != "") {
                    $requette = "$in";
                } else {
                    $requette = "0";
                }
            }
        } else {

            if ($findate != "") {
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE  BETWEEN '$date' AND '$findate'");
            } else {
                $dateTEmp = explode("-", $date);
                $date = $dateTEmp[0] . "-" . $dateTEmp[1];
                $extru = $this->global->get_data_joint_parameter('sachet_extrusion', 'commande', 'commande.BC_PE=sachet_extrusion.EX_BC_ID', "(commande.BC_ORIGINE='PLASMAD') AND EX_DATE like '$date%'");
            }

            foreach ($extru as $key => $extru) {
                if (!in_array($extru->EX_BC_ID, $tableArray)) {
                    array_push($tableArray, $extru->EX_BC_ID);
                    if ($i != 0) {
                        $in .= " OR BC_PE like '$extru->EX_BC_ID'";
                    } else {
                        $in .= "BC_PE like '$extru->EX_BC_ID'";
                        $i++;
                    }
                }
            }
            if ($in != "") {
                $requette = "$in";
            } else {
                $requette = "0";
            }
        }
        $datas = $this->commande->select_commande_all("(" . $requette . ") ORDER BY BC_DATE ASC");
        
        $data = array();
        foreach ($datas as $row) {
          $sub_array = array();
          $sub_array[] = $row->BC_PE;
          $sub_array[] = $row->BC_DIMENSION;
          $qtt = explode(" ",$row->BC_QUNTITE);
          $sub_array[] = $row->BC_QUNTITE;
          $terminer = $this->test_valeur($this->global->get_sum_colum(["BC_PE"=>$row->BC_PE],"JO_AV", "jobcart_sachet_extrusion")->JO_AV);
          $sortie = $this->test_valeur( $this->global->get_sum_colum(["BC_PE"=>$row->BC_PE],"JO_SORTIE", "jobcart_sachet_extrusion")->JO_SORTIE);
          $sub_array[] =  $terminer;
          $sub_array[] = $sortie - $terminer;
          $livre = $this->test_valeur($this->global->get_sum_colum(["BC_ID"=>$row->BC_PE,"SF_ORIGIN"=>"Sortie livraison"],"SF_QUANTITE", "sortie_produits_finis")->SF_QUANTITE);
          $sub_array[] =  $livre ;
          $sub_array[] = $qtt[0] -  $livre;
          $data[] = $sub_array;
          
        }
        $output = array(
          "data" => $data
        );
        echo json_encode($output);
    }
    public function Sachet_extrusion()
    {
        $this->render_view('finance/production/Sachet_extrusion');
    }
    public function Sachet_impression()
    {
        $this->render_view('finance/production/Sachet_impression');
    }
    public function Sachet_coupe()
    {
        $this->render_view('finance/production/Sachet_coupe');
    }

    function test_valeur($valeur)
    {
        return  $valeur == null ? 0 : $valeur;
    }

}
