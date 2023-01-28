<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'controllers/BaseAdmin.php');

class Stats extends BaseAdmin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product');
		$this->load->model('receiptModel');
	}

	public function top_product_sales(){
		$data = [];
		$data['product_sales'] = $this->product->get_top_product_sales();
		$data['page'] = 'stats-product-sales.php';
		$this->load->view('admin-template',$data);
	}

	public function top_receipt_sales(){
		$data = [];
		$data['receipt_sales'] = $this->receiptModel->get_top_receipt_sales();
		$data['page'] = 'stats-receipt-sales.php';
		$this->load->view('admin-template',$data);
	}
}
