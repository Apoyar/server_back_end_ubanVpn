<?php
class User_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function check_user($user){

    $query=$this->db->get_where('radcheck', ['username'=>$user, 'attribute'=>'MD5-password']);

    if(empty($query->result_array())){
      return false;
    }
    else if($query->result_array()[0]['username']==$user){
      return true;
    }
  }

  public function check($user, $pass){

    $query=$this->db->get_where('radcheck', ['username'=>$user, 'attribute'=>'MD5-password', 'value'=>$pass]);

    if(empty($query->result_array())){
      return false;
    }
    else if($query->result_array()[0]['username']==$user && $query->result_array()[0]['value']==$pass){
      return true;
    }
  }

}