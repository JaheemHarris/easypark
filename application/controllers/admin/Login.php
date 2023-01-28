<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private static $login_errors = array(
        "-1" => "User not logged in!",
        "-2" => "Provided information incorrects!"
    );

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('admin_login');
    }

	public function test(){
		// $user_id = $this->input->get('id');
		// $this->user->enable_account($user_id);
		$data = [];
		$data['page'] = 'product-list.php';
		$this->load->view('template',$data);
	}

    //User authentification process 
    public function check(){
        $email = $this->input->pologinst('email');
        $passwd = $this->input->post('passwd');

        $role = "ROLE_USER";

        $user = $this->user->get_user($email,$passwd,$role);
        if(isset($user)){
            $this->session->set_userdata('user',$user);
            redirect(base_url('welcome'));
        }else{
            redirect(base_url('login/user?error'));
        }
    }

    //Admin authentification process
    public function auth(){
        $email = $this->input->post('email');
        $passwd = $this->input->post('passwd');

        $role = "ROLE_ADMIN";

        $user = $this->user->get_user($email,$passwd,$role);
        
        if(isset($user)){
            $this->session->set_userdata('user',$user);
            redirect(base_url('welcome'));
        }
        if(!isset($user)){
            redirect(base_url('login/admin?error=-2'));
        }
    }
}
