<?php
class logs_model extends CI_Model
{
  public function __construct()
  {
   
  }
  public function insertLog($param=array()){
    return $this->db->insert('log',$param);
  }
}