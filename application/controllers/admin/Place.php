<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/BaseAdmin.php');

class Place extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('placeModel');
	}

	public function disable(){
		$data = [];
		$data['places'] = $this->placeModel->get_places();
		$data['page'] = 'place-desactivate.php';
		$this->load->view("admin-template",$data);
	}

	public function situation(){
		$data = [];
		$this->load->model('heureModel');
		$heure = $this->heureModel->get_now();
		$data['situations'] = $this->placeModel->get_situation();
		if(!is_array($data))
			$data['situations']=[];
		$data['heure'] = $heure;
		$data['page'] = 'place-situation.php';
		$this->load->view("admin-template",$data);
	}

	public function desactivate(){
		$id = $this->input->post('place');
		if(isset($id) && $id!=""){
			$place = $this->placeModel->get_placement($id);
			if($place==null){
				$this->placeModel->disable($id);
				redirect(base_url('admin/place/disable?success'));
			}else
				redirect(base_url('admin/place/disable?error'));
		}else
			redirect(base_url('admin/place/disable?error'));
	}

	public function new(){
		$data = [];
		$data['page'] = 'place-form.php';
		$this->load->view("admin-template",$data);
	}

	public function add(){
		$numero = $this->input->post('numero');
		if(isset($numero) && $numero!=""){
			$res = $this->placeModel->insert($numero);
			if($res)
				redirect(base_url('admin/place/new?success'));
			else
				redirect(base_url('admin/place/new?error'));
		}else{
			redirect(base_url('admin/place/new?error'));
		}
	}

	public function to_pdf($id){
		$data = [];
		$data['place'] = $this->placeModel->get_situation_by_id($id);
        // $this->load->view('pdf', $data);
		// $html = $this->output->get_output();
		// $this->load->library('../pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A10', 'portrait');
		// $this->dompdf->render();
		// ob_end_clean();
		// $this->dompdf->stream("ticker.pdf", array("Attachment"=>0));
		
		$this->load->view("pdf",$data);
	}
}
