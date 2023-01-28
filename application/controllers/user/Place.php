<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'controllers/BaseUser.php');

class Place extends BaseUser {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('placeModel');
	}

	// public function toPdf(){
    //     $this->load->model('commande');
    //     $idCommande = $this->input->get('commande');
    //     $commandeLivree = $this->commande->getCommandeLivree($idCommande);
    //     $data = array();
    //     $data['dataCommande'] = $commandeLivree;
    //     $this->load->view('commandePdf', $data);
	// 	$html = $this->output->get_output();
	// 	$this->load->library('pdf');
	// 	$this->dompdf->loadHtml($html);
	// 	$this->dompdf->setPaper('A4', 'landscape');
	// 	$this->dompdf->render();
	// 	ob_end_clean();
	// 	$this->dompdf->stream("commande.pdf", array("Attachment"=>0));
    // }

	public function park($place,$numero){
		$this->load->model('tarifModel');
		$this->load->model('heureModel');
		$data = [];
		$data ['place'] = $place;
		$data['numero'] = $numero;
		$data['tarifs'] = $this->tarifModel->list();
		$data['heure'] = $this->heureModel->get_now();
		$data['page'] = 'park-form.php';
		$this->load->view('user-template',$data);
	}

	public function quit($place,$numero){
		$this->load->model('heureModel');
		$data = [];
		$data ['place'] = $place;
		$data['numero'] = $numero;
		$data['heure'] = $this->heureModel->get_now();
		$data['placement'] = $this->placeModel->get_placement($place);
		$data['page'] = 'park-quit.php';
		$this->load->view('user-template',$data);
	}

	public function leave(){
		$id = $this->input->post('id');
		$id_place = $this->input->post('place');
		$heure_depart = $this->input->post('heure_depart');
		$park = $this->input->post('park');
		$numero_voiture = $this->input->post('numero');
		
	
		if(isset($id) && isset($heure_depart) && $id!=null && $heure_depart!=null){
			$this->load->model('walletModel');
			$user = $this->session->user;
			$money = $this->walletModel->get_wallet_money($user->id);
			$heure_depart = str_replace('T'," ",  $heure_depart);
			$amende = $this->placeModel->get_park($id,$heure_depart);
			if(100000>$money)
				redirect(base_url('user/place/quit/').$id_place.'/'.$park.'?error=-1');
			$this->db->trans_start();
			$this->walletModel->sorti($user->id,100000);
			if($amende!=null){
				$this->placeModel->infraction($numero_voiture);
			}
			$res = $this->placeModel->quit($id,$heure_depart);
			$this->placeModel->update($id_place,0);
			$this->db->trans_complete();
			if($res)
				redirect(base_url('place/liste'));
			else
				redirect(base_url('user/place/quit/').$id_place.'/'.$park.'?error=-1');
		}else
			redirect(base_url('user/place/quit/').$id_place.'/'.$park.'?error=-2');
	}

	public function addPark(){
		$park = $this->input->post('park');
		$numero_voiture = $this->input->post('numero');

		$id_tarif = $this->input->post('tarif');
		$id_place = $this->input->post('place');
		$heure_arrivee = $this->input->post('heure_arrivee');

		$this->load->model('walletModel');
		$user = $this->session->user;
		$money = $this->walletModel->get_wallet_money($user->id);
		
		$heure_arrivee = str_replace('T'," ",  $heure_arrivee);

		$date = date('Y-m-d',strtotime($heure_arrivee));

		$date1['f'] = $date.' 06:00';
		$date1['l'] = $date.' 08:00';

		$date2['f']  = $date.' 12:00';
		$date2['l']  = $date.' 14:00';

		$date4['f']  = $date.' 15:00';
		$date4['l']  = $date.' 16:00';

		$date3['f'] = $date.' 18:00';
		$date3['l'] = date('Y-m-d',strtotime($date.'+ 1 day')).' 06:00';

		if(isset($numero_voiture) && isset($id_tarif) && isset($id_place) && isset($heure_arrivee) && $numero_voiture!="" && $id_tarif!="" && $id_place!="" && $heure_arrivee!=""){

			$infr = $this->placeModel->est_en_infraction($numero_voiture);

			if($infr->count==3){
				redirect(base_url('user/place/park/').$id_place.'/'.$park.'?infr');
			}

			$this->load->model('tarifModel');
			$tarif = $this->tarifModel->get($id_tarif);

			$reste = $money - $tarif->prix;
			$heure_arrivee = str_replace('T'," ",  $heure_arrivee);

			$remise = "Pas de remise";
			$montant = $tarif->prix;

			if($date3['f']<=$heure_arrivee && $heure_arrivee<=$date3['l']){
				$tar = $this->placeModel->get_tarif($tarif->delai,'00:35');
				if($tar!=null){
					$montant = $tar->prix;
				}else
					$montant = 0;
				$remise = "35min gratuit";
			}

			if($date1['f']<=$heure_arrivee && $heure_arrivee<=$date1['l']){
				$montant = $tarif->prix-($tarif->prix*0.15);
				$remise = "-15%";
			}
	
			if($date2['f']<=$heure_arrivee && $heure_arrivee<=$date2['l']){
				$montant = $tarif->prix+($tarif->prix*0.10);
				$remise = "+10%";
			}

			if($date4['f']<=$heure_arrivee && $heure_arrivee<=$date4['l']){
				$tar = $this->placeModel->get_tarif($tarif->delai,'00:35');
				if($tar!=null){
					$montant = $tar->prix;
				}else
					$montant = 0;
				$remise = "35min gratuit";
			}


			if($reste >= 0){
				$this->db->trans_start();
				$res = $this->placeModel->park($id_place,$user->id,$numero_voiture,$id_tarif,$heure_arrivee,$tarif->delai,$montant,$remise);
				$this->placeModel->update($id_place,1);
				$this->walletModel->sorti($user->id,$tarif->prix);
				$this->db->trans_complete();
				if($res){
					$place = [];
					$place['numero_voiture'] = $numero_voiture;
					$place['heure_arrivee'] = $heure_arrivee;
					$place['delai'] = $tarif->delai;
					$place['remise'] = $remise;
					$place['montant'] = $montant;
					$data = [];
					$data['place']=$place;
					$this->load->view('ticket',$data);
				}
				else
					redirect(base_url('user/place/park/').$id_place.'/'.$park.'?error');
			}else
				redirect(base_url('user/place/park/').$id_place.'/'.$park.'?error=-2');
		}else
			redirect(base_url('user/place/park/').$id_place.'/'.$park.'?error');
	}
}
