<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('BaseAdmin.php');

class Receipts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('receiptModel');	
	}

	public function index(){
		$this->load->library('pagination');

		$element_per_page = 6;
		$total = $this->receiptModel->get_total_receipt();
		
	
		// init params
		$params = array();

		//element par page
		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
	
		if ($total > 0)
		{
			// get current page records
			//liste element pour la page
			$all_receipts = $this->receiptModel->get_all_receipts($page*$element_per_page,$element_per_page);
			$params["receipts"] = $all_receipts;
				
			$config['base_url'] = base_url('receipts/index');
			$config['total_rows'] = $total;
			$config['per_page'] = $element_per_page;
			$config["uri_segment"] = 3;
			
			// custom paging configuration
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;

			// $config['attributes'] = array('class' => 'page-link');
			
			$config['full_tag_open'] = '<div class="col-md-8 col-sm-8"><ul class="pagination pull-right">';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'Première';
			$config['first_tag_open'] = '<li >';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = 'Dernière';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';

			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li><span>';
			$config['cur_tag_close'] = '</span></li>';

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);
				
			// build paging links
			$params["links"] = $this->pagination->create_links();
			$params["uri"] = $this->uri;
		}
		$params['page'] = 'receipt-list.php';
		$this->load->view('template', $params);
	}

	public function view($receipt_id){

		$receipt = $this->receiptModel->get_receipt($receipt_id);
		$details = $this->receiptModel->get_receipt_details($receipt_id);
		

		$data = [];
		if(!isset($receipt)){
			redirect(base_url('receipts'));
		}
		$data['receipt'] = $receipt;
		$data['details'] = $details;
		$data['page'] = 'receipt-item.php';
		$this->load->view('template',$data);
	}
}
