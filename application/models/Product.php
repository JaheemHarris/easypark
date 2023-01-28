<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit','128M');

    class Product extends CI_Model{
         
        public function __construct(){
        }

		public function get_total_product($product_name,$category_id,$price_min,$price_max){
			if($product_name!=null && $product_name!=''){
				$this->db->like('product_name',$product_name);
			}
			if($category_id!=null && $category_id!=''){
				$this->db->where('category_id',$category_id);
			}
			if(isset($price_min) && $price_min!='' && $price_max==''){
				$this->db->where('price >=',$price_min);
			}
			if(isset($price_max) && $price_max!='' && $price_min==''){
				$this->db->where('price <=',$price_max);
			}
			if(isset($price_min) && isset($price_max) && $price_min!='' && $price_max!=''){
				if(intval($price_min)<intval($price_max)){
					$this->db->where('price >=',$price_min);
					$this->db->where('price <=',$price_max);
				}
			}
			$total = $this->db->count_all_results('view_product_stock');
			return $total;
		}

		//get array of products limit/pagination
        public function get_all_products($product_name,$category_id,$price_min,$price_max,$offset,$total_element){
			if($product_name!=null && $product_name!=''){
				$this->db->like('product_name',$product_name);
			}
			if($category_id!=null && $category_id!=''){
				$this->db->where('category_id',$category_id);
			}
			if(isset($price_min) && $price_min!='' && $price_max==''){
				$this->db->where('price >=',$price_min);
			}
			if(isset($price_max) && $price_max!='' && $price_min==''){
				$this->db->where('price <=',$price_max);
			}
			if(isset($price_min) && isset($price_max) && $price_min!='' && $price_max!=''){
				if(intval($price_min)<intval($price_max)){
					$this->db->where('price >=',$price_min);
					$this->db->where('price <=',$price_max);
				}
			}
			$query = $this->db->get('view_product_stock',$total_element,$offset);
			return $query->result_array();
		}

		public function get_all(){
			$this->db->limit(100);
			$query = $this->db->get('view_product_stock');
			return $query->result();
		}

		//Get product by id
		public function get_product($product_id){
			$this->db->where('id',$product_id);
			$query = $this->db->get('view_product_stock'); 
			return $query->row();
		}

		public function get_categories(){
			$query = $this->db->get('category');
			return $query->result();
		}

		public function get_available_quantity($product_id){
			$this->db->where('product_id',$product_id);
			$query = $this->db->get('view_available_quantity');
			return $query->row();
		}

		public function get_top_product_sales(){
			$query = $this->db->get('top_product_sales');
			return $query->result();
		}
    }
?>
