<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Payment;
require DIR_EXTENSION.'purpletree_multivendor/system/library/stripe/vendor/autoload.php';
require DIR_EXTENSION.'purpletree_multivendor/system/library/stripe/vendor/stripe/stripe-php/init.php';

class PtsStripe extends \Opencart\System\Engine\Controller {
	public function index() {
		if ($this->config->get('payment_pts_stripe_debug')) {
				 $this->log->write('init Purpletre Stripe payment method');
		 }
		
		$this->load->language('extension/purpletree_multivendor/payment/pts_stripe');

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		if ($order_info) {
			$data['business'] = $this->config->get('payment_pp_adaptive_email');
			$data['item_name'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

			$data['products'] = array();

			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();

				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
						
						if ($upload_info) {
							$value = $upload_info['name'];
						} else {
							$value = '';
						}
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value)
					);
				}

				$pts_amount=number_format($this->currency->convert((float)$product['price'], $this->config->get('config_currency'), $order_info['currency_code']), 2, '.', '')*100;

				$data['stripe_data'][] = array(
					'name'     		=> $product['name'],
					'images'   => [HTTP_SERVER.'image/'.$product['image']],
					'amount'    => $pts_amount,
					'currency'   => $order_info['currency_code'],
					'quantity' => $product['quantity'],
				);

				$data['products'][] = array(
					'name'     => htmlspecialchars($product['name']),
					'model'    => htmlspecialchars($product['model']),
					'price'    => $this->currency->format($product['price'], $order_info['currency_code'], false, false),
					'quantity' => $product['quantity'],
					'option'   => $option_data,
					'weight'   => $product['weight']
				);
			}
			
	////  totals		
			$totals = [];
		$taxes = $this->cart->getTaxes();
		$total = 0;

		$this->load->model('checkout/cart');

		($this->model_checkout_cart->getTotals)($totals, $taxes, $total);
		
			$sort_order = array();

			foreach ($totals as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $totals);

			if(!empty($totals)){
				foreach($totals as $key=>$value){
				$order_data['totals'][$value['code']][] = $value;	
				}
			}
 
			$sub_total = $order_data['totals']['sub_total'][0]['value'];
			$grand_total = $order_data['totals']['total'][0]['value'];
			
			unset($order_data['totals']['sub_total']);
			unset($order_data['totals']['total']);

			$total_details=0;	
			$total_discount=0;	

			foreach($order_data['totals'] as $key=>$val){
				foreach($val as $key1=>$val1){
					$value = $val1['value'];
					if($value < 0){				
						$total_discount -= $value;
					} else {
						$total_details  += $value;
					}					
				}
			}
		if($sub_total < $total_discount){	
		$this->load->language('extension/purpletree_multivendor/payment/pts_stripe');
			$data['stripe_data'][] = array(
					'name'      => $this->language->get('text_shipping_and_other'),
					'amount'    => $total_details*100,
					'currency'  => $order_info['currency_code'],
					'quantity'  => 1,
				);  
		}

			$data['discount_amount_cart'] = 0;

			$total = $order_info['total'] - $this->cart->getSubTotal();

			$data['currency_code'] = $order_info['currency_code'];
			$data['first_name'] = $order_info['payment_firstname'];
			$data['last_name'] = $order_info['payment_lastname'];
			$data['address1'] = $order_info['payment_address_1'];
			$data['address2'] = $order_info['payment_address_2'];
			$data['city'] = $order_info['payment_city'];
			$data['zip'] = $order_info['payment_postcode'];
			$data['country'] = $order_info['payment_iso_code_2'];
			$data['email'] = $order_info['email'];
			$data['invoice'] = $this->session->data['order_id'] . ' - ' . $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'];
			//$data['lc'] = $this->session->data['language'];
			$data['return'] = $this->url->link('checkout/success','payment=paypalpayout',true);
			$data['notify_url'] = $this->url->link('extension/payment/pp_adaptive/callback', '', true);
			$data['cancel_return'] = $this->url->link('checkout/checkout', '', true);

			if (!$this->config->get('payment_pp_adaptive_transaction')) {
				$data['paymentaction'] = 'authorization';
			} else {
				$data['paymentaction'] = 'sale';
			}

			$data['custom'] = $this->session->data['order_id'];

	$stripe_status = $this->config->get('payment_pts_stripe_status');
	if($stripe_status and ($grand_total > 0)){

		$payment_mode = $this->config->get('payment_pts_stripe_payment_mode');
		if ($this->config->get('payment_pts_stripe_debug')) {
				$pmt_mode='Test';
			if($payment_mode){
				$pmt_mode='Live';
			}
			$this->log->write('Payment Mode' .$pmt_mode);
		}
		$stripe = array();
		if($payment_mode){
			$stripe = array(
			  "secret_key"      => $this->config->get('payment_pts_stripe_secret_key_live'),
			  "publishable_key" => $this->config->get('payment_pts_stripe_publish_key_live')
			);
		} else {
			$stripe = array(
			  "secret_key"      => $this->config->get('payment_pts_stripe_secret_key_test'),
			  "publishable_key" => $this->config->get('payment_pts_stripe_publish_key_test')
			);
		}
		if ($this->config->get('payment_pts_stripe_debug')) {
			$this->log->write('Secret Key: ' .$stripe['secret_key']);
			$this->log->write('Publishable Key: ' .$stripe['publishable_key']);
		}
	if(!empty($stripe['secret_key'])){
		try {
	if($grand_total > 0){
		\Stripe\Stripe::setApiVersion('2019-08-14');
		\Stripe\Stripe::setApiKey($stripe['secret_key']);
		$stripe = new \Stripe\StripeClient($stripe['secret_key']);

	$name=$order_info['firstname'].' '.$order_info['lastname'];
	$customer = $stripe->customers->create([
		  'name' => $name,
		  'phone' => $order_info['telephone'],
		  'email' => $order_info['email'],
		  'description' => 'Customer information',
		  'address' => [
		  'line1' => $order_info['payment_address_1'],
		  'line2' => $order_info['payment_address_2'],
		  'city' => $order_info['payment_city'],
		  'state' => $order_info['payment_zone'],
		  'country' => $order_info['payment_country'],
		  'postal_code' => $order_info['payment_postcode'] 
		  ],
		]);
		

		$checkout_session_data = [
		  'payment_method_types' => ['card'],
		  'line_items' => [$data['stripe_data']],
		  'metadata' => ['order_id' => $this->session->data['order_id']],
		  'success_url' => $this->url->link('extension/purpletree_multivendor/payment/pts_stripe|callback&order_id='.$this->session->data['order_id'], '', true),
		  'cancel_url' => $this->url->link('checkout/checkout'),
		  'customer_email' => $order_info['email'],
		];
if($total_details > 0){
if($sub_total >= $total_discount){
	$checkout_session_data['shipping_options'] = [
      [
        'shipping_rate_data' => [
          'type' => 'fixed_amount',
          'fixed_amount' => [
            'amount' => $total_details*100,
            'currency' => $order_info['currency_code'],
          ],
          'display_name' => $this->language->get('text_and_other'),
        ]
		]];
} 
} 

	if($total_discount > 0){
		$stripe = $stripe->coupons->create([
				  'name' => $this->language->get('text_coupon_and_other_discount'),
				  'amount_off' => $total_discount*100,
				  'currency' => $order_info['currency_code']
				]);
		$coupon = $stripe->coupons->retrieve($stripe['id'],[]);
		$coupon_id = $coupon['id'];
		
	$checkout_session_data['discounts'] = [
	['coupon' => $coupon_id]
	];
	} 
		$session = $stripe->checkout->sessions->create($checkout_session_data);
	}
		} 
		catch(Exception $e) {
			if ($this->config->get('payment_pts_stripe_debug')) {
				  $this->log->write('Message:' .$e->getMessage());
			}
		}
	}
	try{	

	$this->session->data['payment_intent']='';
	if(isset($session['payment_intent'])){
	$this->session->data['payment_intent']=$session['payment_intent'];
	if ($this->config->get('payment_pts_stripe_debug')) {
			 $this->log->write('Payment intent:' .$this->session->data['payment_intent']);
		}
	}
	
		$data['session_id']='';
	if(isset($session['id'])){
	$data['session_id']=$session['id'];
		if ($this->config->get('payment_pts_stripe_debug')) {
			 $this->log->write('Session Id:' .$session['id']);
		}
	}
	
	if(!$this->session->data['payment_intent']){
		throw new Exception("Payment intent is not found");
	}
	
	if(!$data['session_id']){
		throw new Exception("Session Id is not found");
	}
	$data['secret_key']=$this->config->get('payment_pts_stripe_secret_key_test');
	$data['publishable_key']=$this->config->get('payment_pts_stripe_publish_key_test');
	    if($payment_mode){
		    $data['secret_key']=$this->config->get('payment_pts_stripe_secret_key_live');
	        $data['publishable_key']=$this->config->get('payment_pts_stripe_publish_key_live');
			}else{
			$data['secret_key']=$this->config->get('payment_pts_stripe_secret_key_test');
	        $data['publishable_key']=$this->config->get('payment_pts_stripe_publish_key_test');
	 }

	} 
	catch(Exception $e){
		if ($this->config->get('payment_pts_stripe_debug')) {
				  $this->log->write('Message:' .$e->getMessage());
		 }
	}

	return $this->load->view('extension/purpletree_multivendor/payment/pts_stripe', $data);
	}
//api
		}
	}

	public function callback() {

		if ($this->config->get('payment_pts_stripe_debug')) {
			$this->log->write('Redirect to callback method');
		}			

		$payment_mode = $this->config->get('payment_pts_stripe_payment_mode');
		if ($this->config->get('payment_pts_stripe_debug')) {
				$pmt_mode='Test';
			if($payment_mode){
				$pmt_mode='Live';
			}
			$this->log->write('Payment Mode' .$pmt_mode);
		}
		$stripe = array();
		if($payment_mode){
			$stripe = array(
			  "secret_key"      => $this->config->get('payment_pts_stripe_secret_key_live'),
			  "publishable_key" => $this->config->get('payment_pts_stripe_publish_key_live')
			);
		} else {
			$stripe = array(
			  "secret_key"      => $this->config->get('payment_pts_stripe_secret_key_test'),
			  "publishable_key" => $this->config->get('payment_pts_stripe_publish_key_test')
			);
		}
	try{
		\Stripe\Stripe::setApiVersion('2019-08-14');
		\Stripe\Stripe::setApiKey($stripe['secret_key']);
		
		
		$stripe = new \Stripe\StripeClient($stripe['secret_key']);
		
		$intent = $stripe->paymentIntents->retrieve($this->session->data['payment_intent'],[]);
		$this->load->model('checkout/order');
		$order_id=(int)$this->request->get['order_id'];
		$order_info = $this->model_checkout_order->getOrder((int)$order_id);

		if(!empty($intent)){

			switch($intent['status']) {
					case 'succeeded':
						$order_status_id = $this->config->get('payment_pts_stripe_completed_status_id');
						break;	
				}
				$this->model_checkout_order->addHistory($order_id, $order_status_id);
				if($intent['status']=='succeeded'){
	
				$this->invoiceGenerate($order_id);

			
		$this->load->model('extension/purpletree_multivendor/payment/pts_stripe');
		$comm_data= $this->model_extension_purpletree_multivendor_payment_pts_stripe->getCommissionData($order_id);

		if(!empty($comm_data)){
				if ($this->config->get('payment_pts_stripe_debug')) {
				$this->log->write($comm_data);
			}
			foreach($comm_data as $data){
			$invoice_id = $this->model_extension_purpletree_multivendor_payment_pts_stripe->getInvoieId($data['order_id'],$data['seller_id']);	
			
			 $invoiceData = $this->model_extension_purpletree_multivendor_payment_pts_stripe->getInvoieData($invoice_id);	

			 $accountId = $this->model_extension_purpletree_multivendor_payment_pts_stripe->getStripeAccountID($data['seller_id']);
			 $messageseller='';
			// $pay_amount= number_format((float)$invoiceData['total_pay_amount'], 2, '.', '')*100;
			if ($this->config->get('payment_pts_stripe_debug')) {
				$this->log->write('accountId:' .$accountId);
				$this->log->write('pay_amount:' .$this->session->data['currency'].$invoiceData['total_pay_amount']);
			}
			try {
				$pay_amount=number_format($this->currency->convert((float)$invoiceData['total_pay_amount'], $this->config->get('config_currency'), $this->session->data['currency']), 2, '.', '')*100;
				
				$this->log->write('-------Transfer start--------');	
				$transfer = $stripe->transfers->create([
				'amount' => $pay_amount,
				'currency' => $this->session->data['currency'],
				'destination' => $accountId,
				'transfer_group' => $order_id,
				]);
				
				/* $payout = \Stripe\Payout::create([
				  'amount' => $pay_amount,
				  'currency' => $this->session->data['currency'],
				], [
				  'stripe_account' => $accountId,
				]);	  */
				}
		catch(Exception $e){
			if ($this->config->get('payment_pts_stripe_debug')) {
				$this->log->write('Message:' .$e->getMessage());
			 }
			$messageseller.=$e->getMessage(); 
		}
				$status = 'Pending';
				$status_id=1;
				$msg='Seller Payment is pending';
				if(isset($payout['status'])){
				 if($payout['status']=='paid'){
					$status_id=2;
					$status='Complete';
					$msg='Seller Payment is Complete';
					} 
				} 
				$payoutId='';
				if(isset($payout['id'])){
					$payoutId=$payout['id'];
				}
				$messageseller.=$msg;
				 $transData=array(
							'invoice_id'		=> $invoice_id,
							'seller_id'			=> $data['seller_id'],
							'transaction_id'	=> $payoutId,
							'amount'			=> $invoiceData['total_pay_amount'],
							'payment_mode'		=> 'Online',
							'status'			=> $status,
							'status_id'			=> $status_id,
							'comment'			=> $messageseller,
							); 
							if ($this->config->get('payment_pts_stripe_debug')) {
				$this->log->write($transData);
			}
				$this->model_extension_purpletree_multivendor_payment_pts_stripe->saveTranDetail($transData);
				$this->model_extension_purpletree_multivendor_payment_pts_stripe->saveTranHistory($transData); 
			}
				}
				}
				$this->response->redirect($this->url->link('checkout/success'));
			} else {
				$this->model_checkout_order->addHistory($order_id, $this->config->get('config_order_status_id'));
				$this->response->redirect($this->url->link('checkout/success'));
			}
	} 
	catch(Exception $e){
			if ($this->config->get('payment_pts_stripe_debug')) {
					  $this->log->write('Message:' .$e->getMessage());
			 }
	}
}

public function invoiceGenerate($order_id=''){
		$this->load->model('extension/purpletree_multivendor/payment/pts_stripe');
		$comm_data= $this->model_extension_purpletree_multivendor_payment_pts_stripe->getCommissionData($order_id);

		if(!empty($comm_data)){
			foreach($comm_data as $commissionData){
				$commisionss[$commissionData['id']]=$commissionData['order_id'];
			}
		}
					try {
					$commisioninvoiceids = array();
					$so_id = array();
					$uniqueSoId=array();
					$total_price =array();
					$total_commission=array();
					if(!empty($commisionss)) {
						foreach ($commisionss as $commisionid => $order_id) {
							$commisionssss = $this->model_extension_purpletree_multivendor_payment_pts_stripe->getCommissionsforinvoide($commisionid);
							$so_id[] = array('seller_id'=> $commisionssss['seller_id'],
							'order_id'=> $commisionssss['order_id']
							);
							$total_commission[$commisionssss['seller_id']][]=$commisionssss['commission'];
						}
						$uniqueSoId=array_unique($so_id,SORT_REGULAR);
						foreach($uniqueSoId as $vvvv){
							$total_price[$vvvv['seller_id']][]= $this->model_extension_purpletree_multivendor_payment_pts_stripe->getCommissionTotal($vvvv['order_id'],$vvvv['seller_id']);
						}
						
						$t_comm=array();
						if(!empty($total_commission)){
							foreach($total_commission as $vk=>$vv){
								$t_commission=0;
								foreach($vv as $vkk=>$vvv){
									$t_commission+=$vvv;	
								}
								$t_comm[$vk]=$t_commission;	
							}
						}
						
						$t_total=array();
						if(!empty($total_price)){
							foreach($total_price as $vk1=>$vv1){
								$t_tot=0;
								foreach($vv1 as $vkk2=>$vvv2){
									$t_tot+=$vvv2;	
								}
								$t_total[$vk1]=$t_tot;	
							}
							
						}
						if(!empty($t_comm)){
							foreach($t_comm as $seller_idd=>$seller_commm){
								$total_price=$t_total[$seller_idd];
								$total_pay_amount=$total_price-$seller_commm;
								
								$linkid[$seller_idd] = $this->model_extension_purpletree_multivendor_payment_pts_stripe->savelinkid($total_price,$seller_commm,$total_pay_amount);
							}
						}
						foreach ($commisionss as $commisionid => $order_id) {
							$commisionsss = $this->model_extension_purpletree_multivendor_payment_pts_stripe->getCommissionsforinvoide($commisionid);
							
							if(!empty($commisionsss)) {
								if($commisionsss['order_id'] == $order_id && $commisionsss['invoice_status'] == 0) {
									$linkidd=$linkid[$commisionsss['seller_id']];
									$this->model_extension_purpletree_multivendor_payment_pts_stripe->saveCommisionInvoice($commisionsss,$linkidd);

								}
							} 
						}
					}
					} catch (Exception $e) {
					$this->error['warning'] = $e->getMessage();
				}
}

}
?>