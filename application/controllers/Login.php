<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('user_model');
  }
  public function form(){
    $this->load->view('login/login_form');
  }
  public function login(){
    $_POST['remote']='true';
    $_POST['user']='user0';
    $_POST['pass']=md5('password0');
    if($_POST['remote'] && $this->user_model->check_user($_POST['user'])){
      if($this->user_model->check($_POST['user'], $_POST['pass'])){
        $responce=['message'=>'success'];
      }
      else{
        $responce=['error'=>'Incorrect user/pass, please try again'];
      }
    }
    else{
      $responce=['error'=>'Incorrect user/pass, please try again'];
    }
    echo var_dump($responce);

  }
}