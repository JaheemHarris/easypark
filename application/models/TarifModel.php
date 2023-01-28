<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class TarifModel extends CI_Model{
         
        public function __construct(){
		}

		public function insert($delai,$prix){
			$query = "INSERT INTO tarif(delai,prix) VALUES (?,?)";
			return $this->db->query($query,array($delai,$prix));
		}

		public function list(){
			$query = $this->db->get('tarif');
			return $query->result_array();
		}

		public function get($id_tarif){
			$query = "SELECT * FROM tarif WHERE id = ? LIMIT 1";
			$res = $this->db->query($query,$id_tarif);
			return $res->row();
		}
    }
?>
