<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('BaseAdmin.php');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product');	
	}

	public function index(){
		$this->load->library('pagination');

		$product_name = $this->input->get('product_name');
		$category_id = $this->input->get('category');
		$price_min = $this->input->get('price_min');
		$price_max = $this->input->get('price_max');

		$element_per_page = 9;
		$total = $this->product->get_total_product($product_name,$category_id,$price_min,$price_max);
		
	
		// init params
		$params = array();

		//element par page
		$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
	
		if ($total > 0)
		{
			// get current page records
			//liste element pour la page
			$all_products = $this->product->get_all_products($product_name,$category_id,$price_min,$price_max,$page*$element_per_page,$element_per_page);
			$params["results"] = $all_products;
				
			$config['base_url'] = base_url('products/index');
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
		$params['categories'] = $this->product->get_categories();
		$params['page'] = 'product-list.php';
		$this->load->view('template', $params);
	}

	public function view($product_id){
		$data = [];
		$product = $this->product->get_product($product_id);
		if(!isset($product)){
			redirect(base_url('products'));
		}
		// $available = $this->product->get_available_quantity($product_id);
		// $data['available'] = $available;
		$data['product'] = $product;
		$data['page'] = 'product-detail.php';
		$this->load->view('template',$data);
	}
}
