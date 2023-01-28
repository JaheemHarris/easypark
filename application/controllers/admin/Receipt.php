<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'controllers/BaseAdmin.php');

class Receipt extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('receiptModel');
	}

	public function new(){
		$this->load->model('product');
		$data = [];
		$data['products'] = $this->product->get_all();
		$data['page'] = 'receipt-form.php';
		$this->load->view("admin-template",$data);
	}

	public function add(){

		$receipt_name = $this->input->post('receipt-name');
		$details_receipt = $this->input->post('details-receipt');

		if(isset($receipt_name) && isset($details_receipt)){
			$details = json_decode($details_receipt);
			if(isset($details) && $details!=null && $details!=''){
				$this->receiptModel->insert($receipt_name,$details);
				redirect(base_url('admin/receipt/new?success'));
			}else{
				redirect(base_url('admin/receipt/new?error'));
			}
		}else{
			redirect(base_url('admin/receipt/new?error'));
		}
	}

	public function list(){
		$this->load->library('pagination');

		$element_per_page = 6;
		$total = $this->receiptModel->get_total_receipt();
		
	
		// init params
		$params = array();

		//element par page
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
	
		if ($total > 0)
		{
			// get current page records
			//liste element pour la page
			$all_receipts = $this->receiptModel->get_all_receipts($page*$element_per_page,$element_per_page);
			$params["receipts"] = $all_receipts;
				
			$config['base_url'] = base_url('admin/receipt/list');
			$config['total_rows'] = $total;
			$config['per_page'] = $element_per_page;
			$config["uri_segment"] = 4;
			
			// custom paging configuration
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;

			// $config['attributes'] = array('class' => 'page-link');
			
			$config['num_links'] = 2;
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;

			$config['attributes'] = array('class' => 'page-link');
			
			$config['full_tag_open'] = '<nav aria-label="..."><ul class="pagination">';
			$config['full_tag_close'] = '</ul></nav>';
			
			$config['first_link'] = 'Première';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = 'Dernière';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';

			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';

			$config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
			$config['cur_tag_close'] = '</span></li>';

			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);
				
			// build paging links
			$params["links"] = $this->pagination->create_links();
			$params["uri"] = $this->uri;
		}
		$params['page'] = 'receipts.php';
		$this->load->view('admin-template', $params);
	}
}
