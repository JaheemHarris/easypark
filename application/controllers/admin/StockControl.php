<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'controllers/BaseAdmin.php');

class StockControl extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stock');
	}

	public function index(){

		$this->load->library('pagination');

		$product_name = $this->input->get('product_name');
		$category_id = $this->input->get('category');
		$price_min = $this->input->get('price_min');
		$price_max = $this->input->get('price_max');

		$element_per_page = 10;
		$total = $this->stock->get_total_instock();
		
	
		// init params
		$params = array();

		//element par page
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
	
		if ($total > 0)
		{
			// get current page records
			//liste element pour la page
			$params["products_instock"] = $this->stock->get_products_instock($page*$element_per_page,$element_per_page);
				
			$config['base_url'] = base_url('admin/stockControl/index');
			$config['total_rows'] = $total;
			$config['per_page'] = $element_per_page;
			$config["uri_segment"] = 4;
			
			// custom paging configuration
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
		$params['page'] = 'product-stock.php';
		$this->load->view('admin-template', $params);
	}
}
