<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class WalletModel extends CI_Model{
         
        public function __construct(){
		}

		public function get_wallet_money($user_id){
			$this->db->where('user_id',$user_id);
			$query = $this->db->get('wallet_amount');
			return $query->row()->amount;
		}

		public function recharge($user_id,$amount){
			$query = "INSERT INTO wallet(user_id,entry,transaction_date) VALUES (?,?,now())";
			$result = $this->db->query($query,array($user_id,$amount));
			return $result;
		}

		public function validate($wallet_id){
			$query = "UPDATE wallet SET status = 1 WHERE id = ?";
			$result = $this->db->query($query,array($wallet_id));
			return $result;
		}

		public function sorti($user_id,$amount){
			$query = "INSERT INTO wallet(user_id,`exit`,transaction_date,status) VALUES (?,?,now(),1)";
			$result = $this->db->query($query,array($user_id,$amount));
			return $result;
		}

		public function get_nonvalid_recharge(){
			$query = $this->db->get('nonvalid_recharge');
			return $query->result();
		}
    }
?>
