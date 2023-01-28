<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/BaseAdmin.php');

class Tarif extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tarifModel');
	}

	public function new(){
		$data = [];
		$data['page'] = 'tarif-form.php';
		$this->load->view("admin-template",$data);
	}

	public function add(){
		$delai = $this->input->post('delai');
		$prix = $this->input->post('prix');
		if(isset($delai) && $delai!="" && isset($prix) && $prix!=""){
			$res = $this->tarifModel->insert($delai,$prix);
			if($res)
				redirect(base_url('admin/tarif/new?success'));
			else
				redirect(base_url('admin/tarif/new?error'));
		}else{
			redirect(base_url('admin/tarif/new?error'));
		}
	}

	public function list(){
		$tarifs = $this->tarifModel->list();
		if(!is_array($tarifs))
			$tarifs = [];
		$data = [];
		$data['tarifs']=$tarifs;
		$data['page'] = 'tarif-list.php';
		$this->load->view("admin-template",$data);
	}
}
