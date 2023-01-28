<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/BaseAdmin.php');

class Heure extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('heureModel');
	}

	public function changer(){
		$data = [];
		$data['heure'] = $this->heureModel->get_now();
		$data['page'] = 'heure-form.php';
		$this->load->view("admin-template",$data);
	}

	public function modifier(){
		$heure = $this->input->post('heure');
		if(isset($heure) && $heure!=""){
			$res = $this->heureModel->set_heure($heure);
			if($res)
				redirect(base_url('admin/heure/changer?success'));
			else
				redirect(base_url('admin/heure/changer?error'));
		}else
			redirect(base_url('admin/heure/changer?error'));
	}
}
