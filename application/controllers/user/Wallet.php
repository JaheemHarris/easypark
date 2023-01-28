<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'controllers/BaseUser.php');

class Wallet extends BaseUser {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('walletModel');
	}

	public function recharge(){
		$this->load->library('session');
		$user = $this->session->user;
		if(isset($user)){
			$data = [];
			$data['page'] = 'wallet-recharge.php';
			$this->load->view("user-template",$data);
		}else{
			redirect(base_url('user/account/login?loggin'));
		}
	}

	public function add(){
		$this->load->library('session');
		$user = $this->session->user;
		if(isset($user)){
			$amount = $this->input->post('amount');
			if(isset($amount)){
				if($amount>0){
					$this->load->library('session');
					$user = $this->session->user;
					$this->walletModel->recharge($user->id,$amount);
					redirect(base_url('user/wallet/recharge?success'));
				}else{
					redirect(base_url('user/wallet/recharge?error'));
				}
			}else{
				redirect(base_url('user/wallet/recharge?error'));
			}
		}else{
			redirect(base_url('user/account/login?loggin'));
		}
	}

	public function view(){
		$data = [];
		$this->load->library('session');
		$user = $this->session->user;
		$this->load->model('walletModel');
		$data['money'] = $this->walletModel->get_wallet_money($user->id);
		$data['page'] = 'my-money.php';
		$this->load->view('user-template',$data);
	}
}
