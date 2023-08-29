<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');
class Controlleur extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pdf');
    $this->load->library('SimpleXLSX');
    $this->load->model('stock_matier_premier');
    $this->load->model('entree_matiere_premiere');
  }
  public function index()
  {
    $this->render_view('controlleur/accueil');
  }
  public function createUser()
  {
    $this->load->model('user_fonction');
    $fonction = $this->user_fonction->get_user_fonction_all();
    $data = ["fonction" => $fonction];
    $this->render_view('controlleur/utilisateur/form_create_user', $data);
  }
  public function Liste_des_matieres_premieres()
  {
    $this->render_view("controlleur/suivi_matiere/Init_stock");
  }
  public function import_files_matiere_premiere_controlleur()
  {

    $data = scandir(FCPATH . 'uploads/excel');
    $uploads_dir = FCPATH . 'uploads/excel';
    $methodOk = false;
    $methodOk = isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"]);
    if ($methodOk) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = basename($_FILES["file"]["name"]);
      if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        if ($xlsx = SimpleXLSX::parse("$uploads_dir/$name")) {

          $header_values = $rows = [];

          foreach ($xlsx->rows() as $k => $r) {
            if ($k === 0) {
              $header_values = $r;
              continue;
            }
            $rows[] = array_combine($header_values, $r);
          }
          foreach ($rows as $rows) {
            $data = "";
            $matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_DESIGNATION" => $rows['ST_DESIGNATION']]);
            $methodOk = $matiere == Null;
            $data = [
              "ST_DESIGNATION" => $rows["ST_DESIGNATION"],
              "ST_QUANTITE" => $rows["ST_QUANTITE"],
              "ST_MATIER_TYPE" => $rows['ST_MATIER_TYPE']

            ];
            if ($methodOk) {
              $methodOk = $this->stock_matier_premier->insert_stock_matier_premier($data);
            } else {
              $methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $matiere->ST_ID], $data);
            }
          }
        }
      }
    }
    echo $methodOk;
  }

  public function create_function_form()
  {
    return $this->load->view("controlleur/utilisateur/form_create_fonction");
  }
  public function Rapport_de_commande()
  {
    $this->render_view('controlleur/commande/rapport');
  }
  public function get_data_rapport_production()
  { 
    $type = $this->input->get('type');
    $methodOk = $type !=null;
   
    if($methodOk){
      $refnum_commande = $this->input->get('refnum');
      $debut = $this->input->get('debut');
      $fin = $this->input->get('fin');
      $type = $this->input->get('type');
    }else{
      $refnum_commande = $this->input->post('refnum');
      $debut = $this->input->post('debut');
      $fin = $this->input->post('fin');
      $type = $this->input->post('type');
    }
   
  
    $date = date('Y-m');
    if (!empty($refnum_commande)) {
      $datas = $this->commande->select_commande_all(["BC_PE" => $refnum_commande, "BC_ORIGINE" => "PLASMAD"]);
    } else if (!empty($debut) && !empty($fin)) {
      $datas = $this->commande->select_commande_all("(BC_DATE BETWEEN '$debut' AND '$fin') AND BC_ORIGINE ='PLASMAD'");
    } else if (!empty($client)) {
      $datas = $this->commande->select_commande_all(["BC_CODE" => $client, "BC_ORIGINE" => "PLASMAD"]);
    } else {

      $datas = $this->commande->select_commande_all("BC_DATE like  '$date%' AND BC_ORIGINE='PLASMAD'");
    }

    $data = [
      "data" => $datas
    ];
 
    
    if($methodOk){

    header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=rapport_sur_commande_".date('Ymd').rand(). " PLASMAD.xls");
		echo $this->load->view('controlleur/commande/data_rapport', $data,true);
    exit;
	
    }
    if(!$methodOk){
      $this->load->view('controlleur/commande/data_rapport', $data);
    }
   
  }

public function print_execl(){
  header('Content-Type: application/vnd.ms-excel');  
  header('Content-disposition: attachment; filename='.date('ymd').rand().'.xls');  
  echo  $this->input->get('data');
}
  public function create_fonction()
  {
    $this->load->model('user_fonction');
    $fact = $this->input->post('fonction');
    $data = ["foct_designation" => $fact];
    echo $this->user_fonction->insert_user_fonction($data);
  }
  public function delete_user()
  {
    $this->load->model("users");
    $refnum = $this->input->post('refnum');
    echo $this->users->delete_utilisateur(["id" => $refnum]);
  }

  public function listUsers()
  {
    $this->render_view('controlleur/utilisateur/form_liste_users');
  }
  public function data_list_users()
  {
    $this->load->model("users");
    $datas = $this->users->get_utilisateur_data();
    $data = array();
    foreach ($datas as $row) {

      $sub_array = array();
      $sub_array[] = $row->matricule;
      $sub_array[] = $row->nom;
      $sub_array[] = $row->prenom;
      $sub_array[] = $row->societe;
      $sub_array[] = $row->fonction_users;
      $sub_array[] = "<a id='$row->id' href='#' class='btn btn-danger user_delete btn-sm'><i class='fa fa-trash'></i>&nbsp;Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function create_user()
  {
    $this->load->model("users");
    $nom = $this->input->post("nom");
    $prenom = $this->input->post("prenom");
    $matricule = $this->input->post("matricule");
    $refnum_fonction = $this->input->post("fonction_users");
    $societe = $this->input->post("societe");
    $fonction = $this->input->post("fonction");
    $data =  [
      "matricule" => $matricule,
      "nom" => $nom,
      "prenom" => $prenom,
      "societe" => $societe,
      "fonction_users" => $fonction,
      "mot_de_passe" => "0000",
      "fonction" => $refnum_fonction,
      "status" => "Actif"
    ];
    echo $this->users->insert_utilisateur($data);
  }
  public function suivie_machine_extrusion()
  {
    $this->load->model('machine');
    $param = [
      "MA_SPECIFIQUE" => "EXTRUSION",
      "MA_STATUT" => "on"
    ];
    $data = [
      "machine" => $this->machine->get_machine($param)
    ];
    $this->render_view("controlleur/suivi_machine/extrusion", $data);
  }
  public function se_to_time($sec)
  {
    return sprintf('%02d:%02d:%02d', floor($sec / 3600), floor($sec / 60 % 60), floor($sec % 60));
  }
  public function time_to_sec($time)
  {
    list($h, $m, $s) = explode(":", $time);

    $seconds = 0;
    $seconds += (intval($h) * 3600);
    $seconds += (intval($m) * 60);
    $seconds += (intval($s));
    return $seconds;
  }
  public function data_suivi_machine_list()
  {
    $this->load->model('global');
    $param = [
      "MA_SPECIFIQUE" => "EXTRUSION",
      "MA_STATUT" => "on"
    ];
    $i = 0;
    $debut = $this->input->get("debut");
    $fin = $this->input->get("fin");
    $data_machine = $this->machine->get_machine($param);

    foreach ($data_machine as  $machine) {
      $sub_array = array();

      if ($debut != "" and $fin != "") {
        $poids = $this->global->get_sum_colum("(EX_DATE BETWEEN '$debut' AND '$fin') AND EX_N_MACH like '$machine->MA_DESIGNATION'", "EX_PDS_SOMME", "sachet_extrusion");
        $deche = $this->global->get_sum_colum("(EX_DATE BETWEEN '$debut' AND '$fin') AND EX_N_MACH like '$machine->MA_DESIGNATION'", "EX_DECHETS", "sachet_extrusion");
        $dure = $this->global->get_somme_time("EX_DUREE", "(EX_DATE BETWEEN '$debut' AND '$fin') AND EX_N_MACH like '$machine->MA_DESIGNATION'", "sachet_extrusion");
      } else if ($debut != "") {
        $poids = $this->global->get_sum_colum(["EX_DATE" => $debut, "EX_N_MACH" => $machine->MA_DESIGNATION], "EX_PDS_SOMME", "sachet_extrusion");
        $deche = $this->global->get_sum_colum(["EX_DATE" => $debut, "EX_N_MACH" => $machine->MA_DESIGNATION], "EX_DECHETS", "sachet_extrusion");
        $dure = $this->global->get_somme_time("EX_DUREE", ["EX_DATE" => $debut, "EX_N_MACH" => $machine->MA_DESIGNATION], "sachet_extrusion");
      } else {
        $debut_show = date("Y-m");
        $poids = $this->global->get_sum_colum("EX_DATE like '$debut_show%' AND EX_N_MACH ='$machine->MA_DESIGNATION'", "EX_PDS_SOMME", "sachet_extrusion");
        $deche = $this->global->get_sum_colum("EX_DATE like '$debut_show%' AND EX_N_MACH ='$machine->MA_DESIGNATION'", "EX_DECHETS", "sachet_extrusion");
        $dure = $this->global->get_somme_time("EX_DUREE", "EX_DATE like '$debut_show%' AND EX_N_MACH ='$machine->MA_DESIGNATION'", "sachet_extrusion");
      }

      if ($poids->EX_PDS_SOMME != 0) {
        $rebut = ($deche->EX_DECHETS * 100) / $poids->EX_PDS_SOMME;
      } else {
        $rebut = 0;
      }
      $i++;
      $sub_array = array();
      $sub_array[] = $machine->MA_DESIGNATION;
      $sub_array[] = $poids->EX_PDS_SOMME != NULL ? $poids->EX_PDS_SOMME : 0;
      $sub_array[] = $deche->EX_DECHETS != NULL ? $deche->EX_DECHETS : 0;
      $sub_array[] = number_format($rebut, '2');
      $sub_array[] = $dure->format_heure != NULL ? $dure->format_heure : "00:00:00";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_suivi_machine_impression_list()
  {
    $this->load->model('global');
    $param = [
      "MA_SPECIFIQUE" => "IMPRESSION_EXTRUSION",
      "MA_STATUT" => "on"
    ];
    $i = 0;
    $debut = $this->input->get("debut");
    $fin = $this->input->get("fin");
    $data_machine = $this->machine->get_machine($param);


    foreach ($data_machine as  $machine) {
      if ($debut != "" and $fin != "") {
        $poids = $this->global->get_sum_colum("(EI_DATE BETWEEN '$debut' AND '$fin') AND EI_MACH like '$machine->MA_DESIGNATION'", "EI_PDS_SOMME", "sachet_impression");
        $deche = $this->global->get_sum_colum("(EI_DATE BETWEEN '$debut' AND '$fin') AND EI_MACH like '$machine->MA_DESIGNATION'", "EI_METRE_SOMME", "sachet_impression");
        $dure = $this->global->get_somme_time("EI_DUREE", "(EI_DATE BETWEEN '$debut' AND '$fin') AND EI_MACH like '$machine->MA_DESIGNATION'", "sachet_impression");
      } else if ($debut != "") {
        $poids = $this->global->get_sum_colum(["EI_DATE" => $debut, "EI_MACH" => $machine->MA_DESIGNATION], "EI_PDS_SOMME", "sachet_impression");
        $deche = $this->global->get_sum_colum(["EI_DATE" => $debut, "EI_MACH" => $machine->MA_DESIGNATION], "EI_METRE_SOMME", "sachet_impression");
        $dure = $this->global->get_somme_time("EI_DUREE", ["EI_DATE" => $debut, "EI_MACH" => $machine->MA_DESIGNATION], "sachet_impression");
      } else {
        $debut_show = date("Y-m");
        $poids = $this->global->get_sum_colum("EI_DATE like '$debut_show%' AND EI_MACH ='$machine->MA_DESIGNATION'", "EI_PDS_SOMME", "sachet_impression");
        $deche = $this->global->get_sum_colum("EI_DATE like '$debut_show%' AND EI_MACH ='$machine->MA_DESIGNATION'", "EI_METRE_SOMME", "sachet_impression");
        $dure = $this->global->get_somme_time("EI_DUREE", "EI_DATE like '$debut_show%' AND EI_MACH ='$machine->MA_DESIGNATION'", "sachet_impression");
      }
      $sub_array = array();
      $sub_array[] = $machine->MA_DESIGNATION;
      $sub_array[] = $poids->EI_PDS_SOMME != NULL ? $poids->EI_PDS_SOMME : 0;
      $sub_array[] = $deche->EI_METRE_SOMME != NULL ? $deche->EI_METRE_SOMME : 0;
      $sub_array[] = $dure->format_heure != NULL ? $dure->format_heure : "00:00:00";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_suivi_machine_coupe_list()
  {
    $this->load->model('global');
    $param = [
      "MA_SPECIFIQUE" => "COUPE_EXTRUSION",
      "MA_STATUT" => "on"
    ];
    $i = 0;
    $debut = $this->input->get("debut");
    $fin = $this->input->get("fin");
    $data_machine = $this->machine->get_machine($param);


    foreach ($data_machine as  $machine) {
      if ($debut != "" and $fin != "") {
        $poids = $this->global->get_sum_colum("(ED_DATE BETWEEN '$debut' AND '$fin') AND ED_MACHINE like '$machine->MA_DESIGNATION'", "ED_PIOD_ENTRE_SOMME", "sachet_coupe");
        $mettrage = $this->global->get_sum_colum("(ED_DATE BETWEEN '$debut' AND '$fin') AND ED_MACHINE like '$machine->MA_DESIGNATION'", "ED_METRAGE_SOMME", "sachet_coupe");
        $dure = $this->global->get_somme_time("ED_DURE", "(ED_DATE BETWEEN '$debut' AND '$fin') AND ED_MACHINE like '$machine->MA_DESIGNATION'", "sachet_coupe");
        $piece = $this->global->get_sum_colum("(ED_DATE BETWEEN '$debut' AND '$fin') AND ED_MACHINE like '$machine->MA_DESIGNATION'", "ED_1ER_CHOIX_SOMME", "sachet_coupe");
        $deche = $this->global->get_sum_colum("(ED_DATE BETWEEN '$debut' AND '$fin') AND ED_MACHINE like '$machine->MA_DESIGNATION'", "ED_DECHE_COUPE", "sachet_coupe");
      } else if ($debut != "") {
        $poids = $this->global->get_sum_colum(["ED_DATE" => $debut, "ED_MACHINE" => $machine->MA_DESIGNATION], "ED_PIOD_ENTRE_SOMME", "sachet_coupe");
        $mettrage = $this->global->get_sum_colum(["ED_DATE" => $debut, "ED_MACHINE" => $machine->MA_DESIGNATION], "ED_METRAGE_SOMME", "sachet_coupe");
        $dure = $this->global->get_somme_time("ED_DURE", ["ED_DATE" => $debut, "ED_MACHINE" => $machine->MA_DESIGNATION], "sachet_coupe");
        $piece = $this->global->get_sum_colum(["ED_DATE" => $debut, "ED_MACHINE" => $machine->MA_DESIGNATION], "ED_1ER_CHOIX_SOMME", "sachet_coupe");
        $deche = $this->global->get_sum_colum(["ED_DATE" => $debut, "ED_MACHINE" => $machine->MA_DESIGNATION], "ED_DECHE_COUPE", "sachet_coupe");
      } else {
        $debut_show = date("Y-m");
        $poids = $this->global->get_sum_colum("ED_DATE like '$debut_show%' AND ED_MACHINE ='$machine->MA_DESIGNATION'", "ED_PIOD_ENTRE_SOMME", "sachet_coupe");
        $mettrage = $this->global->get_sum_colum("ED_DATE like '$debut_show%' AND ED_MACHINE ='$machine->MA_DESIGNATION'", "ED_METRAGE_SOMME", "sachet_coupe");
        $piece = $this->global->get_sum_colum("ED_DATE like '$debut_show%' AND ED_MACHINE ='$machine->MA_DESIGNATION'", "ED_1ER_CHOIX_SOMME", "sachet_coupe");
        $dure = $this->global->get_somme_time("ED_DURE", "ED_DATE like '$debut_show%' AND ED_MACHINE ='$machine->MA_DESIGNATION'", "sachet_coupe");
        $deche = $this->global->get_sum_colum("ED_DATE like '$debut_show%' AND ED_MACHINE ='$machine->MA_DESIGNATION'", "ED_DECHE_COUPE", "sachet_coupe");
      }
      $sub_array = array();
      $sub_array[] = $machine->MA_DESIGNATION;
      $sub_array[] = $poids->ED_PIOD_ENTRE_SOMME != NULL ? $poids->ED_PIOD_ENTRE_SOMME : 0;
      $sub_array[] = $mettrage->ED_METRAGE_SOMME != NULL ? $mettrage->ED_METRAGE_SOMME : 0;
      $sub_array[] = $piece->ED_1ER_CHOIX_SOMME != NULL ? $piece->ED_1ER_CHOIX_SOMME : 0;
      $sub_array[] = $deche->ED_DECHE_COUPE != NULL ? $deche->ED_DECHE_COUPE : 0;
      $sub_array[] = $dure->format_heure != NULL ? $dure->format_heure : "00:00:00";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_list_use_matiere_print()
  {
    $this->load->model("matiere_impression_use");
    $param = array();
    $refnum = $this->input->get("refnum");
    if ($refnum != "") {
      $param = ["MI_PO" => $refnum];
    }
    $datas = $this->matiere_impression_use->get_matiere_impression_use($param);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->MI_DATE;
      $sub_array[] = $row->MI_DESIGNATION;
      $sub_array[] = $row->MI_QUANTITE;
      $sub_array[] = $row->MI_PRIX;
      $sub_array[] = "<a href='#' id='$row->MI_ID' class='btn btn-danger btn-sm delete_Imprim_matiere'><i class='fa fa-trash'></i>&nbsp; Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function statu_commande_data_list()
  {
    $this->load->model("commande");
    $this->load->model("global");
    $debut = $this->input->get('debut');
    $fin  = $this->input->get('fin');

    $data = array();
    if ($debut != "" && $fin != "") {
      $datas = $this->commande->select_commande_all("(BC_DATE BETWEENd '$debut' AND '$fin') ORDER BY BC_DATE ASC");
    } else if ($debut != "") {
      $datas = $this->commande->select_commande_all("BC_DATE = '$debut' ORDER BY BC_DATE ASC");
    } else {
      $debut = date('Y-m');
      $datas = $this->commande->select_commande_all("BC_DATE like '%$debut%' ORDER BY BC_DATE ASC");
    }

    foreach ($datas as $row) {
      $sub_array = array();
      $bg = "bg-danger";
      $porcent_extru = 0;
      $sub_array[] = $row->BC_PE;
      $sub_array[] = $row->BC_TYPEPRODUIT;
      $sub_array[] = $row->BC_DIMENSION;
      $sub_array[] = $row->BC_QUNTITE;
      $sub_array[] = $row->BC_STATUT;
      $poids_net = $this->global->get_sum_colum([" EX_BC_ID" => $row->BC_PE], "EX_PDS_NET", "sachet_extrusion");
      if ($row->BC_POISENKGSAVECMARGE != 0 && $poids_net != null) {
        $porcent_extru = ($poids_net->EX_PDS_NET * 100) / (float)$row->BC_POISENKGSAVECMARGE;
      }
      if ($porcent_extru < 15 and  0 > $porcent_extru) {
        $bg = "bg-warning";
      } else if ($porcent_extru > 14) {
        $bg = "bg-success";
      }
      $sub_array[] = '<div class="progress">
      <div class="progress-bar ' . $bg . '" role="progressbar"
        style="width: ' . number_format($porcent_extru, 2) . '%" aria-valuenow="25"
        aria-valuemin="0" aria-valuemax="100">' . number_format($porcent_extru, 2) . '%</div>
    </div>';


      $poide_impression = $this->global->get_sum_colum(["BC_ID" => $row->BC_PE], "EI_PDS_SOMME", "sachet_impression");
      if ($row->BC_POISENKGSAVECMARGE != 0) {
        $porcent_impression = ($poide_impression->EI_PDS_SOMME * 100) / (float)$row->BC_POISENKGSAVECMARGE;
      }
      if ($porcent_impression < 15 and  0 > $porcent_impression) {
        $bg = "bg-warning";
      } else if ($porcent_impression > 14) {
        $bg = "bg-success";
      }
      $sub_array[] = '<div class="progress">
    <div class="progress-bar ' . $bg . '" role="progressbar"
      style="width: ' . number_format($porcent_impression, 2) . '%" aria-valuenow="25"
      aria-valuemin="0" aria-valuemax="100">' . number_format($porcent_impression, 2) . '%</div>
  </div>';

      $sub_array[] = "TEST";
      $st_produit_fini = $this->global->get_sum_colum(["BC_ID" => $row->BC_PE], "STF_QUANTITE", "stock_produits_finis_plasmad");
      $sub_array[] = $st_produit_fini->STF_QUANTITE;
      $st_surplus = $this->global->get_sum_colum(["BC_ID" => $row->BC_PE], "STF_QUANTITE", "stock_surplus_produit_finis");
      $sub_array[] = $st_surplus->STF_QUANTITE;
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_list_suivi_commande()
  {
    $this->load->model("global");
    $debut = $this->input->get('debut');
    $fin = $this->input->get('fin');
    $datas = array();
    if (!empty($debut)  && !empty($fin)) {
      $datas = $this->commande->select_commande_all("BC_DATE BETWEEN '" . $debut . "' AND '" . $fin . "'");
    } else if (!empty($debut)) {
      $datas = $this->commande->select_commande_all("BC_DATE like '" . $debut . "'");
    } else {
      $datas = $this->commande->select_commande_all("BC_DATE like '" . date('Y-m') . "%'");
    }

    $data = array();
    foreach ($datas as $key => $row) {
      $sub_array = array();

      $poid_net_extrusion = $this->global->get_sum_colum(["EX_BC_ID" => $row->BC_PE], "EX_PDS_NET", "sachet_extrusion");
      $poid_somme_extrusion = $this->global->get_sum_colum(["EX_BC_ID" => $row->BC_PE], "EX_PDS_SOMME", "sachet_extrusion");
      $poid_somme_impression = $this->global->get_sum_colum(["BC_ID" => $row->BC_PE], "EI_PDS_SOMME", "sachet_impression");
      $poid_entre_coupe = $this->global->get_sum_colum(["BC_ID" => $row->BC_PE], "ED_PIOD_ENTRE_SOMME", "sachet_coupe");
      $total_sortie_matiere = $this->global->get_sum_colum(["SM_DESTINATAIRE" => $row->BC_PE], "SM_QUANTITE", "sortie_matiere_premiere");

      $sub_array[] =  $row->BC_PE;
      $sub_array[] =  $row->BC_TYPEPRODUIT;
      $sub_array[] = number_format($total_sortie_matiere->SM_QUANTITE, 2, '.', ' ');
      $sub_array[] = number_format($poid_net_extrusion->EX_PDS_NET, 2, '.', ' ');
      $sub_array[] = number_format($total_sortie_matiere->SM_QUANTITE - $poid_net_extrusion->EX_PDS_NET, 2, '.', ' ');
      $sub_array[] = number_format($poid_somme_extrusion->EX_PDS_SOMME, 2, '.', ' ');
      $sub_array[] = number_format($poid_somme_impression->EI_PDS_SOMME, 2, '.', ' ');
      $sub_array[] = number_format($poid_somme_extrusion->EX_PDS_SOMME - $poid_somme_impression->EI_PDS_SOMME, 2, '.', ' ');
      $sub_array[] = $poid_somme_impression->EI_PDS_SOMME != null && $poid_somme_impression->EI_PDS_SOMME  != 0 ? number_format($poid_somme_impression->EI_PDS_SOMME, 2, '.', ' ') : number_format($poid_somme_extrusion->EX_PDS_SOMME, 2, '.', ' ');
      $sub_array[] = number_format($poid_entre_coupe->ED_PIOD_ENTRE_SOMME, 2, '.', ' ');
      $sub_array[] = $poid_somme_impression->EI_PDS_SOMME != null && $poid_somme_impression->EI_PDS_SOMME  != 0 ? number_format($poid_somme_impression->EI_PDS_SOMME - $poid_entre_coupe->ED_PIOD_ENTRE_SOMME, 2, '.', ' ') : number_format($poid_somme_extrusion->EX_PDS_SOMME - $poid_entre_coupe->ED_PIOD_ENTRE_SOMME, 2, '.', ' ');
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function modif_list_matier_en_attent_de_validation()
  {
     $this->load->model('validation_matiere');
    $this->load->model('matiere_detail_attent_validation');
    $refnum = $this->input->post("refnum");
    $methodOk = false;
    $param = ["STATUT_MAV" => "NON VALIDER"];
    if ($refnum != "") {
      $param = ["STATUT_MAV" => "NON VALIDER", "PO_MAV" => $refnum];
    }
    $datas = $this->validation_matiere->get_validation_matiere($param);
    $data = array();
    foreach ($datas as $row) {
      
        $commande = $this->commande->select_commande(["BC_PE"=>$row->PO_MAV]);
        $methodOk = $commande != null;
        if($methodOk){
          $methodOk =  $commande->BC_ORIGINE =="PLASMAD";
        }
       if($methodOk){
          $sub_array = array();
          $sub_array[] = $row->DATE_MAV;
          $sub_array[] = $row->DEMANDE_MAV;
          $sub_array[] = $row->PO_MAV;
          $sub_array[] = $row->MAC_MAV;
          $sub_array[] = $row->DES_MIAV;
          $sub_array[] = $row->QTT_MIAV;
          $sub_array[] = $row->STATUT_MAV;
          $sub_array[] = '<a id="' . $row->ID_MAV . '" href="#" class="btn btn-primary btn-sm valider"><i class="fa fa-check"></i> Valider</a> &nbsp; <a href="#" id="' . $row->ID_MAV . '" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Supprimer</a>';
          $data[] = $sub_array;
        }
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_list_matier_en_attent_de_validation()
  {
    $this->load->model('validation_matiere');
    $this->load->model('matiere_detail_attent_validation');
    $refnum = $this->input->post("refnum");
    $param = ["STATUT_MAV" => "NON VALIDER"];
    if ($refnum != "") {
      $param = ["STATUT_MAV" => "NON VALIDER", "PO_MAV" => $refnum];
    }
    $datas = $this->validation_matiere->get_validation_matiere($param);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->DATE_MAV;
      $sub_array[] = $row->DEMANDE_MAV;
      $sub_array[] = $row->PO_MAV;
      $sub_array[] = $row->MAC_MAV;
      $sub_array[] = $row->DES_MIAV;
      $sub_array[] = $row->QTT_MIAV;
      $sub_array[] = $row->STATUT_MAV;
      $sub_array[] = '<a id="' . $row->ID_MAV . '" href="#" class="btn btn-primary btn-sm valider"><i class="fa fa-check"></i> Valider</a> &nbsp; <a href="#" id="' . $row->ID_MAV . '" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Supprimer</a>';
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function insert_validation_matiere()
  {
    $refnum = $this->input->post("refnum");
    $quantite = $this->input->post("quantite");
    $prix = $this->input->post("prix");
    $matiere = $this->input->post("matiere");
    $machine = $this->input->post("machine");
    $param = [
      "DATE_MAV" => date("Y-m-d"),
      "DEMANDE_MAV" => $this->session->userdata("matricule"),
      "PO_MAV" => $refnum,
      "MAC_MAV" => $machine,
      "DES_MIAV" => $matiere,
      "PRIX_MIAV" => $prix,
      "QTT_MIAV" => $quantite,
      "STATUT_MAV" => "NON VALIDER",
    ];
    echo $this->validation_matiere->insert_validation_matiere($param);
  }
  public function delete_matiere_attent_validation()
  {
    $refnum = $this->input->post("refnum");
    $param = ["ID_MAV" => $refnum];
    echo $this->validation_matiere->delete_validation_matiere($param);
  }
  public function valide_sortie_matiere()
  {
    $this->load->model("sortie_matiere_premiere");
    $this->load->model("validation_matiere");
    $refnum = $this->input->post("refnum");
    $destinataire = $this->input->post("destinataire");

    if ($destinataire == "")
      $destinataire = "PLASMAD";

    $methodOk = false;

    $validation = $this->validation_matiere->get_detail_validation_matiere(["ID_MAV" => $refnum]);
    $methodOk = $validation != null;

    if ($methodOk) {
      $matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_DESIGNATION" => $validation->DES_MIAV]);
      $methodOk = $matiere != null;
    }


    if ($methodOk) {
      $param = [
        "RF_MATIERE" => $matiere->ST_ID,
        "SM_DATE" => $validation->DATE_MAV,
        "SM_MAGASINIER" => $validation->DEMANDE_MAV,
        "SM_MATIER" => $validation->DES_MIAV,
        "SM_QUANTITE" => $validation->QTT_MIAV,
        "SM_DESTINATAIRE" => $validation->PO_MAV,
        "EM_TYPE" => "SORTIE",
        "SM_VALEUR" => $validation->PRIX_MIAV,
        "SM_MACHINE" => $validation->MAC_MAV,
        "SM_REFERENCE" => null
      ];
      $methodOk = $this->sortie_matiere_premiere->insert_sortie_matiere_premiere($param);
    }

    if ($methodOk) {
      $quantite = $matiere->ST_QUANTITE - $validation->QTT_MIAV;
      $methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $matiere->ST_ID], ["ST_QUANTITE" => $quantite]);
    }

    if ($methodOk) {
      echo $this->validation_matiere->update_validation_matiere(["ID_MAV" => $refnum], ["STATUT_MAV" => "VALIDER"]);
    }
  }
  public function data_liste_entre_produit_fini()
  {
    $this->load->model('entree_produits_finis');
    $refnum = $this->input->get('refnum');
    $param = ["BC_ID" => $refnum];
    $datas = $this->entree_produits_finis->get_entree_produits_finis($param);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->EF_ID;
      $sub_array[] = $row->EF_DATE;
      $sub_array[] = $row->EF_MAGASIN;
      $sub_array[] = $row->BC_ID;
      $sub_array[] = $row->EF_QUANTITE;
      $sub_array[] = $row->EF_TAILL;
      $sub_array[] = $row->STF_OBSE;
      $sub_array[] = "<a href='#' class='delete btn btn-sm btn-danger' id='$row->EF_ID'><i class='fa fa-trash'></i>&nbsp;Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function data_liste_sortie_produit_fini()
  {
    $this->load->model('sortie_produits_finis');
    $refnum = $this->input->get('refnum');
    $param = ["BC_ID" => $refnum];
    $datas = $this->sortie_produits_finis->get_sortie_produits_finis($param);
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->SF_ID;
      $sub_array[] = $row->SF_DATE;
      $sub_array[] = $row->SF_MAGASIN;
      $sub_array[] = $row->BC_ID;
      $sub_array[] = $row->SF_QUANTITE;
      $sub_array[] = $row->SF_TAILL;
      $sub_array[] = $row->STF_OBSE;
      $sub_array[] = "<a href='#' class='delete btn btn-sm btn-danger' id='$row->SF_ID'><i class='fa fa-trash'></i>&nbsp;Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function Recap_sortie_matiere()
  {
    $this->render_view("controlleur/suivi_matiere/recap_sortie_matiere");
  }
  public function Recap_data_sortie_matiere()
  {
    $this->load->model("global");
    $date = $this->input->post('date_debut');
    $reponse = $this->global->get_distinct_colum(["SM_DATE" => $date], "SM_MATIER", "sortie_matiere_premiere");

    $data = ["data" => $reponse, "date" => $date];
    //var_dump($data);
    $this->load->view("controlleur/suivi_matiere/recap_data_sortie_matiere", $data);
  }
  public function data_list_sortie_materiel()
  {
    $this->load->model('sortie_matiere_premiere');

    $debut = $this->input->get('dateCost');
    $fin = $this->input->get('dateCostFin');
    $reference = $this->input->get('reference');

    if ($reference != "" && $debut != "" && $fin != "") {
      $sql = "SM_MATIER like '$reference' AND SM_DATE BETWEEN '$debut' AND '$fin'";
    } else if ($reference != "" && $debut != "") {
      $sql = ["SM_MATIER" => $reference, "SM_DATE" => $debut];
    } else if ($reference != "") {
      $sql = ["SM_MATIER" => $reference];
    } else if ($debut != "" && $fin != "") {
      $sql = "SM_DATE BETWEEN '$debut' AND '$fin'";
    } else if ($debut != "") {
      $sql = ["SM_DATE" => $debut];
    } else {
      $sql = array();
    }
    $type = "";
    $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere($sql);
    $matiere = array();
    $i = 0;
    foreach ($datas as $key => $datas) {
      if (array_key_exists($datas->SM_MATIER, $matiere)) {
        $matiere[$datas->SM_MATIER]['quantite'] += $datas->SM_QUANTITE;
        $matiere[$datas->SM_MATIER]['PO'] .= " / " . $datas->SM_MATIER;
        $i++;
      } else {
        $matiere[$datas->SM_MATIER]['quantite'] = $datas->SM_QUANTITE;
        $matiere[$datas->SM_MATIER]['PO'] = $datas->SM_MATIER;
        $i++;
      }
    }
    $data = array();
    foreach ($matiere as $key => $matiere) {
      $sub_array = array();
      $sub_array[] = $key;
      $sub_array[] = $matiere['quantite'];
      $sub_array[] = "KG";
      $sub_array[] = $matiere['PO'];
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function create_prix_appliquer()
  {
    $this->load->model('prix_appiquer');

    $data = [
      "H_MACHINE_EXTR" => $this->input->post("H_MACHINE_EXTR"),
      "H_MOD_EXTR" => $this->input->post("H_MOD_EXTR"),
      "H_MOD_IMPR" => $this->input->post("H_MOD_IMPR"),
      "H_MACHINE_COUPE" => $this->input->post("H_MACHINE_COUPE"),
      "H_MOD_COUPE" => $this->input->post("H_MOD_COUPE"),
      "H_MACHINE_IMPR" => $this->input->post("H_MACHINE_IMPR"),
      "OVERHEADS" => $this->input->post("OVERHEADS"),
      "PA_STATUT" => "actif",
      "PA_DATE" => date("Y-m-d"),

    ];
    echo  json_encode($this->prix_appiquer->insert_prixappliquer($data));
  }
  public function create_operateur()
  {
    $this->load->model('operateur');
    $matricule  = $this->input->post('matricule');
    $nom  = $this->input->post('nom');
    $fonction  = $this->input->post('fonction');
    $machine = $this->input->post('machine');

    $data = [
      "OP_NOM" => $nom,
      "OP_STATUT" => "on",
      "OP_MATRICULES" => $matricule,
      "OP_FONCTION" => $fonction,
      "OP_PRENOM" => $nom,
      "OP_MACHINE" => $machine
    ];
    echo $this->operateur->insert_operateur($data);
  }

  public function create_machine()
  {
    $this->load->model('machine');
    $designation  = $this->input->post("designation");
    $vitesse  = $this->input->post("vitesse");
    $capacite  = $this->input->post("capacite");
    $dimension  = $this->input->post("dimension");
    $specification = $this->input->post("specification");
    $data = [
      "MA_DESIGNATION" => $designation,
      "MA_SPECIFIQUE" => $specification,
      "MA_STATUT" => "on",
      "MA_VITESSE" => $vitesse,
      "MA_DIM_MM" => $dimension,
      "CAPACITE" => $capacite
    ];
    echo $this->machine->insert_machine($data);
  }
  public function data_list_operateur()
  {
    $this->load->model('operateur');
    $datas = $this->operateur->get_operateur();
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->OP_MATRICULES;
      $sub_array[] = $row->OP_NOM;
      $sub_array[] = $row->OP_MACHINE;
      $sub_array[] = $row->OP_STATUT;
      $sub_array[] = '<a href="#" class="btn btn-danger btn-sm delete_operateur" id="' . $row->OP_ID . '" ><i class="fa fa-trash"></i>&nbsp;supprimer</a>';
      $data[] = $sub_array;
    }
    $output = array("data" => $data);
    echo json_encode($output);
  }
  public function data_list_machine()
  {
    $this->load->model('machine_model');
    $datas = $this->machine_model->get_machine();

    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->MA_ID;
      $sub_array[] = $row->MA_DESIGNATION;
      $sub_array[] = $row->MA_SPECIFIQUE;
      $sub_array[] = $row->MA_VITESSE;
      $sub_array[] = $row->MA_DIM_MM;
      $sub_array[] = $row->MA_STATUT;
      //$sub_array[] = '<a href="#" id="'.$row->MA_ID.'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>&nbsp;Modifier</a>';	
      $sub_array[] = '<a href="#" id="' . $row->MA_ID . '" class="btn btn-danger btn-sm delete_machine"><i class="fa fa-trash"></i>&nbsp;Supprimer</a>';
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function entree_matiere_liste_data()
  {
    $methodOk = isset($_GET["date_de_debut"]) && isset($_GET['date_fin']);
    if ($methodOk) {
      $date_de_debut = $_GET["date_de_debut"];
      $date_fin = $_GET['date_fin'];
      $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere("EM_DATE BETWEEN '$date_de_debut' AND '$date_fin'");
    }

    if (!$methodOk) {
      $methodOk = isset($_GET["date_de_debut"]);
      if ($methodOk) {
        $date_de_debut = $_GET["date_de_debut"];
        $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere(["EM_DATE" => $date_de_debut]);
      }
    }

    if (!$methodOk) {

      $datas = $this->entree_matiere_premiere->get_entree_matiere_premiere();
    }


    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->EM_ID;
      $sub_array[] = $row->EM_DATE;
      $sub_array[] = $row->EM_MAGASINIER;
      $sub_array[] = $row->EM_FORNISEUR;
      $sub_array[] = $row->EM_MATIER;
      $sub_array[] = $row->EM_QUANTITE;
      $sub_array[] = "<a class='btn btn-danger btn-sm delete_matiere'  href='#' id='$row->EM_ID'><i class='fa fa-trash'></i>&nbsp;&nbsp;Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function sortie_matiere_liste_data()
  {
    $this->load->model("sortie_matiere_premiere");
    $methodOk = isset($_GET["date_de_debut"]) && isset($_GET['date_fin']);
    if ($methodOk) {
      $date_de_debut = $_GET["date_de_debut"];
      $date_fin = $_GET['date_fin'];
      $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere("SM_DATE BETWEEN '$date_de_debut' AND '$date_fin'");
    }

    if (!$methodOk) {
      $methodOk = isset($_GET["date_de_debut"]);
      if ($methodOk) {
        $date_de_debut = $_GET["date_de_debut"];
        $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere(["SM_DATE" => $date_de_debut]);
      }
    }

    if (!$methodOk) {

      $datas = $this->sortie_matiere_premiere->get_sortie_matiere_premiere();
    }


    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->SM_ID;
      $sub_array[] = $row->SM_DATE;
      $sub_array[] = $row->SM_MAGASINIER;
      $sub_array[] = $row->SM_DESTINATAIRE;
      $sub_array[] = $row->SM_MATIER;
      $sub_array[] = $row->SM_QUANTITE;
      $sub_array[] = "<a class='btn btn-danger btn-sm delete_matiere'  href='#' id='$row->SM_ID'><i class='fa fa-trash'></i>&nbsp;&nbsp;Supprimer</a>";
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }
  public function delete_entree_matieree()
  {

    $refnum = $this->input->post('refnum');
    $parametre = ["EM_ID" => $refnum];
    $matiere_entree = $this->entree_matiere_premiere->get_detail_entree_matiere_premiere($parametre);
    $methodOk = $matiere_entree != null;
    if ($methodOk) {

      $detail_matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_DESIGNATION" => $matiere_entree->EM_MATIER]);
      $methodOk = $detail_matiere != null;
      $quantite = $matiere_entree->EM_QUANTITE;
      if ($methodOk) {
        $quantite -= $detail_matiere->ST_QUANTITE;
        $methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $detail_matiere->ST_ID], ["ST_QUANTITE" => $quantite]);
      }

      if ($methodOk) {
        $methodOk = $this->entree_matiere_premiere->delete_entree_matiere_premiere($parametre);
      }
    }

    echo $methodOk;
  }
  public function delete_sortie_matiere()
  {
    $this->load->model('sortie_matiere_premiere');
    $refnum = $this->input->post('refnum');
    $parametre = ["SM_ID" => $refnum];
    $matiere_sortie = $this->sortie_matiere_premiere->get_detail_sortie_matiere_premiere($parametre);

    $methodOk = $matiere_sortie != null;
    if ($methodOk) {

      $detail_matiere = $this->stock_matier_premier->get_detail_stock_matier_premier(["ST_DESIGNATION" => $matiere_sortie->SM_MATIER]);
      $methodOk = $detail_matiere != null;
      $quantite = $matiere_sortie->SM_QUANTITE;

      if ($methodOk) {
        $quantite += $detail_matiere->ST_QUANTITE;
        $methodOk = $this->stock_matier_premier->update_stock_matier_premier(["ST_ID" => $detail_matiere->ST_ID], ["ST_QUANTITE" => $quantite]);
      }

      if ($methodOk) {
        $methodOk = $this->sortie_matiere_premiere->delete_entree_matiere_premiere($parametre);
      }
    }

    echo $methodOk;
  }


  public function data_list_Prix()
  {
    $this->load->model('prix_appiquer');
    $datas = $this->prix_appiquer->get_prix_all_appliquer();
    $data = array();
    foreach ($datas as $row) {
      $sub_array = array();
      $sub_array[] = $row->PA_ID;
      $sub_array[] = $row->PA_DATE;
      $sub_array[] = $row->H_MACHINE_EXTR;
      $sub_array[] = $row->H_MOD_EXTR;
      $sub_array[] = $row->H_MOD_IMPR;
      $sub_array[] = $row->H_MACHINE_COUPE;
      $sub_array[] = $row->H_MOD_COUPE;
      $sub_array[] = $row->H_MACHINE_IMPR;
      $sub_array[] = $row->OVERHEADS;
      $sub_array[] = $row->PA_STATUT;
      $sub_array[] = '<a href="#" class="btn btn-warning edit_statut btn-sm" id="' . $row->PA_ID . '"><i class="fa fa-edit"></i>&nbsp;Désactiver</a>';
      $data[] = $sub_array;
    }
    $output = array(
      "data" => $data
    );
    echo json_encode($output);
  }

  public function disable_prix_appliquer()
  {
    $this->load->model('prix_appiquer');
    $refnum = $this->input->post('refnum');
    echo $this->prix_appiquer->update_prixappliquer(["PA_ID" => $refnum], ["PA_STATUT" => "inactif"]);
  }

  public function delete_operateur()
  {
    $this->load->model('operateur');
    $refnum = $this->input->post('refnum');
    echo $this->operateur->delete_operateur(["OP_ID" => $refnum]);
  }
  public function delete_machine()
  {
    $this->load->model('machine');
    $refnum = $this->input->post('refnum');
    echo $this->machine->delete_machine(["MA_ID" => $refnum]);
  }
  public function delete_mouvement_produit_fini()
  {
    $refnum = $this->input->post("refnum");
    $type = $this->input->post("type");
    switch ($type) {
      case 'entree':
        $this->delete_entree_data($refnum);
        break;
      case 'sortie':
        $this->delete_sortie_data($refnum);
        break;
    }
  }

  public function save_entre_produit_fini()
  {
    $this->load->model("entree_produits_finis");
    $this->load->model("stock_produit_finis");
    $this->load->model("commande");
    $date = $this->input->post("date");
    $refnum = $this->input->post("refnum");
    $taille = $this->input->post("taille");
    $entree = $this->input->post("entree");
    $type = $this->input->post("type");
    $obs = $this->input->post("obs");

    $methodOk = ($date != "") && ($refnum != "") && ($entree != "");

    if ($methodOk) {
      $detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["STF_TAIL" => $taille, "BC_ID " => $refnum]);
      $methodOk = $detail_produit != null;

      if ($methodOk) {
        $quantite = $detail_produit->STF_QUANTITE + $entree;
        $methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
      }

      if (!$methodOk) {
        $commande = $this->commande->select_commande(["BC_PE" => $refnum]);
        $methodOk = $commande != null;
        if ($methodOk) {
          $data_insert = [
            "BC_ID" => $refnum,
            "STF_QUANTITE" => $entree,
            "STF_TAIL" => $taille,
            "STF_CLIENT" => $commande->BC_CLIENT,
            "STF_DIM" => $commande->BC_DIMENSION,
            "STF_DATE" => $date,
            "STF_VALEUR" => $commande->BC_PRIX,
            "STF_ORIGIN" => "PLASMAD"
          ];
          $methodOk = $this->stock_produit_finis->insert_stock_produit_finis($data_insert);
        }
      }
    }

    if ($methodOk) {
      $param = [
        "EF_DATE" => $date,
        "EF_MAGASIN" => $this->session->userdata('matricule'),
        "BC_ID" => $refnum,
        "EF_TAILL" => $taille,
        "EF_QUANTITE" => $entree,
        "EF_TYPE" => $type,
        "EF_REMARQUE" => "",
        "STF_OBSE" => $obs
      ];
      $methodOk = $this->entree_produits_finis->insert_entree_produits_finis($param);
    }
    echo $methodOk;
  }

  public function delete_entree_data($refnum)
  {
    $this->load->model("entree_produits_finis");
    $this->load->model("stock_produit_finis");
    $entree = $this->entree_produits_finis->get_detail_entree_produits_finis(["EF_ID" => $refnum]);
    $methodOk = $entree != null;
    if ($methodOk) {
      $detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["STF_TAIL" => $entree->EF_TAILL, "BC_ID " => $entree->BC_ID]);
      $methodOk = $detail_produit != null;
      if ($methodOk) {
        $quantite = $detail_produit->STF_QUANTITE;
        $quantite -= $entree->EF_QUANTITE;
        $methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
      }
    }

    if ($methodOk) {
      $this->entree_produits_finis->get_delete_entree_produits_finis(["EF_ID" => $refnum]);
    }
    echo $methodOk;
  }
  public function delete_sortie_data($refnum)
  {
    $this->load->model("sortie_produits_finis");
    $this->load->model("stock_produit_finis");
    $sortie = $this->sortie_produits_finis->get_detail_sortie_produits_finis(["SF_ID" => $refnum]);
    $methodOk = $sortie != null;
    if ($methodOk) {
      $detail_produit = $this->stock_produit_finis->get_detail_stock_produit_finis(["STF_TAIL" => $sortie->SF_TAILL, "BC_ID " => $sortie->BC_ID]);
      $methodOk = $detail_produit != null;
      if ($methodOk) {
        $quantite = $detail_produit->STF_QUANTITE;
        $quantite += $sortie->SF_QUANTITE;
        $methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $detail_produit->STF_ID], ["STF_QUANTITE" => $quantite]);
      }
    }

    if ($methodOk) {
      $this->sortie_produits_finis->delete_sortie_produits_finis(["SF_ID" => $refnum]);
    }
    echo $methodOk;
  }
  public function array_unique($array, $unique_key)
  {
    if (!is_array($array))
      return $array;

    $unique_keys = array();
    foreach ($array as $key => $items) {
      if (!in_array($items[$unique_key], $unique_keys))
        $unique_keys[$items[$unique_key]] = $items;
    }
    return $unique_keys;
  }
  public function data_daily()
  {
    $this->load->model("global");

    $extrusion = $this->global->select_data_joint_colum($requette = array(), "BC_DATE,BC_DIMENSION,BC_DATELIVRE,BC_LIEULIVRE,BC_CODE,BC_QUNTITE,BC_DATE,BC_PE,BC_DIMENSION, EX_DATE AS 'DATE'", "commande.BC_PE=sachet_extrusion.EX_BC_ID", "sachet_extrusion", "commande");
    $impression = $this->global->select_data_joint_colum($requette = array(), "BC_DATE,BC_DIMENSION,BC_DATELIVRE,BC_LIEULIVRE,BC_CODE,BC_QUNTITE,BC_DATE,BC_PE,BC_DIMENSION, EI_DATE AS 'DATE'", "commande.BC_PE=sachet_impression.BC_ID", "sachet_impression", "commande");
    $coup = $this->global->select_data_joint_colum($requette = array(), "BC_DATE,BC_DIMENSION,BC_DATELIVRE,BC_LIEULIVRE,BC_CODE,BC_QUNTITE,BC_DATE,BC_PE,BC_DIMENSION, ED_DATE AS 'DATE'", "commande.BC_PE=sachet_coupe.BC_ID", "sachet_coupe", "commande");
    $reponse = array_merge($extrusion, $impression, $coup);
    $commande = $this->array_unique($reponse, "BC_PE");
    $data = ["data" => $commande];
    $this->load->view('controlleur/suivi_production/data_daily', $data);
  }
  public function init_refnum()
  {
    $this->load->model('global');
    $type = $this->input->post("int_table");
    $type_po = $this->input->post("type");
    $refnum = $this->input->post("refnum");
    $methode_ok = false;
    if ($type_po == "CMTI I") {
      switch ($type) {
        case 'PP':
          $methodOk = $this->global->init_table("refnum_pp_cmt");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pp_cmt", ["ID_STATUT" => "off", 'ID_CMT' => $refnum]);
          }
          break;
        case 'PE':
          $methodOk = $this->global->init_table("refnum_pe_cmt");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pe_cmt", ["CMT_STATUT" => "off", 'CMT_ID' => $refnum]);
          }
          break;
        case 'P':
          $methodOk = $this->global->init_table("refnum_p_madakem");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_p_madakem", ["PE_STATUT" => "off", 'ID_PE' => $refnum]);
          }
          break;
        case 'L':
          $methodOk = $this->global->init_table("refnum_l_plasmad");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_l_plasmad", ["PE_STATUT" => "off", 'ID_PE' => $refnum]);
          }
          break;
        default:
          $methodOk = $this->global->init_table("refnum_pe_cmt");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pe_cmt", ["CMT_STATUT" => "off", 'CMT_ID' => $refnum]);
          }
          break;
      }
    } else {
      switch ($type) {
        case 'PP':
          $methodOk = $this->global->init_table("refnum_pp");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pp", ["PP_STATUT" => "off", 'PP_ID' => $refnum]);
          }
          break;
        case 'PE':
          $methodOk = $this->global->init_table("refnum_pe");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pe", ["PE_STATUT" => "off", 'ID' => $refnum]);
          }
          break;
        case 'P':
          $methodOk = $this->global->init_table("refnum_p_madakem");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_p_madakem", ["PE_STATUT" => "off", 'ID_PE' => $refnum]);
          };
          break;
        case 'L':
          $methodOk = $this->global->init_table("refnum_l_plasmad");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_l_plasmad", ["PE_STATUT" => "off", 'ID_PE' => $refnum]);
          };
          break;
        default:
          $methodOk = $this->global->init_table("refnum_pe");
          if ($methodOk) {
            $methode_ok =  $this->global->insert_in_table("refnum_pe", ["PE_STATUT" => "off", 'ID' => $refnum]);
          }
          break;
      }
    }
    return $methode_ok;
  }
  public function return_last_rehum()
  {
    $type = $this->input->post("int_table");
    $type_po = $this->input->post("type");

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
          $ref_num = $this->commande->last_p_commande();
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

    echo (int)$refnum_po;
  }
  public function init_refnum_cintre()
  {
    $this->load->model('global');
    $type = $this->input->post("type");
    $refnum = $this->input->post("refnum");
    switch ($type) {
      case 'CMTI':
        $methodOk = $this->global->init_table("refnum_cintre_cmti");
        if ($methodOk) {
          $methodOk =  $this->global->insert_in_table("refnum_cintre_cmti", ["STATUT" => "off", 'ID' => $refnum]);
        }
        break;
      case 'EPZ':
        $methodOk = $this->global->init_table("refnum_cintre_epz");
        if ($methodOk) {
          $methodOk =  $this->global->insert_in_table("refnum_cintre_epz", ["STATUT" => "off", 'ID' => $refnum]);
        }
        break;
    }
    echo $methodOk;
  }
  public function return_last_refnum_cintre()
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
  public function Init_stock_produit_fini(){
    $this->render_view("controlleur/suivi_produit_fini/Init_stock");
  }

  public function import_files_stock_produit_fini_controlleur()
  {

     $this->load->model('stock_produit_finis');
    $data = scandir(FCPATH . 'uploads/excel');
    $uploads_dir = FCPATH . 'uploads/excel';
    $methodOk = false;
    
    $methodOk = isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"]);
    if ($methodOk) {
      $tmp_name = $_FILES["file"]["tmp_name"];
      $name = basename($_FILES["file"]["name"]);
      if (move_uploaded_file($tmp_name, "$uploads_dir/produit_fini/$name")) {
        if ($xlsx = SimpleXLSX::parse("$uploads_dir/produit_fini/$name")) {
       
          $header_values = $rows = [];

          foreach ($xlsx->rows() as $k => $r) {
            if ($k === 0) {
              $header_values = $r;
              continue;
            }
            $rows[] = array_combine($header_values, $r);
            
          }
          
          foreach ($rows as $rows) {
            
            $data = "";
            $produit_fini = $this->stock_produit_finis->get_detail_stock_produit_finis(["BC_ID" => $rows['N°PO'],"STF_TAIL"=>$rows['TAILLE']]);
            $methodOk = $produit_fini != Null;
            $data = [
              "STF_QUANTITE" => $rows["EN STOCK"]
            ];
            if ($methodOk) {
              $methodOk = $this->stock_produit_finis->update_stock_produit_finis(["STF_ID" => $produit_fini->STF_ID], $data);
            }
          }
        }
      }
    }
    echo $methodOk;
  }


  public function Nouvelle_operateur()
  {
    $this->render_view("controlleur/operateur/Nouvelle_operateur");
  }
  public function Liste_des_operateurs()
  {
    $this->render_view("controlleur/operateur/Liste_des_operateurs");
  }
  public function Nouvelle_machine()
  {
    $this->render_view("controlleur/suivi_machine/Nouvelle_machine");
  }
  public function Liste_des_machines()
  {
    $this->render_view("controlleur/suivi_machine/Liste_des_machines");
  }
  public function entree_produit_fini()
  {
    $this->render_view("controlleur/suivi_produit_fini/Entree");
  }
  public function Recap_matiere()
  {
    $this->render_view("controlleur/suivi_matiere/Recap_matiere");
  }
  public function Supprimer_transaction()
  {
    $this->render_view("controlleur/suivi_produit_fini/Supprimer_transaction");
  }
  public function Valider_sortie_matiere()
  {
    $this->load->model('validation_matiere');
    $this->load->model('global');
    $this->load->model('matiere_detail_attent_validation');
    $refnum = $this->input->post("refnum");
    $param = ["validation_matiere.STATUT_MAV" => "NON VALIDER","commande.BC_ORIGINE"=>"PLASMAD"];
    if ($refnum != "") {
      $param = ["validation_matiere.STATUT_MAV" => "NON VALIDER", "validation_matiere.PO_MAV" => $refnum];
    }
    $datas = $this->global->get_data_joint_parameter("validation_matiere","commande","validation_matiere.PO_MAV =commande.BC_PE",$param);
    $data = ["data"=>$datas];
    $this->render_view("controlleur/suivi_matiere/valider_sortie_matiere",$data);
  }
  public function suivie_machine_impression()
  {
    $this->render_view("controlleur/suivi_machine/impression");
  }
  public function suivie_machine_coupe()
  {
    $this->render_view("controlleur/suivi_machine/coupe");
  }
  public function Donnee_de_production()
  {
    $this->render_view("controlleur/Suivi_production/Donnee_de_production");
  }
  public function Daily_production_follow_up()
  {
    $this->render_view("controlleur/Suivi_production/Daily_production_follow_up");
  }
  public function Statut_commande()
  {
    $this->render_view("controlleur/Suivi_production/Statut_commande");
  }
  public function Encres_et_solvants()
  {
    $this->render_view("controlleur/Suivi_production/Encres_et_solvants");
  }
  public function suivi_commande()
  {
    $this->render_view("controlleur/suivi_commande");
  }

  public function Nouveau_Prix_appliquer()
  {
    $this->render_view("controlleur/Prix_appliquer/Nouveau");
  }
  public function Liste_des_prix()
  {
    $this->render_view("controlleur/Prix_appliquer/Liste_des_prix");
  }


  public function Supprimer_entree_matiere()
  {
    $this->render_view("controlleur/suivi_matiere/Supprimer_entree_matiere");
  }
  public function Supprimer_sortie_matiere()
  {
    $this->render_view("controlleur/suivi_matiere/Supprimer_sortie_matiere");
  }
  public function Supprimer_mouvement_matiere()
  {
    $this->render_view("controlleur/suivi_matiere/Supprimer_mouvement_matiere");
  }
  public function Initialiser_refnum()
  {
    $data = ['type_de_matier' => $this->commande->type_de_matier()];
    $this->render_view("refnum/index", $data);
  }
}
