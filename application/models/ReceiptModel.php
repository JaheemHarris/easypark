<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class ReceiptModel extends CI_Model{
         
        public function __construct(){
        }

		public function get_total_receipt(){
			return $this->db->count_all_results('view_receipts');
		}

		//get array of products limit/pagination
        public function get_all_receipts($offset,$total_element){
			$query = $this->db->get('view_receipts',$total_element,$offset);
			return $query->result_array();
		}

		public function get_receipt($receipt_id){
			$this->db->where('id',$receipt_id);
			$this->db->limit(1);
			$query = $this->db->get('view_receipts');
			return $query->row();
		}

		public function get_receipt_details($receipt_id){
			$this->db->where('receipt_id',$receipt_id);
			$query = $this->db->get('view_receipt_details');
			return $query->result();
		}

		public function insert($receipt_name,$receipt_details){
			$this->db->trans_start();

			$query = "INSERT INTO receipt(receipt_name,receipt_image) VALUES (?,'model1.jpg')";
			$this->db->query($query,array($receipt_name));
			$receipt_id = $this->db->insert_id();

			forEach($receipt_details as $detail){
				$query = "INSERT INTO receipt_formula(receipt_id,product_id,percentage) VALUES (?,?,?)";
				$this->db->query($query,array($receipt_id,$detail->id,$detail->percentage));
			}

			$this->db->trans_complete();
		}

		public function get_top_receipt_sales(){
			$query = $this->db->get('top_receipt_sales');
			return $query->result();
		}
    }
?>
