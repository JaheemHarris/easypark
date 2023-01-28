<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function index(){
		$data = [];
		$this->load->library('session');
		$user = $this->session->user;
		if(isset($user)){
			$this->load->model('user');
			$info_user = $this->user->get_info_user($user->id);
			$data['info_user'] = $info_user;
			$data['page'] = 'user-account.php';
			$this->load->view("template",$data);
		}else{
			redirect(base_url('login/user?error'));
		}
	}

	public function new(){
		$this->load->view("register");
	}

	public function create(){
		$user = [];
		$user['nom'] = $this->input->post('nom');
		$user['prenom'] = $this->input->post('prenom');
		$user['email'] = $this->input->post('email');
		$user['password'] = $this->input->post('password');

		

		$this->load->model('user');
		$res = $this->user->insert($user);

		if($res){
			redirect(base_url('login/user'));
		}else{
			redirect(base_url('user/account/new?error'));
		}
	}
}
