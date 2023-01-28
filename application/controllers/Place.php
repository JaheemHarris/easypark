<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('BaseAdmin.php');

class Place extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('placeModel');	
		$this->load->model('heureModel');
	}

	public function liste(){
		$data = [];
		$heure = $this->heureModel->get_now();
		$places = $this->placeModel->list($heure);
		if(!is_array($places))
			$places = [];
		$data['places'] = $places;
		$data['page'] = 'place-list.php';
		$this->load->view('user-template',$data);
	}
}
