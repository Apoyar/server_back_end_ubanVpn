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
    $_POST['pass']='password0';

    $creds=['user'=>$_POST['user'], 'pass'=>md5($_POST['pass'])];

    if($_POST['remote'] && $this->user_model->check_user($creds['user'])){
      if($this->user_model->check($creds['user'], $creds['pass'])){
        $cert=shell_exec('curl --insecure -u '.'user0'.':'.'password0'.' https://gw.ubanvpn.com:943/rest/GetUserlogin');
        $response=[
          'message'=>'success',
          'certificate'=>$cert
        ];

      }
      else{
        $response=['error'=>'Incorrect user/pass, please try again'];
      }
    }
    else{
      $response=['error'=>'Incorrect user/pass, please try again'];
    }
    echo var_dump($response);

  }
}