<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Stock extends CI_Model{
         
        public function __construct(){
		}

		public function get_total_instock(){
			return $this->db->count_all_results('view_products_stock');
		}

		public function get_products_instock($offset,$element_number){
			$query = $this->db->get('view_products_stock',$element_number,$offset);
			return $query->result();
		}
    }
?>
