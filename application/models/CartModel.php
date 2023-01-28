<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class CartModel extends CI_Model{
         
        public function __construct(){
		}

		public function remove_wallet($user_id,$amount){
			$query = "INSERT INTO wallet(user_id,exit,status) VALUES (?,?,1)";
			$result = $this->db->query($query,array($user_id,$amount));
			return $result;
		}

		public function pay($user_id,$total_amount,$cartItems){
			$this->db->trans_start();

			$query = "INSERT INTO payement(user_id,total_amount) VALUES (?,?)";
			$res = $this->db->query($query,array($user_id,$total_amount));
			$id = $this->db->insert_id();

			forEach($cartItems as $item){
				$query = "INSERT INTO payement_details(payement_id,receipt_id,product_id,quantity,unit_price,total_price) VALUES (?,?,?,?,?,?)";
				$total_price = $item->price*$item->quantity;
				$this->db->query($query,array($id,$item->receipt_id,$item->id,$item->quantity,$item->price,$total_price));

				$query = "INSERT INTO stock(product_id,exit) VALUES (?,?)";
				$this->db->query($query,array($item->id,$item->quantity));
			}

			$query = "INSERT INTO wallet(user_id,exit,status) VALUES (?,?,1)";
			$result = $this->db->query($query,array($user_id,$total_amount));

			$this->db->trans_complete();
		}

		public function pay_details(){
		}
    }
?>
