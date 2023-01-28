<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseUser extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if($this->session->has_userdata("user")){
            $user = $this->session->user;
            if($user->role != "ROLE_USER"){
                redirect(base_url("login/user?error=-1"));
            }
        }else{
            redirect(base_url("login/user?error=-1"));
        }
    }
}
