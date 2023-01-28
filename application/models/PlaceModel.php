<?php   if( ! defined('BASEPATH')) exit('No direct script access allowed');

    class PlaceModel extends CI_Model{
         
        public function __construct(){
		}

		public function insert($numero){
			$query = "INSERT INTO place(numero) VALUES (?)";
			return $this->db->query($query,array($numero));
		}

		public function get_places(){
			$query = 'SELECT * FROM place ORDER BY id ASC';
			return $this->db->query($query)->result_array();
		}

		public function list($heure){
			$query = "CALL test_liste(?)";
			$res = $this->db->query($query,array($heure));
			return $res->result_array();
		}

		public function disable($id){
			$query = "UPDATE place SET est_desactive=1 WHERE id = ?";
			$this->db->query($query,array($id));
		}

		public function park($id_place,$id_user,$numero_voiture,$id_tarif,$heure_arrivee,$delai,$montant,$remise){
			$query = "INSERT INTO placement_voiture(id_place,id_user,id_tarif,numero_voiture,heure_arrivee,heure_prevue,montant,remise) VALUES (?,?,?,?,?,ADDTIME(?,?),?,?)";
			return $this->db->query($query,array($id_place,$id_user,$id_tarif,$numero_voiture,$heure_arrivee,$heure_arrivee,$delai,$montant,$remise));
		}

		public function update($id_place,$status){
			$query = "UPDATE place SET est_occupe=? WHERE id = ?";
			$this->db->query($query,array($status,$id_place));
		}

		public function get_placement($place){
			$query = "SELECT * FROM placement_voiture WHERE id_place = ? AND heure_depart IS NULL LIMIT 1";
			$res = $this->db->query($query,array($place));
			return $res->row();
		}

		public function quit($id,$heure_depart){
			$query = "UPDATE placement_voiture SET heure_depart = ? WHERE id = ?";
			$res = $this->db->query($query,array($heure_depart,$id));
			return $res;
		}

		public function get_park($id,$heure_depart){
			$query = "SELECT * FROM placement_voiture WHERE heure_depart is null AND TIME(heure_prevue)<TIME(?) AND id = ?";
			$res = $this->db->query($query,array($heure_depart,$id));
			return $res->row();
		}

		public function get_park_numero($id,$heure_depart,$numero){
			$query = "SELECT * FROM placement_voiture WHERE heure_depart is null AND TIME(heure_prevue)<TIME(?) AND id = ? AND numero_voiture = ?";
			$res = $this->db->query($query,array($heure_depart,$id,$numero));
			return $res->row();
		}

		public function get_tarif($tarif,$gratuit){
			$query = "SELECT * , TIMEDIFF(?,?) As payant,TIMEDIFF(TIMEDIFF(?,?),delai) As reste FROM tarif WHERE TIMEDIFF(TIMEDIFF(?,?),delai)<='00:00:00' AND ?>? ORDER BY TIMEDIFF(TIMEDIFF(?,?),delai) DESC LIMIT 1;";
			$res = $this->db->query($query,array($tarif,$gratuit,$tarif,$gratuit,$tarif,$gratuit,$tarif,$gratuit,$tarif,$gratuit));
			return $res->row();
		}

		public function get_situation(){
			$query = "SELECT * FROM get_situation";
			$res = $this->db->query($query);
			return $res->result_array();
		}

		public function get_situation_by_id($id){
			$query = "SELECT * FROM get_situation WHERE id_park = ?";
			$res = $this->db->query($query,array($id));
			return $res->row();
		}

		public function infraction($immatricualtion){
			$query = "INSERT INTO infraction(numero_voiture) VALUES (?)";
			$this->db->query($query,array($immatricualtion));
		}

		public function est_en_infraction($immatricualtion){
			$query = "SELECT COUNT(*) AS count FROM infraction WHERE numero_voiture = ?";
			return $this->db->query($query,array($immatricualtion))->row();
		}
    }
?>
