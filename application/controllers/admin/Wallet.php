<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'controllers/BaseAdmin.php');

class Wallet extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('walletModel');
	}

	public function validation(){
		$data = [];
		$data['wallet'] = $this->walletModel->get_nonvalid_recharge();
		$data['page'] = 'wallet-validation.php';
		$this->load->view("admin-template",$data);
	}

	public function validate($wallet_id){

		$res = $this->walletModel->validate($wallet_id);
		if(!$res){
			redirect(base_url('admin/wallet/validation?error'));
		}
		redirect(base_url('admin/wallet/validation?success'));
	}
}
