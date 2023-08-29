<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Commercial extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
    $this->load->model('prix_appiquer');
    $this->load->model('commande');
    $this->load->model('livraison');
  }
  public function index()
  {
    $this->render_view('commercial/accueil');
  }
  public function bon_sachets()
  {
    $ref_num = $this->commande->last_pe_commande();
    $refnum_po = "PE";
    $ref_num != "" ? $refnum_po .= $ref_num->ID + 1 : $refnum_po .= 1;
    $data = [
      "num_po" => $refnum_po,
      'type' => $this->commande->type(),
      'type_de_matier' => $this->commande->type_de_matier()
    ];

    $this->render_view('commercial/BonDeCommande/Bon_de_commande', $data);
  }
  public function disable_old_refnum_po($type_po = null, $type = null)
  {
    $methode_ok = false;
    if ($type_po == "CMTI I") {
      switch ($type) {
        case 'PP':
          $methode_ok = $this->commande->insert_pe_commande_cmt_pp();
          break;
        case 'PE':
          $methode_ok = $this->commande->insert_pe_commande_cmtpe();
          break;
        case 'P':
          $methode_ok = $this->commande->insert_P_commande_madakem();
          break;
        case 'L':
          $methode_ok = $this->commande->insert_L_commande_madakem();
          break;
        default:
          $methode_ok = $this->commande->insert_pe_commande_cmtpe();
          break;
      }
    } else {
      switch ($type) {
        case 'PP':
          $methode_ok = $this->commande->insert_pp_commande();
          break;
        case 'PE':
          $methode_ok = $this->commande->insert_pe_commande();
          break;
        case 'P':
          $methode_ok = $this->commande->insert_P_commande_madakem();
          break;
        case 'L':
          $methode_ok = $this->commande->insert_L_commande_madakem();
          break;
        default:
          $methode_ok = $this->commande->insert_pe_commande();
          break;
      }
    }
    return $methode_ok;
  }
  public function refnum_bon($type_po = null, $type = null)
  {
    $method_ok = false;

    $method_ok = $type == null && $type_po == null;
    if ($method_ok) {
      $type = $this->input->post('type');
      $type_po = $this->input->post('type_po');
    }
    $refnum_po = 0;
    if ($type_po == "CMTI I") {
      switch ($type) {
        case 'PP':
          $ref_num = $this->commande->last_pe_commande_cmt_pp();
          $ref_num != "" ? $refnum_po .= $ref_num->ID_CMT + 1 : $refnum_po .= 1;
          break;
        case 'PE':
          $ref_num = $this->commande->last_pe_commande_cmtpe();
          $ref_num != "" ? $refnum_po .= $ref_num->CMT_ID + 1 : $refnum_po .= 1;
          break;
        case 'L':
          $ref_num = $this->commande->last_l_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID_PE + 1 : $refnum_po .= 1;
          break;
        case 'P':
          $ref_num = $this->commande->last_p_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID_PE + 1 : $refnum_po .= 1;
          break;
        default:
          $ref_num = $this->commande->last_pe_commande_cmtpe();
          $ref_num != "" ? $refnum_po .= $ref_num->CMT_ID + 1 : $refnum_po .= 1;
          break;
      }
    } else {
      switch ($type) {
        case 'PP':
          $ref_num = $this->commande->last_pp_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->PP_ID + 1 : $refnum_po .= 1;
          break;
        case 'PE':
          $ref_num = $this->commande->last_pe_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID + 1 : $refnum_po .= 1;
          break;
        case 'L':
          $ref_num = $this->commande->last_l_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID_PE + 1 : $refnum_po .= 1;
          break;
        case 'P':
          $ref_num = $this->commande->last_p_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID_PE + 1 : $refnum_po .= 1;
          break;
        default:
          $ref_num = $this->commande->last_pe_commande();
          $ref_num != "" ? $refnum_po .= $ref_num->ID + 1 : $refnum_po .= 1;
          break;
      }
    }
    if ($method_ok) {
      echo json_encode((int)$refnum_po);
    } else {
      return (int)$refnum_po;
    }
  }

  public function printFacture()
  {

    isset($_GET['po']) && !empty($_GET['po']) ?   $refnum_pe = $_GET['po'] : $refnum_pe = $this->input->post('PO');
    $data = $this->commande->select_commande(['BC_PE' => $refnum_pe]);
    $html =  $this->load->view('global/print/print_commande', ["data" => $data], true);
    $filename = "BON DE COMMANDE $data->BC_ID";
    $dompdf = new pdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename);
  }



  public function sauve_commande_sachet()
  {
    $content = json_decode($this->input->post('content'));
    $refnum_commande = 0;
    $method_ok = false;
    $data = [
      "BC_PE" => $content[13],
      "BC_DATE" => date('Y-m-d'),
      "BC_CLIENT" => $content[14],
      "BC_CODE" => $content[15],
      "BC_DATELIVRE" => $content[16],
      "BC_REASSORT" => $content[9],
      "BC_ECHANTILLON" => $content[10],
      "BC_DIMENSION" => $content[11],
      "BC_RABAT" => $content[12],
      "BC_SOUFFLET" => $content[5],
      "BC_PERFORATION" => $content[6],
      "BC_TYPE" => $content[7],
      "BC_IMPRESSION" => $content[8],
      "BC_CYLINDRE" => $content[1],
      "BC_QUNTITE" => $content[2],
      "BC_PRIX" => $content[3],
      "BC_OBSERVATION" => $content[4],
      "BC_COMMERCIAL" => $this->session->userdata('matricule'),
      "BC_STATUT" => "NON PLANIFIER",
      "BC_TYPEPRODUIT" => $content[17],
      "BC_TYPEMATIER" => $content[18],
      "BC_TYPE_PRODUIT" => $content[19],
      "BC_LIEULIVRE " => $content[20],
      "BC_QUANTITEAPRODUIREENMETRE" => $content[23],
      "BC_POIDSDUNSACHET" => $content[24],
      "BC_POISENKGSAVECMARGE" => $content[25],
      "BC_DIMENSIONPROD " => $content[26],
      "BC_TYPE_CLIENT"=>$content[21],
      "BC_ORIGINE" => "PLASMAD"
    ];
    $method_ok = $this->commande->insert_commande($data);
    if ($method_ok) {
      $prix_appliquer = $this->commande->select_prix_appliquer(["PA_STATUT" => "actif"]);
      if ($prix_appliquer) {

        $datas = [
          "PB_PO" => $content[13],
          "PB_PRIX" => $content[22],
          "PB_TYPE_CALCULE" => $content[19],
          "PB_DATE" => date('Y-m-d'),
          "PB_PRIX_ARIARY" => $content[28],
          "PB_VITESSE_MACHINE" => $content[39],
          "PB_WIDTH" => $content[29],
          "PB_LENGTH" => $content[30],
          "PB_THICKNESS" => $content[31],
          "PB_FLAP" => $content[32],
          "PB_GUSSET" => $content[33],
          "PB_ORDER" => $content[34],
          "PB_MARGE" => $content[35],
          "PB_PRINTING_AREA" => $content[36],
          "PB_PRIX_MATIER" => $content[37],
          "PB_MARGES" => $content[38],
          "PB_SANS_MARGE" => $content[40],
          "PB_EURO" => $content[41],
          "PB_MARGE_REEL" => $content[42],
          "PB_ID_HM" => $prix_appliquer->PA_ID,
          "BC_ORIGIN" => "PLASMAD"
        ];
        $method_ok = $this->commande->insert_prix_commande($datas);
      }
    }


    if ($method_ok) {
      $method_ok = $this->disable_old_refnum_po($content[21], $content[18]);
    }
    if ($method_ok) {
      $refnum_commande =  $this->refnum_bon($content[21], $content[18]);
    }

    echo json_encode(array("messsage" => $method_ok, "refnum_commande" => $refnum_commande));
  }
  public function upadate_commande()
  {
    $content = json_decode($this->input->post('content'));
    $data = [
      "BC_CLIENT" => $content[14],
      "BC_CODE" => $content[15],
      "BC_DATELIVRE" => $content[16],
      "BC_REASSORT" => $content[9],
      "BC_ECHANTILLON" => $content[10],
      "BC_DIMENSION" => $content[11],
      "BC_RABAT" => $content[12],
      "BC_SOUFFLET" => $content[5],
      "BC_PERFORATION" => $content[6],
      "BC_TYPE" => $content[7],
      "BC_IMPRESSION" => $content[8],
      "BC_CYLINDRE" => $content[1],
      "BC_QUNTITE" => $content[2],
      "BC_OBSERVATION" => $content[4],
      "BC_TYPEPRODUIT" => $content[17],
      "BC_TYPEMATIER" => $content[18]
    ];

    echo $this->commande->update_commande(["BC_PE" => $content[13]], $data);
  }

  public function recherche_commande_specifique($anne = null, $mois = null, $debut = null, $fin = null)
  {

    $data = array();
    $datas = array();
    $method_ok = false;

    $method_ok = ($debut != "" && $fin != "");
    if ($method_ok) {
      $requette = "BC_COMMERCIAL like '" . $this->session->userdata('matricule') . "' AND  BC_DATE between '" . $debut . "' AND '" . $fin . "'";
      $datas = $this->commande->select_commande_all($requette);
      if (!$datas) {
        $method_ok = false;
      }
    }

    if (!$method_ok) {
      $method_ok = $anne != null;

      if ($method_ok) {
        $mois < 10 ? $moisx = '0' . $mois :  $moisx = $mois;
        $requette = "'BC_COMMERCIAL' ='" . $this->session->userdata('matricule') . "' AND 'BC_DATE' like '" . $anne . "-" . $moisx . "%'";
        $datas = $this->commande->select_commande_all($requette);
        if (!$datas) {
          $method_ok = false;
        }
      }
    }

    if (!$method_ok) {
      $requette = [
        'BC_COMMERCIAL' => $this->session->userdata('matricule'),
      ];
      $datas = $this->commande->select_commande_all($requette);
    }


    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_DATE;
      $sub_array[] = $row->BC_CLIENT;
      $sub_array[] = $row->BC_DIMENSION;
      if ($row->BC_OBSERVATION == "") {
        $sub_array[] = '<a href="#" class="btn btn-warning lire-obse">Pas d\'observation</a>';
      } else {
        $sub_array[] = '<a href="#" class="btn btn-success lire-obse" id="' . $row->BC_PE . '">Lire observation</a>';  //$row->BC_OBSERVATION;
      }
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $sub_array[] = $row->BC_STATUT;

      $sub_array[] =
        '<a href="#" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
			 <a href="#" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function Suivie_commande()
  {
    $this->render_view('commercial/BonDeCommande/Suivie_commande');
  }

  public function calendrier_livraison_commande()
  {

    $date = $this->input->post('date');
    if (empty($date)) {
      $date = date('Y-m-d');
    }
    $donne = array();
    $datas = $this->livraison->get_date_livraison_join_commande(['DL_DATE' => $date]);
    foreach ($datas as $key => $datas) {
      if (array_key_exists($datas->BC_LIEULIVRE, $donne)) {
        $donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
      } else {
        $donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
      }
    }

    $this->load->view('Commercial/Calendrier/liste_des_livraison', ["data" => $donne]);
  }
  public function export_date_livraison()
  {

    $date = $this->input->post('date');

    if (empty($date)) {
      $date = date('Y-m-d');
    }

    $donne = array();
    $datas = $this->livraison->get_date_livraison_join_commande(['DL_DATE' => $date]);
    foreach ($datas as $key => $datas) {
      if (array_key_exists($datas->BC_LIEULIVRE, $donne)) {
        $donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
      } else {
        $donne[$datas->BC_LIEULIVRE][$datas->BC_PE] = $datas;
      }
    }
    $html = "";
    $excel = "LIVRAISON DU : $date\n\n";
    foreach ($donne as $key => $donne) {
      $excel .= "$key\t\t\tQUANTITE\tPOIDS(KGS)\n";
      foreach ($donne as $valeur) {
        $excel .= "$valeur->BC_PE\t$valeur->BC_CODE\t$valeur->BC_DIMENSION\t$valeur->BC_QUNTITE\t$valeur->BC_POISENKGSAVECMARGE\n";
      }
    }

    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=Liste des livraisons du : " . $date . ".xls");

    print $excel;
    exit;
  }

  public function autocomplet_commande()
  {
    $mot = $this->input->get('term');
    $data = $this->commande->select_commande_all("BC_PE like '%$mot%' LIMIT 10");
    $reponse = array();
    foreach ($data as $key => $data) {
      $reponse[] = $data->BC_PE;
    }
    echo json_encode($reponse);
  }
  public function liste_suivie_commande()
  {


    $data = array();
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $refnum_commande = $this->input->get('refnum_commande');
    $client = $this->input->get('client');

    if (!empty($refnum_commande)) {
      $datas = $this->commande->select_commande_all(["BC_PE" => $refnum_commande, "BC_COMMERCIAL" => $this->session->userdata('matricule')]);
    } else if (!empty($client)) {
      $datas = $this->commande->select_commande_all(["BC_CODE" => $client, "BC_COMMERCIAL" => $this->session->userdata('matricule')]);
    } else if (!empty($debut) && !empty($fin)) {
      $datas = $this->commande->select_commande_all("(BC_DATE BETWEEN '$debut' AND '$fin') AND BC_COMMERCIAL like '" . $this->session->userdata('matricule') . "'");
    } else if (!empty($client)) {
      $datas = $this->commande->select_commande_all(["BC_CODE" => $client, "BC_COMMERCIAL" => $this->session->userdata('matricule')]);
    } else {
      $date = date('Y-m');
      $datas = $this->commande->select_commande_all("BC_DATE like  '$date%'  AND BC_COMMERCIAL like '" . $this->session->userdata('matricule') . "'");
    }

    foreach ($datas as $row) {
      $sub_array = array();

      $reponse = $this->rapport->get_rapport_de_commande(["RP_PO" => $row->BC_PE]);
      $sub_array[] = $row->BC_CLIENT;
      $sub_array[] = $row->BC_DATE;
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_STATUT;
      $sub_array[] = $row->BC_CODE;
      $sub_array[] = $row->BC_DIMENSION;
      $sub_array[] = $row->BC_QUNTITE;
      $sub_array[] = $row->BC_DATELIVRE;
      $dateLivre =  $this->livraison->get_date_livraison_all(['DL_PO' => $row->BC_PE]);
      $ddL = "";
      $var = 0;
      $replivre = "";
      foreach ($dateLivre as $key => $dateLivre) {
        if ($var == 0) {
          $ddL .= $dateLivre->DL_DATE;
          $var = 1;
        } else {
          $ddL .= "/" . $dateLivre->DL_DATE;
        }
        $replivre .= $dateLivre->DL_DATE . " / ";
      }
      $sub_array[] = $ddL;
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $livre = 0;
      $dataSortie = array();

      if ($dataSortie) {
        foreach ($dataSortie as $key => $dataSortie) {
          $qtt =  $dataSortie->EF_QUANTITE;
          $livre = trim($qtt);
        }
      }
      $sub_array[] = $livre;
      if ($reponse) {
        $sub_array[] = $reponse->Actual_Delivered_Date;
      } else {
        $sub_array[] = "";
      }
      if ($reponse) {
        $sub_array[] = $reponse->Delivered_qty;
      } else {
        $sub_array[] = "";
      }

      $sub_array[] = "";
      $sub_array[] = $row->BC_PRIX;
      $prix = explode(" ", $row->BC_PRIX);
      $prixs = 0;
      if (is_array($prix)) {
        $quatite = explode(" ", $row->BC_QUNTITE);
        if (is_array($quatite)) {
          $sub_array[] = trim((float)$prix[0]) * (float)$quatite[0];
          $prixs = trim((float)$prix[0]);
        } else {
          $sub_array[] = $prix[0] * $row->BC_QUNTITE;
          $prixs = $prix[0];
        }
      } else {
        $quatite = explode(" ", $row->BC_QUNTITE);
        if (is_array($quatite)) {
          $sub_array[] =  $row->BC_PRIX * $quatite[0];
          $prixs = $row->BC_PRIX;
        } else {
          $sub_array[] =  $row->BC_PRIX * $row->BC_QUNTITE;
        }
      }
      if ($reponse) {
        $sub_array[] = $reponse->Unit_Price_Euro;
        $sub_array[] = $reponse->Amount_Euro;
        $sub_array[] = $reponse->Production_Lead_time;
        $sub_array[] = $reponse->Variance_Delivery;
        $sub_array[] = $reponse->Varaince_Actual_Dlvry;
        $sub_array[] = $reponse->Amount_Dlvd_USD;
        $sub_array[] =  $reponse->Delivered_qty * $prixs;
        $qtt = explode(" ", $row->BC_QUNTITE);
        $sub_array[] =  number_format((float)$qtt[0] - $reponse->Delivered_qty, 2, ',', ' ');
        $sub_array[] = $reponse->Bal_Amount_USD;
        $sub_array[] = number_format(((float)$qtt[0] - $reponse->Delivered_qty) * $prixs, 2, ',', ' ');
      } else {
        $sub_array[] = "";
        $sub_array[] = "";
        $sub_array[] = "";
        $sub_array[] = "";
        $sub_array[] = "";
        $sub_array[] = "";
        $sub_array[] = "";
        $qtt = explode(" ", $row->BC_QUNTITE);
        $sub_array[] = (float)$qtt[0];
        $sub_array[] = "";
        $sub_array[] = "";
      }

      $sub_array[] =
        '<a href="#" id="' . $row->BC_PE . '"  class="edit_post btn btn-warning btn-sm"><i class="fa fa-edit"></i> Modifier</a>';

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function update_suivie_commande()
  {
    $id = $this->input->post("idModifMod");
    $reponse = $this->rapport->get_rapport_de_commande(["RP_PO" => $id]);
    if ($reponse) {
      $item = $this->input->post("itemModif");
      $valeur = $this->input->post("valeurModif");
      $first = str_replace(" ", "_", $item);
      $second = str_replace("-", "_", $first);
      $last = str_replace("_(day)", "", $second);
      if ($item == "Actual Delivered Date") {
        $key = trim($last);
        $valeur = $reponse->$key . "/" . $this->input->post("valeurModif");
        return $this->rapport->update_rapport_de_commande(["RP_PO" => $id], [trim($last) => $valeur]);
      } else {
        return $this->rapport->update_rapport_de_commande(["RP_PO" => $id], [trim($last) => $valeur]);
      }
    } else {
      $item = $this->input->post("itemModif");
      $valeur = $this->input->post("valeurModif");
      $first = str_replace(" ", "_", $item);
      $second = str_replace("-", "_", $first);
      $last = str_replace("(day)", "", $second);
      $second;
      return $this->rapport->insert_rapport_de_commande([trim($last) => $valeur, "RP_PO" => $id]);
    }
  }
  public function export_rapport_de_commande()
  {


    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $po = $this->input->get('po');
    $client = $this->input->get('client');
    if (!empty($po)) {
      $datas = $this->commande->select_commande_all(["BC_PE" => $po, "BC_COMMERCIAL" => $this->session->userdata('matricule')]);
    } else if (!empty($client)) {
      $datas = $this->commande->select_commande_all(["BC_CODE" => $client, "BC_COMMERCIAL" => $this->session->userdata('matricule')]);
    } else if (!empty($debut) && !empty($fin)) {

      $datas = $this->commande->select_commande_all("(BC_DATE BETWEEN '$debut' AND '$fin') AND BC_COMMERCIAL like '" . $this->session->userdata('matricule') . "'");
    } else {
      $date = date('Y-m');
      $datas = $this->commande->select_commande_all("BC_DATE like  '$date%'  AND BC_COMMERCIAL like '" . $this->session->userdata('matricule') . "'");
    }
    $excel = "REFERENCE CLIENT\tPO Date \tPlasmad PO No.\tSTATUS\tCustomer\tDimensions\tOrder Quantity\tRequired Delivery Date\tConfirmed Delivery Date\tDescription XIT\tDelivered qty\tActual Delivered Date\tDelivery Month\tCfmd Delivery Week\tUnit Price USD\tAmount USD\tUnit Price Euro\tAmount Euro\tProduction Lead-time (day)\tVariance Delivery (day)\tVaraince Actual Dlvry (day)\tAmount-Dlvd USD\tAmount-Dlvd EURO\tBalance to be Dlvd (Qty)\tBal Amount USD\tBal Amount Euro\n";

    foreach ($datas as $row) {


      $reponse = $this->rapport->get_rapport_de_commande(["RP_PO" => $row->BC_PE]);
      $excel .= $row->BC_CLIENT;
      $excel .= "\t" . $row->BC_DATE;
      $excel .= "\t" . $row->BC_PE;
      $excel .= "\t" . $row->BC_STATUT;
      $excel .= "\t" . $row->BC_CODE;
      $excel .= "\t" . $row->BC_DIMENSION;
      $excel .= "\t" . $row->BC_QUNTITE;
      $excel .= "\t" . $row->BC_DATELIVRE;
      $dateLivre =  $this->livraison->get_date_livraison_all(['DL_PO' => $row->BC_PE]);
      $ddL = "";
      $var = 0;
      $replivre = "";
      foreach ($dateLivre as $key => $dateLivre) {
        $replivre .= $dateLivre->DL_DATE . " / ";
        if ($var == 0) {
          $ddL .= $dateLivre->DL_DATE;
          $var = 1;
        } else {
          $ddL .= "/" . $dateLivre->DL_DATE;
        }
      }
      $excel .= "\t" . $ddL;
      $excel .= "\t" . $row->BC_TYPEPRODUIT;
      $livre = 0;
      $dataSortie = array();

      if ($dataSortie) {
        foreach ($dataSortie as $key => $dataSortie) {
          $qtt =  $dataSortie->EF_QUANTITE;
          $livre = trim($qtt);
        }
      }
      $excel .= "\t" . $livre;


      if ($reponse) {
        $excel .= "\t" . $reponse->Actual_Delivered_Date;
      } else {
        $excel .= "\t";
      }
      if ($reponse) {
        $excel .= "\t" . $reponse->Delivered_qty;
      } else {
        $excel .= "\t";
      }

      $sub_array[] = "";
      $sub_array[] = $row->BC_PRIX;
      $prix = explode(" ", $row->BC_PRIX);
      $prixs = 0;
      if (is_array($prix)) {
        $quatite = explode(" ", $row->BC_QUNTITE);
        if (is_array($quatite)) {
          $excel .= "\t" . trim((float)$prix[0]) * (float)$quatite[0];
          $prixs = trim((float)$prix[0]);
        } else {
          $excel .= "\t" . $prix[0] * $row->BC_QUNTITE;
          $prixs = $prix[0];
        }
      } else {
        $quatite = explode(" ", $row->BC_QUNTITE);
        if (is_array($quatite)) {
          $excel .= "\t" .  $row->BC_PRIX * $quatite[0];
          $prixs = $row->BC_PRIX;
        } else {
          $excel .= "\t" . $row->BC_PRIX * $row->BC_QUNTITE;
        }
      }
      if ($reponse) {
        $excel .= "\t" . $reponse->Unit_Price_Euro;
        $excel .= "\t" . $reponse->Amount_Euro;
        $excel .= "\t" . $reponse->Production_Lead_time;
        $excel .= "\t" . $reponse->Variance_Delivery;
        $excel .= "\t" . $reponse->Varaince_Actual_Dlvry;
        $excel .= "\t" . $reponse->Amount_Dlvd_USD;
        $excel .= "\t" . $reponse->Delivered_qty * $prixs;
        $qtt = explode(" ", $row->BC_QUNTITE);
        $excel .= "\t" . number_format((float)$qtt[0] - $reponse->Delivered_qty, 2, ',', ' ');
        $excel .= "\t" . $reponse->Bal_Amount_USD;
        $excel .= "\t" . number_format(((float)$qtt[0] - $reponse->Delivered_qty) * $prixs, 2, ',', ' ');
      } else {
        $excel .= "\t";
        $excel .= "\t";
        $excel .= "\t";
        $excel .= "\t";
        $excel .= "\t";
        $excel .= "\t";
        $excel .= "\t";
        $qtt = explode(" ", $row->BC_QUNTITE);
        $excel .= "\t" . (float)$qtt[0];
        $excel .= "\t";
        $excel .= "\t";
      }

      $excel .= "\n";
    }
    header("Content-type: application/vnd.ms-excel");
    header("Content-disposition: attachment; filename=suivi commande : " . date('d-m-Y') . ".xls");

    print $excel;
    exit;
  }

  public function calculePrixCommande()
  {

    $parametrePrix = $this->prix_appiquer->get_prix_appliquer(["PA_STATUT" => "actif"]);
    $resultatPrix = array("prix" => 0, "marge" => 0, "total" => 0);
    $width = $this->input->post('width');
    $length = $this->input->post('length');
    $tickness = $this->input->post('thickness');
    $flat = $this->input->post('Flap');
    $gusset = $this->input->post('Gusset');
    $order = $this->input->post('Order');
    if ($this->input->post('marge') == "") {
      $porcent = 0;
    } else {
      $porcent = $this->input->post('marge');
    }
    $marge = $this->input->post('marges');

    $Prix_matier = $this->input->post('Prix_matier');
    $VitesseMachine = $this->input->post('VitesseMachine');
    $Printing_area = $this->input->post('Printing_area');
    $parametre = $this->input->post('parametre');
    switch ($parametre) {
      case '1':
        $rollDim = $width;
        $wt = (($rollDim * 1000 * $tickness * 2 * 0.923) / 1000) / 1000;
        $row = $order;
        $marielYeild = (($rollDim * 1000 * $tickness * 2 * 0.923) / 1000) / 1000;
        $totalYeild = $row / $marielYeild;
        $totalMat = $row + ($row * $marge / (100));
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $liknColor = (0.000222 * $Printing_area * $totalYeild * 0.001 * 3) * 5;

        $liknColor1 = (0.000222 * $Printing_area * $totalYeild * 0.001 * 3) * 5;


        $solvant = ((0.002 / 0.75) * $Printing_area * $totalYeild * 0.001) * 2.5;
        $printMc = ($totalMat / 25) * 0.910;
        $printPow = (($totalMat / 25) * 2) * 0.470;
        $Pover = $totalMat * 0.403;

        $totalBE = $Pover + $printPow + $printMc + $solvant + $modEXT + $hmachineEXT + $total + $liknColor1 + $liknColor;
        $prix = $totalBE / $order;
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = $prixmarge + $prix;
        break;


      case '2':

        $rollDim = $width + ($gusset * 2);
        $wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;

        $total = $totalMat * $Prix_matier;
        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $hmachineCoupe = 40 * 0.136;
        $modeCoupe = (40 * 2) * 0.5;
        $Pover = $totalMat * 0.403;
        $totalBE = $Pover + $modeCoupe + $hmachineCoupe + $modEXT + $hmachineEXT + $total;
        $prix = $totalBE / $order;
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '3':

        $rollDim = $width;
        $wt = ($rollDim * 1000 * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $row / $marielYeild;
        $total = $totalMat * $Prix_matier;
        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $Pover = $row * 0.403;

        $totalBE = $Pover + $modEXT + $hmachineEXT + $total;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '4':
        $rollDim = $width + $gusset;
        $wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $hmachin = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;

        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $Pover + $modeCoupe + $hmachin + $modEXT + $hmachineEXT + $total;


        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);
        break;
      case '5':
        $rollDim = $width + $gusset;
        $wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

        $machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
        $modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;

        $machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;

        $solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;
        $enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;

        $Pover = $totalMat * 0.403;
        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '6':
        $rollDim = $width + $gusset;
        $wt = ($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;
        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
        $solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

        $machinPrint =  ($totalYeild / 2000) * $parametrePrix->H_MACHINE_IMPR;
        $modPrint =  (($totalYeild / 2000)) * $parametrePrix->H_MOD_IMPR;
        $machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '7':



        $rollDim = $length + $flat / 2 + $gusset;
        $wt = ($rollDim * $width * $tickness * 2 * 0.923) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

        $enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
        $solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

        $machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
        $modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;
        $sealing = $totalYeild * 0.0045;
        $machinecoupe = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover + $sealing;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '8':



        $rollDim = $length + $flat / 2 + $gusset;
        $wt = ($rollDim * $width * $tickness * 2 * 0.9) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.9 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

        $sealing = $totalYeild * 0.0045;
        $machinecoupe = (($order * 12) / 15000) *  $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinecoupe + $Pover + $sealing;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;

      case '9':
        $rollDim = $length + $flat / 2 + $gusset;
        $wt = ($rollDim * $width * $tickness * 2 * 0.9) / 1000 / 1000;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.9 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;

        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;

        $enrenoir = (0.000222 * $Printing_area * $order * 0.001) * 5;
        $solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

        $machinPrint =  ($totalMat / 25) * $parametrePrix->H_MACHINE_IMPR;
        $modPrint =  (($totalMat / 25) * 2) * $parametrePrix->H_MOD_IMPR;



        $sealing = $totalYeild * 0.0045;

        $machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinecoupe + $Pover + $sealing + $machinPrint + $modPrint + $solvant + $enrenoir;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      case '10':
        $rollDim = $width + $gusset;
        $wt = (($rollDim * $length * $tickness * 2 * 0.923) / 1000 / 1000) / 2;
        $row = $order * $wt;
        $marielYeild = $rollDim * 1000 * $tickness * 2 * 0.923 / 1000 / 1000;
        $totalMat = $row + ($row * $marge / (100));
        $totalYeild = $totalMat / $marielYeild;
        $total = $totalMat * $Prix_matier;
        $hmachineEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MACHINE_EXTR;
        $modEXT = ($totalMat / $VitesseMachine) * $parametrePrix->H_MOD_EXTR;
        $enrenoir = (0.000222 * $order * $Printing_area * 0.001) * 5;
        $solvant = ((0.002 / 0.75) * $Printing_area * $order * 0.001) * 2.590;

        $machinPrint =  ($totalYeild / 2000) * $parametrePrix->H_MACHINE_IMPR;
        $modPrint =  (($totalYeild / 2000)) * $parametrePrix->H_MOD_IMPR;
        $machinecoupe = (($order * 12) / 15000) * $parametrePrix->H_MACHINE_COUPE;
        $modeCoupe = ((($order * 12) / 15000) * 2) * $parametrePrix->H_MOD_COUPE;
        $Pover = $totalMat * 0.403;

        $totalBE = $total + $modEXT + $hmachineEXT + $modeCoupe + $machinPrint + $modPrint + $machinecoupe + $solvant + $enrenoir + $Pover;
        $prix = number_format($totalBE / $order, 4);
        $prixmarge = ($prix * $porcent) / 100;
        $prixavemarge = number_format($prixmarge + $prix, 4);

        break;
      default:
        $totalBE = 0;
        $prix = number_format(0, 4);
        $prixmarge = 0;
        $prixavemarge = number_format(0, 4);
        break;
    }
    $resultatPrix['prix'] = number_format($prix, '4');
    $resultatPrix['marge'] = number_format($prixmarge, '4');
    $resultatPrix['total'] = number_format($prixavemarge, '4');
    $resultatPrix['rollDim'] = number_format($rollDim, '4');
    $resultatPrix['totalMat'] = number_format($totalMat, '4');
    $resultatPrix['totalYeild'] = number_format($totalYeild, '4');
    $resultatPrix['wt'] = number_format($wt, '4');

    echo json_encode($resultatPrix);
  }
  public function Pre_costing()
  {
    $this->render_view('commercial/PreCosting/index');
  }
  public function bon_cintre()
  {
    $this->render_view('commercial/BonDeCommande/Bon_de_commande_centre');
  }

  public function refnum_Bon_de_commande_Cintre()
  {
    $type = $this->input->post('type');
    if ($type == "") {
      $type = "EPZ";
    }

    $refnum = "";
    if ($type == "CMTI") {

      $refnum_data = $this->commande->get_last_refnum_cintre_cmti();
      !empty($refnum_data) ? $refnum = $refnum_data->ID + 1 : $refnum = 1;
    } else {
      $refnum_data = $this->commande->get_last_refnum_cintre_epz();
      !empty($refnum_data) ? $refnum = $refnum_data->ID + 1 : $refnum = 1;
    }
    echo json_encode($refnum);
  }
  public function save_commande_cintre()
  {
    $methode_ok = false;
    $BC_DATE = $this->input->post('BC_DATE');
    $dt = new dateTime($BC_DATE);
    $BC_DATE = $dt->format('Y-m-d');
    // $this->input->post('BC_DATE');
    $BC_TYPEPO = $this->input->post('BC_TYPEPO');
    $BC_PE = $this->input->post('BC_PE');
    $BC_TYPEPRODUIT = $this->input->post('BC_TYPEPRODUIT');
    $BC_CLIENT = $this->input->post('BC_CLIENT');
    $BC_CODE = $this->input->post('BC_CODE');
    $BC_DATELIVRE = $this->input->post('BC_DATELIVRE');
    $dt = new dateTime($BC_DATELIVRE);
    $BC_DATELIVRE = $dt->format('Y-m-d');
    $BC_LIEU = $this->input->post('BC_LIEU');
    $BC_TYPE_PRODUIT = $this->input->post('BC_TYPE_PRODUIT');
    $BC_MODEL = $this->input->post('BC_MODEL');
    $BC_COULEUR = $this->input->post('BC_COULEUR');
    $BC_QUNTITE = $this->input->post('BC_QUNTITE');
    $BC_OBSERVATION = $this->input->post('BC_OBSERVATION');
    $BC_CON_PRIX = $this->input->post('BC_CON_PRIX');
    $data = [
      "BC_DATE" => $BC_DATE,
      "BC_PE" => $BC_PE,
      "BC_TYPEPRODUIT" => $BC_TYPEPRODUIT,
      "BC_CLIENT" => $BC_CLIENT,
      "BC_CODE" => $BC_CODE,
      "BC_DATELIVRE" => $BC_DATELIVRE,
      "BC_LIEULIVRE" => $BC_LIEU,
      "BC_MODEL" => $BC_MODEL,
      "BC_IMPRESSION" => $BC_COULEUR,
      "BC_QUNTITE" => $BC_QUNTITE,
      "BC_OBSERVATION" => $BC_OBSERVATION,
      "BC_PRIX" => $BC_CON_PRIX,
      "BC_COMMERCIAL" => $this->session->userdata('matricule'),
      "BC_STATUT" => "NON PLANIFIER",
    ];

    $methode_ok = $this->commande->insert_commande($data);

    if ($methode_ok) {
      if ($BC_TYPEPO == "EPZ") {
        $this->commande->insert_refnum_cintre_epz(["STATUT" => "off"]);
      } else {
        $this->commande->insert_refnum_cintre_cmti(["STATUT" => "off"]);
      }
    }

    echo  json_encode($methode_ok);
  }
  public function print_bon_commande_cintre()
  {
    if (isset($_GET['refnum']) && !empty($_GET['refnum'])) {
      $BC_PO = $this->input->get('refnum');
    } else {
      $BC_PO = $this->input->post('refnum');
    }
    $data = $this->commande->select_commande(['BC_PE' => $BC_PO]);
    $html =  $this->load->view('global/print/print_commande_cintre', ["data" => $data], true);
    $filename = "BON DE COMMANDE $data->BC_ID";
    $dompdf = new pdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename);
  }
  public function Liste_commande_sachets()
  {
    $data = [
      'annee' => $this->get_years(),
      'type' => $this->commande->type(),
      'type_de_matier' => $this->commande->type_de_matier()
    ];

    $this->render_view('commercial/BonDeCommande/Liste_commande_sachets', $data);
  }
  public function Liste_commande_cintre()
  {
    $data = [
      'annee' => $this->get_years(),
      'type' => $this->commande->type(),
      'type_de_matier' => $this->commande->type_de_matier()
    ];
    $this->render_view('commercial/BonDeCommande/Liste_commande_cintre', $data);
  }
  public function Calendrier_de_livraison()
  {
    $data = ["data" => array()];
    $this->render_view('commercial/Calendrier/Calendrier_de_livraison', $data);
  }
  public function Stock_Produit_fini()
  {
    $this->render_view('commercial/Stock/Stock_Produit_fini');
  }
  public function Stock_surplus()
  {
    $this->render_view('commercial/Stock/Stock_surplus');
  }
  public function stock_surplus_data_list()
  {
    $dateDebut = $this->input->post('dateDebut');
    $dateFin = $this->input->post('dateFin');
    if (!empty($dateDebut) && !empty($dateFin)) {
      $datas = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis(("STF_ORIGIN='PLASMAD_STOCK' AND STF_DATE BETWEEN $dateDebut AND $dateFin"));
    } else {
      //$date = date('Y-m');
      $datas = $this->stock_surplus_produit_finis->get_stock_surplus_produit_finis(("STF_ORIGIN='PLASMAD_STOCK'"));
    }

    $data = array();
    foreach ($datas as $row) {
      if ($row->STF_QUANTITE != 0) {
        $sub_array = array();
        $date = new DateTime($row->STF_DATE);
        $sub_array[] = $date->format('d-m-Y');
        $sub_array[] = $row->BC_ID;
        $sub_array[] = $row->STF_CLIENT;
        $sub_array[] = $row->STF_DIM;
        $sub_array[] = $row->STF_TAIL;
        $sub_array[] = $row->STF_QUANTITE;
        $refnum = $this->commande->select_commande(['BC_PE' => $row->BC_ID]);
        $refnum ? $sub_array[]  = $refnum->BC_PRIX : $sub_array[] = 0;
        $sub_array[] = $row->STF_LOCALISATION;
        $sub_array[] = "<a href='$row->BC_ID' class='btn btn-info infoProduit btn-sm'><i class='fa fa-info'><i/></a>";
        $data[] = $sub_array;
      }
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function autocomplet_client_commande()
  {
    $mot = $this->input->get('term');
    $resultat = array();
    $data = $this->commande->select_commande_all(" BC_CODE like '%$mot%' GROUP BY BC_CODE  LIMIT 10");
    foreach ($data as $key => $data) {
      $resultat[] = $data->BC_CODE;
    }
    echo json_encode($resultat);
  }

  public function get_data_pre_costing()
  {

    $datas = $this->prix_commande->get_prix_commande(array());

    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->PB_DATE;
      $sub_array[] = $row->PB_PO;
      $sub_array[] = $row->PB_TYPE_CALCULE;
      $sub_array[] = $row->PB_WIDTH;
      $sub_array[] = $row->PB_LENGTH;
      $sub_array[] = $row->PB_THICKNESS;
      $sub_array[] = $row->PB_FLAP;
      $sub_array[] = $row->PB_GUSSET;
      $sub_array[] = $row->PB_ORDER;
      $sub_array[] = $row->PB_MARGE;
      $sub_array[] = $row->PB_PRINTING_AREA;
      $sub_array[] = $row->PB_PRIX_MATIER;
      $sub_array[] = $row->PB_VITESSE_MACHINE;
      $sub_array[] = $row->PB_PRIX_ARIARY;
      $sub_array[] = $row->PB_EURO;
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }


  public function Stock_matiere_premiere()
  {
    $this->render_view('commercial/Stock/Stock_matiere_premiere');
  }

  public function matiere_liste_Data()
  {

    $datas = $this->stock_matier_premier->get_stock_matier_premier(["ST_ORIGIN" => "PLASMAD_MAGASIN"]);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->ST_DESIGNATION;
      $sub_array[] = $row->ST_QUANTITE;
      $sub_array[] = $row->ST_UNITE;
      $sub_array[] = $row->ST_PRIX_UNITAIRE;
      $sub_array[] = "<a href='#' class='btn btn-info btn-sm info' id=' $row->ST_ID'><i class='fa fa-info'></i></a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function get_observation()
  {
    $ref_num = $this->input->post('po');
    $reponse = $this->commande->select_commande(["BC_PE" => $ref_num]);
    if ($reponse) {
      echo $reponse->BC_OBSERVATION;
    } else {
      echo "Observation  introuvable";
    }
  }
  public function detail_commande()
  {
    $refnum_pe = $this->input->post("refnum_pe");
    $reponse = $this->commande->select_commande(["BC_PE" => $refnum_pe]);
    echo json_encode($reponse);
  }
  public function print_costing()
  {
    $this->load->model("prix_commande");
    if (isset($_GET['refnum']) && !empty($_GET['refnum'])) {
      $BC_PO = $_GET['refnum'];
    } else {
      $BC_PO = $this->input->post('refnum');
    }
    $data = $this->prix_commande->get_detail_prix_commande(['PB_PO' => $BC_PO]);

    $html =  $this->load->view('commercial/PreCosting/print_costing', ["data" => $data], true);
    //echo $html;
    $filename = "PRECOSTING : $data->PB_PO";
    $dompdf = new pdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename);
  }

  public function annule_commande()
  {

    $refnum_pe = $this->input->post("refnum_pe");
    $text = $this->input->post("text");
    $data = [
      "BC_OBJETANNULATION " => $text,
      "BC_STATUT" => "Annulée"
    ];
    echo $this->commande->update_commande(["BC_PE" => $refnum_pe], $data);
  }

  public function liste_commande_sachet()
  {

    $data = array();
    $datas = $this->commande->select_commande_all(['BC_COMMERCIAL' => $this->session->userdata('matricule'), "BC_TYPEPRODUIT" => 'SACHETS']);
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_DATE;
      $sub_array[] = $row->BC_CLIENT;
      $sub_array[] = $row->BC_DIMENSION;
      if ($row->BC_OBSERVATION == "") {
        $sub_array[] = '<a href="#" class="btn btn-warning lire-obse">Pas d\'observation</a>';
      } else {
        $sub_array[] = '<a href="#" class="btn btn-success lire-obse" id="' . $row->BC_PE . '">Lire observation</a>';  //$row->BC_OBSERVATION;
      }
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $sub_array[] = $row->BC_STATUT;

      $sub_array[] =
        '<a href="#" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
            <a href="#" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }


  public function liste_commande_cintre_data()
  {

    $data = array();
    $datas = $this->commande->select_commande_all(['BC_COMMERCIAL' => $this->session->userdata('matricule'), "BC_TYPEPRODUIT" => 'CINTRES']);
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_DATE;
      $sub_array[] = $row->BC_CLIENT;
      if ($row->BC_OBSERVATION == "") {
        $sub_array[] = '<a href="#" class="btn btn-warning lire-obse">Pas d\'observation</a>';
      } else {
        $sub_array[] = '<a href="#" class="btn btn-success lire-obse" id="' . $row->BC_PE . '">Lire observation</a>';  //$row->BC_OBSERVATION;
      }
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $sub_array[] = $row->BC_STATUT;

      $sub_array[] =
        '<a href="#" id="' . $row->BC_PE . '"  class="edit_post btn btn-info btn-sm"><i class="fa fa-info"></i></a>
      <a href="#" id="' . $row->BC_PE . '" class="delete_post btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }


  public function get_years()
  {
    $indate = date('Y');
    $data = array(0 => $indate);
    $i = 1;
    for ($i = 1; $i < 20; $i++) {
      $data[$i] = $indate -  $i;
    }
    return $data;
  }
}
