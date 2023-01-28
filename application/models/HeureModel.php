<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class HeureModel extends CI_Model{
         
        public function __construct(){
		}

		public function get_now(){
			$query = "SELECT get_now() AS heure";
			$res = $this->db->query($query);
			return $res->row()->heure;
		}

		public function set_heure($heure){
			$query = "INSERT INTO heure_actuelle VALUES (1,?) ON DUPLICATE KEY UPDATE heure = ?";
			return $this->db->query($query,array($heure,$heure));
		}
    }
?>
