<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function index(){
		$data = array();
		$data['page'] = 'cart.php';
		$success = $this->input->get('success');
		if(isset($success)){
?>
<script>
	localStorage.removeItem('cartItems');
</script>
<?php
		}
		$this->load->view('template',$data);
	}

	public function paiement(){
		$this->load->library('session');
		$user = $this->session->user;
		if(isset($user)){
			$cart_items = $this->input->post('cart');
			if(isset($cart_items) && $cart_items!=''){
				$cart = json_decode($cart_items);
				$total_amount = 0;
				forEach($cart as $c){
					$total_amount += $c->quantity * $c->price;
				} 
				$this->load->model('walletModel');
				$this->load->library('session');

				$user = $this->session->user;

				$user_money = $this->walletModel->get_wallet_money($user->id);

				if($total_amount <= $user_money->amount){
					$this->load->model('cartModel');
					$this->cartModel->pay($user->id,$total_amount,$cart);
					redirect(base_url('cart?success'));
				}else{
					redirect(base_url('cart?error'));
				}
			}
		}else{
			redirect(base_url('user/account/login?loggin'));
		}
	}
}
