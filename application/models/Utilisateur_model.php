<?php
class utilisateur_model extends CI_Model
{
    public function __construct()
    {
    }
    public function listeUtilisateur()
    {
        return $this->db->get('utilisateurs')->result_object();
    }
    public function insertbontest($data){
        return $this->db->insert('bondecommande',$data);
        
    }
    public function datailUtilisateur($UT_ID)
    {
        $this->db->where('UT_ID', $UT_ID);
        return $this->db->get('utilisateurs')->row_object();
    }
    public function machine()
    {
        return $this->db->get('machine')->result_object();
    }
    public function updateUtilisateur($UT_ID, $UT_DATA)
    {
        $this->db->where('UT_ID', $UT_ID);
        $this->db->set($UT_DATA);
        return $this->db->update('utilisateurs');
    }
    public function insertutilisateur($data)
    {
        return  $this->db->insert('utilisateurs', $data);
    }
    public function supprimerUtilisateur($UT_ID)
    {
        $this->db->where('UT_ID', $UT_ID);
        return $this->db->delete('utilisateurs');
    }
    public function insetMachine($data)
    {
        return $this->db->insert('machine', $data);
    }
    public function insetOperateur($data)
    {
        return $this->db->insert('operateur', $data);
    }
    public function insertprixAppliquer($param)
    {
        return $this->db->insert('prixAppliquer', $param);
    }
    public function UpDateprixAppliquer($param, $requette)
    {
        return $this->db->where($requette)->update("prixAppliquer", $param);
    }
    public function listeOperateur()
    {
        return $this->db->get('operateur')->result_object();
    }
    public function listeMachine()
    {
        return $this->db->get('machine')->result_object();
    }
    public function insetFormule($data)
    {
        return $this->db->insert('formule', $data);
    }
    public function updateFormule($requette, $data)
    {
        return $this->db->where($requette)->update('formule', $data);
    }
    public function requetteSimple($sql)
    {
        return $this->db->query($sql)->result_object();
    }
    public function selectprixappliquer($requette=array()){
        return $this->db->where($requette)->get('prixappliquer')->result_object();
    }
    public function ListeprixAppliquer($requette=array()){
        return $this->db->where($requette)->get('prixappliquer')->result_object();
    }

    
}
