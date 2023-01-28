<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class User extends CI_Model{
         
        public function __construct(){
		}

		public function insert($user){
			$query = "INSERT INTO auth_user(role_id,firstname,lastname,email,password,is_enabled) VALUES (2,?,?,?,md5(?),1)";
			$query_result = $this->db->query($query,array($user['prenom'],$user['nom'],$user['email'],$user['password']));
			return $query_result;
		}

        public function get_user($email,$passwd,$role){
            // $this->load->library('database');
            $query = "SELECT u.*,r.role_name as role FROM auth_user u JOIN auth_role r ON u.role_id = r.id where u.email = %s AND u.password = md5(%s) AND r.role_name = %s";
            $query = sprintf($query,$this->db->escape($email),$this->db->escape($passwd),$this->db->escape($role));
            $query_result = $this->db->query($query);
            // $query = "SELECT u.*,r.role_name as role FROM auth_user u JOIN auth_role r ON u.role_id = r.id where u.email = ? and u.password = sha1(?) AND r.role_name = ?";
            // $query_result = $this->db->query($query,array($email,$passwd,$role));
            return $query_result->row();
        }

		public function get_nonvalid_account($email,$passwd,$role){
			$query = "SELECT u.*,r.role_name as role FROM auth_user u JOIN auth_role r ON u.role_id = r.id where u.email = %s AND u.password = md5(%s) AND r.role_name = %s AND is_enabled = 0";
            $query = sprintf($query,$this->db->escape($email),$this->db->escape($passwd),$this->db->escape($role));
            $query_result = $this->db->query($query);
            return $query_result->row();
		}

		public function get_nonvalid_accounts(){
			$query = "SELECT * FROM auth_user where is_enabled = 0";
            $query_result = $this->db->query($query);
            return $query_result->result();
		}

		public function enable_account($user_id){
			$query = "UPDATE auth_user SET is_enabled = 1 WHERE id = ? ";
			$this->db->query($query,array($user_id));
		}

		public function get_user_by_id($user_id){
			$query = "SELECT u.*,r.role_name as role FROM auth_user u JOIN auth_role r ON u.role_id = r.id where u.id = ?";
			$query_result = $this->db->query($query,array($user_id));
			return $query_result->row();
		}

		public function get_info_user($user_id){
			$query = "SELECT au.*,wa.amount FROM auth_user au JOIN wallet_amount wa ON au.id = wa.user_id WHERE au.id = ?";
			$query_result = $this->db->query($query,array($user_id));
			return $query_result->row();
		}
    }
?>
