<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Globals extends My_Controller
{ 
   public function __construct()
   {
      parent::__construct();
   }
   public function change_image_users(){
       
		$uploads_dir = FCPATH.'/images/users';
		$tmp_name = $_FILES["file"]["tmp_name"];
		$name = basename($this->session->userdata("matricule").".jpg");
        $method_ok = move_uploaded_file($tmp_name, "$uploads_dir/$name");
        $method_ok ?  true : false ;
		
   }
   public function change_passe(){
     return $this->load->view("global/change_passe");
   }
   public function change_pass_user(){
      $this->load->model("users");
      $reponse = ["message"=>"true"];
      $param =["matricule"=>$this->session->userdata("matricule")];
      $user_info = $this->users->get_utilisateur_info($param);
      $old_pass = $this->input->post("old_pass");
      $new_pass = $this->input->post("new_pass");
      if($user_info->mot_de_passe==$old_pass){
           $this->users->update_utilisateur_data($param,["mot_de_passe"=>$new_pass]);
      }else{
         $reponse["message"]="Mot de passe incorrecte";
      }
      echo json_encode($reponse);
   }

}