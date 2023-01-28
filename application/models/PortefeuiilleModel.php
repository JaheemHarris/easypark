<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class PortefeuilleModel extends CI_Model{
         
        public function __construct(){
		}

		public function insert($numero){
			$query = "INSERT INTO portefeuille(numero) VALUES (?)";
			return $this->db->query($query,array($numero));
		}
    }
?>
