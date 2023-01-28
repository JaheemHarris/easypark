<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseAdmin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if($this->session->has_userdata("admin")){
            $user = $this->session->admin;
            if($user->role != "ROLE_ADMIN"){
                redirect(base_url("login/admin?error=-1"));
            }
        }else{
            redirect(base_url("login/admin?error=-1"));
        }
    }
}
